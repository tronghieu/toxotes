<?php

namespace SFS\Image;

use Flywheel\Filesystem\Image;

class Transform {
    public $source_file;
    /**
     * @var \Flywheel\Filesystem\Image
     */
    private $_manipulator;

    public function __construct($source_file = null) {
        if ($source_file) {
            $this->setSourceFile($source_file);
        }
    }

    public function crop($params) {
        $params = array_merge(array(
            'x' => 0,
            'y' => 0,
            'w' => 0,
            'h' => 0,
            'm' => 'c'
        ), $params);

        if (!$this->_manipulator) {
            throw new \Exception('Has not define source_file');
        }

        switch($params['m']) {
            case 'cc':
                return $this->_manipulator->cropFromCenter($params['w'], $params['h']);
            case 'c':
            default:
                return $this->_manipulator->crop($params['x'], $params['y'], $params['w'], $params['h']);
        }
    }

    public function resize($params) {
        $params = array_merge(array(
            'w' => 0,
            'h' => 0,
            'm' => 'r'
        ), $params);

        switch($params['m']) {
            case 'a':
                $transformMethod = 'adaptiveResize';
                break;
            case 'r':
            default:
                $transformMethod = 'resize';
        }

        if (!$this->_manipulator) {
            throw new \Exception('Has not define source_file');
        }

        $this->_manipulator->$transformMethod($params['w'], $params['h']);
    }

    public function square($params) {
        if (!$this->_manipulator) {
            throw new \Exception('Has not define source_file');
        }
        $this->_manipulator->square($params['w']);
    }

    public function save($output) {
        if (!$this->_manipulator) {
            throw new \Exception('Has not define source_file');
        }
        return $this->_manipulator->save($output);
    }

    public function display() {
        $this->_manipulator->show();
    }

    public function setSourceFile($source_file) {
        if ($source_file != $this->source_file) {
            $this->source_file = $source_file;
            $this->_manipulator = new Image($source_file);
            if ($this->_manipulator->hasError()) {
                throw new \Exception($this->_manipulator->getErrorMessage());
            }
        }
    }

    public static function hydrateParameters($input) {
        $output = array();
        for ($i = 0, $size = sizeof($input); $i < $size; ++$i) {
            $p = explode('_', $input[$i]);
            if (isset($p[1])) {
                $output[$p[0]] = $p[1];
            } else {
                $output[$p[0]] = $p[0];
            }
        }
        return $output;
    }
}