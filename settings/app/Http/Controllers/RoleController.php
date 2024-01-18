<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    // Display a list of existing roles
    public function index()
    {
        $roles = Role::withCount('users')->get();
        return view('roles.index', ['roles' => $roles]);
    }

    // Create a new role (GET request)
    public function create()
    {
        return view('roles.create');
    }

    // Store a new role (POST request)
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'roleName' => 'required',
        ]);

        // display the checkbox state in the UI
        $isAdminEnabled = $request->input('is_admin_enabled') ? 1 : 0;
        $isSettingsEnabled = $request->input('is_settings_enabled') ? 1 : 0;
        $isOperationEnabled = $request->input('is_operation_enabled') ? 1 : 0;
        $isAuditEnabled = $request->input('is_audit_enabled') ? 1 : 0;

        // Create and store the role with toggle values
        Role::create([
            'roleName' => $request->input('roleName'),
            'is_admin_enabled' => $isAdminEnabled,
            'is_settings_enabled' => $isSettingsEnabled,
            'is_operation_enabled' => $isOperationEnabled,
            'is_audit_enabled' => $isAuditEnabled,
        ]);
        return redirect()->route('permission')->with('success', 'Role created successfully');
    }

    public function checkUsers($roleId)
    {
        $userCount = DB::table('users')->where('role_id', $roleId)->count();

        return response()->json(['userCount' => $userCount]);
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        // Check if there are users with the selected role
        $hasUsers = DB::table('users')->where('role_id', $role->id)->exists();

        if ($hasUsers) {
            return response()->json(['success' => false, 'message' => 'Cannot delete role with active users.']);
        }

        $role->delete();

        return response()->json(['success' => true, 'message' => 'Role deleted successfully.']);
    }
}
