<?php
chdir(__DIR__);
set_time_limit(0);
class ApiTestScenario {
    public $totalReg = 0;

    public $currency = array(
        'VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND','VND',
        'USD','USD','USD','USD','USD','USD','CNY','CNY',
        'KIP','BAT','EURO'
        );

    public $method = array(
        //Account
        'createAcc' => 200,//include get
        'frozenAcc' => 10,
        'deleteAcc' => 5,
        'reactiveAcc' => 10,


        //Deposit
        'createDeposit' => 3000,
        'suspendDeposit' => 70,
        'cancelDeposit' => 50,
        'finishDeposit' => 500,
//
//        //Withdraw
        'createWithdraw' => 500,
        'suspendWithdraw' => 10,
        'cancelWithdraw' => 50,
        'finishWithdraw' => 50,
//
//        //Transaction
//        'createTransaction' => 10000,
//        'suspendTransaction' => 500,
//        'cancelTransaction' => 300,
//        'finishTransaction' => 2000,
    );

    protected $_m = array();

    public $request = array();

    /**
     * @var RestClient
     */
    public $client;
    public $noSuspend;

    public function setup() {
        require_once __DIR__ .'/RestClient.php';
        $this->client = new RestClient('w4lu9roAvl0tHLestiADroarOe', '3Ustat6W2vUbRuWeXEMEwr7put4E3AMe7aBr6FATREtu5aZAtUgUd6b8');
//        $this->client->urlBase = 'http://localhost/mc_billing/public/';
        //prepare
        foreach($this->method as $m => $w) {
            for($i =0; $i < $w; ++$i) {
                $this->_m[] = $m;
            }
        }
    }

    public function call() {
        $loop = mt_rand(10, 100);
        for($i = 0; $i < $loop; ++$i) {
            $method = $this->_m[array_rand($this->_m)];
            print_r("\nBEGINNING BATCH " .date('d-m-Y H:i:s' ."\n"));
            $this->$method();
            print_r('END BATCH ' .date('d-m-Y H:i:s' ."\n"));
            print_r("***********************************************************\n");
        }
    }

    public function createAcc() {
        $this->totalReg++;
        $param = array(
            'currency' => $this->currency[array_rand($this->currency)],
        );

        print_r('POST /v1/account' ."\t" .date('d-m-Y H:i:s') ."\n");
        print_r("PARAM:\n" .json_encode($param) ."\n");
        $response = $this->client->httpRequest('/v1/account', 'POST', $param);
        $t = $this->client->startTime;
        $e = $this->client->endTime;
        print_r("EXEC TIME: " .(($e[1]+$e[0]) - ($t[1]+$t[0])) ."\n");
        print_r("RESPONSE:\nHTTP: {$this->client->httpCode}\n" .$this->client->rawResponse /*var_export($response, true)*/ ."\n");
        print_r("----------------------------------------------------------------\n");

        if ($this->client->httpCode != 200) {
            return;
        }

        $account = $response['account'];

        //get detailcall
        $this->getAcc($account['uk']);
        $r = mt_rand(0, 100);

        if ($r <= 1) {//1% will be delete
            $this->deleteAcc($account['uk']);
        } else if ($r <= 5) {//9% will be frozen
            $this->frozenAcc($account['uk']);
        }
    }

    public function getAcc($uk = null) {
        $this->totalReg++;
        print_r("GET /v1/account/detail/{$uk}" ."\t" .date('d-m-Y H:i:s') ."\n");
//        print_r("PARAM:\n" .var_export($param, true) ."\n");
        $response = $this->client->httpRequest("/v1/account/detail/{$uk}", 'GET');
        $t = $this->client->startTime;
        $e = $this->client->endTime;
        print_r("EXEC TIME: " .(($e[1]+$e[0]) - ($t[1]+$t[0])) ."\n");
        print_r("RESPONSE:\nHTTP: {$this->client->httpCode}\n" .$this->client->rawResponse /*var_export($response, true)*/  ."\n");
        print_r("----------------------------------------------------------------\n");

        return $response;
    }

    public function frozenAcc($uk = null) {
        if (empty($uk)) {//get random acc
            $conn = SimpleDBA::getInstance();
            $account = $conn->query('SELECT a.uk FROM account a ORDER BY RAND() LIMIT 1')->fetch(\PDO::FETCH_ASSOC);
            $uk = $account['uk'];
        }

        $this->totalReg++;
        print_r("PUT /v1/account/frozen/{$uk}" ."\t" .date('d-m-Y H:i:s') ."\n");
//        print_r("PARAM:\n" .var_export($param, true) ."\n");
        $response = $this->client->httpRequest("/v1/account/frozen/{$uk}", 'PUT');
        $t = $this->client->startTime;
        $e = $this->client->endTime;
        print_r("EXEC TIME: " .(($e[1]+$e[0]) - ($t[1]+$t[0])) ."\n");
        print_r("RESPONSE:\nStatus:{$this->client->httpCode}\n" .$this->client->rawResponse /*var_export($response, true)*/  ."\n");
        print_r("----------------------------------------------------------------\n");
        if ($this->client->httpCode != 200) {
            return;
        }

        $account = $response['account'];
        $r = mt_rand(0, 100);
        $this->getAcc($account['uk']);
        if ($r <= 10) {
            $this->deleteAcc($account['uk']);
        } elseif ($r <= 80) {//50% reactive
            $this->reactiveAcc($account['uk']);
        }
    }

    public function deleteAcc($uk = null) {
        if (empty($uk)) {//get random acc
            $conn = SimpleDBA::getInstance();
            $account = $conn->query('SELECT a.uk FROM account a ORDER BY RAND() LIMIT 1')->fetch(\PDO::FETCH_ASSOC);
            $uk = $account['uk'];
        }

        $this->totalReg++;
        print_r("PUT /v1/account/delete/{$uk}" ."\t" .date('d-m-Y H:i:s') ."\n");
//        print_r("PARAM:\n" .var_export($param, true) ."\n");
        $response = $this->client->httpRequest("/v1/account/delete/{$uk}", 'PUT');
        $t = $this->client->startTime;
        $e = $this->client->endTime;
        print_r("EXEC TIME: " .(($e[1]+$e[0]) - ($t[1]+$t[0])) ."\n");
        print_r("RESPONSE:\nStatus:{$this->client->httpCode}\n" .$this->client->rawResponse /*var_export($response, true)*/ ."\n");
        print_r("----------------------------------------------------------------\n");

        if ($this->client->httpCode != 200) {
            return;
        }

//        $account = $response['account'];
        $r = mt_rand(0, 100);
        $this->getAcc($uk);
        if ($r <= 10) {
            $this->frozenAcc($uk);
        } elseif ($r <= 80) {//50% reactive
            $this->reactiveAcc($uk);
        }
    }

    public function reactiveAcc($uk = null) {
        if (empty($uk)) {//get random acc
            $conn = SimpleDBA::getInstance();
            $account = $conn->query('SELECT a.uk FROM account a ORDER BY RAND() LIMIT 1')->fetch(\PDO::FETCH_ASSOC);
            $uk = $account['uk'];
        }
        $this->totalReg++;
        print_r("PUT /v1/account/reactive/{$uk}" ."\t" .date('d-m-Y H:i:s') ."\n");
//        print_r("PARAM:\n" .var_export($param, true) ."\n");
        $response = $this->client->httpRequest("/v1/account/reactive/{$uk}", 'PUT');
        $t = $this->client->startTime;
        $e = $this->client->endTime;
        print_r("EXEC TIME: " .(($e[1]+$e[0]) - ($t[1]+$t[0])) ."\n");
        print_r("RESPONSE:\nStatus:{$this->client->httpCode}\n" .$this->client->rawResponse /*var_export($response, true)*/  ."\n");
        print_r("----------------------------------------------------------------\n");
        if ($this->client->httpCode != 200) {
            return;
        }

        $account = $response['account'];
        $r = mt_rand(0, 100);
        $this->getAcc($account['uk']);
        if ($r <= 10) {//50% reactive
            $this->deleteAcc($account['uk']);
        } elseif($r <= 20) {
            $this->frozenAcc($account['uk']);
        }
    }

    public function createDeposit($accUk = null) {
        $conn = SimpleDBA::getInstance();
        if (!$accUk) {//get random acc
            $account = $conn->query('SELECT a.* FROM account a ORDER BY RAND() LIMIT 1')->fetch(\PDO::FETCH_ASSOC);
            $accUk = $account['uk'];
        } else {
            $account = $conn->query('SELECT a.* FROM account a WHERE a.uk="' .$accUk. '" LIMIT 1')->fetch(\PDO::FETCH_ASSOC);
        }

        //random amount;
        $amount = mt_rand(1, 3000);

        //currency
        $currency = (mt_rand(0, 100) <= 5)? $this->currency[array_rand($this->currency)] : $account['currency'];
        if ($currency == 'VND' || $account['currency'] == 'VND') {
            $amount = $amount*1000;
        }

        if (mt_rand(0, 100) < 20) {
            $currency = null;
        }

        $this->totalReg++;
        $param = array(
            'currency' => $currency,
            'acc_uk' => $accUk,
            'amount' => $amount,
            'note' => 'I like to moving! ' .date('d-m-Y H:i:s')
        );

        print_r('POST /v1/deposit' ."\t" .date('d-m-Y H:i:s') ."\n");
        print_r("PARAM:\n" .json_encode($param) ."\n");
        $response = $this->client->httpRequest('/v1/deposit', 'POST', $param);
        $t = $this->client->startTime;
        $e = $this->client->endTime;
        print_r("EXEC TIME: " .(($e[1]+$e[0]) - ($t[1]+$t[0])) ."\n");
        print_r("RESPONSE:\nHTTP: {$this->client->httpCode}\n" .$this->client->rawResponse /*var_export($response, true)*/  ."\n");
        print_r("----------------------------------------------------------------\n");

        if ($this->client->httpCode != 200) {
            return;
        }

        $d = $response['deposit_voucher'];
        $this->getDeposit($d['uk']);
        $r = mt_rand(0, 100);
        if ($r <= 5) { //cancel 5% deposit
            $this->cancelDeposit($d['uk']);
        } else if ($r <= 10) {//suspend 10% deposit
            $this->suspendDeposit($d['uk']);
        } else if ($r <= 90) {//finish 75% deposit, common way
            $this->finishDeposit($d['uk']);
        }
    }

    public function getDeposit($uk = null) {
        $this->totalReg++;

        print_r("GET /v1/deposit/detail/{$uk}\t" .date('d-m-Y H:i:s') ."\n");
        $response = $this->client->httpRequest("/v1/deposit/detail/{$uk}", 'GET');
        $t = $this->client->startTime;
        $e = $this->client->endTime;
        print_r("EXEC TIME: " .(($e[1]+$e[0]) - ($t[1]+$t[0])) ."\n");
        print_r("RESPONSE:\nHTTP: {$this->client->httpCode}\n" .$this->client->rawResponse /*var_export($response, true)*/  ."\n");
        print_r("----------------------------------------------------------------\n");
    }

    public function finishDeposit($uk = null) {
        $this->totalReg++;

        if (empty($uk)) {//get random acc
            $conn = SimpleDBA::getInstance();
            $d = $conn->query('SELECT d.uk FROM deposit_voucher d
                                        WHERE (d.status = "INIT" OR d.status = "SUSPENDED")
                                          AND d.created_time >= DATE_SUB(CURDATE(), INTERVAL 1 DAY)
                                        ORDER BY RAND() LIMIT 1')
                ->fetch(\PDO::FETCH_ASSOC);
            $uk = $d['uk'];
        }

        $param = array('deposit_key' => $uk);

        print_r('PUT /v1/deposit/finish' ."\t" .date('d-m-Y H:i:s') ."\n");
        print_r("PARAM:\n" .json_encode($param) ."\n");
        $response = $this->client->httpRequest('/v1/deposit/finish', 'PUT', $param);
        $t = $this->client->startTime;
        $e = $this->client->endTime;
        print_r("EXEC TIME: " .(($e[1]+$e[0]) - ($t[1]+$t[0])) ."\n");
        print_r("RESPONSE:\nHTTP: {$this->client->httpCode}\n" .$this->client->rawResponse /*var_export($response, true)*/ ."\n");
        print_r("----------------------------------------------------------------\n");

        if ($this->client->httpCode != 200) {
            return;
        }

        $d = $response['deposit_voucher'];
        $this->getDeposit($d['uk']);
        $r = mt_rand(0, 100);
        if ($r <= 1) {//try cancel 1% of it
            $this->cancelDeposit($d['uk']);
        } else if ($r<=20) {//suspend 20% after finish
            $this->suspendDeposit($d['uk']);
        }
    }

    public function cancelDeposit($uk = null) {
        $this->totalReg++;

        if (empty($uk)) {//get random acc
            $conn = SimpleDBA::getInstance();
            $d = $conn->query('SELECT d.uk FROM deposit_voucher d
                                        WHERE (d.status = "INIT" OR d.status = "SUSPENDED")
                                          AND d.created_time >= DATE_SUB(CURDATE(), INTERVAL 1 DAY)
                                        ORDER BY RAND() LIMIT 1')
                ->fetch(\PDO::FETCH_ASSOC);
            $uk = $d['uk'];
        }

        $param = array('deposit_key' => $uk);

        print_r('PUT /v1/deposit/cancel' ."\t" .date('d-m-Y H:i:s') ."\n");
        print_r("PARAM:\n" .json_encode($param) ."\n");
        $response = $this->client->httpRequest('/v1/deposit/cancel', 'PUT', $param);
        $t = $this->client->startTime;
        $e = $this->client->endTime;
        print_r("EXEC TIME: " .(($e[1]+$e[0]) - ($t[1]+$t[0])) ."\n");
        print_r("RESPONSE:\nHTTP: {$this->client->httpCode}\n" .$this->client->rawResponse /*var_export($response, true)*/ ."\n");
        print_r("----------------------------------------------------------------\n");

        if ($this->client->httpCode != 200) {
            return;
        }

        $this->getDeposit($response['deposit_voucher']['uk']);
        $r = mt_rand(0, 100);
        if ($r <=5) {//try finish
            $this->finishDeposit($response['deposit_voucher']['uk']);
        } elseif ($r <= 10) {//try to suspend
            $this->suspendDeposit($response['deposit_voucher']['uk']);
        }
    }

    public function suspendDeposit($uk = null) {
        if ($this->noSuspend) {
            return;
        }

        $this->totalReg++;

        if (empty($uk)) {//get random acc
            $conn = SimpleDBA::getInstance();
            $d = $conn->query('SELECT d.uk FROM deposit_voucher d
                                        WHERE (d.status = "INIT" OR d.status = "FINISHED")
                                          AND d.created_time >= DATE_SUB(CURDATE(), INTERVAL 1 DAY)
                                        ORDER BY RAND() LIMIT 1')
                ->fetch(\PDO::FETCH_ASSOC);
            $uk = $d['uk'];
        }

        $param = array('deposit_key' => $uk);

        print_r('PUT /v1/deposit/suspend' ."\t" .date('d-m-Y H:i:s') ."\n");
        print_r("PARAM:\n" .json_encode($param) ."\n");
        $response = $this->client->httpRequest('/v1/deposit/suspend', 'PUT', $param);
        $t = $this->client->startTime;
        $e = $this->client->endTime;
        print_r("EXEC TIME: " .(($e[1]+$e[0]) - ($t[1]+$t[0])) ."\n");
        print_r("RESPONSE:\nHTTP: {$this->client->httpCode}\n" .$this->client->rawResponse /*var_export($response, true)*/ ."\n");
        print_r("----------------------------------------------------------------\n");

        if ($this->client->httpCode != 200) {
            return;
        }

        $d = $response['deposit_voucher'];
        $this->getDeposit($d['uk']);
        $r = mt_rand(0, 100);
        if ($r <= 20) {//cancel 20%
            $this->cancelDeposit($d['uk']);
        } else if($r <= 95) {//finish 75%
            $this->finishDeposit($d['uk']);
        }
    }

    public function createWithdraw($accUk = null) {
        $conn = SimpleDBA::getInstance();
        if (!$accUk) {//get random acc
            $account = $conn->query('SELECT a.* FROM account a ORDER BY RAND() LIMIT 1')->fetch(\PDO::FETCH_ASSOC);
            $accUk = $account['uk'];
        } else {
            $account = $conn->query('SELECT a.* FROM account a WHERE a.uk="' .$accUk. '" LIMIT 1')->fetch(\PDO::FETCH_ASSOC);
        }

        //random amount;
        $amount = mt_rand(1, 3000);

        //currency
        $currency = (mt_rand(0, 100) <= 5)? $this->currency[array_rand($this->currency)] : $account['currency'];
        if ($currency == 'VND' || $account['currency'] == 'VND') {
            $amount = $amount*1000;
        }

        if (mt_rand(0, 100) < 20) {
            $currency = null;
        }

        $this->totalReg++;
        $param = array(
            'currency' => $currency,
            'acc_uk' => $accUk,
            'amount' => $amount,
            'note' => 'I like to moving! ' .date('d-m-Y H:i:s')
        );

        print_r('POST /v1/withdraw' ."\t" .date('d-m-Y H:i:s') ."\n");
        print_r("PARAM:\n" .json_encode($param) ."\n");
        $response = $this->client->httpRequest('/v1/withdraw', 'POST', $param);
        $t = $this->client->startTime;
        $e = $this->client->endTime;
        print_r("EXEC TIME: " .(($e[1]+$e[0]) - ($t[1]+$t[0])) ."\n");
        print_r("RESPONSE:\nHTTP: {$this->client->httpCode}\n" .$this->client->rawResponse /*var_export($response, true)*/ ."\n");
        print_r("----------------------------------------------------------------\n");

        if ($this->client->httpCode != 200) {
            return;
        }

        $d = $response['withdraw_voucher'];
        $this->getWithdraw($d['uk']);
        $r = mt_rand(0, 100);
        if ($r <= 5) { //cancel 5% deposit
            $this->cancelWithdraw($d['uk']);
        } else if ($r <= 15) {//suspend 10% deposit
            $this->suspendWithdraw($d['uk']);
        } else if ($r <= 90) {//finish 75% deposit, common way
            $this->finishWithdraw($d['uk']);
        }
    }

    public function getWithdraw($uk = null) {
        $this->totalReg++;

        print_r("GET /v1/withdraw/detail/{$uk}\t" .date('d-m-Y H:i:s') ."\n");
        $response = $this->client->httpRequest("/v1/withdraw/detail/{$uk}", 'GET');
        $t = $this->client->startTime;
        $e = $this->client->endTime;
        print_r("EXEC TIME: " .(($e[1]+$e[0]) - ($t[1]+$t[0])) ."\n");
        print_r("RESPONSE:\nHTTP: {$this->client->httpCode}\n" .$this->client->rawResponse /*var_export($response, true)*/ ."\n");
        print_r("----------------------------------------------------------------\n");
    }

    public function suspendWithdraw($uk = null) {
        if ($this->noSuspend) {
            return;
        }
        $this->totalReg++;

        if (empty($uk)) {//get random acc
            $conn = SimpleDBA::getInstance();
            $d = $conn->query('SELECT w.uk FROM withdraw_voucher w
                                        WHERE (w.status = "INIT" OR w.status = "FINISHED")
                                          AND w.created_time >= DATE_SUB(CURDATE(), INTERVAL 1 DAY)
                                        ORDER BY RAND() LIMIT 1')
                ->fetch(\PDO::FETCH_ASSOC);
            $uk = $d['uk'];
        }

        $param = array('withdraw_key' => $uk);

        print_r('PUT /v1/withdraw/suspend' ."\t" .date('d-m-Y H:i:s') ."\n");
        print_r("PARAM:\n" .json_encode($param) ."\n");
        $response = $this->client->httpRequest('/v1/withdraw/suspend', 'PUT', $param);
        $t = $this->client->startTime;
        $e = $this->client->endTime;
        print_r("EXEC TIME: " .(($e[1]+$e[0]) - ($t[1]+$t[0])) ."\n");
        print_r("RESPONSE:\nHTTP: {$this->client->httpCode}\n" .$this->client->rawResponse /*var_export($response, true)*/ ."\n");
        print_r("----------------------------------------------------------------\n");

        if ($this->client->httpCode != 200) {
            return;
        }

        $d = $response['withdraw_voucher'];
        $this->getWithdraw($d['uk']);
        $r = mt_rand(0, 100);
        if ($r <= 20) {//cancel 20%
            $this->cancelWithdraw($d['uk']);
        } else if($r <= 100) {//finish 80%
            $this->finishWithdraw($d['uk']);
        }
    }

    public function cancelWithdraw($uk = null) {
        $this->totalReg++;

        if (empty($uk)) {//get random acc
            $conn = SimpleDBA::getInstance();
            $d = $conn->query('SELECT w.uk FROM withdraw_voucher w
                                        WHERE (w.status = "INIT" OR w.status = "SUSPENDED")
                                          AND w.created_time >= DATE_SUB(CURDATE(), INTERVAL 1 DAY)
                                        ORDER BY RAND() LIMIT 1')
                ->fetch(\PDO::FETCH_ASSOC);
            $uk = $d['uk'];
        }

        $param = array('withdraw_key' => $uk);

        print_r('PUT /v1/withdraw/cancel' ."\t" .date('d-m-Y H:i:s') ."\n");
        print_r("PARAM:\n" .json_encode($param) ."\n");
        $response = $this->client->httpRequest('/v1/withdraw/cancel', 'PUT', $param);
        $t = $this->client->startTime;
        $e = $this->client->endTime;
        print_r("EXEC TIME: " .(($e[1]+$e[0]) - ($t[1]+$t[0])) ."\n");
        print_r("RESPONSE:\nHTTP: {$this->client->httpCode}\n" .$this->client->rawResponse /*var_export($response, true)*/ ."\n");
        print_r("----------------------------------------------------------------\n");

        if ($this->client->httpCode != 200) {
            return;
        }

        $this->getWithdraw($response['withdraw_voucher']['uk']);
        $r = mt_rand(0, 100);
        if ($r <=5) {//try finish
            $this->finishWithdraw($response['withdraw_voucher']['uk']);
        } elseif ($r <= 10) {//try to suspend
            $this->suspendWithdraw($response['withdraw_voucher']['uk']);
        }
    }

    public function finishWithdraw($uk = null) {
        $this->totalReg++;

        if (empty($uk)) {//get random acc
            $conn = SimpleDBA::getInstance();
            $d = $conn->query('SELECT w.uk FROM withdraw_voucher w
                                        WHERE (w.status = "INIT" OR w.status = "SUSPENDED")
                                          AND w.created_time >= DATE_SUB(CURDATE(), INTERVAL 1 DAY)
                                        ORDER BY RAND() LIMIT 1')
                ->fetch(\PDO::FETCH_ASSOC);
            $uk = $d['uk'];
        }

        $param = array('withdraw_key' => $uk);

        print_r('PUT /v1/withdraw/finish' ."\t" .date('d-m-Y H:i:s') ."\n");
        print_r("PARAM:\n" .json_encode($param) ."\n");
        $response = $this->client->httpRequest('/v1/withdraw/finish', 'PUT', $param);
        $t = $this->client->startTime;
        $e = $this->client->endTime;
        print_r("EXEC TIME: " .(($e[1]+$e[0]) - ($t[1]+$t[0])) ."\n");
        print_r("RESPONSE:\nHTTP: {$this->client->httpCode}\n" .$this->client->rawResponse /*var_export($response, true)*/ ."\n");
        print_r("----------------------------------------------------------------\n");

        if ($this->client->httpCode != 200) {
            return;
        }

        $d = $response['withdraw_voucher'];
        $this->getWithdraw($d['uk']);
        $r = mt_rand(0, 100);
        if ($r <= 1) {//try cancel 1% of it
            $this->cancelWithdraw($d['uk']);
        } else if ($r<=20) {//suspend 20% after finish
            $this->suspendWithdraw($d['uk']);
        }
    }

    public function createTransaction() {
        $conn = SimpleDBA::getInstance();
        $rand = mt_rand(0, 100);
        if ($rand <=10) {
            $uks = $conn->query("SELECT a.uk, a.currency
                                    FROM account a
                                    WHERE a.currency = 'CNY' AND a.balance > 0
                                    ORDER BY RAND() LIMIT 2")->fetchAll(PDO::FETCH_ASSOC);
        } else if ($rand <= 30) {
            $uks = $conn->query("SELECT a.uk, a.currency
                                    FROM account a
                                    WHERE a.currency = 'USD' AND a.balance > 0
                                    ORDER BY RAND() LIMIT 2")->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $uks = $conn->query("SELECT a.uk, a.currency
                                    FROM account a
                                     WHERE a.balance > 0
                                    ORDER BY RAND() LIMIT 2")->fetchAll(PDO::FETCH_ASSOC);
        }

        $from = $uks[0]['uk'];
        $to = $uks[1]['uk'];

        //random amount;
        $amount = mt_rand(1, 3000)*1000;
        $rand = mt_rand(0, 100);
        if ($rand < 50) {
            $currency = $uks[0]['currency'];
        } elseif ($rand < 90) {
            $currency = $uks[1]['currency'];
        } else {
            $currency = null;
        }

        $rand = mt_rand(0, 100);
        if ($rand < 50) { //50% FROM
            $fee_for = 'FROM_ACC';
        } else if ($rand < 80) { // 30% TO
            $fee_for = 'TO_ACC';
        } else if ($rand < 95) { //15% blank
            $fee_for = null;
        } else {
            $fee_for = "NOTHING"; //error for test
        }

        $this->totalReg++;
        $param = array(
            'currency' => $currency,
            'from_acc' => $from,
            'to_acc' => $to,
            'amount' => $amount,
            'fee_for' => $fee_for,
            'note' => 'I like to moving! ' .date('d-M-Y H:i:s')
        );

        print_r('POST /v1/transaction' ."\t" .date('d-m-Y H:i:s') ."\n");
        print_r("PARAM:\n" .json_encode($param) ."\n");
        $response = $this->client->httpRequest('/v1/transaction', 'POST', $param);
        $t = $this->client->startTime;
        $e = $this->client->endTime;
        print_r("EXEC TIME: " .(($e[1]+$e[0]) - ($t[1]+$t[0])) ."\n");
        print_r("RESPONSE:\nHTTP: {$this->client->httpCode}\n" .$this->client->rawResponse /*var_export($response, true)*/ ."\n");
        print_r("----------------------------------------------------------------\n");

        if ($this->client->httpCode != 200) {
            return;
        }

        $d = $response['transaction'];
        $this->getTransaction($d['uk']);
        $r = mt_rand(0, 100);
        if ($r <= 5) { //cancel 5% deposit
            $this->cancelTransaction($d['uk']);
        } else if ($r <= 15) {//suspend 10% deposit
            $this->suspendTransaction($d['uk']);
        } else if ($r <= 80) {//finish 60% deposit, common way
            $this->finishTransaction($d['uk']);
        }
    }

    public function getTransaction($uk = null) {
        $this->totalReg++;

        print_r("GET /v1/transaction/detail/{$uk}\t" .date('d-m-Y H:i:s') ."\n");
        $response = $this->client->httpRequest("/v1/transaction/detail/{$uk}", 'GET');
        $t = $this->client->startTime;
        $e = $this->client->endTime;
        print_r("EXEC TIME: " .(($e[1]+$e[0]) - ($t[1]+$t[0])) ."\n");
        print_r("RESPONSE:\nHTTP: {$this->client->httpCode}\n" .$this->client->rawResponse /*var_export($response, true)*/ ."\n");
        print_r("----------------------------------------------------------------\n");
    }

    public function cancelTransaction($uk = null) {
        $this->totalReg++;

        if (empty($uk)) {//get random acc
            $conn = SimpleDBA::getInstance();
            $d = $conn->query('SELECT t.uk FROM `transaction` t
                                        WHERE (t.status = "INIT" OR t.status = "SUSPENDED")
                                          AND t.type = "TRANSFER"
                                          AND t.created_time >= DATE_SUB(CURDATE(), INTERVAL 1 DAY)
                                        ORDER BY RAND() LIMIT 1')
                ->fetch(\PDO::FETCH_ASSOC);
            $uk = $d['uk'];
        }

        $param = array('trans_key' => $uk);

        print_r('PUT /v1/transaction/cancel' ."\t" .date('d-m-Y H:i:s') ."\n");
        print_r("PARAM:\n" .json_encode($param) ."\n");
        $response = $this->client->httpRequest('/v1/transaction/cancel', 'PUT', $param);
        $t = $this->client->startTime;
        $e = $this->client->endTime;
        print_r("EXEC TIME: " .(($e[1]+$e[0]) - ($t[1]+$t[0])) ."\n");
        print_r("RESPONSE:\nHTTP: {$this->client->httpCode}\n" .$this->client->rawResponse /*var_export($response, true)*/ ."\n");
        print_r("----------------------------------------------------------------\n");

        if ($this->client->httpCode != 200) {
            return;
        }

        $this->getTransaction($response['transaction']['uk']);
        $r = mt_rand(0, 100);
        if ($r <=5) {//try finish
            $this->finishTransaction($response['transaction']['uk']);
        } elseif ($r <= 10) {//try to suspend
            $this->suspendTransaction($response['transaction']['uk']);
        }
    }

    public function suspendTransaction($uk = null) {
        if ($this->noSuspend) {
            return;
        }
        $this->totalReg++;

        if (empty($uk)) {//get random acc
            $conn = SimpleDBA::getInstance();
            $d = $conn->query('SELECT t.uk FROM `transaction` t
                                        WHERE (t.status = "INIT" OR t.status = "FINISHED")
                                          AND t.type="TRANSFER"
                                          AND t.created_time >= DATE_SUB(CURDATE(), INTERVAL 1 DAY)
                                        ORDER BY RAND() LIMIT 1')
                ->fetch(\PDO::FETCH_ASSOC);
            $uk = $d['uk'];
        }

        $param = array('trans_key' => $uk);

        print_r('PUT /v1/transaction/suspend' ."\t" .date('d-m-Y H:i:s') ."\n");
        print_r("PARAM:\n" .json_encode($param) ."\n");
        $response = $this->client->httpRequest('/v1/transaction/suspend', 'PUT', $param);
        $t = $this->client->startTime;
        $e = $this->client->endTime;
        print_r("EXEC TIME: " .(($e[1]+$e[0]) - ($t[1]+$t[0])) ."\n");
        print_r("RESPONSE:\nHTTP: {$this->client->httpCode}\n" .$this->client->rawResponse /*var_export($response, true)*/ ."\n");
        print_r("----------------------------------------------------------------\n");

        if ($this->client->httpCode != 200) {
            return;
        }

        $d = $response['transaction'];
        $this->getTransaction($d['uk']);
        $r = mt_rand(0, 100);
        if ($r <= 20) {//cancel 20%
            $this->cancelTransaction($d['uk']);
        } else if($r <= 100) {//finish 60%
            $this->finishTransaction($d['uk']);
        }
    }

    public function finishTransaction($uk = null) {
        $this->totalReg++;

        if (empty($uk)) {//get random acc
            $conn = SimpleDBA::getInstance();
            $d = $conn->query('SELECT t.uk FROM `transaction` t
                                        WHERE (t.status = "INIT" OR t.status = "SUSPENDED")
                                          AND t.created_time >= DATE_SUB(CURDATE(), INTERVAL 1 DAY)
                                        ORDER BY RAND() LIMIT 1')
                ->fetch(\PDO::FETCH_ASSOC);
            $uk = $d['uk'];
        }

        $param = array('trans_key' => $uk);

        print_r('PUT /v1/transaction/finish' ."\t" .date('d-m-Y H:i:s') ."\n");
        print_r("PARAM:\n" .json_encode($param) ."\n");
        $response = $this->client->httpRequest('/v1/transaction/finish', 'PUT', $param);
        $t = $this->client->startTime;
        $e = $this->client->endTime;
        print_r("EXEC TIME: " .(($e[1]+$e[0]) - ($t[1]+$t[0])) ."\n");
        print_r("RESPONSE:\nHTTP: {$this->client->httpCode}\n" .$this->client->rawResponse /*var_export($response, true)*/ ."\n");
        print_r("----------------------------------------------------------------\n");

        if ($this->client->httpCode != 200) {
            return;
        }

        $d = $response['transaction'];
        $this->getTransaction($d['uk']);
        $r = mt_rand(0, 100);
        if ($r <= 1) {//try cancel 1% of it
            $this->cancelTransaction($d['uk']);
        } else if ($r<=20) {//suspend 20% after finish
            $this->suspendTransaction($d['uk']);
        }
    }
}

require_once __DIR__ .'/includes/dba.php';

$a = new ApiTestScenario();
$a->setup();
$a->noSuspend = false;
$a->call();
$total_call = @file_get_contents('/var/www/html/logs/total_call_'.date('d_m_Y'));
$total_call+= $a->totalReg;
@file_put_contents('/var/www/html/logs/total_call_'.date('d_m_Y'), $total_call);
print_r("\n\n\n\nTOTAL REQUEST: {$a->totalReg}\n");
print_r("TOTAL CALL TIME: " .$a->client->trackExeTime ."\n");
print_r("STATISTIC:\nTOTAL ACCOUNT BALANCE: currency : BALANCE | FROZEN_BALANCE\n");
$conn = SimpleDBA::getInstance();
$d = $conn->query('SELECT SUM(a.balance) AS s, SUM(a.frozen_balance) AS s1, a.currency
                    FROM account a
                    WHERE a.type ="NORMAL"
                    GROUP BY a.currency')
    ->fetchAll(\PDO::FETCH_ASSOC);
foreach ($d as $_d) {
    print_r("{$_d['currency']}: {$_d['s']} | {$_d['s1']}\n");
}

print_r("TOTAL DEPOSIT AMOUNT: currency : STATUS | AMOUNT | TOTAL FEE\n");
$d = $conn->query('SELECT a.currency, a.status, SUM(a.total_fee) AS s1, SUM(a.amount) AS s
                    FROM deposit_voucher a GROUP BY a.currency, a.status')
    ->fetchAll(\PDO::FETCH_ASSOC);
foreach ($d as $_d) {
    print_r("{$_d['currency']}: {$_d['status']} | {$_d['s']} | {$_d['s1']}\n");
}

print_r("TOTAL WITHDRAWAL AMOUNT: currency : STATUS | AMOUNT | FEE\n");
$d = $conn->query('SELECT a.currency, a.status, SUM(a.total_fee) AS s1, SUM(a.amount) AS s
                    FROM withdraw_voucher a GROUP BY a.currency, a.status;')
    ->fetchAll(\PDO::FETCH_ASSOC);
foreach ($d as $_d) {
    print_r("{$_d['currency']}: {$_d['status']} | {$_d['s']} | {$_d['s1']}\n");
}

print_r("TOTAL TRANSACTION AMOUNT: TRANSFER? - CURRENCY : TYPE | STATUS | AMOUNT | FEE\n");
$d = $conn->query('SELECT a.currency, a.status, SUM(a.total_fee) AS s1, a.type , a.money_transfer, SUM(a.amount) AS s
                    FROM `transaction` a
                    GROUP BY a.money_transfer,a.currency, a.status, a.type')
    ->fetchAll(\PDO::FETCH_ASSOC);
foreach ($d as $_d) {
    if ($_d['money_transfer'] == 1) {
        print_r("TRANSFERRED MONEY - ");
    } else {
        print_r("HASN'T TRANSFERRED MONEY - ");
    }
    print_r("{$_d['currency']}: {$_d['type']} | {$_d['status']} | {$_d['s']} | {$_d['s1']}\n");
}

print_r("TOTAL FEE AMOUNT: currency : BALANCE | FROZEN BALANCE\n");
$d = $conn->query('SELECT SUM(a.balance) AS s, SUM(a.frozen_balance) AS s1, a.currency
                    FROM account a
                    WHERE a.type = "FEE"
                    GROUP BY a.currency')
    ->fetchAll(\PDO::FETCH_ASSOC);
foreach ($d as $_d) {
    print_r("{$_d['currency']}: {$_d['s']} | {$_d['s1']}\n");
}
print_r("====================================================================\n");
