<?php
use Flywheel\Db\Expression;

/**
 * WithdrawVoucher
 *  This class has been auto-generated at 14/12/2012 23:30:49
 * @version		$Id$
 * @package		Model

 */

require_once dirname(__FILE__) .'/Base/WithdrawVoucherBase.php';
class WithdrawVoucher extends \WithdrawVoucherBase {
    const STATUS_INIT = 'INIT',
        STATUS_SUSPENDED = 'SUSPENDED',
        STATUS_CANCELLED = 'CANCELLED',
        STATUS_FINISHED = 'FINISHED',
        STATUS_EXPIRED = 'EXPIRED';

    public $keepVersion = false;
    public $checksumFieldName = 'crc';
    public $checksumFields= array('uk', 'acc_id', 'currency','amount', 'status', 'charged_fee', 'total_fee');

    public $reload = false;

    public function init() {
        parent::init();
        self::setReadMode(\Flywheel\Db\Manager::__MASTER__);
    }

    protected function _beforeSave() {
        parent::_beforeSave();
        if ($this->isNew()) {
            $loop = 0;
            do {
                $uk = \ModelPeer::generateUk('WIT', $this);
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

    public function reload() {
        if ($this->reload) {
            parent::reload();
            self::addInstanceToPool($this, $this->uk);
            $this->reload = false;
        }
    }

    /**
     * @param $uk
     * @return \WithdrawVoucher|bool
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
     * @return DepositVoucher|bool
     */
    public static function retrieveById($id) {
        if (null == $id)
            return false;

        $objs = self::getInstancesFromPool();
        if (!empty($objs)) {
            foreach ($objs as $obj) {
                /* @var WithdrawVoucher $account */
                if ($id == $obj->id) return $obj;
            }
        }

        $obj = self::findOneById((int) $id);
        if ($obj)
            self::addInstanceToPool($obj, $obj->uk);
        return $obj;
    }

    /**
     * Check voucher exist, valid checksum, in NORMAL state and not is a FINISHED or CANCELLED
     *
     * @param $id
     * @param $message
     * @return WithdrawVoucher|bool
     * @throws Flywheel\Exception\Api
     */
    public static function checkForTransferById($id, &$message) {
        $voucher = self::retrieveById($id);
        if (!$voucher) {
            $message[] = 'Not found any deposit voucher with id ' .$id;
            return false;
        }

        return self::_check($voucher, $message);
    }

    /**
     * Check voucher exist, valid checksum, in NORMAL state and not is a FINISHED or CANCELLED
     *
     * @param $uk
     * @param $message
     * @param bool $exceptFinish
     * @return WithdrawVoucher|bool
     */
    public static function checkForTransferByUk($uk, &$message, $exceptFinish = false)
    {
        $voucher = self::retrieveByUk($uk);
        if (!$voucher) {
            $message[] = array('code' => API_WIT_VOUCHER_NOT_FOUND,
                'message' => 'Not found any withdraw voucher with key ' .$uk);
            return false;
        }

        return self::_check($voucher, $message, $exceptFinish);
    }

    protected static function _check(\WithdrawVoucher $voucher, &$message, $exceptFinish = false) {
        if (!\ModelPeer::checksumCompare($voucher, $voucher->checksumFields)) {
            throw new \CoreException("Checksum not match with WithdrawVoucher: " .$voucher->toJSon(), 500);
        }

        //check status
        if (true != $exceptFinish && self::STATUS_FINISHED == $voucher->status) {
            $message[] = array('code' => API_WITH_VOUCHER_HAS_BEEN_FINISHED,
                'message' => "Voucher[{$voucher->uk}] has been finished.");
            return $voucher;
        }
        if (self::STATUS_CANCELLED == $voucher->status) {
            $message[] = array('code' => API_WIT_VOUCHER_HAS_BEEN_CANCELED,
                'message' => "Voucher[{$voucher->uk}] has been cancelled.");
            return $voucher;
        }

        //check expire
        if (self::STATUS_EXPIRED == $voucher->status ||
            (self::STATUS_INIT == $voucher->status
                && null != $voucher->expired_time
                && '0000-00-00 00:00:00' != $voucher->expired_time)) {
            if (new DateTime($voucher->expired_time) < new DateTime()) {
                $message[] = array(
                    'code' => API_WIT_VOUCHER_HAS_BEEN_EXPIRED,
                    'message' => "Voucher[{$voucher->uk}] has been expired.");
                return $voucher;
            }
        }

        return $voucher;
    }
}