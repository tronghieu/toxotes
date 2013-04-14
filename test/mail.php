<?php
require_once __DIR__ .'./../bootstrap.php';
try {
    \Flywheel\Mail\Sender::sendMail('mylifeisskidrow@gmail.com', 'Thử gửi mail cái', 'Hello thằng hâm<br />');
} catch (\Exception $e) {
    print_r($e->getMessage() .' at '.$e->getFile() .' in '. $e->getLine());
    print_r($e->getTraceAsString());
}