<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $activityData = User::leftJoin('roles', 'users.role_id', '=', 'roles.id')
        ->leftJoin('login_history', 'users.id', '=', 'login_history.user_id')
        ->select('users.name', 'roles.roleName', 'login_history.total_login_time', 'login_history.login_time','login_history.logout_time')
        ->get();

    $users = User::all();

    return view('history.activitylog.index', ['activityData' => $activityData, 'users' => $users]);
}

public function fetchUserActivityData(Request $request)
{
    // Access parameters from the request
    $selectedDate = $request->input('selected_date');
    $selectedUsername = $request->input('selected_username');

    // Example: Fetch data from the database based on the selected date
    $data = DB::table('users')
        ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
        ->leftJoin('login_history', 'users.id', '=', 'login_history.user_id')
        ->select(
            'users.name',
            'roles.roleName',
            DB::raw('TIMEDIFF(login_history.logout_time, login_history.login_time) as total_login_time'),
            'login_history.login_time',
            'login_history.logout_time'
        )
        ->whereDate('login_history.login_time', '=', $selectedDate)
        ->when($selectedUsername, function ($query) use ($selectedUsername) {
            return $query->where('users.name', $selectedUsername);
        })
        ->get();

    return response()->json($data);
}
   
}