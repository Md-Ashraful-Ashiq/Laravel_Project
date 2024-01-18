<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $role = Role::find($user->role_id);

            if ($role && $role->is_settings_enabled) {
                return redirect('permission');
            } else {
                Auth::logout();
                return redirect('login')->withError('Not allowed to login here');
            }
        }

        return redirect('login')->withError('Login details are not valid');
    }
       
    public function showRegistrationForm()
    {
        $roles = Role::all();
        return view('auth.register', compact('roles'));
    }

    public function register(Request $request)
    {
        // validate
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed',
            'role' => 'required|exists:roles,id', // Adjust the validation rule
        ]);

        // save in users table
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role,
        ]);

        // Attach the selected role to the user
        $user->role()->associate($request->role);

    return redirect('login')->withSuccess('User created successfully. Please login.');
    }

    public function home()
    {
        return view('home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('');
    }
}