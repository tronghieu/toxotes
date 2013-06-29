<?php
namespace Toxotes;

use Flywheel\Loader;

class Block {
    public static function loadBlocks($position) {
    }

    /**
     * @param $path
     * @param $owner
     * @throws Exception
     * @return Widget
     */
    public static function loadWidget($path, $owner) {
        $className = end(explode('.', $path));
        Loader::import($path.'.'.$className, true);
        $class = new $className();
        if (!($class instanceof Widget)) {
            throw new Exception("{$className} not is \\Toxotes\\Widget instance");
        }

        $class->setOwner($owner);

        return $class;
    }
}