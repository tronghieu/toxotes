<?php
use Flywheel\Db\Expression;

/**
 * Account
 *  This class has been auto-generated at 14/12/2012 11:13:09
 * @version		$Id$
 * @package		Model
 * @copyright		VCCorp (c) 2010
 */

require_once dirname(__FILE__) .'/Base/AccountBase.php';
class Account extends \AccountBase {
    const STATUS_NORMAL = 'NORMAL',
        STATUS_FROZEN = 'FROZEN',
        STATUS_DELETED = 'DELETED',
        TYPE_NORMAL = 'NORMAL',
        TYPE_PARTNER = 'PARTNER',
        TYPE_SYSTEM = 'SYSTEM',
        TYPE_FEE = 'FEE';

    public static $supportCurrency = array('VND', 'USD', 'CNY');
    public static $supportStatues = array('NORMAL', 'FROZEN', 'DELETED');

    public $keepVersion = false;
    public $checksumFieldName = 'crc';
    public $checksumFields= array('uk', 'currency', 'balance', 'frozen_balance', 'status', 'type');

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
                $uk = \ModelPeer::generateUk('ACC', $this);
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
     * @return \Account|bool
     */
    public static function retrieveByUk($uk) {
        if (null == $uk) {
            return false;
        }

        if (null != ($obj = self::getInstanceFromPool($uk))) {
            return $obj;
        }

        $obj = self::findOneByUk($uk);
        /* @var \Account $obj */
        if ($obj)
            self::addInstanceToPool($obj, $obj->uk);
        return $obj;
    }

    /**
     * @param $id
     * @return Account|bool
     */
    public static function retrieveById($id) {
        if (null == $id)
            return false;

        $accounts = self::getInstancesFromPool();
        if (!empty($accounts)) {
            foreach ($accounts as $account) {
                /* @var Account $account */
                if ($id == $account->id) return $account;
            }
        }

        $account = self::findOneById((int) $id);
        if ($account)
            self::addInstanceToPool($account, $account->uk);
        return $account;
    }

    /**
     * @param $currency
     * @return bool
     */
    public static function checkCurrencySupported($currency) {
        if (in_array(strtoupper($currency), self::$supportCurrency))
            return true;

        return false;
    }

    /**
     * Check account exist, valid checksum, in NORMAL state and not is a FEE and SYSTEM TYPE
     *
     * @param $uk
     * @param $message
     * @return Account|bool
     * @throws Flywheel\Exception\Api
     */
    public static function checkForTransferByUk($uk, &$message) {
        $acc = self::retrieveByUk($uk);
        if (!$acc) {
            $message[] = array(
                'code' => API_ACCOUNT_NOT_FOUND,
                'message' => 'Not found any account with key ' .$uk
            );
            return false;
        }

        return self::_check($acc, $message);
    }

    /**
     * Check account exist, valid checksum, in NORMAL state and not is a FEE and SYSTEM TYPE
     *
     * @param $id
     * @param $message
     * @return Account|bool
     * @throws Flywheel\Exception\Api
     */
    public static function checkForTransferById($id, &$message) {
        $acc = \Account::retrieveById($id);
        if (!$acc) {
            $message[] = array(
                'code' => API_ACCOUNT_NOT_FOUND,
                'message' => 'Not found any account with id ' .$id);
            return false;
        }

        return self::_check($acc, $message);
    }

    protected static function _check(\Account $acc, &$message) {
        if (!\ModelPeer::checksumCompare($acc, $acc->checksumFields)) {
            throw new \CoreException("Checksum not math with Account:" .$acc->toJSon(), 500);
        }

        if (\Account::STATUS_FROZEN == $acc->status) {
            $message[] = array(
                'code' => API_ACCOUNT_HAS_BEEN_FROZEN,
                'message' => "Account[{$acc->uk}] is in FROZEN state");
            return $acc;
        }
        if (\Account::STATUS_DELETED == $acc->status
            || $acc->type == \Account::TYPE_SYSTEM || $acc->type == \Account::TYPE_FEE) {
            $message[] = array(
                'code' => API_ACCOUNT_WAS_DELETED,
                'message' => "Account[{$acc->uk}] has not existed or has been deleted");
            return $acc;
        }

        if (\Account::STATUS_NORMAL != $acc->status) {
            $message[] = array(
                'code' => API_ACCOUNT_NOT_IN_NORMAL_STATE,
                'message' => "Account[{$acc->uk}] isn't in NORMAL state");
            return $acc;
        }

        return $acc;
    }

    protected function _changeBalance($amount, $add = true) {
        $this->reload = true;
        $this->beginTransaction();
        $operator = ($add)? '+' : '-';
        $q = "UPDATE account a SET a.balance = a.balance {$operator} ? WHERE a.id = ?";
        if (false !== self::getWriteConnection()->executeUpdate($q, array($amount, $this->id))) {
            $this->commit();
            //update crc
            $this->reload();
//            $this->crc = ModelPeer::generateCrc($this, $this->checksumFields);
//            $this->keepVersion = true;
            $this->save();
            $this->reload();
            return true;
        }
        $this->rollBack();
        return false;
    }

    protected function _changeFrozenBalance($amount, $add = true) {
        $this->reload = true;
        $this->beginTransaction();
        $operator = ($add)? '+' : '-';
        $q = "UPDATE account a SET a.frozen_balance = a.frozen_balance {$operator} ? WHERE a.id = ?";
        if (false !== self::getWriteConnection()->executeUpdate($q, array($amount, $this->id))) {
            $this->commit();
            //update crc
            $this->reload();
//            $this->crc = ModelPeer::generateCrc($this, $this->checksumFields);
            $this->save();
            $this->reload();
            return true;
        }
        $this->rollBack();
        return false;
    }

    public function plusBalance($amount) {
        return $this->_changeBalance($amount);
    }

    public function minusBalance($amount) {
        return $this->_changeBalance($amount, false);
    }

    public function plusFrozenBalance($amount) {
        return $this->_changeFrozenBalance($amount);
    }

    public function minusFrozenBalance($amount) {
        return $this->_changeFrozenBalance($amount, false);
    }

    public function moveFromBalanceToFrozenBalance($amount) {
        $this->reload = true;
        $this->beginTransaction();
        $q = "UPDATE account a
                SET a.frozen_balance = a.frozen_balance + ?
                 , a.balance = a.balance - ?
                WHERE a.id = ?";
        if (false !== self::getWriteConnection()
                ->executeUpdate($q, array($amount, $amount, $this->id))) {
            $this->commit();
            //update crc
            $this->reload();
//            $this->crc = ModelPeer::generateCrc($this, $this->checksumFields);
            $this->save();
            $this->reload();
            return true;
        }
        $this->rollBack();
        return false;
    }

    public function moveFromFrozenBalanceToBalance($amount) {
        $this->reload = true;
        $this->beginTransaction();
        $q = "UPDATE account a
                SET a.frozen_balance = a.frozen_balance - ?
                 , a.balance = a.balance + ?
                WHERE a.id = ?";
        if (false !== self::getWriteConnection()->executeUpdate($q, array($amount, $amount, $this->id))) {
            $this->commit();
            //update crc
            $this->reload();
//            $this->crc = ModelPeer::generateCrc($this, $this->checksumFields);
            $this->save();
            $this->reload();
            return true;
        }
        $this->rollBack();
        return false;
    }
    
    public function genUkAccount()
    {
		$uk=self::genUk();
        $test=Account::findOneByUk($uk);
		while(!empty($test)){
            $uk=$this->genUk();
            $test=Account::findOneByUk($uk);
        }
        return $uk;
    }
    
     function genUk($length=15) {
     $characters = '0123456789QWERTYUIOPLKJHGFDSAZXCVBNM';
//     $characters ='0123456789';
     $string = '';    
     for ($p = 0; $p < $length; $p++) {
         $string .= $characters[mt_rand(0, strlen($characters)-1)];
     }
     return $string;
 }
}