<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::paginate());
    }
  
    public function store(UserCreateRequest $request)
    {
        $user = User::create(
            $request->only('firstName', 'lastName', 'email', 'role_id')
            + ['password' => Hash::make(1234) ]   
        );
    }
 
    public function show(string $id)
    {
        return new UserResource(User::find($id));
    }

    public function update(UserUpdateRequest $request, string $id)
    {
        $user = User::find($id);
        $user->update($request->only('firstName', 'lastName', 'email', 'role_id'));
    return response($user, Response::HTTP_ACCEPTED);
    }

    public function destroy(string $id)
    {
        User::destroy($id);
        return response(null, Response::HTTP_NO_CONTENT);
    }
}