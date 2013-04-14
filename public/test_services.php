<?php
require_once __DIR__ .'/../bootstrap.php';

if (isset($_POST['submit'])) {
    $error = array();
    $username = @$_POST['username'];
    $password = @$_POST['password'];

    if ($username == 'liuzhoungxiao'
        && sha1($password) == 'c028b2b61f46edba1bdf798f96326f38672c915c') : ?>
        CONNECT DB: <?php connect_db(); ?><br />
        CONNECT REDIS: <?php connect_redis(); ?><br />
        CONNECT MONGO LOGGER: <?php connect_mongo(); ?><br />
    <?php endif ?>
<?php
} else {
?>
    <form action="" method="POST">
        <input name="username" type="text">
        <input name="password" type="password">
        <input type="submit" name="submit">
    </form>

<?php
}

function connect_db() {
    try {
        $conn  = \Flywheel\Db\Manager::getConnection();
        echo 'OK!';
    } catch (\Exception $e) {
        echo 'FAIL!';
    }
}

function connect_redis() {
    try {
        $conn  = \Flywheel\Redis\RedisClient::getConnection();
        if ('+PONG' == $conn->ping())
            echo 'OK!';
        else
            echo 'FAIL!';
    } catch (\Exception $e) {
        echo 'FAIL!';
    }
}

function connect_mongo() {
    try {
        $cfg = \Flywheel\Config\ConfigHandler::load('global.config.corelogging');
        $cfg = $cfg['handler'];

        if (!class_exists('Mongo') && !class_exists('MongoClient')) {
            throw new \InvalidArgumentException('MongoClient or Mongo instance required');
        }
        $options = $cfg['options'];
        $dsn = $cfg['dsn'];

        try {
            if (class_exists('Mongo')) {
                $conn = new \Mongo($dsn, $options);
            } else if (class_exists('MongoClient')) {
                $conn = new \MongoClient($dsn, $options);
            }
        } catch (MongoConnectionException $e) {
            throw $e;
        }

        echo 'OK!';

    } catch (\Exception $e) {
        echo 'FAIL!';
    }
}
?>