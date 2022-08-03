<?php

namespace App\Http\Controllers;

use App\Models\TeamSales;
use App\Models\TeamSalesGroup;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.auth.login', [
            'title' => 'Login',
        ]);
    }
    
    public function home()
    {
        if (Auth::user()->user_role == 0) {
            return redirect('/dashboard');
        }
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
        }
      
        return back()->with('loginError', "Your login credentials don't match!");
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('logout', 'You Have Logged Out');
    }
}
