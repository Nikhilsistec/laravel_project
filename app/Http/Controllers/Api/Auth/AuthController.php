<?php

namespace App\Http\Controllers\Api\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
   public function login(Request $request)
   {

      $validatedData = $request->validate([
        'email'=>['required','email'],
        'password'=>['min:8']
       ]);

    $user = User::where(['email' => $validatedData['email']])->first();

    if (!$user || !Hash::check($validatedData['password'], $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // $token = $user->createToken("auth_token")->accessToken;

         $accessToken = $user->createToken("auth_token")->accessToken;

         // Save the token to the database
         DB::table('oauth_access_tokens')
             ->where('id', $accessToken)
             ->update(['user_id' => $user->id]);



    return response()->json([
        // 'token' => $token,
        'token' => $accessToken,
        'user' => $user,
        'message' => 'User login successful',
        'status' => 1
    ]);
   }

   
}
