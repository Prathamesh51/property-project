<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function adminLoginForm()
    {
        return view('auth.adminLogin');
    }

    public function userLoginForm()
    {
        return view('auth.userLogin');
    }

    public function adminLogin(Request $request)
    {
       return $this->login($request, 'admin');
    }

    public function userLogin(Request $request)
    {
        return $this->login($request, 'user');
    }

    public function login(Request $request, string $role)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($credentials)) {
            return back()->with('error', 'Invalid email or password');
        }

        $request->session()->regenerate();

        $user = Auth::user();

        if (Auth::user()->role == $role) {
            return redirect('/property');
        }

        return back()->with('error', 'Invalid email or password');

    }

    public function logout()
    {
        if(Auth::check()){
            Auth::logout();
            return redirect()->route('login');
        }
        return redirect()->route('login');

    }

}
