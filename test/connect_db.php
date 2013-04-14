<?php
require_once __DIR__ .'/../bootstrap.php';
try {
    $conn = \Flywheel\Db\Manager::getConnection();
    $stmt = $conn->query('SELECT * FROM account WHERE id = 19');
    print_r($stmt->fetch(\PDO::FETCH_ASSOC));
} catch (Exception $e) {
    print_r($e);
}