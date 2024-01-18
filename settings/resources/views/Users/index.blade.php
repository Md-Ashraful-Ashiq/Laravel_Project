@extends('layouts.app')

@section('content')

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Add these in the head section -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

<!-- DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

<!-- Add these in the head section -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>



    <div class="w-100 shadow-sm p-3 mb-1 d-flex justify-content-between align-items-center">
        <h2 class="mb-0">Users</h2>
        <div class="ml-auto">
            <button id="access_config_add_button" type="submit" class="btn btn-sm btn-warning" data-toggle="modal">
                <i class="fas fa-plus pr-1"></i> Add New User
            </button>
        </div>
    </div>

    <div class="row m-3">
    <div class="col-11 pl-5">

        <div class="flex-row">
            <nav class="nav nav-tabs border-0" role="tablist">
                <a id="active_user_tab" class="nav-item nav-link border-0 mr-1 active" data-toggle="tab" href=".activeUsers" role="tab" aria-selected="true">Active Users</a>
                <a id="inactive_user_tab" class="nav-item nav-link border-0 bg-grey mr-1" data-toggle="tab" href=".inactiveUsers" role="tab">Inactive Users</a>
            </nav>
        </div>

        <div class="tab-content">

            <!--Active Users Start-->
            <div id="activeTab" class="tab-pane show active activeUsers" role="tabpanel">

                <!--Users Search Result Start-->
                <div class="userSearchResult mt-2" style="max-height: calc(36vh); overflow: auto; display: none;">
                    <div class="card shadow">
                        <div class="card-body">
                            <table id="user_audit_trail_data_table" class="table table-hover w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Edit</th>
                                        <th>Deactivate</th>
                                        <th>User</th>
                                        <th>Role</th>
                                        <th>Created Date</th>
                                        <th>Created By</th>
                                        <th>Modified Date</th>
                                        <th>Activity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $increment = 1;
                                    @endphp
                                    @foreach ($auditData as $data)
                                    <tr data-user-id="{{ $data->id }}" data-username="{{ $data->name }}" data-role-id="{{ $data->role_id }}" data-created-by="{{ $data->created_by }}" data-create-date="{{ $data->created_at }}">
                                    <td>
                                    <button class="btn btn-primary btn-sm edit-user-btn" data-target="#editUserModal" data-toggle="modal" data-id="{{ $data->id }}">Edit</button>
                                        </td>
                                        <td>
                                        <button class="btn btn-danger btn-sm deactivate-user-btn" data-toggle="modal" data-target="#deactivateUserModal" data-id="{{ $data->id }}">Deactivate</button>
                                        </td>
                                        <td>{{ $increment++ }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->roleName }}</td>
                                        <td>{{ $data->created_at }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->updated_at }}</td>
                                        <td>{{ $data->activity }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
                    <!-- ... (edit user modal content) ... -->
                </div>
                <!-- Edit User Modal Ends -->

                <!-- Deactivate User Modal Starts -->
                <div class="modal fade" id="deactivateUserModal" tabindex="-1" role="dialog" aria-labelledby="deactivateUserModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
                    <!-- ... (deactivate user modal content) ... -->
                </div>

            </div>  <!--Users Search Result End-->
            </div>  <!-- .card-shadow End-->
        </div>  <!-- .activeUsers End-->

            <!--Inactive Users Start-->
            <div id="inactiveTab" class="tab-pane inactiveUsers" role="tabpanel">
                <div class="card shadow">
                    <div class="card-body pt-2">
                        <table id="users_inactive_data_table" class="user-data-table table table-hover w-100"></table>
                    </div><!-- .card-body End-->
                </div><!-- .card-shadow End-->
            </div><!-- .inactiveUsers End-->

        </div>
        <!--tab content End-->
</div>
    

<!-- Add New User Modal Starts -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <div class="text-success ml-auto small pt-2">Mandatory Fields</div>
            </div>

                <div class="modal-body">
                <div id="divLogInfo">
                    <!-- Login Info Starts -->
                    <h5 class="modal-title border-bottom pb-2 mb-2">Login Info</h5>
                    <div class="row mb-2">
                            <div class="col-sm-6 form-row py-6">
                                <label class="col-sm-5 col-form-label">Username</label>
                                <div class="col-sm-7">
                                    <input id="user_username" type="text" name="user_username" class="form-control" data-validate="username" required="">
                                    <div class="invalid-feedback">Please enter a username</div>
                                </div>
                            </div>

                            <div class="col-sm-6 form-row py-1">
                                <label class="col-sm-5 col-form-label">Access Level</label>
                                <div class="col-sm-7">
                                <select id="access_config_role" class="form-control" data-style="border" data-width="100%" data-live-search="true" name="access_level">
                                <option value="" selected disabled>Select Access Level</option>
                                @foreach($roles->sortByDesc('created_at') as $role)
                                    <option value="{{ $role->id }}" data-admin-enabled="{{ $role->is_admin_enabled }}" data-settings-enabled="{{ $role->is_settings_enabled }}" data-operation-enabled="{{ $role->is_operation_enabled }}" data-audit-enabled="{{ $role->is_audit_enabled }}" data-users-count="{{ $role->users_count }}">
                                        {{ $role->roleName }}
                                    </option>
                                @endforeach
                            </select>
                                </div>
                            </div>                        
                        </div>

                        <div class="row mb-2">
                            <div class="col-sm-6 form-row py-6">
                                <label class="col-sm-5 col-form-label">Create By</label>
                                <div class="col-sm-7">
                                <select id="created_by_user" class="form-control" data-style="border" data-width="100%" data-live-search="true" name="created_by_user">
                                <option value="" selected disabled>Select Create By</option>
                                </select>
                                </div>
                            </div>
                            </div>

                            <div class="row mb-2">
                            <div class="col-sm-6 form-row py-6">
                                <label class="col-sm-5 col-form-label">Create Date</label>
                                <div class="col-sm-7">
                                <input id="create_date" type="text" name="create_date" class="form-control" required>
                                <div class="invalid-feedback">Please select a date</div>
                                </div>
                            </div>
                                                
                    </div>
                </div>

            <div class="modal-footer">
                <div class="row">
                    <div class="col">
                        <button type="button" id="closeAddUserModalBtn" class="btn btn-light btn-sm" data-dismiss="modal" style="margin-top: 1px;">Cancel</button>
                    </div>
                    <div class="col">
                        <button type="button" id="user_modal_button_save" class="btn btn-warning btn-sm" style="margin-right: 90px;">Add New User</button>
                    </div>
                </div>
            </div>
            </div>
    </div>
</div>
</div>
<!-- Add New User Modal Ends -->

<!-- Edit User Modal Starts -->
<div class="modal fade" id="editUserModalContent" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <div class="text-success ml-auto small pt-2">Mandatory Fields</div>
            </div>

                <div class="modal-body">
                <div id="divLogInfo">
                    <!-- Login Info Starts -->
                    <h5 class="modal-title border-bottom pb-2 mb-2">Login Info</h5>
                    <div class="row mb-2">
                            <div class="col-sm-6 form-row py-6">
                                <label class="col-sm-5 col-form-label">Username</label>
                                <div class="col-sm-7">
                                <input id="user_username_edit" type="text" name="user_username_edit" class="form-control" data-validate="username" required="">
                                    <div class="invalid-feedback">Please enter a username</div>
                                </div>
                            </div>

                            <div class="col-sm-6 form-row py-1">
                                <label class="col-sm-5 col-form-label">Access Level</label>
                                <div class="col-sm-7">
                                <select id="access_config_role" class="form-control" data-style="border" data-width="100%" data-live-search="true" name="access_level">
                                    <option value="{{ $role->id }}" data-admin-enabled="{{ $role->is_admin_enabled }}" data-settings-enabled="{{ $role->is_settings_enabled }}" data-operation-enabled="{{ $role->is_operation_enabled }}" data-audit-enabled="{{ $role->is_audit_enabled }}" data-users-count="{{ $role->users_count }}">
                                        {{ $role->roleName }}
                                    </option>
                            </select>
                                </div>
                            </div>                        
                        </div>

                        <div class="row mb-2">
                            <div class="col-sm-6 form-row py-6">
                                <label class="col-sm-5 col-form-label">Create By</label>
                                <div class="col-sm-7">
                                    <select id="created_by_user_edit" class="form-control" data-style="border" data-width="100%" data-live-search="true" name="created_by_user">
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                            <div class="row mb-2">
                            <div class="col-sm-6 form-row py-6">
                                <label class="col-sm-5 col-form-label">Create Date</label>
                                <div class="col-sm-7">
                                <input id="create_date_edit" type="text" name="create_date_edit" class="form-control" required>
                                <div class="invalid-feedback">Please select a date</div>
                                </div>
                            </div>
                                                
                    </div>
                </div>

            <div class="modal-footer">
                <div class="row">
                    <div class="col">
                        <button type="button" id="closeEditUserModalBtn" class="btn btn-light btn-sm" data-dismiss="modal" style="margin-top: 1px;">Cancel</button>
                    </div>
                    <div class="col">
                        <button type="button" id="user_modal_button_save" class="btn btn-warning btn-sm" style="margin-right: 90px;">Update User Now</button>
                    </div>
                </div>
            </div>
            </div>
    </div>
</div>
</div>
<!-- Edit User Modal Ends -->


<script>

    $(document).ready(function () {
        // Initialize the date picker
        $('#create_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        });

        // Initialize the date picker for create_date input in Edit User Modal
        $('#create_date_edit').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        });

        // DataTable Initialization
        var userAuditTrailTable = $('#user_audit_trail_data_table').DataTable({
            "columnDefs": [
                {
                    "targets": [0, 1], // Edit and Deactivate buttons columns
                    "orderable": false,
                    "searchable": false
                }
            ],
            columns: [
                { 
                    data: null,
                    render: function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                { 
                    data: null,
                    render: function (data, type, row, meta) {
                        return '<button class="btn btn-primary btn-sm edit-user-btn" data-id="' + row.id + '">Edit</button>';
                    }
                },
                { 
                    data: null,
                    render: function (data, type, row, meta) {
                        return '<button class="btn btn-danger btn-sm deactivate-user-btn" data-id="' + row.id + '">Deactivate</button>';
                    }
                },
                { data: 'name' },
                { data: 'roleName' },
                { data: 'created_at' },
                { data: 'name' },
                { data: 'updated_at' },
                { data: 'activity' },
            ],
        });

        // Fetch and display data when the page is loaded
        var ajaxUrl = '/fetch-user-audit-data';
        $.ajax({
            url: ajaxUrl,
            type: 'GET',
            success: function (data) {
                // Show the User search result section
                $('.userSearchResult').show();
                // Add data to the table
                userAuditTrailTable.clear().rows.add(data).draw();
            },
            error: function (error) {
                console.error('Error fetching data: ', error);
            }
        });

        // Open the modal when the "Add New User" button is clicked
        $('#access_config_add_button').on('click', function () {
            $('#addUserModal').modal('show');
        });

        // Fetch and populate user list for 'Created By' field
        $.ajax({
            url: '/get-users-list',
            type: 'GET',
            success: function (users) {
                var createdBySelect = $('#created_by_user');
                
                users.forEach(function (user) {
                    createdBySelect.append('<option value="' + user.id + '">' + user.name + '</option>');
                });
            },
            error: function (error) {
                console.error('Error fetching users list: ', error);
            }
        });

        // Fetch and populate user list for 'Created By' field in Edit User Modal
        $.ajax({
            url: '/get-users-list',
            type: 'GET',
            success: function (users) {
                var createdBySelectEdit = $('#created_by_user_edit');
                users.forEach(function (user) {
                    createdBySelectEdit.append('<option value="' + user.id + '">' + user.name + '</option>');
                });
            },
            error: function (error) {
                console.error('Error fetching users list: ', error);
            }
        });

        // Event listener for Close button click
        $('#closeAddUserModalBtn').on('click', function () {
            $('#addUserModal').modal('hide');
        });

        // Event listener for Close button click in Edit User Modal
        $('#closeEditUserModalBtn').on('click', function () {
            $('#editUserModalContent').modal('hide');
        });

        // Event listener for Edit button click
        $('body').on('click', '.edit-user-btn', function () {
            var userId = $(this).data('id');
            var row = $('#user_audit_trail_data_table').DataTable().row($(this).closest('tr')).data();

            // Populate the edit modal fields with the user information
            $('#user_username_edit').val(row.name);
            $('#access_config_role_edit').val(row.role_id).trigger('change');

            // Fetch and populate user list for 'Create By' field in Edit User Modal
            $.ajax({
                url: '/get-users-list',
                type: 'GET',
                success: function (users) {
                    var createdBySelectEdit = $('#created_by_user_edit');
                    createdBySelectEdit.empty().append(
                        users.map(user => $('<option>', {
                            value: user.id,
                            text: user.name,
                            selected: user.id === row.created_by
                        }))
                    );
                },
                error: function (error) {
                    console.error('Error fetching users list: ', error);
                }
            });

            // Format the created_at date to show only the date without the timestamp
            var createDate = moment(row.created_at, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD');
            $('#create_date_edit').val(createDate);

            // Show the edit user modal
            $('#editUserModalContent').modal('show');
        });
        
    });
</script>

@endsection