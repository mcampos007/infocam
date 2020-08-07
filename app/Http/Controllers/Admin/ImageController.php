<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use File;
class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $product = Product::find($id);

        $images = $product->images()->orderBy('featured','desc')->get();
        return view('admin.products.images.index')->with(compact('product','images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //Guardar la imagen 
        
        $file = $request->file('photo');
        $path = public_path().'/images/products';
        $filename = uniqid().$file->getClientOriginalName();
        $moved = $file->move($path,$filename);

        //Crear Registro en BD
        if ($moved){


            $productImage = new ProductImage();
            $productImage->image = $filename;
            //$productImage->featuredv= ;
            $productImage->product_id = $id;
            $productImage->save(); //INSERT
         }   
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //eliminar el Archivo
        $productImage = ProductImage::find($request->image_id);
        if (substr($productImage->image,0,4) ==="http"){
            $deleted = true;            

        }else{
            $fullPath = public_path() . '/images/products/' . $productImage->image;
            $deleted = File::delete($fullPath);
        }
        //Eliminar el Registro
        if ($deleted){
            $productImage->delete();
        }
        return back();

    }

    public function select($id, $image){

        ProductImage::where('product_id',$id)->update([
            'featured' =>false
        ]);
        $productImage = ProductImage::find($image);
        $productImage->featured = true;
        $productImage->save();

        return back();
    }
}
