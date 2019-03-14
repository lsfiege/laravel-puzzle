<?php

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->text(35),
        'body' => $faker->paragraph(rand(1, 3)),
        'user_id' => factory(\App\User::class)->create()->id
    ];
});
