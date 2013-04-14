<?php

class BaseApiEvent extends \Flywheel\Event\Event {
    protected function _init() {
        foreach($this->params as &$value) {
            if ($value instanceof \Flywheel\Model\ActiveRecord) {
                $obj = $value->toArray();
                $obj['object'] = get_class($value);

                if ($value instanceof DepositVoucher) {
                    $obj['acc_uk'] = Account::retrieveById($value->acc_id)->uk;
                } else if ($value instanceof WithdrawVoucher) {
                    $obj['acc_uk'] = Account::retrieveById($value->acc_id)->uk;
                } else if ($value instanceof \Transaction) {
                    $obj['from_acc_uk'] = Account::retrieveById($value->from_acc)->uk;
                    $obj['to_acc_uk'] = Account::retrieveById($value->to_acc)->uk;
                }

                $value = $obj;
            }
        }

        if (!isset($this->params['operation_id'])) {
            if (($app = \Flywheel\Base::getApp()) &&
                ($controller = $app->getController())) {
                if ($controller instanceof V1ApiController) {
                    $this->params['operation_id'] = $controller->getOperationId();
                }
            }
        }

        if ($this instanceof AccountEvent) {
            $this->params['item_kind_id'] = 'ACCOUNT';
            if (isset($this->params['account'])) {
                $this->params['item_real_id'] = $this->params['account']['uk'];
            }

        } elseif ($this instanceof DepositEvent) {
            $this->params['item_kind_id'] = 'DEPOSIT_VOUCHER';
            if (isset($this->params['deposit'])) {
                $this->params['item_real_id'] = $this->params['deposit']['uk'];
            }

        } elseif ($this instanceof WithdrawEvent) {
            $this->params['item_kind_id'] = 'WITHDRAW_VOUCHER';
            if (isset($this->params['withdraw'])) {
                $this->params['item_real_id'] = $this->params['withdraw']['uk'];
            }

        } elseif ($this instanceof \TransactionEvent) {
            $this->params['item_kind_id'] = 'TRANSACTION';
            if (isset($this->params['transaction'])) {
                $this->params['item_real_id'] = $this->params['transaction']['uk'];
            }
        }

        if (!isset($this->params['consumer'])) {
            $this->params['consumer'] = EVENT_CONSUMER_NAME;
        }
    }
}