<?php
use Flywheel\Document\Html;

$assets_folder = 'assets/flat/';
/** @var Html $document */
$document = $this->document();
$document->cssBaseUrl = $assets_folder;
$document->jsBaseUrl = $assets_folder;

//add css
$document->addCss('css/bootstrap.min.css');
$document->addCss('css/plugins/jquery-ui/jquery-ui.min.css');
$document->addCss('css/plugins/nprogress/nprogress.css');
$document->addCss('css/style.css');
$document->addCss('css/theme.css');
$document->addCss('css/custom.css');
//$document->addCss('css/editor.css');

//Add
$document->addJs('js/jquery.min.js', 'TOP');
$document->addJs('js/bootstrap.min.js', 'TOP');
$document->addJs('js/plugins/nicescroll/jquery.nicescroll.min.js', 'TOP');
$document->addJs('js/plugins/jquery-ui/jquery-ui.js', 'TOP');
$document->addJs('js/plugins/slimscroll/jquery.slimscroll.min.js', 'TOP');
$document->addJs('js/plugins/nprogress/nprogress.js', 'TOP');
$document->addJs('js/plugins/form/jquery.form.min.js', 'TOP');
$document->addJs('js/plugins/bootbox/bootbox.min.js', 'TOP');
$document->addJs('js/plugins/autoNumeric/autoNumeric.js', 'TOP');
$document->addJs('js/eakroko.min.js', 'TOP');
$document->addJs('js/application.min.js', 'TOP');