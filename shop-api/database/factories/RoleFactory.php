<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'label'       => $faker->title,
        'title'       => $faker->title,
        'description' => $faker->text(191),
        'delete_able' => false
    ];
});
