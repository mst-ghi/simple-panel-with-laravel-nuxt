<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Permission;
use Faker\Generator as Faker;

$factory->define(Permission::class, function (Faker $faker) {
    return [
        'label'       => $faker->title,
        'title'       => $faker->title,
        'description' => $faker->text(191),
        'delete_able' => false
    ];
});
