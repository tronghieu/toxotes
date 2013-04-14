<?php 
/**
 * DepositFee
 *  This class has been auto-generated at 18/12/2012 06:01:45
 * @version		$Id$
 * @package		Model

 */

require_once dirname(__FILE__) .'/Base/DepositFeeBase.php';
class DepositFee extends \DepositFeeBase {
    public function init() {
        parent::init();
        self::setReadMode(\Flywheel\Db\Manager::__MASTER__);
    }
}