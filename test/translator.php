<?php

use Symfony\Component\Translation\Loader\PhpFileLoader;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\MessageSelector;
use Symfony\Component\Translation\Loader\ArrayLoader;

require_once __DIR__ .'/../bootstrap.php';

try {

    $translator = new Translator('fr_FR', new MessageSelector());
    $translator->setFallbackLocales(array('en'));
    $translator->addLoader('php', new PhpFileLoader());
    $translator->addResource('php', ROOT_PATH .'/resource/languages/en-Us.php', 'fr');

    $name = 'Hiếu';
    echo $translator->trans('Hello World!, ' .'Hiếu')."\n";
} catch (\Exception $e) {
    print_r($e);
}