<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class TestController extends Controller
{
    //
    
    public function welcome(){

    	$products = Product::paginate(9);  // retorna todos los datos de la tabla productos se cambio all por paginate
    	return view('welcome')->with(compact('products'));  //compact crea un arreglo asociativo de lo contenido en la variable products
    }
}
