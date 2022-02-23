<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Exception;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
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
    public function store(Request $request)
    {
        $file_name = '';
        if($request->file()) {
            $file_name = time().'_'.$request->file->getClientOriginalName();
            $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');
           //  $fileUpload->image_url = time().'_'.$request->file->getClientOriginalName();
        }
        if($request->filled('variants')){
            try{
                $variants = json_decode($request->variants,true);
                foreach ($variants as $value) {
                    $fileUpload = new Product;
                    $fileUpload->image_url = $file_name;
                    $fileUpload->name=$request->name;
                    $fileUpload->price=$value['price'];
                    $fileUpload->discount=$request->discount ? $request->discount : 0;
                    $fileUpload->desc=$request->desc;
                    $fileUpload->chicken=$request->chicken ? 1 :0;
                    $fileUpload->cheese=$request->cheese  ? 1 :0;
                    $fileUpload->tomato=$request->tomato ? 1 :0;
                    $fileUpload->paprika=$request->paprika ? 1 :0;
                    $fileUpload->beef=$request->beef ? 1 :0;
                    $fileUpload->special=$request->special ? 1 :0;
                    $fileUpload->size=$value['size'];
                    $fileUpload->category_id=$request->category_id;
                    $fileUpload->save();
                }
            }catch(Exception $err){
                return $err;
            }

        }else{
            $fileUpload = new Product;
            $fileUpload->image_url = $file_name;
            $fileUpload->name=$request->name;
            $fileUpload->price=$request->price;
            $fileUpload->discount=$request->discount ? $request->discount : 0;
            $fileUpload->desc=$request->desc;
            $fileUpload->chicken=$request->chicken ? 1 :0;
            $fileUpload->cheese=$request->cheese  ? 1 :0;
            $fileUpload->tomato=$request->tomato ? 1 :0;
            $fileUpload->paprika=$request->paprika ? 1 :0;
            $fileUpload->beef=$request->beef ? 1 :0;
            $fileUpload->special=$request->special ? 1 :0;
            $fileUpload->size=$request->size;
            $fileUpload->category_id=$request->category_id;
             $fileUpload->save();
        }

         return response()->json(['success'=>'File uploaded successfully.']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $product = Product::find($id);
        $product->update($request->all());
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Product::destroy($id);
    }
}
