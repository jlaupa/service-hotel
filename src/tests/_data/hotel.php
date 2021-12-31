<?php
$faker = Faker\Factory::create();

return [
    'hotel' => [
        'id' => 1,
        'name' => $faker->title,
        'deleted' => false,
        'full_address' => $faker->streetAddress
    ],
    'hotel_empty' => [
        'id' => 2,
        'name' => $faker->title,
        'deleted' => false,
        'full_address' => $faker->streetAddress
    ],
];
