<?php

//var_dump();

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host='.getenv('POSTGRE_HOST').';port='.getenv('POSTGRE_PORT').';dbname='.getenv('POSTGRE_DB'),
    'username' => getenv('POSTGRE_USER'),
    'password' => getenv('POSTGRE_PASSWORD'),
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    /*'enableSchemaCache' => false,
    'schemaCacheDuration' => 84600,
    'schemaCache' => 'cache',*/
];
