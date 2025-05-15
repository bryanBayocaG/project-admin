<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserUpdateInfoRequest;
use App\Http\Requests\UserUpdatePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    //
    public function register(RegisterRequest $request){
        $user = User::create([
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),

        ]);
        return response($user, Response::HTTP_CREATED);
    }

    public function login(Request $request){
        if(!Auth::attempt($request->only('email', 'password'))){
            return response([
                'error' => 'Invalid Credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }
        /** @var User $user */
        $user = Auth::user();
        $jwt = $user->createToken('token')->plainTextToken;
        $cookie = cookie('jwt', $jwt, 60*24);
        return response([
            'jwt' => $jwt
        ])->withCookie($cookie);
    }
    public function user(Request $request){
        return $request->user();
    }

    public function logout()
    {
        $cookie = Cookie::forget('jwt');
        return response([
            'message' => 'success'
        ])->withCookie($cookie);
    }

    public function updateInfo(UserUpdateInfoRequest $request){

        $user = $request->user();
        $user->update($request->only('firstName', 'lastName', 'email'));
        return response($user, Response::HTTP_ACCEPTED);
    }

        public function updatePassword(UserUpdatePasswordRequest $request){
        $user = $request->user();
        $user->update([
            'password' => Hash::make($request->input('password')),
        ]);
        return response($user, Response::HTTP_ACCEPTED);
    }
}