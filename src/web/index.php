<?php

//Response for Preflight
if ('OPTIONS' === $_SERVER['REQUEST_METHOD']) {
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, PATCH, DELETE');
    $allowHeaders = [
        'Authentication',
        'Accept',
        'Authorization',
        'Cache-Control',
        'Content-Type',
        'Keep-Alive',
        'Origin',
        'User-Agent',
        'X-Requested-With',
        'X-Token-Auth',
        'X-Mx-ReqToken',
        'X-Requested-With',
        'www-authenticate',
    ];
    header('Access-Control-Allow-Headers: '.implode(',', $allowHeaders));
    header('Access-Control-Allow-Origin: *');
    exit(0);
}

require_once __DIR__.'/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::create(__DIR__.'/../../');
$dotenv->load();

$debugEnabled = filter_var(getenv('ENABLE_YII_DEBUG'), FILTER_VALIDATE_BOOLEAN);
if (true === $debugEnabled) {
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'dev');
}

require_once __DIR__.'/../../vendor/yiisoft/yii2/Yii.php';
$config = require __DIR__.'/../config/web.php';

(new yii\web\Application($config))->run();
