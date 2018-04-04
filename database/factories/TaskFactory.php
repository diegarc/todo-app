<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Task::class, function (Faker $faker) {
    return [
        'text' => $faker->name,
        'user_id' => factory(\App\Models\User::class)->create()->id
    ];
});
