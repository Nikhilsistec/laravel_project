<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\AddUpdateController;
use App\Http\Controllers\Api\Auth\ImageController;
use App\Http\Controllers\Api\Auth\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login',[AuthController::class, 'login']);
Route::post('register',[RegisterController::class, 'register']);
Route::get('users', [AddUpdateController::class, 'showUsers']);
//Serach API Route......
Route::get('search/{first_name}',[AddUpdateController::class,'search']);




Route::middleware(['auth:api'])->group(function (){
    Route::post('adduser',[AddUpdateController::class, 'AddUsers']);
    Route::delete('users/{id}', [AddUpdateController::class, 'deleteUser']);
    
    Route::prefix('users')->group(function () {
        Route::get('{id}', [AddUpdateController::class, 'getUser']);
        Route::put('update/{id}', [AddUpdateController::class, 'updateUser']);
    });
    Route::put('restoreuser/{id}', [AddUpdateController::class, 'restoreUser']);
    Route::post('image',[ImageController::class,'UploadImage']);
    Route::post('forgot',[ForgotPasswordController::class, 'forgot']);
});



Route::post('/upload', [UserController::class, 'upload']);