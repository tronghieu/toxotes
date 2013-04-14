<?php 
/**
 * CosData
 *  This class has been auto-generated at 04/02/2013 17:00:43
 * @version		$Id$
 * @package		Model

 */

require_once dirname(__FILE__) .'/Base/CosDataBase.php';
class CosData extends \CosDataBase {
    public function setTableDefinition() {
        parent::setTableDefinition();
        self::$_dbConnectName = Cos::getDbConnectName();
    }
}