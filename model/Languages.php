<?php 
/**
 * Languages
 * @version		$Id$
 * @package		Model

 */

require_once dirname(__FILE__) .'/Base/LanguagesBase.php';
class Languages extends \LanguagesBase {
    /**
     * get all languages
     * @param null $assoc_key
     * @return Languages[]
     */
    public static function getAllLanguages($assoc_key = null) {
        $result = [];
        $stmt = self::read()->orderBy('ordering', 'DESC')->execute();
        while($row = $stmt->fetchObject(self::getPhpName(), [null, false])) {
            if (!$assoc_key) {
                $result[] = $row;
            } else {
                $result[$row->$assoc_key] = $row;
            }
        }

        return $result;
    }

    /**
     * Get all active languages
     * @param null $assoc_key
     * @return array
     */
    public static function getAllActiveLanguages($assoc_key = null) {
        $result = [];
        $stmt = self::read()->where('`published` = 1')->orderBy('ordering', 'DESC')->execute();
        while($row = $stmt->fetchObject(self::getPhpName(), [null, false])) {
            if (!$assoc_key) {
                $result[] = $row;
            } else {
                $result[$row->$assoc_key] = $row;
            }
        }

        return $result;
    }
}