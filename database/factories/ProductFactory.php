<?php

use Faker\Generator as Faker;
use App\Product; //importo modelo

$factory->define(Product::class, function (Faker $faker) { //se cambio Model por  Product
    return [
        
            'name' => substr($faker->sentence(3),0,-1),  //se usa substr para quitar el punto final
            'description' => $faker->sentence(10), //oracion de 10 palabras
            'long_description' => $faker->text, //texto aleatorio
            'price' => $faker->randomFloat(2,5,150), // valor float de 2 decimales y valor minimo 5 y maximo 150
			'category_id' => $faker->numberBetween(1,5) //numero entre 1 y 5
    ];
});
