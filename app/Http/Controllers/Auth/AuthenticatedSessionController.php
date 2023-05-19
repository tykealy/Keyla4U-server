<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginMail;
use Illuminate\Support\Facades\Redirect;
class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        if (! Gate::allows('CanAccessDashboard',Auth::user())) {
            Auth::logout();
            abort(403);
        }else{
            //sending mail to admin
            $userEmail = Auth::User()->email;
            Mail::to($userEmail)->send(new LoginMail());
            
            if(Gate::allows('admin',Auth::user())){
                $request->session()->regenerate();
                return redirect()->intended(RouteServiceProvider::HOME); 
            }else{
                $request->session()->regenerate();
                return redirect::route('super_admin_dashboard');
            }
                
        }
    }   
    
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
