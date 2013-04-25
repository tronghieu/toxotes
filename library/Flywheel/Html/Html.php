<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nobita
 * Date: 4/25/13
 * Time: 10:06 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Flywheel\Html;

class Html {
    protected $_htmlOptions = array();

    public function setHtmlOption($options) {
        $this->_htmlOptions = array_merge_recursive($this->_htmlOptions, $options);
    }

    /**
     * @param null $htmlOptions
     * @return string
     */
    public function serializeHtmlOption($htmlOptions = null) {
        if (null == $htmlOptions) {
            $htmlOptions = $this->_htmlOptions;
        }

        $s = '';
        if (!empty($htmlOptions)) {
            foreach ($htmlOptions as $attr => $value) {
                $s .= $attr .'="' .$value .'" ';
            }
        }

        return $s;
    }
}