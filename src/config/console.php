<?php

require __DIR__.'/dependencies.php';

$params = require __DIR__.'/params.php';
$db = require __DIR__.'/db.php';

$config = [
    'id' => 'basic-console',
    'language' => 'es',
    'sourceLanguage' => 'en-US',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
    ],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@vendor' => __DIR__.'/../../vendor',
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/translations',
                    'fileMap' => [
                        'app/errors' => 'errors.php',
                        'app/mail' => 'mail.php',
                        'app/notification' => 'notification.php',
                        'app' => 'app.php',
                    ],
                ],
            ],
        ],
        'log' => [
            'traceLevel' => 3,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logVars' => [
                        '!_GET',
                        '!_POST',
                        '!_FILES',
                        '!_COOKIE',
                        '!_SESSION',
                        '!_SERVER',
                    ],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
];

if (true) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
