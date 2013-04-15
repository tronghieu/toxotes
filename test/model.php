<?php
require_once __DIR__ .'./../bootstrap.php';
\Flywheel\Loader::import('global.model.*');
try {
//    $user = Users::read()
//        ->where('id=?')
//        ->setParameter(1, 1, PDO::PARAM_INT)
//        ->execute()
//        ->fetchObject('Users', array(null, false));
//
//    var_dump($user);

    $user = Users::read()->where(1)
        ->execute()
        ->fetchAll(PDO::FETCH_CLASS, 'Users', array(null, false));
    var_dump($user);

    /** @var Users[] $user */

    var_dump($user[0]->getRegisterTime());
} catch (\Exception $e) {
    var_dump($e);
}