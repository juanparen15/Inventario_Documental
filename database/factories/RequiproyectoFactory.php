<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Requiproyecto;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
$factory->define(Requiproyecto::class, function (Faker $faker) {
    $detproyecto = $this->faker->unique()->word(20);
        return [
            'detproyecto'=> $detproyecto,
            'slug'=> Str::slug($detproyecto)
    ];
});
