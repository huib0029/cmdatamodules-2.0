<?php

use Faker\Generator as Faker;

$factory->define(App\Task::class, function (Faker $faker) {
    return [
        'user_id' => str_random(10),
        'name' => $faker->name,
        'description' => $faker->text(200),
    ];
});
