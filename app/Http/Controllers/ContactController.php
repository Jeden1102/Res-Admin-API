<?php

namespace App\Http\Controllers;
use App\Mail\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function subscribe(Request $request) 
{
 
        Mail::to('dom.rad14@gmail.com')->send(new Contact($request));
        return new JsonResponse(
            [
                'success' => true, 
                'message' => "Your contact e-mail has been send, please be patient and wait for our respond."
            ], 
            200
        );
}
}
