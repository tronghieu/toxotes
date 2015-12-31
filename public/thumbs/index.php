<?php
use Flywheel\Loader;

define('ROOT_DIR', dirname(dirname(__DIR__)));
define('MEDIA_DIR', ROOT_DIR .'/public/media');
define('PUBLIC_DIR', ROOT_DIR .'/public/');
require_once __DIR__ .'/../../vendor/autoload.php';

Loader::addNamespace('SFS', ROOT_DIR .'/library/');
Loader::register();

$app = new \Slim\Slim(array(
    'debug' => true,
    'mode' => 'development',
    /*'log.enabled' => true,
    'log.level' => \Slim\Log::DEBUG,
    'log.writer' => new \SFS\Log('default'),*/
));


$app->get('/cache/:function/:dimension/:path+', function($function, $dimension, $path) use ($app) {
    $path = implode(DIRECTORY_SEPARATOR, $path);

    $public_dir = rtrim(dirname(MEDIA_DIR), '/');

    //check file exists
    if (!file_exists($public_dir .'/' .$path)) {
        //throw 404
        $app->halt(404, 'File not found!');
    }

    try {
        $dimension = explode('-', $dimension);
        $params = \SFS\Image\Transform::hydrateParameters($dimension);
        $imgTransform = new \SFS\Image\Transform($public_dir .'/' .$path);
        if (!method_exists($imgTransform, $function)) {
            $app->halt(400, 'Not support API "' .$function .'"');
            exit;
        }
        $imgTransform->$function($params);

        $dimension = implode('-', $dimension);

        $output = "{$public_dir}/thumbs/cache/{$function}/$dimension/$path";
        \SFS\Upload::makeFileStorageDir($output);
        $imgTransform->save($output);
        $imgTransform->display();
        exit;
    } catch (\Exception $e) {
        \SFS\Log::getInstance()->error($e->getMessage() ."\nTrances:\n" . $e->getTraceAsString());
        $app->halt(500, 'Error occur:');
    }

});

$app->run();