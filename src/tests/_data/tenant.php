<?php

$faker = Faker\Factory::create();


return [
    'tenant' => [
        'id' => 1,
        'room_id' => 3,
        'user_id' => 3,
        'amount_people' => 2,
        'check_in' => $faker->date('Y-m-d'),
        'check_out' => date('Y-m-d'),
        'deleted' => false
    ],
];
