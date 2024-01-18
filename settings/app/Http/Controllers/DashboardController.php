<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class DashboardController extends Controller
{
    public function index()
{
    // return view('dashboard');
    $roles = Role::all();
    return view('dashboard', compact('roles'));
}
}
