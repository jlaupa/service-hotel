<?php

$faker = Faker\Factory::create();


return [
    'user' => [
        'id' => 1,
        'name' => $faker->title,
        'email' => $faker->unique()->safeEmail,
    ],
    'user_old' => [
        'id' => 2,
        'name' => $faker->title,
        'email' => $faker->unique()->safeEmail,
    ],
    'user_booked' => [
        'id' => 3,
        'name' => $faker->title,
        'email' => $faker->unique()->safeEmail,
    ],
    'user_rented' => [
        'id' => 4,
        'name' => $faker->title,
        'email' => $faker->unique()->safeEmail,
    ],
];
