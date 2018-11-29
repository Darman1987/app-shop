<?php

use Illuminate\Database\Seeder;
use App\Product; //importo modelo
use App\Category; //importo modelo
use App\ProductImage; //importo modelo

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //model factory 
        // factory(Category::class,5)->create();
        // factory(Product::class,100)->create(); //crea objetos y los inserta en base de datos  si se usar make en vez de create solo se crean los objetos pero no se insertan el numero 100 indica que se crean 100 registros
        
        // factory(ProductImage::class,200)->create();
        // 
        
        $categories = factory(Category::class,5)->create();
        $categories->each(function ($category){
        	$products = factory(Product::class,20)->make();
        	$category->products()->saveMany($products);

        	$products->each(function ($p){
                $images = factory(ProductImage::class,5)->make();
        	    $p->images()->saveMany($images);
        	});

        });

        //creacion de 5 categorias . por cada categoria crea 20 productos y por cada producto crea 5 imagenes.
        //para poder hacer esta relacion se deben haber ya hecho relaciones entre los modelos
    }
}
