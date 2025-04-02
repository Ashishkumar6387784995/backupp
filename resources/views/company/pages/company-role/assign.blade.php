@extends('company.layout.default')

@section('manageRoleAndUserMaster','active menu-item-open')
@section('content')
<div class="card card-custom">
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-3 pb-0">
            <div class="card-title">
                <h3 class="card-label">Manage User Assign Responsibilities</h3>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="mb-7">
            <div class="row align-items-center">
                <form method="POST" action="" class="w-100" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-lg-9 col-xl-12">
                        <div class="row align-items-center">
                            <div class="form-group col-md-12">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Permission Name</th>
                                            <th>Add</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                            <th>View</th>
                                            <th>All</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $permissionTypes = ['jobs', 'tasks', 'manage_workforces', 'job_application', 'who_is_in', 'timesheets', 'roaster', 'invoices', 'byo_payslips', 'qrcodes', 'staff_request'];
                                            $actions = ['add', 'edit', 'delete', 'view', 'all'];
                                        @endphp
                
                                        @foreach($permissionTypes as $permission)
                                            <tr>
                                                <td>{{ ucfirst(str_replace('_', ' ', $permission)) }}</td>
                                                @foreach($actions as $action)
                                                    <td>
                                                        <input type="checkbox" value="1" 
                                                               name="permission[{{ $permission }}][{{ $action }}]" 
                                                               class="form-check-input {{ $permission }} {{ $action === 'all' ? $permission . '-all' : '' }}"
                                                               {{ isset($permissions[$permission][$action]) && $permissions[$permission][$action] == 1 ? 'checked' : '' }}>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group col-md-12">
                                <center><button class="btn btn-success">Submit</button></center>
                            </div>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

@endsection

{{-- Styles Section --}}
@section('styles')
<style>
    .modal .modal-header .close span {
        display: block;
        font-size: 27px;
        color: #000;
        /* background: darkred; */
    }
    .select2-container {
        width: 100% !important;
    }.form-check-input {
        margin-left: 0px !important;
    }
</style>
@endsection

{{-- Scripts Section --}}
@section('scripts')
<script src="https://ckeditor.com/docs/vendors/4.11.3/ckeditor/ckeditor.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $('.select2').select2();
    });
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll("input[class$='-all']").forEach(function (allCheckbox) {
            allCheckbox.addEventListener("change", function () {
                let permissionClass = this.classList[1].replace('-all', '');
                document.querySelectorAll(`.${permissionClass}`).forEach(function (checkbox) {
                    checkbox.checked = allCheckbox.checked;
                });
            });
        });
    });
</script>
@endsection