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
        $t = explode('.', $path);
        $className = end($t);
        Loader::import($path.'.'.$className, true);
        /** @var Widget $class */
        $class = new $className();
        $class->setName($className);
        if (!($class instanceof Widget)) {
            throw new Exception("{$className} not is \\Toxotes\\Widget instance");
        }

        $class->setOwner($owner);

        return $class;
    }

    /**
     * @param $position
     * @param null $lang
     * @return \Toxotes\Widget[]
     */
    public static function getBlocksByPosition($position, $lang = null) {
        $q = \WidgetBlock::select()->where('`position` = :pos')
                ->setParameter(':pos', $position, \PDO::PARAM_STR)
                ->andWhere('`status` = :status')
                ->setParameter(':status', 'ACTIVE', \PDO::PARAM_STR)
                ->orderBy('ordering');

        if ($lang != '*' && '' != $lang) {
            $q->andWhere('`language` = "*" OR `language` = :lang')
                ->setParameter(':lang', $lang, \PDO::PARAM_STR);
        }

        /** @var \WidgetBlock[] $widgets */
        $widgets = $q->execute();

        $result = array();

        foreach($widgets as $widget) {
            $widgetx = self::loadWidget($widget->getPath(), $widget);
            $result[] = $widgetx;
        }

        return $result;
    }
}