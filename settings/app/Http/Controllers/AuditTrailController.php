<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AuditTrailController extends Controller
{
    public function index()
    {
        $auditData = User::leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->select('users.name', 'roles.roleName', 'users.created_at', 'users.updated_at')
            ->get();

        return view('AuditTrail.index', ['auditData' => $auditData]);
    }
    
    public function fetchUserAuditData(Request $request)
    {
        // Access parameters from the request
        $from = $request->input('date_range_from');
        $to = $request->input('date_range_to');

        $startDate = Carbon::parse($from)->format('Y-m-d') . ' 00:00:00';
        $endDate = Carbon::parse($to)->format('Y-m-d') . ' 23:59:59';

        // Example: Fetch data from the database based on the parameters
        $data = DB::table('users')
        ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
        ->leftJoin('user_activities', 'users.id', '=', 'user_activities.user_id')
        ->select('users.name', 'roles.roleName', 'user_activities.activity', 'user_activities.created_at as activity_created_at', 'users.created_at', 'user_activities.created_at as updated_at')
        ->whereBetween('user_activities.created_at', [$startDate, $endDate])
        ->orderBy('user_activities.created_at', 'desc')
        ->get();
    
        return response()->json($data);
    }   

    public function fetchAccessConfigAuditData(Request $request)
{
    // Access parameters from the request
    $from = $request->input('date_range_from');
    $to = $request->input('date_range_to');

    $startDate = Carbon::parse($from)->format('Y-m-d') . ' 00:00:00';
    $endDate = Carbon::parse($to)->format('Y-m-d') . ' 23:59:59';

    // Example: Fetch data from the database based on the parameters
    $data = DB::table('users')
        ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
        ->leftJoin('user_activities', 'users.id', '=', 'user_activities.user_id')
        ->select('users.name', 'roles.roleName', 'user_activities.activity', 'user_activities.created_at as activity_created_at', 'users.created_at', 'user_activities.created_at as updated_at')
        ->whereBetween('user_activities.created_at', [$startDate, $endDate])
        ->orderBy('user_activities.created_at', 'desc')
        ->get();

    return response()->json($data);
}
}
