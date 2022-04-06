<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Storage;
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
    public function productsGrupped(){
        return Product::all()->groupBy("category_id");
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
        $file_name = 'x';
        try{
            if($request->file()) {
                $file_name = time().'_'.$request->file->getClientOriginalName();
                $file_path = $request->file('file')->storeAs('uploads', $file_name, 's3');
                // Storage::disk('s3')->put($file_name,file_get_contents($request->file()));
                // $fileUpload->image_url = time().'_'.$request->file->getClientOriginalName();
        }
        }catch(Exception $err){
            return $err;
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
                    $fileUpload->chicken=$request->chicken;
                    $fileUpload->cheese=$request->cheese ;
                    $fileUpload->tomato=$request->tomato;
                    $fileUpload->paprika=$request->paprika;
                    $fileUpload->beef=$request->beef;
                    $fileUpload->special=$request->special;
                    $fileUpload->size=$value['size'];
                    $fileUpload->category_id=$request->category_id;
                    $fileUpload->save();
                }
            }catch(Exception $err){
                return $err;
            }
        }

            $fileUpload = new Product;
            $fileUpload->image_url = $file_name;
            $fileUpload->name=$request->name;
            $fileUpload->price=$request->price;
            $fileUpload->discount=$request->discount ? $request->discount : 0;
            $fileUpload->desc=$request->desc;
            $fileUpload->chicken=$request->chicken;
            $fileUpload->cheese=$request->cheese ;
            $fileUpload->tomato=$request->tomato;
            $fileUpload->paprika=$request->paprika;
            $fileUpload->beef=$request->beef;
            $fileUpload->special=$request->special;
            $fileUpload->size=$request->size;
            $fileUpload->category_id=$request->category_id;
             $fileUpload->save();
             return $fileUpload;

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
        // $test = $request->chicken == "true" ? "tak" : "nie";
        // $test2 = $request->cheese == "true" ? "tak" : "nie";
        // return response()->json(['cheicken'=>$test,'cheese'=>$test2]);

        $file_name = '';
        if($request->file()) {
            try{
                $file_name = time().'_'.$request->file->getClientOriginalName();
                $file_path = $request->file('file')->storeAs('uploads', $file_name, 's3');
               //  $fileUpload->image_url = time().'_'.$request->file->getClientOriginalName();
               $user =  DB::table("products")->where('id','=',$id)->update([
                'name'=>$request->name,
                'image_url'=>$file_name,
                'price'=>$request->price,
                'discount'=>$request->discount ? $request->discount : 0,
                'desc'=>$request->desc,
                'chicken'=>$request->chicken == "true" ? 1 :0,
                'cheese'=>$request->cheese == "true"  ? 1 :0,
                'tomato'=>$request->tomato ? 1 :0,
                'paprika'=>$request->paprika ? 1 :0,
                'beef'=>$request->beef ? 1 :0,
                'special'=>$request->special ? 1 :0,
                'size'=>$request->size,
                'category_id'=>$request->category_id,
            ]);
            }catch(Exception $err){
                return $err;
            }

        return $user;
        }else{
            try{
                $user =  DB::table("products")->where('id','=',$id)->update([
                    'name'=>$request->name,
                    'price'=>$request->price,
                    'discount'=>$request->discount ? $request->discount : 0,
                    'desc'=>$request->desc,
                    'chicken'=>$request->chicken == "true" ? 1 :0,
                    'cheese'=>$request->cheese  == "true" ? 1 :0,
                    'tomato'=>$request->tomato  == "true"? 1 :0,
                    'paprika'=>$request->paprika == "true"? 1 :0,
                    'beef'=>$request->beef == "true"? 1 :0,
                    'special'=>$request->special == "true"? 1 :0,
                    'size'=>$request->size,
                    'category_id'=>$request->category_id,
                ]);
                return $request->chicken;
            }catch(Exception $err){
                return $err;
            }

        }
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
