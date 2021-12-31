<?php

/**
 * @var Factory $factory
 **/

use app\models\Hotel;
use insolita\muffin\Factory;

$factory->define(
    Hotel::class,
    function (Faker\Generator $faker) {
        return [
            'name' => $faker->name,
            'phone' => $faker->randomNumber(6),
            'full_address' => $faker->title(),
            'deleted' => false
        ];
    }
);

$factory->state(Hotel::class, 'test_ok', ['id' => 1]);
//$factory->state(Hotel::class, 'test_fail', ['id' => null]);
