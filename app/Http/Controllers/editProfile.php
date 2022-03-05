<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class editProfile extends Controller
{
        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $file_name = '';
        if($request->file()) {
            try{
                $file_name = time().'_'.$request->file->getClientOriginalName();
                $file_path = $request->file('file')->storeAs('uploads/avatars', $file_name, 's3');

               $user =  DB::table("users")->where('id','=',$id)->update([
                'name'=>$request->name,
                'surname'=>$request->surname,
                'email'=>$request->email,
                'photo_url'=>$file_name,
            ]);
            }catch(Exception $err){
                return $err;
            }
        return DB::table('users')->where('id','=',$id)->get();
        }else{
            try{
                $user =  DB::table("users")->where('id','=',$id)->update([
                    'name'=>$request->name,
                    'surname'=>$request->surname,
                'email'=>$request->email,
                ]);
                return DB::table('users')->where('id','=',$id)->get();
            }catch(Exception $err){
                return $err;
            }

        }
    }

    public function changePassword(Request $request, $id)
    {
        $user =  DB::table('users')->where('id','=',$id)->get();
        if (Hash::check($request->oldPwd, $user[0]->password)) {
            if($request->newPwd == $request->newPwdRepeat){
                DB::table("users")->where('id','=',$id)->update([
                    'password'=>Hash::make($request->newPwd),
                ]);
                return "Password updated succefully!";
            }else{
                return "Passwords are not the same";
            }
        }else{
            $response = [
                'info'=>'Wrong password',
            ];
        return response($response, 400);
        }

        // $user =  DB::table("users")->where('id','=',$id)->update([
        //     'name'=>$request->name,
        //     'surname'=>$request->surname,
        // 'email'=>$request->email,
        // ]);
      

    }
}
