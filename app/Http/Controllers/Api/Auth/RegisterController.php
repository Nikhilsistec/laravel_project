<?php

namespace App\Http\Controllers\Api\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class RegisterController extends Controller
{
      public function register(Request $request)
      {
           $this->validate($request ,[
               'name'=>'required',
               'email' => 'required|unique:users',
               'password' => ['required', 'string', 'min:8', 'max:20', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/','confirmed'],
               
            ]);

            $user = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
            ]);

            // $user = User::create($validatedData);
            // $token = $user->createToken("auth_token")->accessToken;
            return response()->json(
                [
                      'user' => $user,
                      'password' => $user->password,
                      'message' => 'User Register SuccessFully!!!!',
                      'status' => 1
                ]
                );

      }


}

































































































  //    $validatedData = $this->validate($request ,[
            //    'name'=>'required',
            //    'email' => 'required|unique:users',
            //    'password'=> 'required|confirmed',
            // ]);

            // $user = User::create([
            //     'name'=>$request->name,
            //     'email'=>$request->email,
            //     'password'=>Hash::make($request->password),
            // ]);

            // $user = User::create($validatedData);
            // $token = $user->createToken("auth_token")->accessToken;
            // return response()->json(
            //     [
            //           'token' => $token,
            //           'user' => $user,
            //           'password' => $user->password,
            //           'message' => 'User Register SuccessFully!!!!',
            //           'status' => 1
            //     ]
            //     );


            // return response([
            //     'message' => 'User Successfully Register'
            // ],200);

