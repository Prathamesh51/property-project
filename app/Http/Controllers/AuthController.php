<?php

namespace App\Http\Controllers;

use App\Enums\CreatedVia;
use App\Jobs\SendUserApprovedMail;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

        if ($user->role !== $role) {
            Auth::logout();
            return back()->with('error', 'You do not have access to this role');
        }

        if (!$user->is_active) {
            if($user->created_via === CreatedVia::SELF_REGISTER) {
                Auth::logout();
                return back()->with('error', 'Your account is not active. Please wait for admin approval.');
            }
            Auth::logout();
            return back()->with('error', 'Your account is not active');
        }

        return redirect('/property');

    }

    public function logout()
    {
        if(Auth::check()){
            Auth::logout();
            return redirect()->route('login');
        }
        return redirect()->route('login');

    }

    public function userRegisterForm()
    {
        return view('auth.registerForm');
    }

    public function userRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'confirmed_password' => 'required|string|min:6|same:password',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'user';
        $user->is_active = false;
        $user->created_via = CreatedVia::SELF_REGISTER;
        $user->save();

        return redirect()->route('login')->with('success', 'Registration successful. Please wait for admin approval.');
    }

    public function userRequests()
    {
        $users = User::where('role','user')
                ->where('created_via', CreatedVia::SELF_REGISTER)
                ->get();
        $userName = Auth::user()->name;
        return view('property.userRequests', compact('users', 'userName'));
    }

    public function approveUser($userId)
    {
        
        $user = User::findOrFail($userId);
        $user->is_active = true;
        $user->save();

        SendUserApprovedMail::dispatch($user);
        // $token = Str::random(64);

        // DB::table('password_resets')->insert([
        //     'email' => $user->email,
        //     'token' => $token,
        //     'created_at' => now()
        // ]);
        // SendUserApprovedMail::dispatch($user, $token);
        
        return redirect()->back()->with('success', 'User approved successfully.');
    }

    public function usersList()
    {
        $users = User::where('is_active', true)->get();
        $roles = Role::all();
        $userName = Auth::user()->name;
        return view('property.usersList', compact('users', 'userName','roles'));
    }

}
