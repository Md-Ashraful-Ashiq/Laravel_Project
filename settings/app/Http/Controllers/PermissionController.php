<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class PermissionController extends Controller
{
    public function index()
{
    //return view('permission');
    $roles = Role::all();
    return view('layouts.permission', compact('roles'));    
}
}