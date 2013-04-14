<?php 
/**
 * WithdrawFee
 *  This class has been auto-generated at 18/12/2012 06:01:48
 * @version		$Id$
 * @package		Model

 */

require_once dirname(__FILE__) .'/Base/WithdrawFeeBase.php';
class WithdrawFee extends \WithdrawFeeBase {
    public function init() {
        parent::init();
        self::setReadMode(\Flywheel\Db\Manager::__MASTER__);
    }
}