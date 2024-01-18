@extends('layouts.app')

@section('content')

<!-- Add these in the head section -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

<!-- DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

<!-- Audit Trail Starts -->

<div class="w-100 shadow-sm p-3 mb-1 d-flex justify-content-between align-items-center">
    <h2 class="mb-0">AuditTrail</h2>
</div>


<div class="row m-3">
    <div class="col-12 pl-0 ml-0">
        <div class="flex-row">
            <nav class="nav nav-tabs border-0" role="tablist">
                <a id="audit-trail-user-tab" class="nav-item nav-link border-0 mr-1 active" data-toggle="tab" href=".usersTab" role="tab" aria-selected="true">
                    Users
                </a>
                <a id="audit-trail-access-config-tab" class="nav-item nav-link border-0 bg-grey mr-1" data-toggle="tab" href=".accessConfigTab" role="tab">Access Config</a>

                <a id="audit-trail-team-tab" class="nav-item nav-link border-0 bg-grey mr-1" data-toggle="tab" href=".teamsTab" role="tab" aria-selected="true">Teams</a>

                <a id="audit-trail-security-policy-tab" class="nav-item nav-link border-0 bg-grey mr-1" data-toggle="tab" href=".securityPolicyTab" role="tab">Security Policy</a>
            </nav>
        </div>
        <div class="tab-content">
            <div id="audit-trail-user-tab-page" class="tab-pane usersTab active show" role="tabpanel">
                <div class="card shadow">
                    <div class="card-header bg-white">Trace back all users creation history in Login Settings &gt; Users</div>

                    <!--Users Card Body Start-->
                    <div class="card-body py-2">
                        <div class="row mb-2">
                            <div class="col-sm-10">
                                <div class="col-sm-6 form-row py-1">
                                    <label class="col-sm-3 col-form-label">Date Range</label>
                                    <div class="input-group pr-3">
                                        <input id="user_audit_trail_daterange" type="text" class="form-control col-sm-12" name="daterange">
                                        <div class="input-group-append">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 form-row bg-light p-2 ml-0 mr-0 mt-1 rounded">
                                    <label class="col-sm-1 col-form-label mr-5">View By</label>
                                    <div class="form-check form-check-inline col-sm-1">
                                        <input class="form-check-input" name="userActionType" type="radio" value="" checked="">
                                        <label class="form-check-label text-sm">All</label>
                                    </div>
                                    <div class="form-check form-check-inline col-sm-1">
                                        <input class="form-check-input" name="userActionType" type="radio" value="create">
                                        <label class="form-check-label text-sm">Created</label>
                                    </div>
                                    <div class="form-check form-check-inline col-sm-1">
                                        <input class="form-check-input" name="userActionType" type="radio" value="update">
                                        <label class="form-check-label text-sm">Updated</label>
                                    </div>
                                    <div class="form-check form-check-inline col-sm-1">
                                        <input class="form-check-input" name="userActionType" type="radio" value="delete">
                                        <label class="form-check-label text-sm">Deleted</label>
                                    </div>
                                    <div class="form-check form-check-inline col-sm-1">
                                        <input class="form-check-input" name="userActionType" type="radio" value="activate">
                                        <label class="form-check-label text-sm">Activated</label>
                                    </div>
                                    <div class="form-check form-check-inline col-sm-1">
                                        <input class="form-check-input" name="userActionType" type="radio" value="deactivate">
                                        <label class="form-check-label text-sm">Deactivated</label>
                                    </div>
                                </div>

                            </div>

                            <div class="col-sm-2 text-right my-auto">
                                <button id="user_audit_trail_button_search" type="button" class="btn btn-warning" aria-expanded="false"> Search</button>
                            </div>
                        </div>

                    </div><!--Card Body End-->
                </div><!--Card End-->

                <!--Users Search Result Start-->
                <div class="userSearchResult mt-2" style="max-height: calc(36vh); overflow: auto; display: none;">
                    <div class="card shadow">
                        <div class="card-body">
                            <table id="user_audit_trail_data_table" class="table table-hover w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
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
                                    <tr>
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
                </div>
                <!--Users Search Result End-->

            </div>
            <div id="audit-trail-access-config-tab-page" class="tab-pane fade accessConfigTab" role="tabpanel"><!--Access Config Start-->
                <div class="card shadow">
                    <div class="card-header bg-white">Trace back all roles creation history in Login Settings &gt; Access Config</div>

                    <!--Access Config Card Body Start-->
                    <div class="card-body py-2">
                        <div class="row mb-2">
                            <div class="col-sm-10">
                                <div class="col-sm-6 form-row py-1">
                                    <label class="col-sm-3 col-form-label">Date Range</label>
                                    <div class="input-group col-sm-7">
                                        <input id="access_config_audit_trail_daterange" type="text" class="form-control col-sm-12" name="daterange">
                                        <div class="input-group-append">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 form-row bg-light p-2 ml-0 mr-0 mt-1 rounded">
                                    <label class="col-sm-1 col-form-label mr-5">View By</label>
                                    <div class="form-check form-check-inline col-sm-1">
                                        <input class="form-check-input" name="accessConfigActionType" type="radio" value="" checked="">
                                        <label class="form-check-label text-sm">All</label>
                                    </div>
                                    <div class="form-check form-check-inline col-sm-1">
                                        <input class="form-check-input" name="accessConfigActionType" type="radio" value="create">
                                        <label class="form-check-label text-sm">Created</label>
                                    </div>
                                    <div class="form-check form-check-inline col-sm-1">
                                        <input class="form-check-input" name="accessConfigActionType" type="radio" value="update">
                                        <label class="form-check-label text-sm">Updated</label>
                                    </div>
                                    <div class="form-check form-check-inline col-sm-1">
                                        <input class="form-check-input" name="accessConfigActionType" type="radio" value="delete">
                                        <label class="form-check-label text-sm">Deleted</label>
                                    </div>
                                </div>

                            </div>

                            <div class="col-sm-2 text-right my-auto">
                                <button id="access_config_audit_trail_button_search" type="button" class="btn btn-warning" aria-expanded="false">
                                    <!-- <i class="fas fa-search"></i> --> Search</button>
                            </div>
                        </div>
                    </div><!--Card Body End-->
                </div><!--Card End-->

                <!--Access Config Search Result Start-->
                <div class="accessSearchResult mt-2" style="max-height: calc(36vh); overflow: auto; display: none;">
                    <div class="card shadow">
                        <div class="card-body">
                            <table id="access_config_audit_trail_data_table" class="table table-hover w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Role</th>
                                        <th>Created Date</th>
                                        <th>Created By</th>
                                        <th>Modified Date</th>
                                        <th>Modified By</th>
                                        <th>Activity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $increment = 1;
                                    @endphp
                                    @foreach ($auditData as $data)
                                    <tr>
                                        <td>{{ $increment++ }}</td>
                                        <td>{{ $data->roleName }}</td>
                                        <td>{{ $data->created_at }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->updated_at }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->activity }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--Access Config Search Result End-->

            </div>

            <div id="audit-trail-teams-tab-page" class="tab-pane fade teamsTab" role="tabpanel"><!--Teams Start-->
                <div class="card shadow">
                    <div class="card-header bg-white">Trace back all roles creation history in Login Settings &gt; Teams</div>

                    <!--Teams Card Body Start-->
                    <div class="card-body py-2">
                        <div class="row mb-2">
                            <div class="col-sm-10">
                                <div class="col-sm-6 form-row py-1">
                                    <label class="col-sm-3 col-form-label">Date Range</label>
                                    <div class="input-group col-sm-7">
                                        <input id="teams_audit_trail_daterange" type="text" class="form-control col-sm-12" name="daterange">
                                        <div class="input-group-append">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 form-row bg-light p-2 ml-0 mr-0 mt-1 rounded">
                                    <label class="col-sm-1 col-form-label mr-5">View By</label>
                                    <div class="form-check form-check-inline col-sm-1">
                                        <input class="form-check-input" name="teamsConfigActionType" type="radio" value="" checked="">
                                        <label class="form-check-label text-sm">All</label>
                                    </div>
                                    <div class="form-check form-check-inline col-sm-1">
                                        <input class="form-check-input" name="teamsConfigActionType" type="radio" value="create">
                                        <label class="form-check-label text-sm">Created</label>
                                    </div>
                                    <div class="form-check form-check-inline col-sm-1">
                                        <input class="form-check-input" name="teamsConfigActionType" type="radio" value="update">
                                        <label class="form-check-label text-sm">Updated</label>
                                    </div>
                                    <div class="form-check form-check-inline col-sm-1">
                                        <input class="form-check-input" name="teamsConfigActionType" type="radio" value="delete">
                                        <label class="form-check-label text-sm">Deleted</label>
                                    </div>
                                </div>

                            </div>

                            <div class="col-sm-2 text-right my-auto">
                                <button id="teams_audit_trail_button_search" type="button" class="btn btn-warning" aria-expanded="false">
                                    <!-- <i class="fas fa-search"></i> --> Search</button>
                            </div>
                        </div>
                    </div><!--Card Body End-->
                </div><!--Card End-->

                <!--Teams Config Search Result Start-->
                <div class="teamsSearchResult mt-2" style="max-height: calc(36vh); overflow: auto;">
                    <div class="card shadow">
                        <div class="card-body">
                            <table id="teams_config_audit_trail_data_table" class="table table-hover w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>team</th>
                                        <th>Created Date</th>
                                        <th>Created By</th>
                                        <th>Modified Date</th>
                                        <th>Modified By</th>
                                        <th>Activity</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <!--teams Config Search Result End-->
            </div>

            <div id="audit-trail-security-policy-tab-page" class="tab-pane fade securityPolicyTab" role="tabpanel"><!--Security Policy Start-->
                <div class="card shadow">
                    <div class="card-header bg-white">Trace back all roles creation history in Login Settings &gt; Security Policy</div>

                    <!--Security Policy Card Body Start-->
                    <div class="card-body py-2">
                        <div class="row mb-2">
                            <div class="col-sm-10">
                                <div class="col-sm-6 form-row py-1">
                                    <label class="col-sm-3 col-form-label">Date Range</label>
                                    <div class="input-group col-sm-7">
                                        <input id="security_policy_audit_trail_daterange" type="text" class="form-control col-sm-12" name="daterange">
                                        <div class="input-group-append">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 form-row bg-light p-2 ml-0 mr-0 mt-1 rounded">
                                    <label class="col-sm-1 col-form-label mr-5">View By</label>
                                    <div class="form-check form-check-inline col-sm-1">
                                        <input class="form-check-input" name="securityPolicyActionType" type="radio" value="" checked="">
                                        <label class="form-check-label text-sm">All</label>
                                    </div>
                                    <div class="form-check form-check-inline col-sm-1">
                                        <input class="form-check-input" name="securityPolicyActionType" type="radio" value="create">
                                        <label class="form-check-label text-sm">Created</label>
                                    </div>
                                    <div class="form-check form-check-inline col-sm-1">
                                        <input class="form-check-input" name="securityPolicyActionType" type="radio" value="update">
                                        <label class="form-check-label text-sm">Updated</label>
                                    </div>
                                    <div class="form-check form-check-inline col-sm-1">
                                        <input class="form-check-input" name="securityPolicyActionType" type="radio" value="delete">
                                        <label class="form-check-label text-sm">Deleted</label>
                                    </div>
                                </div>

                            </div>

                            <div class="col-sm-2 text-right my-auto">
                                <button id="security_policy_audit_trail_button_search" type="button" class="btn btn-warning" aria-expanded="false">
                                    <!-- <i class="fas fa-search"></i> --> Search</button>
                            </div>
                        </div>
                    </div><!--Card Body End-->
                </div><!--Card End-->

                <!--Security Policy Search Result Start-->
                <div class="securitySearchResult mt-2" style="max-height: calc(36vh); overflow: auto;">
                    <div class="card shadow">
                        <div class="card-body">
                            <table id="security_policy_audit_trail_data_table" class="table table-hover w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Created Date</th>
                                        <th>Created By</th>
                                        <th>Modified Date</th>
                                        <th>Modified By</th>
                                        <th>Activity</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <!--Security Policy Search Result End-->

            </div>
        </div>
    </div>
</div>
<!-- Audit Trail Ends -->

<script>
    $(document).ready(function () {
        // Date Range Picker Initialization
        $('input[name="daterange"]').daterangepicker({
            opens: 'right'
        });

        // DataTable Initialization
        var userAuditTrailTable = $('#user_audit_trail_data_table').DataTable({
            columns: [
                { 
                data: null,
                render: function (data, type, row, meta) {
                // 'meta.row' is the current row index
                return meta.row + 1; // Add 1 to start counting from 1
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
        

        // Search Button Click Event
        $('#user_audit_trail_button_search').on('click', function () {
            var dateRange = $('input[name="daterange"]').val().split(' - ');
            var startDate = dateRange[0] + ' 00:00:00';
            var endDate = dateRange[1] + ' 23:59:59';

            var ajaxUrl = '/fetch-user-audit-data';
            ajaxUrl += '?date_range_from=' + startDate + '&date_range_to=' + endDate;

            $.ajax({
                url: ajaxUrl,
                type: 'GET',
                success: function (data) {
                // Show the User search result section
                $('.userSearchResult').show();
                    // Clear the existing table and add new data
                    userAuditTrailTable.clear().rows.add(data).draw();
                },
                error: function (error) {
                    console.error('Error fetching data: ', error);
                }
            });
        });

         // DataTable Initialization for Access Config
    var accessConfigAuditTrailTable = $('#access_config_audit_trail_data_table').DataTable({
        columns: [
            {
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            { data: 'roleName' },
            { data: 'created_at' },
            { data: 'name' }, // Assuming 'createdBy' is the correct field name
            { data: 'updated_at' },
            { data: 'name' }, // Assuming 'modifiedBy' is the correct field name
            { data: 'activity' },
        ],
        // Add other DataTable options as needed
    });

    // Search Button Click Event for Access Config
    $('#access_config_audit_trail_button_search').on('click', function () {
        var dateRange = $('#access_config_audit_trail_daterange').val().split(' - ');
        var startDate = dateRange[0] + ' 00:00:00';
        var endDate = dateRange[1] + ' 23:59:59';

        var ajaxUrl = '/fetch-access-config-audit-data';
        ajaxUrl += '?date_range_from=' + startDate + '&date_range_to=' + endDate;

        $.ajax({
            url: ajaxUrl,
            type: 'GET',
            success: function (data) {
                 // Show the Access Config search result section
            $('.accessSearchResult').show();
                // Clear the existing table and add new data
                accessConfigAuditTrailTable.clear().rows.add(data).draw();
            },
            error: function (error) {
                console.error('Error fetching data: ', error);
            }
        });
    });

    });
</script>

@endsection