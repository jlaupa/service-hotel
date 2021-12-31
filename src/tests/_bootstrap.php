<?php

ini_set('xdebug.max_nesting_level', -1);
define('YII_ENV', 'test');
defined('YII_DEBUG') or define('YII_DEBUG', true);

require_once __DIR__.'/../../vendor/yiisoft/yii2/Yii.php';
require __DIR__.'/../../vendor/autoload.php';

\Yii::$container->setSingleton(
    \insolita\muffin\Factory::class,
    \insolita\muffin\Factory::class,
    [\Faker\Factory::create('en_EN')]
);
