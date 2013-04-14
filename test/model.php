<?php
require_once __DIR__ .'./../bootstrap.php';
\Flywheel\Loader::import('global.model.*');
try {

    $conn = Account::getReadConnection();
    $stmt = $conn->executeUpdate('');
    $stmt = $conn->executeQuery('');
    $stmt->fetchAll();


    $conn = Account::getWriteConnection();

    $accounts = Account::read()
        ->setMaxResults(20)
        ->execute()
        ->fetchAll(\PDO::FETCH_ASSOC);

    foreach ($accounts as &$account) {
        $a = new Account();
        $a->hydrate($account);
        $a->setNew(false);
        $account = $a;
    }


    $stmt = Account::read()
        ->setMaxResults(20)
        ->execute();

    $accounts = array();
    while($stmt->fetch(\PDO::FETCH_ASSOC)) {
        $a = new Account();
        $a->hydrate($account);
        $a->setNew(false);

        $accounts[] = $a;
    }

//        ->fetchObject('Account');
    var_dump($accounts);
} catch (\Exception $e) {
    var_dump($e);
}