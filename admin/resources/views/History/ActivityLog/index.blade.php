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

<div class="w-100 shadow-sm p-3 mb-1 d-flex justify-content-between align-items-center">
    <h2 class="mb-0">ACTIVITY LOG</h2>
</div>
<div class="card border-0 mt-3 mx-3 shadow" style="background-color:#f5f5f5;">
    <div class="card-body">
        <span class="text-muted"><em>Choose the fields below to search for past login history for Volare collector or Volare admin.</em></span>
        <div class="card mt-2 p-3 toppanel-blue" style="background-color: #2686b0">
            <div class=" d-flex align-items-center">
                <div class="text-white d-flex align-items-center flex-fill">
                </div>
                <div class="d-flex justify-content-end flex-fill">
                    <div class="text-white d-flex align-items-center flex-fill">
                        <label class="col-3 mb-0">Date Range</label>
                        <div class="input-group pr-3">
                            <input id="user_history_daterange" type="text" class="form-control col-sm-12" name="daterange">
                            <div class="input-group-append">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="align-items-start pt-3 pb-2">
            <div class="col-5 d-flex align-items-center">
                <div>
                    <label class="mb-0" style="white-space: nowrap; line-height: 2.5em; margin-right: 10px;">Username</label>
                </div>
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" id="usernameDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-bottom: 20px">
                        <span id="selectedUsername">Select Username</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="usernameDropdown">
                        @foreach($users as $user)
                        <a class="dropdown-item" href="#">{{ $user->name }}</a>
                        @endforeach
                    </div>
                </div>
                <!-- Hidden input to store the selected username -->
                <input type="hidden" id="selectedUsernameInput" name="selectedUsername">
            </div>
        </div>
    </div>
    <div class="card-footer bg-card-footer-history">
        <button id="user_activity_button_search" type="button" class="btn btn-warning" aria-expanded="false">Search</button>
    </div>
</div>

<div class="userSearchResult mt-2" style="max-height: calc(36vh); overflow: auto; display: none;">
    <div class="card shadow">
        <div class="card-body">
            <table id="history_activitylog_data_table" class="table table-hover w-100">
                <thead>
                    <tr>
                        <th>Collector</th>
                        <th>Access</th>
                        <th>Total Login Time</th>
                        <th>Login Time</th>
                        <th>Logout Time</th>
                        <th>System</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($activityData as $data)
                    <tr>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->roleName }}</td>
                        <td>{{ $data->total_login_time }}</td>
                        <td>{{ $data->login_time }}</td>
                        <td>{{ $data->logout_time }}</td>
                        <td>Admin</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Date Range Picker Initialization
        $('input[name="daterange"]').daterangepicker({
            singleDatePicker: true, // Set to true for a single date picker
            opens: 'right',
            locale: {
                format: 'YYYY-MM-DD'
            }
        });

        // DataTable Initialization
        var userActivityTable = $('#history_activitylog_data_table').DataTable({
            columns: [{
                    data: 'name'
                },
                {
                    data: 'roleName'
                },
                {
                    data: 'total_login_time'
                },
                {
                    data: 'login_time'
                },
                {
                    data: 'logout_time'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return 'Admin';
                    }
                },
            ],
        });

        // Add a click event listener to each dropdown item

        var dropdownItems = document.querySelectorAll('.dropdown-item');
        dropdownItems.forEach(function(item) {
            item.addEventListener('click', function() {
                var selectedUsername = item.textContent.trim();
                selectedUsernameSpan.textContent = selectedUsername;
                selectedUsernameInput.value = selectedUsername;

                // Trigger the search button click after selecting a username
                $('#user_activity_button_search').trigger('click');
            });
        });


        // Search Button Click Event
        $('#user_activity_button_search').on('click', function() {
            var selectedDate = $('input[name="daterange"]').val();
            var selectedUsername = $('#selectedUsernameInput').val();

            if (selectedDate) {
                var ajaxUrl = '/fetch-user-activity-data';
                ajaxUrl += '?selected_date=' + selectedDate;
                ajaxUrl += '&selected_username=' + selectedUsername;

                $.ajax({
                    url: ajaxUrl,
                    type: 'GET',
                    success: function(data) {
                        // Show the search result table
                        $('.userSearchResult').show();
                        // Clear the existing table and add new data
                        userActivityTable.clear().rows.add(data).draw();
                    },
                    error: function(error) {
                        console.error('Error fetching data: ', error);
                    }
                });
            } else {
                console.error('Invalid date selection');
            }
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dropdownButton = document.getElementById('usernameDropdown');
        var selectedUsernameSpan = document.getElementById('selectedUsername');
        var selectedUsernameInput = document.getElementById('selectedUsernameInput');

        // Add a click event listener to each dropdown item
        var dropdownItems = document.querySelectorAll('.dropdown-item');
        dropdownItems.forEach(function(item) {
            item.addEventListener('click', function() {
                var selectedUsername = item.textContent.trim();
                selectedUsernameSpan.textContent = selectedUsername;
                selectedUsernameInput.value = selectedUsername;
            });
        });

        // Set the initial state for the dropdown
        if (selectedUsernameInput.value === '') {
            selectedUsernameSpan.textContent = 'Nothing selected';
        }
    });
</script>
@endsection