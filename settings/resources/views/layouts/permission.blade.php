@extends('layouts.app')

@section('content')
<div id="chooseRole">
    <div class="w-100 shadow-sm p-3 mb-1 d-flex justify-content-between align-items-center">
        <h2 class="mb-0">Permission</h2>
        <div class="ml-auto">
            <button id="access_config_add_button" type="submit" class="btn btn-sm btn-warning" data-toggle="modal">
                <i class="fas fa-plus pr-1"></i> Add New Role
            </button>
        </div>
    </div>
</div>


<!-- choose role top heading starts -->
<div id="chooseRole1" class="row p-3">
    <div class="col-sm-6 form-row py-1">
        <label class="col-1 col-form-label">Roles</label>
        <div class="col role-picker">
            <select id="access_config_role" class="selectpicker form-control" data-style="border" data-width="100%" data-live-search="true">
                @foreach($roles->sortByDesc('created_at') as $role)
                <option value="{{ $role->id }}" data-admin-enabled="{{ $role->is_admin_enabled }}" data-settings-enabled="{{ $role->is_settings_enabled }}" data-operation-enabled="{{ $role->is_operation_enabled }}" data-audit-enabled="{{ $role->is_audit_enabled }}" data-users-count="{{ $role->users_count }}">
                    {{ $role->roleName }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-6 form-row py-1 d-flex align-items-center">
        <div>
            <label id="access_config_user_count" class="col-form-label mr-2">(30 Users)</label>
        </div>
        <div class="mr-2">
            <button id="access_config_delete_button" type="button" class="btn btn-sm btn-danger">
                <i class="fas fa-trash pr-1"></i> Delete
            </button>
        </div>
        <div>
            <button id="access_config_duplicate_button" type="button" class="btn btn-sm btn-secondary">
                <i class="fas fa-copy pr-1"></i> Clone
            </button>

        </div>
    </div>
</div>

<div class="row p-3" style="background: black; position: fixed; bottom: 0; width: 100%;">
    <div class="col-12">
        <div class="d-flex">
            <button type="submit" id="access_config_cancel_button" class="btn btn-light btn-sm mr-2 d-none">Cancel</button>
            <button type="submit" id="access_config_save_button" class="btn btn-warning btn-sm" style="margin-left: auto; max-width: 110px; margin-right: 370px;">Update Role</button>
        </div>
    </div>
</div>

<!-- choose role top heading ends -->

<!-- New role top heading starts -->
<div id="newRole" class="row p-3 d-none">
    <div class="col-sm-6 form-row py-1">
        <label class="col-1 col-form-label">Roles</label>
        <div class="col">
            <form method="POST" action="{{ route('roles.store') }}">
                @csrf
                <input name="roleName" id="access_config_new_role" type="text" class="form-control" placeholder="Enter Role Name">
        </div>
    </div>
    <div class="col-sm-6 form-row py-1 d-flex align-items-center">
        <div class="ml-auto">
        </div>
    </div>
    <div class="row p-3" style="background: black; position: fixed; bottom: 0; width: 100%;">
        <div class="col-12">
            <div class="d-flex justify-content-end">
                <button type="submit" id="access_config_cancel_button" class="btn btn-light btn-sm mr-2" style="margin-left: 135vh; max-width: 90px;">Cancel</button>
                <button type="submit" id="create-new-role" class="btn btn-warning btn-sm" style="margin-left: auto; max-width: 130px; margin-right: 370px;">Create New Role</button>
            </div>
        </div>
    </div>
</div>

<div class="row p-3 position-relative">
    <!-- increase the size of card in width (default: col-10) -->
    <div class="custom-content-scrollbar col-11 pl-0">

        <!-- admin tab starts -->

        <div class="admin card bg-white shadow-sm mb-3 rounded wider-card">
            <div class="admintab-field card-header border-bottom bg-white pr-4">
                <span class="float-right mt-3 pr-2">
                    <input type="hidden" name="is_admin_enabled" value="0"> <!-- Add a hidden field for the default value -->
                    <input type="checkbox" name="is_admin_enabled" id="access_config_is_admin_site_enabled" data-onstyle="warning" data-size="mini" data-on="Enable" data-off="Disable" data-width="100">
                </span>
                <p class="m-3 point-numbering">Admin</p>
            </div>
        </div>
        <!-- admin tab ends -->

        <!-- settings tab starts -->

        <div class="settings card bg-white shadow-sm mb-3 rounded">
            <div class="settingstab-field card-header border-bottom bg-white pr-4">
                <span class="float-right mt-3 pr-2">
                    <input type="hidden" name="is_settings_enabled" value="0">
                    <input type="checkbox" name="is_settings_enabled" id="access_config_is_settings_site_enabled" data-onstyle="warning" data-size="mini" data-on="Enable" data-off="Disable" data-width="100" data-main-toggle="Admin">
                </span>
                <p class="m-3 point-numbering">Settings</p>
            </div>
            <div class="settingstab collapse settings-Collapse show" id="multiCollapseSettings2">
                <!-- <div class="card-body py-2 px-2 count_start"> -->
                <div class="card my-6 section settings-sub-card">
                    <!-- <div class="companySettings-field card-header border-0 pr-4">
                        <span class="float-right mt-3 pr-2">
                            <input type="hidden" name="is_settings_enabled" value="0">
                            <input type="checkbox" name="is_settings_enabled" id="access_config_is_settings_site_enabled" data-onstyle="warning" data-size="mini" data-on="Enable" data-off="Disable" data-width="100" data-main-toggle="Admin">
                        </span>
                        <p class="m-3 point-numbering">Users</p>
                    </div> -->

                    <div class="card my-4 section settings-sub-card" id="ac-AuditSettings">
                        <div class="companySettings-field card-header border-0 pr-4">
                            <span class="float-right mt-3 pr-2">
                                <input type="hidden" name="is_audit_enabled" value="0">
                                <input type="checkbox" name="is_audit_enabled" id="access_config_is_audit_site_enabled" data-onstyle="warning" data-size="mini" data-on="Enable" data-off="Disable" data-width="100" data-main-toggle="Admin">
                            </span>
                            <p class="m-3 point-numbering">Audit Trail</p>
                        </div>

                        <div class="operation card bg-white shadow-sm mb-3 rounded settings-sub-card" id="ac-Dashboard">
                            <div class="operationtab-field card-header border-bottom bg-white pr-4">
                                <span class="float-right mt-3 pr-2">
                                    <input type="hidden" name="is_operation_enabled" value="0"> <!-- Add a hidden field for the default value -->
                                    <input type="checkbox" name="is_operation_enabled" id="access_config_is_operation_site_enabled" data-onstyle="warning" data-size="mini" data-on="Enable" data-off="Disable" data-width="100" data-main-toggle="Admin">
                                </span>
                                <p class="m-3 point-numbering">Operation Management</p>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- </div> -->
            </div>
        </div>


        <!-- <div class="operation card bg-white shadow-sm mb-3 rounded" id="ac-Dashboard">
            <div class="operationtab-field card-header border-bottom bg-white pr-4">
                <span class="float-right mt-3 pr-2">
                    <input type="hidden" name="is_operation_enabled" value="0">
                    <input type="checkbox" name="is_operation_enabled" id="access_config_is_operation_site_enabled" data-onstyle="warning" data-size="mini" data-on="Enable" data-off="Disable" data-width="100" data-main-toggle="Admin">
                </span>
                <p class="m-3 point-numbering">Operation</p>
            </div>
        </div> -->
        <!-- settings tab ends -->
    </div>
</div>
</div>
</div>
</form>
<!-- Footer with Update and Cancel Buttons -->

<script type="text/javascript" src="js/permission.js"></script>
@endsection