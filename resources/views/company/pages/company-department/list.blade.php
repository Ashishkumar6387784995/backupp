@extends('company.layout.default')

@section('companydepartmentMaster','active menu-item-open')
@section('content')
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-3 pb-0">
        <div class="card-title">
            <h3 class="card-label">Department List
                <!-- <div class="text-muted pt-2 font-size-sm">Datatable initialized from HTML table</div> -->
            </h3>
        </div>
        <div class="card-toolbar">
            {{-- @include('admin.layout.partials.filters.common-filter') --}}
            <!--begin::Button-->
            <a href="javascript:void(0);" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#companyDepartment">
                <i class="la la-plus"></i>Add Department</a>
            <!--end::Button-->

        </div>
        <form action="" method="get" class="w-100">
            <div class="row col-lg-12 pl-0 pr-0">

                <div class="col-sm-3">
                    <div class="dataTables_length">
                        <label>Status</label>
                        <select name="status" value="" class="form-control">
                            <option value="-1">All Status</option>
                            <option value="0" @if(request('status')=='0' ) {{runTimeSelection(0, request('status'))}} @endif>InActive</option>
                            <option value="1" @if(request('status')=='1' ) {{runTimeSelection(1, request('status'))}} @endif>Active</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="dataTables_length">
                        <label cla>&#160; </label>
                        <button type="submit" class="btn btn-success mt-7" data-toggle="tooltip" title="Apply Filter">Filter</button>
                        <a href="{{ route('company.department.list') }}" class="btn btn-default mt-7" data-toggle="tooltip" title="" data-original-title="Reset">Reset</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">

        <!--begin: Datatable-->
        <table class="table table-bordered table-hover" id="myTable">
            <thead>
                <tr>
                    <th class="custom_sno">SNo.</th>
                    <th>Department Name</th>
                    <th class="custom_status">Status</th>
                    <th class="custom_action">Action</th>
                </tr>
            </thead>
            <tbody>



                @if(count($companydepartments) > 0)
                @foreach($companydepartments as $key => $value)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$value->department->department_name }}</td>
                    <td>
                        <a href="javascript:void(0)" data-url="{{url('company/department/update-status/'.$value->id.'/'.$value->status)}}" onclick="changeStatus(this)"> <span class="label label-lg font-weight-bold label-light-{{($value->status == 1) ? 'success' : 'danger'}} label-inline">{{($value->status == 1) ? 'Active' : 'InActive'}}</span></a>
                    </td>
                    <td>
                        <a href="javascript:void(0)" data-url="{{url('/company/department/delete/'.$value->id)}}" class="btn btn-sm btn-clean btn-icon" data-toggle="tooltip" title="Delete" onclick="deleteItem(this)">
                            <i class="la la-trash"></i>
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

{{-- Modal popup --}}

<div class="modal fade" id="companyDepartment" tabindex="-1" aria-labelledby="companyDepartmentLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="companyDepartmentLabel">Add Department</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('company.companyDepartment.store') }}" method="post">
            @csrf
            <div class="form-group col-md-12">
                <label>Departments</label>
                <div>
                    <select name="department[]" id="" class="form-control select2" multiple>
                        @if (!empty($departments))
                           @foreach ($departments as $department)
                               <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                           @endforeach 
                        @endif
                    </select>
                    
                </div>
            </div>
            
            <div class="form-group col-md-12 mt-3">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>
<script>
    function changeStatus() {
        confirm("Do you want to change status ?");
    }

    function deleteTest() {
        confirm("Do you want to delete department ?");
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
<script>
    $(document).ready(function() {
        $('.select2').select2();
        $('#myTable').DataTable();
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