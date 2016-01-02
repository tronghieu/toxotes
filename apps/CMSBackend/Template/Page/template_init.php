<?php
use Flywheel\Document\Html;

$assets_folder = 'templates/pages.revox.io/';
/** @var Html $document */
$document = $this->document();
$document->cssBaseUrl = $assets_folder;
$document->jsBaseUrl = $assets_folder;


$document->addJs('assets/plugins/jquery/jquery-1.11.1.min.js','TOP');
############################################
##########Plugin js dùng chung##############
############################################
$document->addJs('assets/common.js');
$document->addJs('assets/plugins/boostrapv3/js/bootstrap.min.js');
$document->addJs('assets/plugins/pace/pace.min.js');
$document->addJs('assets/plugins/modernizr.custom.js');
$document->addJs('assets/plugins/jquery-ui/jquery-ui.min.js');
$document->addJs('assets/plugins/jquery/jquery-easy.js');
$document->addJs('assets/plugins/jquery-unveil/jquery.unveil.min.js');
$document->addJs('assets/plugins/jquery-bez/jquery.bez.min.js');
$document->addJs('assets/plugins/jquery-ios-list/jquery.ioslist.min.js');
$document->addJs('assets/plugins/jquery-actual/jquery.actual.min.js');
$document->addJs('assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js');
$document->addJs('assets/plugins/bootstrap-select2/select2.min.js');
$document->addJs('assets/plugins/classie/classie.js');
$document->addJs('assets/plugins/switchery/js/switchery.min.js');
$document->addJs('assets/js/scripts.js');
$document->addJs('assets/js/theme_switcher.js');
$document->addJs('pages/js/pages.min.js');
$document->addJs('assets/js/scripts.js');
$document->addJs('assets/process/paginator.js');
$document->addJs('assets/plugins/bootbox/bootbox.min.js');
####################################################
################ Thêm css js########################
####################################################
#$document->addJs('assets/plugins/switchery/css/switchery.min.css');
$document->addCss('assets/plugins/boostrapv3/css/bootstrap.min.css');
$document->addCss('assets/plugins/pace/pace-theme-flash.css');
$document->addCss('assets/plugins/font-awesome/css/font-awesome.css');
$document->addCss('assets/plugins/jquery-scrollbar/jquery.scrollbar.css');
$document->addCss('assets/plugins/bootstrap-select2/select2.css');
$document->addCss('assets/plugins/switchery/css/switchery.min.css');
$document->addCss('pages/css/pages-icons.css');
$document->addCss('pages/css/pages.css');