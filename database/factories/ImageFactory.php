<?php
use App\User;
use App\Models\Image;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'image_path' => $faker->imageUrl(640, 480),
        'description' => $faker->text(200)
    ];
});
