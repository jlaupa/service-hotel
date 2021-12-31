<?php

require __DIR__.'/dependencies.php';
$params = require __DIR__.'/params.php';
$routes = require __DIR__.'/routes.php';
$db = require __DIR__.'/db.php';

$config = [
    'id' => 'basic',
    'language' => 'es',
    'sourceLanguage' => 'en-US',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        function () {
            \app\events\EventListener::init();
        },
    ],
    'aliases' => [
        '@vendor' => __DIR__.'/../../vendor',
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/translations',
                    'fileMap' => [
                        'app/errors' => 'errors.php',
                        'app/model' => 'model.php',
                        'app' => 'app.php',
                    ],
                ],
            ],
        ],
        'schemaValidator' => [
            'class' => 'app\components\SchemaValidator',
        ],
        'response' => [
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                if (in_array(Yii::$app->controller->id, explode(',', getenv('FORMAT_EXCLUDED_CONTROLLERS')))) {
                    return false;
                }

                $response = $event->sender;
                if ('json' === $response->format && isset($response->data)) {
                    $data = $response->data;
                    $response->data = [
                        'success' => $response->isSuccessful,
                        'data' => $data,
                    ];
                } else {
                    return false;
                }
            },
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'OMAlFEbwCk5Jvc0lqF-X2BIkDKvQIsg3',
        ],
        'user' => [
            'identityClass' => \app\models\User::class,
            'enableAutoLogin' => false,
            'enableSession' => false,
            'loginUrl' => null,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
           'rules' => $routes,
        ],
    ],
    'params' => $params,
];

// Check that params are set from .env file.
foreach ($params as $i => $param) {
    if (empty($param)) {
        print_r("{$i} must be set.");
        exit();
    }
}

$debugEnabled = true;
if ($debugEnabled) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => [getenv('ALLOWED_IPS')],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => [getenv('ALLOWED_IPS')],
    ];
}

return $config;
