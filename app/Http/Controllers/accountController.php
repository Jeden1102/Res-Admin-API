<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Hash;
class accountController extends Controller
{
    function create(Request $request)
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $request
     * @return \Illuminate\Contracts\Validation\Validator
     */

    try{
        $createUser = DB::table("users")->insertGetId([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'surname'=>$request->surname,
            'salary'=>$request->salary,
            'isAdmin'=>$request->isAdmin,
        ]);
        $user = DB::table('users')->where('id','=',$createUser)->get();
        $response = [
            'user'=>$user,
            'info'=>'User has been created succesfully'
        ];
    return response($response, 200);
    }catch(Exception $err){
        return response('There was some error', 404);
    }


}

    public function login(Request $req){
        $user = DB::table('users')->where('email','=',$req->email)->get();
        if($user->count()){
            if(Hash::check($req->password, $user[0]->password)){
                $response = [
                    'user'=>$user,
                    'info'=>'User has logged in  succesfully'
                ];
                return response($response,200);
            }else{
                return response('Bad password', 404);
            }
        }else{
            return response('No user with such email', 404);
        }
    }
}
