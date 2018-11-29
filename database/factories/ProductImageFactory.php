<?php

use Faker\Generator as Faker;
use App\ProductImage; //importo modelo

$factory->define(ProductImage::class, function (Faker $faker) {
    return [
         'image' => $faker->imageUrl(250,250),   //imagen aleatorio de 250 x250
         'product_id' => $faker->numberBetween(1,100) //numero aleatorio entre 1 y 100
    ];
});
