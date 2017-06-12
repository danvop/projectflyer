<?php

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Flyer::class, function (Faker\Generator $faker) {
    return [
        'street'        => $faker->streetAddress,
        'city'          => $faker->city,
        'zip'           => $faker->postcode,
        'state'         => $faker->state,
        'country'       => $faker->country,
        'price'         => $faker->numberBetween(10000, 5000000),
        'description'   => $faker->paragraph(3, true)
    ];
});
