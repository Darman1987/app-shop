<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function index(){
    	$products = Product::paginate(10); //se cambia all por paginate para mostrar de a 10 registros
    	return view('admin.products.index')->with(compact('products'));
    }

    public function create(){
    	return view('admin.products.create');
    }

    public function store(Request $request){
        // dd($request->all()); //el metodo dd imprime los valores que se envian y el metodo trae todos los valores de la peticion
        $product = new Product();
        $product->name = $request->input('name'); 
        $product->description = $request->input('description'); 
        $product->price = $request->input('price'); 
        $product->long_description = $request->input('long_description');
        $product->save(); //ejecuta insert sobre la tabla de productos
        return redirect('/admin/products'); 
    }

    public function edit($id){
        $product = Product::find($id);
        return view('admin.products.edit')->with(compact('product'));
    }

    public function update(Request $request, $id){
        // dd($request->all()); //el metodo dd imprime los valores que se envian y el metodo trae todos los valores de la peticion
        $product =  Product::find($id);  //con esto entiende que es un producto que ya existia
        $product->name = $request->input('name'); 
        $product->description = $request->input('description'); 
        $product->price = $request->input('price'); 
        $product->long_description = $request->input('long_description');
        $product->save(); //update
        return redirect('/admin/products'); 
    }

     public function destroy($id){
        // dd($request->all()); //el metodo dd imprime los valores que se envian y el metodo trae todos los valores de la peticion
        $product =  Product::find($id);  //con esto entiende que es un producto que ya existia

        $product->delete(); //eliminar
        return back(); // hace un redirect a la pagina anterior
    }
}
