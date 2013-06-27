<?php
use Flywheel\Db\Query;

class Menu extends Terms {
    /**
     * @param Query $q
     * @return Terms[]
     */
    public static function getMenuGroup(Query $q = null) {
        if (null == $q) {
            $q = Terms::read();
        }

        $root = Terms::retrieveRoot('menu');
        return $root->getChildren($q);

//        return $q->andWhere('taxonomy = :taxonomy')
//            ->andWhere('lvl=:lvl')
//            ->setParameter(':taxonomy', 'menu', \PDO::PARAM_STR)
//            ->setParameter(':lvl', 1, \PDO::PARAM_INT)
//            ->orderBy('lft')
//            ->execute()
//            ->fetchAll(\PDO::FETCH_CLASS, 'Terms', array(null, false));
    }

    /**
     * @param $menuId
     * @return Terms
     */
    public static function retrieveByPk($menuId) {
        return Terms::retrieveById($menuId);
    }
}