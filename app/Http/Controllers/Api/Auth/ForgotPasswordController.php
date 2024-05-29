<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class ForgotPasswordController extends Controller
{
    public function forgot(Request $request)
    {
        
        $this->validate($request,[
              'email' => 'required|email'
        ]);

        $email = $request->email;

        if(User :: where('email', $email)->doesntExist()){
            return response(['message' => 'Email does not exists' ],400);
        }

        $token = Str::random(20);
        DB::table('password_reset_tokens')->insert([
            'email' => $email,
            'token' => $token
        ]);


      
    }



    public function password(Request $request)
    {
        
        $this->validate($request,[
              'email' => 'required|email'
        ]);

        $email = $request->email;

        if(User :: where('email', $email)->doesntExist()){
            return response(['message' => 'Email does not exists' ],400);
        }

        $token = Str::random(20);
        DB::table('password_reset_tokens')->insert([
            'email' => $email,
            'token' => $token
        ]);


      
    }
}
