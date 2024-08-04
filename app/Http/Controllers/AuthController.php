<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $this->success(
            '',
            ['token' => $user->createToken($request->email)->plainTextToken]
        );
    }


    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $user->assignRole('customer');

        if ($request->hasFile('photo')) {
           $path = $request->file('photo')->store('users/'.$user->id, 'public');
        }

        $user->photos()->create([
            'full_name' => $request->file('photo')->getClientOriginalName(),
            'path' => $path
        ]);

        return $this->success(
            'user created',
            ['token' => $user->createToken($request->email)->plainTextToken]
        );
    }


    public function logout()
    {
        auth()->user()->tokens()->delete();

        return $this->success('user logged out');
    }

    public function user(Request $request)
    {
        return $this->response(new UserResource($request->user()));
    }
}
