<?php
use Flywheel\Db\Expression;

/**
 * Transaction
 *  This class has been auto-generated at 14/12/2012 23:30:49
 * @version		$Id$
 * @package		Model

 */

require_once dirname(__FILE__) .'/Base/TransactionBase.php';
class Transaction extends \TransactionBase {
    const STATUS_INIT = 'INIT',
        STATUS_SUSPENDED = 'SUSPENDED',
        STATUS_CANCELLED = 'CANCELLED',
        STATUS_FINISHED = 'FINISHED',
        STATUS_EXPIRED = 'EXPIRED';
    const TYPE_TRANSFER = 'TRANSFER',
        TYPE_FEE = 'FEE',
        TYPE_REFUND = 'REFUND';

    const FEE_FOR_FROM_ACC = 'FROM_ACC',
            FEE_FOR_TO_ACC = 'TO_ACC',
            FEE_FOR_NONE = 'NONE';

    public static $feeFromAllowedValues = array(
        'NONE', 'FROM_ACC', 'TO_ACC'
    );
    public $keepVersion = false;
    public $checksumFieldName = 'crc';
    public $checksumFields= array('uk', 'currency', 'amount', 'from_acc', 'to_acc','fee_for', 'charged_fee', 'total_fee', 'status', 'relate_to');

    public $reload = false;

    public static function checkAllowFeeFor($feeFor) {
        return in_array($feeFor, self::$feeFromAllowedValues);
    }

    public function init() {
        parent::init();
        self::setReadMode(\Flywheel\Db\Manager::__MASTER__);
    }

    public function reload() {
        if ($this->reload) {
            parent::reload();
            self::addInstanceToPool($this, $this->uk);
            $this->reload = false;
        }
    }

    protected function _beforeSave() {
        parent::_beforeSave();
        if ($this->isNew()) {
            $loop = 0;
            do {
                $uk = \ModelPeer::generateUk('TRA', $this);
                $data = static::findOneByUk($uk);
                $loop++;
                if ($loop > 5) {
                    throw new \Exception('Check unique "uk" field loop many time', 500);
                }
            } while($data);
            $this->uk = $uk;
            $this->created_time = new Expression('NOW()');
        } elseif(!$this->keepVersion) {
            $this->version = new Expression('`version` + 1');
            $this->keepVersion = false;
        }
        $this->crc = \ModelPeer::generateCrc($this, $this->checksumFields);
        $this->reload = true;
    }

    protected function _afterSave() {
        parent::_afterSave();
        self::addInstanceToPool($this, $this->uk);
        self::addInstanceToPool($this, $this->id);
        $this->reload();
    }

    /**
     * @param $uk
     * @return Transaction|bool
     */
    public static function retrieveByUk($uk) {
        if (null == $uk) {
            return false;
        }

        if (null != ($obj = self::getInstanceFromPool($uk))) {
            return $obj;
        }

        $obj = self::findOneByUk($uk);
        if ($obj)
            self::addInstanceToPool($obj, $obj->uk);
        return $obj;
    }

    /**
     * @param $id
     * @return Transaction|bool
     */
    public static function retrieveById($id) {
        if (null == $id)
            return false;

        $objs = self::getInstancesFromPool();
        if (!empty($objs)) {
            foreach ($objs as $obj) {
                /* @var Transaction $account */
                if ($id == $obj->id) return $obj;
            }
        }

        $obj = self::findOneById((int) $id);
        if ($obj)
            self::addInstanceToPool($obj, $obj->uk);
        return $obj;
    }

    /**
     * @param $uk
     * @param $error
     * @param bool $exceptFinish
     * @return bool|Transaction
     */
    public static function checkForTransferByUk($uk, &$error, $exceptFinish = false)
    {
        if (!($obj = self::retrieveByUk($uk))) {
            $error[] = array(
                'code' => API_TRANSACTION_NOT_FOUND,
                'message' => "Transaction not found with key {$uk}");
            return false;
        }

        if(!($obj = self::_check($obj, $error, $exceptFinish))) {
            return $obj;
        }

        //check type
        if (self::TYPE_TRANSFER != $obj->type) {
            $error[] = array(
                'code' => API_TRAN_NOT_ALLOW_TRANSFER,
                'message' => 'Transaction type not allow for transfer');
            return $obj;
        }

        //check account status
        $fromAcc = Account::checkForTransferById($obj->from_acc, $error);
        $toAcc = Account::checkForTransferById($obj->to_acc, $error);

        return $obj;
    }

    /**
     * @param $uk
     * @param $error
     * @return bool|Transaction
     */
    public static function checkToSuspendByUk($uk, &$error) {
        if (!($obj = self::retrieveByUk($uk))) {
            $error[] = array(
                'code' => API_TRANSACTION_NOT_FOUND,
                'message' => "Transaction not found with key {$uk}"
            );
            return false;
        }

        if(!($obj = self::_check($obj, $error, true))) {
            return $obj;
        }

        return $obj;
    }

    protected static function _check(Transaction $obj, &$error, $exceptFinish = false)
    {
        if (!\ModelPeer::checksumCompare($obj, $obj->checksumFields)) {
            throw new CoreException("Checksum not math with Transaction: " .$obj->toJSon(), 500);
        }

        if (self::TYPE_TRANSFER != $obj->type) {
            $error[] = array(
                'code' => API_TRAN_NOT_TRANSFER_TRANSACTION,
                'message' => "Transaction[{$obj->uk}] is not TRANSFER transaction."
            );
            return $obj;
        }

        //check status
        if (!$exceptFinish && self::STATUS_FINISHED == $obj->status) {
            $error[] = array(
                'code' => API_TRANSACTION_HAS_BEEN_FINISHED,
                'message' => "Transaction[{$obj->uk}] has been finished.");
        }

        if (self::STATUS_CANCELLED == $obj->status) {
            $error[] = array(
                'code' => API_TRANSACTION_HAS_BEEN_CANCELED,
                'message' => "Transaction[{$obj->uk}] has been canceled.");
        }

        //check expire
        if (self::STATUS_EXPIRED == $obj->status
            || (self::STATUS_INIT == $obj->status && null != $obj->expired_time
                && '0000-00-00 00:00:00' != $obj->expired_time)) {
            if (new DateTime($obj->expired_time) < new DateTime()) {
                $error[] = array(
                    'code' => API_TRANSACTION_HAS_BEEN_EXPIRED,
                    'message' => "Transaction[{$obj->uk}] has been expired.");
                return false;
            }
        }

        return $obj;
    }
}