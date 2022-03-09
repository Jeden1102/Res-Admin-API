<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Storage;
use App\Models\movie;
class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return movie::all();
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
                // $file_path = $request->file('file')->storeAs('uploads', $file_name, 's3');
                $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');
            //    $url = Storage::put('public/uploads', $request->file('file'));
            //    Storage::disk('local')->put($file_name, $request->file('file'));
                // Storage::disk('s3')->put($file_name,file_get_contents($request->file()));
                // $fileUpload->image_url = time().'_'.$request->file->getClientOriginalName();
                $fileUpload = new movie;
                $fileUpload->path = $file_name;
                $fileUpload->save();
                return $file_name;
        }else{
            return "nie";
        }
        }catch(Exception $err){
            return $err;
        }
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
    public function destroy($id)
    {
        //
    }
}
