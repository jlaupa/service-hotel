<?php

$faker = Faker\Factory::create();


return [
    'room' => [
        'id' => 1,
        'state_id' => 1,
        'name' => $faker->title,
        'price' => $faker->randomNumber(2),
        'hotel_id' => 1,
    ],
    'room_offline' => [
        'state_id' => 2,
        'id' => 2,
        'name' => $faker->title,
        'price' => $faker->randomNumber(3),
        'hotel_id' => 1,
    ],
    'room_booked' => [
        'state_id' => 3,
        'id' => 3,
        'name' => $faker->title,
        'price' => $faker->randomNumber(3),
        'hotel_id' => 1,
    ],
    'room_rented' => [
        'state_id' => 4,
        'id' => 4,
        'name' => $faker->title,
        'price' => $faker->randomNumber(3),
        'hotel_id' => 1,
    ],
];
