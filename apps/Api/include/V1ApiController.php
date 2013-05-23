<?php

class V1ApiController extends BaseApiController {

    public function beforeExecute() {
        parent::beforeExecute();
    }



    /**
     * @param Account $acc
     * @return array
     */
    public function getAccountObject(\Account $acc) {
        return $acc->getAttributes($this->accResponseFields);
    }

    /**
     * @param Transaction $t
     * @return array
     */
    public function getTransactionObject(\Transaction $t) {
        $attr = $t->getAttributes($this->transactionResponseFields);
        if ($t->relate_to) {
            $attr['relate_to'] = \Transaction::retrieveById($t->relate_to)->uk;
        } else {
            $attr['relate_to'] = '';
        }
        $attr['from_acc_uk'] = \Account::retrieveById($t->from_acc)->uk;
        $attr['to_acc_uk'] = \Account::retrieveById($t->to_acc)->uk;
        return $attr;
    }
}
