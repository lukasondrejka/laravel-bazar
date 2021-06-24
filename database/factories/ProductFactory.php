<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
            //'id' => 1,
            //'user_id' => function () {
            //    return factory(App\User::class)->create()->id;
            //},
            'user_id' => 1,
            'category_id' => 5,
            'title' => $faker->sentence(),
            'description' => $faker->paragraph(),
            'photo' => null,
            'price' => $faker->numberBetween($min = 10, $max = 1000),
            'type' => 'ponuka',
            'created_at' => now(),
            'updated_at' => now(),
    ];
});
