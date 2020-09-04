<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name'     => $faker->name,
        'family'   => $faker->lastName,
        'username' => $faker->userName,
        'mobile'   => '09365895522',
        'email'    => $faker->email,
        'password' => \Illuminate\Support\Facades\Hash::make('secret'),
        'status'   => true,
    ];
});
