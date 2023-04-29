<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginMail;

class LoginApi extends Controller
{
    public function store(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $userEmail = $request->email;
            Mail::to($userEmail)->send(new LoginMail());
            return auth()->user();
        }
        return response()->json(['error' => 'Unauthorised'], 401);
    }
}
