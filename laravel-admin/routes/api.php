<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post("register", [AuthController::class, "register"]);
Route::post("login", [AuthController::class, "login"]);

Route::middleware('auth:sanctum')->group(function (){
    Route::get('user', [AuthController::class,'user']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::put('user/updateInfo', [AuthController::class,'updateInfo']);
    Route::put('user/password', [AuthController::class,'updatePassword']);
    Route::get('role', [RoleController::class, 'index']);
    Route::get('permission', [PermissionController::class, 'index']);

    Route::apiResource('users', UserController::class);
    Route::apiResource('roles', RoleController::class);
});