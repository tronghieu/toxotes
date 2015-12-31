<?php 
/**
 * TermProperty
 * @version		$Id$
 * @package		Model

 */

require_once dirname(__FILE__) .'/Base/TermPropertyBase.php';
class TermProperty extends \TermPropertyBase {
    const
        BOOLEAN = 'BOOLEAN',
        INT = 'INT',
        FLOAT = 'FLOAT',
        DATETIME = 'DATETIME',
        TEXT = 'TEXT';

    /**
     * @var \TermProperty[]
     */
    protected static $_properties = [];

    /**
     * @param $term_id
     * @return \TermProperty[] | null
     */
    public static function getTermProperties($term_id) {
        if (!isset(self::$_properties[$term_id])) {
            $stmt = self::read()
                ->where('`term_id` = :term_id')
                ->setParameter(':term_id', $term_id, \PDO::PARAM_INT)
                ->execute();
            /** @var \TermProperty $row */
            while($row = $stmt->fetchObject(self::getPhpName(), [null, false])) {
                self::$_properties[$term_id][$row->getPropertyKey()] = $row;
            }
        }

        return isset(self::$_properties[$term_id])? self::$_properties[$term_id] : [];
    }

    /**
     * @param string $term_id
     * @param string $key
     * @return null|\TermProperty
     */
    public static function getPropertyObj($term_id, $key)
    {
        $properties = self::getTermProperties($term_id);
        return isset($properties[$key])? $properties[$key] : null;
    }

    /**
     * @param $term_id
     * @param $key
     * @return null|string
     */
    public static function getTermPropertyValue($term_id, $key) {
        $obj = self::getPropertyObj($term_id, $key);
        if ($obj instanceof \TermProperty) {
            return $obj->getPropertyValue();
        }
        return null;
    }
}