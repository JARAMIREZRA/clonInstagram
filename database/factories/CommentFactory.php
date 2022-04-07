<?php
use App\User;
use App\Models\Image;
use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'image_id' => Image::all()->random()->id,
        'content' => $faker->text(200)
    ];
});
