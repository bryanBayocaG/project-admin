<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }
  
    public function store(Request $request)
    {
        $user = User::create(
            $request->only('firstName', 'lastName', 'email')
            + ['password' => Hash::make(1234) ]   
        );
    }
 
    public function show(string $id)
    {
        return User::find($id);
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->update($request->only('firstName', 'lastName', 'email'));
    return response($user, Response::HTTP_ACCEPTED);
    }

    public function destroy(string $id)
    {
        User::destroy($id);
        return response(null, Response::HTTP_NO_CONTENT);
    }
}