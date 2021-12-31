<?php

$db = [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host='.$params['POSTGRES_HOST']
        .';port='.$params['POSTGRES_PORT']
        .';dbname='.$params['POSTGRES_DB'],
    'username' => $params['POSTGRES_USER'],
    'password' => $params['POSTGRES_PASSWORD'],
    'charset' => 'utf8',
];

// test database! Important not to run tests on production or development databases
$db['dsn'] = 'pgsql:host='.$params['POSTGRES_HOST']
    .';port='.$params['POSTGRES_PORT']
    .';dbname='.$params['POSTGRES_DB'];

return $db;
