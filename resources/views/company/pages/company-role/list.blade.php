@extends('company.layout.default')

@section('manageRoleAndUserMaster','active menu-item-open')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-3 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Manage Role & User</h3>
                </div>
                <div class="card-toolbar"> 
                    <!--begin::Button-->
                    <a href="{{ route('company.manageroleanduser.add') }}" class="btn btn-primary font-weight-bolder">
                        <i class="la la-plus"></i>Add User</a>
                    <!--end::Button-->
                </div>
                <form action="" method="get" class="w-100">
                    <div class="row col-lg-12 pl-0 pr-0">
                        <div class="col-sm-3">
                            <div class="dataTables_length">
                                <label>Status</label>
                                <select name="status" value="" class="form-control">
                                    <option value="">All Status</option>
                                    <option value="0" @if(request('status')=='0' ) {{runTimeSelection(0, request('status'))}} @endif>InActive</option>
                                    <option value="1" @if(request('status')=='1' ) {{runTimeSelection(1, request('status'))}} @endif>Active</option>
                                </select>
                            </div>
                        </div>
        
                        <div class="col-sm-5">
                            <div class="dataTables_length">
                                <label cla>&#160; </label>
                                <button type="submit" class="btn btn-success mt-7" data-toggle="tooltip" title="Apply Filter">Filter</button>
                                <a href="{{ route('company.manageroleanduser.list') }}" class="btn btn-default mt-7" data-toggle="tooltip" title="Reset Filter">Reset</a>
        
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-bordered table-hover" id="categoryTable">
                    <thead>
                        <tr>
                            <th class="custom_sno">SNo.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Department</th>
                            <th class="custom_status">Status</th>
                            <th class="custom_action">Action/Assign</th>
                        </tr>
                    </thead>
                    <tbody>
                       @if (!empty($users))
                           @foreach ($users as $user)
                               <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role->role }}</td>
                                <td>{{ $user->department?->department_name }}</td>
                                <td>
                                    <a href="javascript:void(0)" data-url="{{url('company/department/update-status/'.$user->id.'/'.$user->status)}}" onclick="changeStatus(this)"> <span class="label label-lg font-weight-bold label-light-{{($user->status == 1) ? 'success' : 'danger'}} label-inline">{{($user->status == 1) ? 'Active' : 'InActive'}}</span></a>
                                </td>
                                <td>
                                    <a href="{{ route('company.manageroleanduser.edit',['id'=> $user->id]) }}" class="btn btn-sm btn-clean btn-icon" title="Edit details" data-toggle="tooltip">
                                        <i class="la la-edit"></i>
                                    </a>
                                    <a href="{{ route('company.manageroleanduser.assign',['id'=> $user->id]) }}" class="btn btn-sm btn-clean btn-icon" title="Assign Responsibilities" data-toggle="tooltip">
                                        <i class="las la-user-secret"></i>
                                    </a>
                                </td>
                               </tr>
                           @endforeach
                       @endif
                    </tbody>
                </table>
                <!--end: Datatable-->
            </div>
        </div>
    </div>
    
</div>


<script>
    function changeStatus() {
        confirm("Do you want to change status?");
    }
</script>
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
    }
</style>
<!-- <link href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection


{{-- Scripts Section --}}
@section('scripts')
@if (!empty($details))
    <script>
        $(document).ready(()=>{
            $('#editdegisnationCategory').modal('show');
        });
    </script>
@endif
<script>
    $(document).ready(function() {
        $('.select2').select2(); // Initialize Select2
        $('#myTable').DataTable();
        $('#categoryTable').DataTable();
        $('.dataTables_filter label input[type=search]').addClass('form-control form-control-sm');
        $('.dataTables_length select').addClass('custom-select custom-select-sm form-control form-control-sm');
    });
</script>
{{-- vendors --}}
<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" type="text/javascript"></script>
<!-- <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script> -->

{{-- page scripts --}}
<!-- <script src="{{ asset('js/pages/crud/datatables/basic/basic.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script> -->
@endsection