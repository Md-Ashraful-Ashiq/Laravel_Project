<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class OperationController extends Controller
{
    public function showOperationManagementPage()
    {
    return view('Operation.index');    
    }
}
