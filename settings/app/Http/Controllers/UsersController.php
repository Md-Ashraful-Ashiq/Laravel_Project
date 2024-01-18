<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function showUsersPage()
{
    $users = User::all();
    $roles = Role::all();
        $auditData = User::leftJoin('roles', 'users.role_id', '=', 'roles.id')
        ->select('users.name', 'roles.roleName', 'users.created_at', 'users.updated_at')
        ->get();

    return view('Users.index', ['auditData' => $auditData, 'users' => $users, 'roles' => $roles]);    
    }

    public function getUsersList()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function fetchUserAuditData(Request $request)
{
    // Access parameters from the request
    $from = $request->input('date_range_from');
    $to = $request->input('date_range_to');

    // Check if date range parameters are provided
    if ($from && $to) {
        $startDate = Carbon::parse($from)->format('Y-m-d') . ' 00:00:00';
        $endDate = Carbon::parse($to)->format('Y-m-d') . ' 23:59:59';

    // Fetch data from the database 
        $data = DB::table('users')
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->leftJoin('user_activities', 'users.id', '=', 'user_activities.user_id')
            ->select('users.name', 'roles.roleName', 'user_activities.activity', 'user_activities.created_at as activity_created_at', 'users.created_at', 'user_activities.created_at as updated_at')
            ->whereBetween('user_activities.created_at', [$startDate, $endDate])
            ->orderBy('user_activities.created_at', 'desc')
            ->get();
    } else {
        // Fetch all data without date range filtering
        $data = DB::table('users')
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->leftJoin('user_activities', 'users.id', '=', 'user_activities.user_id')
            ->select('users.name', 'roles.roleName', 'user_activities.activity', 'user_activities.created_at as activity_created_at', 'users.created_at', 'user_activities.created_at as updated_at')
            ->orderBy('user_activities.created_at', 'desc')
            ->get();
    }

    return response()->json($data);
}

}
