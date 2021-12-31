<?php

$params = require __DIR__.'/test_params.php';
$db = require __DIR__.'/test_db.php';
$container = require __DIR__.'/dependencies.php';

/*
 * Application configuration shared by all test types
 */
return [
    'id' => 'basic-tests',
    'basePath' => dirname(__DIR__),
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'language' => 'en-US',
    'components' => [
        'db' => $db,
        'mailer' => [
            'useFileTransport' => true,
        ],
        'assetManager' => [
            'basePath' => __DIR__.'/../web/assets',
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/translations',
                    'fileMap' => [
                        'app/messages' => 'messages.php',
                        'app/errors' => 'errors.php',
                    ],
                ],
            ],
        ],
    ],
    'params' => $params,

    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
];
