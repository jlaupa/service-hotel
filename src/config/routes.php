<?php
/*
 * Default created endpoints by the framework
 * Info: https://www.yiiframework.com/doc/guide/2.0/es/rest-routing
[
    'PUT,PATCH users/<id>' => 'user/update',
    'DELETE users/<id>' => 'user/delete',
    'GET,HEAD users/<id>' => 'user/view',
    'POST users' => 'user/create',
    'GET,HEAD users' => 'user/index',
    'users/<id>' => 'user/options',
    'users' => 'user/options',
]
 */

return [
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => ['hotel'],
        'pluralize' => true,
        'only' => [
            'view',
            'search-rooms',
            'users-booked',
        ],
        'extraPatterns' => [
            'GET <hotel_id>/users/booked' => 'users-booked',
            'GET <hotel_id>/rooms' => 'search-rooms',
            'GET <hotel_id>' => 'view',
        ],
    ],
];
