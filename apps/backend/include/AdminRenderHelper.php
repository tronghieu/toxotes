<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nobita
 * Date: 4/27/13
 * Time: 4:02 PM
 * To change this template use File | Settings | File Templates.
 */

use Flywheel\Factory;

class AdminRenderHelper {
    public static function addFormJS($doc = null) {
        if (null == $doc) {
            $doc = Factory::getDocument();
        }

        $doc->addJs(array(
            'js/plugins/ui/jquery.mousewheel.js',
            'js/plugins/forms/jquery.uniform.min.js',
            'js/plugins/forms/jquery.autosize.js',
            'js/plugins/forms/jquery.inputlimiter.min.js',
            'js/plugins/forms/jquery.tagsinput.min.js',
            'js/plugins/forms/jquery.inputmask.js',
            'js/plugins/forms/jquery.select2.min.js',
            'js/plugins/forms/jquery.listbox.js',
            'js/functions/forms.js'
        ), 'TOP');
    }

    public static function addTableJs($doc = null) {
        if (null == $doc) {
            $doc = Factory::getDocument();
        }
    }
}