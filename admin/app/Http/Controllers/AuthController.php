<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\LoginHistory;
use Illuminate\Support\Facades\Log;


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

            if ($role && $role->is_admin_enabled) {
                $loginHistory = LoginHistory::create([
                    'user_id' => $user->id,
                    'login_time' => now(),
                ]);

                // Store login history ID in the session for later use
                $request->session()->put('login_history_id', $loginHistory->id);

                return redirect('home');
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
            'role' => 'required|exists:roles,id',
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

        // login user here
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('home');
        }

        return redirect('register')->withError('Error');
    }

    public function home()
    {
        return view('home');
    }

    public function logout(Request $request)
    {
        $loginHistoryId = $request->session()->get('login_history_id');

        if ($loginHistoryId) {
            // Update logout time and calculate total login time
            $loginHistory = LoginHistory::find($loginHistoryId);
            if ($loginHistory) {
                // Update logout time and calculate total login time
                $totalLoginTime = $loginHistory->getTotalLoginTimeAttribute(); // Calculate total login time
                $loginHistory->update([
                    'total_login_time' => $totalLoginTime, // Set total login time
                    'logout_time' => now(),
                ]);
            } else {
                Log::warning('Login history not found for ID: ' . $loginHistoryId);
            }
        }

        Auth::logout();
        $request->session()->forget('login_history_id');
        return redirect('');
    }
}
