<?php
use Flywheel\Db\Expression\Composite;
use Flywheel\Db\Expression;

/**
 * FeeConfig
 *  This class has been auto-generated at 24/12/2012 05:50:26
 * @version		$Id$
 * @package		Model

 */

require_once dirname(__FILE__) .'/Base/FeeConfigBase.php';
class FeeConfig extends \FeeConfigBase {
    const APPLY_TO_DEFAULT = 'DEFAULT',
        APPLY_TO_ACC = 'DEFINED_ACC';

    const SCOPE_DEPOSIT = 'DEPOSIT',
        SCOPE_WITHDRAW = 'WITHDRAW',
        SCOPE_TRANSFER = 'TRANSFER';

    /**
     * @param DepositVoucher $d
     * @return bool|\FeeConfig
     */
    public static function checkFeeForDeposit($d)
    {
        if ($d->isNew()) {
            $time = 'NOW()';
        } else if ($d->created_time instanceof Expression) {
            $time = $d->created_time;
        } else {
            $time = '"' .$d->created_time .'"';
        }

        //check fee apply to defined acc
        $fee = self::_filter(self::APPLY_TO_ACC, $d->acc_id, self::SCOPE_DEPOSIT,
                            $d->currency, $d->amount, $time);
        if (!$fee) { //check fee apply for all
            $fee = self::_filter(self::APPLY_TO_DEFAULT, 0, self::SCOPE_DEPOSIT,
                            $d->currency, $d->amount, $time);
        }

        return $fee;
    }

    /**
     * @param WithdrawVoucher $withdraw
     * @return bool|FeeConfig
     */
    public static function checkFeeForWithdraw($withdraw)
    {
        if ($withdraw->isNew()) {
            $time = 'NOW()';
        } else if ($withdraw->created_time instanceof Expression) {
            $time = $withdraw->created_time;
        } else {
            $time = '"' .$withdraw->created_time .'"';
        }

        $fee = self::_filter(self::APPLY_TO_ACC, $withdraw->acc_id, self::SCOPE_WITHDRAW,
                                $withdraw->currency, $withdraw->amount, $time);
        if (!$fee) {
            $fee = self::_filter(self::APPLY_TO_DEFAULT, 0, self::SCOPE_WITHDRAW,
                                $withdraw->currency, $withdraw->amount, $time);
        }

        return $fee;
    }

    /**
     * @param Transaction $trans
     * @return bool|FeeConfig
     */
    public static function checkFeeForTransaction($trans)
    {
        if ($trans->isNew()) {
            $time = 'NOW()';
        } else if ($trans->created_time instanceof Expression) {
            $time = $trans->created_time;
        } else {
            $time = '"' .$trans->created_time .'"';
        }

        $acc_id = (\Transaction::FEE_FOR_FROM_ACC == $trans->fee_for)?
                        $trans->from_acc : $trans->to_acc;

        $fee = self::_filter(self::APPLY_TO_ACC, $acc_id, self::SCOPE_TRANSFER,
                                $trans->currency, $trans->amount, $time);
        if (!$fee) {
            $fee = self::_filter(self::APPLY_TO_DEFAULT, 0, self::SCOPE_TRANSFER,
                                $trans->currency, $trans->amount, $time);
        }

        return $fee;
    }

    protected static function _filter($apply_to = self::APPLY_TO_DEFAULT, $apply_id = 0, $scope, $currency, $amount, $time) {
        $data = self::read()
            ->where('`scope` = :scope')
            ->andWhere('`apply_to` = :at')
            ->andWhere('`apply_acc` = :ai')
            ->andWhere('`currency` = :currency' )
            ->andWhere('`amount_from` < :amount')
            ->andWhere('`amount_to` = 0 OR `amount_to` >= :amount')
            ->andWhere('TIMEDIFF(' .$time .' , `valid_time`) >=0')
            ->andWhere('(`invalid_time` = "0000-00-00 00:00:00" OR `invalid_time` IS NULL)
                        OR TIMEDIFF(' .$time .', `invalid_time`) <=0')
            ->orderBy('valid_time', 'DESC')
            ->setMaxResults(1)
            ->setParameter(':scope', $scope, \PDO::PARAM_STR)
            ->setParameter(':at', $apply_to, \PDO::PARAM_STR)
            ->setParameter(':ai', $apply_id, \PDO::PARAM_INT)
            ->setParameter(':currency', $currency, \PDO::PARAM_STR)
            ->setParameter(':amount', $amount, \PDO::PARAM_STR)
            ->execute()
            ->fetch(\PDO::FETCH_ASSOC);

        if (!$data) {
            return false;
        }

        $fee = new self();
        $fee->hydrate($data);
        $fee->setNew(false);
        return $fee;
    }
}