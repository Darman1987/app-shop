<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use File;

class ImageController extends Controller
{
    public function index($id){
    	
    	$product = Product::find($id);
    	$images = $product->images()->orderBy('featured','desc')->get(); //el metodo get se usa para finalizar la consulta
         return view('admin.products.images.index')->with(compact('product','images'));;
    }

    public function store(Request $request, $id){
    	//guardar la imagen en nuestro proyecto
       $file = $request->file('photo');
       $path = public_path().'/images/products'; //public_path ruta absoluta a la carpeta public
       $fileName = uniqid().$file->getClientOriginalName(); //uniqid  devuelve un id unico en base a la hora
       $moved = $file->move($path, $fileName); //guardar archivo en ruta y con nombre $fileName
       //crear un registro en la bd  product_images //
       if($moved){ //hasta que no se mueva la imagen no se hace el registro en bd
            $productImage = new productImage();
           $productImage->image= $fileName;
           //$productImage->featured= false;
           $productImage->product_id= $id;
           $productImage->save(); //INSERT
       }
       
       return back();
    }

    public function destroy(Request $request){
    	//eliminar el archivo
       $productImage = ProductImage::find($request->image_id);// $request->image_id tambien se puede acceder de esta forma al name del formulario
       //eliminar el registro en bd
       
       if(substr($productImage->image,0,4)==='http'){
          $delete = true;
        }else{
          $fullPath = public_path().'/images/products/'.$productImage->image;
          $delete = File::delete($fullPath);
        }

        if($delete){
         $productImage->delete();
        }

        return back();
    
    }

    public function select($id, $image){

        ProductImage::where('product_id', $id)->update([
          'featured'=> false,
        ]);

        $productImage = ProductImage::find($image);
        $productImage->featured = true;
        $productImage->save();

        return back();
       
    }
}
