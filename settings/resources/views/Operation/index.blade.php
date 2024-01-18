@extends('layouts.app')

@section('content')
    <div class="w-100 shadow-sm p-3 mb-1 d-flex justify-content-between align-items-center">
        <h2 class="mb-0">Operation Management</h2>
        <div class="ml-auto">
            <button id="access_config_add_button" type="submit" class="btn btn-sm btn-warning" data-toggle="modal">
                <i class="fas fa-plus pr-1"></i> Add New User
            </button>
        </div>
    </div>
    
@endsection