<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\stolik;
use Illuminate\Support\Facades\DB;
use Exception;

class stoliksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return stolik::all();
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
        if($request->arr){
            foreach ($request->arr as $value) {
                stolik::create([
                    'xCoord'=>$value['xCoord'],
                    'yCoord'=>$value['yCoord'],
                ]); 
            }
            return "ok";
        }
        return stolik::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return stolik::find($id);
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
        if($request->release){
            $user =  DB::table("stoliks")->where('id','=',$id)->update([
                'taken'=>0,
                'taken_at'=>null,
                'waiter_id'=>null,
                'waiter_name'=>null,
            ]);
            return $user;
        }
        $product = stolik::find($id);
        if($request->waiterEdit){
            $user =  DB::table("stoliks")->where('id','=',$id)->update([
                'taken'=>$request->taken,
                'taken_at'=>$request->taken_at,
                'waiter_id'=>$request->waiter_id,
                'waiter_name'=>$request->waiter_name,
            ]);
            return $user;
        }
        try{
            $product->update($request->all());
        }catch(Exception $err){
            return $err;
        }
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
        return stolik::destroy($id);
    }
    public function deleteAll(){
        DB::table('stoliks')->delete();
    }
}
