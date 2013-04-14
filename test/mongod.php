<?php
try {
    $ok = array();
    $mongo = new \MongoClient("mongodb://10.58.56.233:27017,10.58.56.233:27018", array(
        "replicaSet" => "rs0",
        "db" => "core_logging",
        "username" => "core_logging",
        "password" => "mc_log13633"));
    $hosts = $mongo->getHosts();
    $ok[] = $hosts;
    //echo json_encode($hosts);
    $db = $mongo->selectDB('core_logging');
    //$error = $db->authenticate("core_logging", "mc_log13633");
    //echo json_encode($error);
    //$ok[] = $error;
    $collection = $db->selectCollection('hieubeo');
    for ($i = time(); $i < time() + 10; ++$i) {
        $collection->insert(array('$i' =>
            new MongoDate()
        ));
    }
    $account = $collection->findOne();
    $ok[] = $account;
    echo json_encode($ok);
    //echo json_encode($account);
} catch (\Exception $e) {
    print_r(get_class($e) ."\n");
    print_r("{$e->getMessage()}\n");
    print_r($e->getTraceAsString());
}