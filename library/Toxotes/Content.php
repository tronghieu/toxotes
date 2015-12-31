<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 1/23/15
 * Time: 11:18 AM
 */

namespace Toxotes;


use Flywheel\Finder\Finder;

class Content {
    public static $termPropertyOpt = [];

    /**
     * Add term property option
     * @param $pid
     * @param $property
     * @param $taxonomy
     */
    public static function addTermPropertyOpt($pid, $property, $taxonomy) {
        self::$termPropertyOpt[$taxonomy][$pid] = $property;
    }

    /**
     * Get all term property option
     * @param $taxonomy
     * @return array
     */
    public static function getTermPropertiesOpt($taxonomy) {
        return isset(self::$termPropertyOpt[$taxonomy])? self::$termPropertyOpt[$taxonomy] : [] ;
    }

    /**
     * Get post's template
     * @return array
     */
    public static function getPostTemplates() {
        static $files = [];
        if (empty($files)) {
            $config = require(FRONTEND_DIR .'/Config/main.cfg.php');
            $template = isset($config['template'])? $config['template'] : 'Default';
            $templateDir = FRONTEND_DIR .'/Template/' .$template.'/Controller/Post/';
            if (is_dir($templateDir)) {
                $finder = new Finder();
                $finder->files()->name('*.phtml')->in($templateDir);
                foreach($finder as $file) {
                    $option = str_replace('.phtml', '', $file->getFilename());
                    $files[] = [
                        'label' => $option,
                        'value' => $option,
                    ];
                }
            }
        }
        return $files;
    }

    /**
     * Get category's template
     * @return array
     */
    public static function getCategoryTemplates()
    {
        static $files = [];
        if (empty($files)) {
            $config = require(FRONTEND_DIR .'/Config/main.cfg.php');
            $template = isset($config['template'])? $config['template'] : 'Default';
            $templateDir = FRONTEND_DIR .'/Template/' .$template.'/Controller/Category/';
            if (is_dir($templateDir)) {
                $finder = new Finder();
                $finder->files()->name('*.phtml')->in($templateDir);
                foreach($finder as $file) {
                    $option = str_replace('.phtml', '', $file->getFilename());
                    $files[] = [
                        'label' => $option,
                        'value' => $option,
                    ];
                }
            }
        }
        return $files;
    }
}