<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;

class RegisterUserApi extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'account_role_id' => 2,
            'phone' => $request->phone
        ]);

        event(new Registered($user));

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $userEmail = $user->email;
            Mail::to($userEmail)->send(new RegisterMail());
            return  response()->json([
                'message' => 'User created successfully',
                'user' => $user
            ], 201);
        }
        return response()->json(['error' => 'Unauthorised'], 401);
    }
}
