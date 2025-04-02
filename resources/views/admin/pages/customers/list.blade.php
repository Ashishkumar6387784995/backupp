@extends('admin.layout.default')

@section('customermaster','active menu-item-open')
@section('content')
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-3 pb-0">
        <div class="card-title">
            <h3 class="card-label">Candidates List
                <!-- <div class="text-muted pt-2 font-size-sm">Datatable initialized from HTML table</div> -->
            </h3>
        </div>
        <div class="card-toolbar">
            {{-- @include('admin.layout.partials.filters.common-filter') --}}
            <!--begin::Button-->
            {{-- <a href="{{url('/admin/customers/add')}}" class="btn btn-primary font-weight-bolder">
                <i class="la la-plus"></i>Add Candidate</a> --}}
            <!--end::Button-->

            <!-- <a href="{{url('/admin/patients/list')}}" class="btn btn-warning ml-2" data-toggle="tooltip" title="View All Patients">View All Patients</a> -->
        </div>

        <form action="" method="get" class="w-100">
            <div class="row col-lg-12 pl-0 pr-0">

                

                
                {{-- <div class="col-sm-3">
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
                        <button type="submit" class="btn btn-success" data-toggle="tooltip" title="Apply Filter" style="margin-top: 20px;">Filter</button>
                        <a href="{{url('/admin/customers/list')}}" class="btn btn-default mt-7" data-toggle="tooltip" title="Reset">Reset</a>
                    </div>
                </div> --}}
            </div>
        </form>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-bordered table-hover" id="myTable">
            <thead>
                <tr>
                    <th class="custom_sno">SNo.</th>
                    <th>  Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Is Verified</th>
                    <th class="custom_status">Status</th>
                    <th class="custom_action">Action</th>
                </tr>
            </thead>
            <tbody>

                @if(count($customers) > 0)
                @foreach($customers as $key => $value)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$value->user->first_name .' '.$value->user->last_name}}</td>
                    <td>{{$value->user->phone }}</td>
                    <td>{{isset($value->user->email) ? $value->user->email : '' }}</td>
                    <td>{{displayDateTime($value->created_at) }}</td>
                    <td>
                        <a href="{{url('admin/customers/user-verify/'.$value->user_id.'/'.$value->user->is_verified)}}" data-url="" onclick="return confirm('Do you want to verify?');"> <span class="label label-lg font-weight-bold label-light-{{($value->user->is_verified == 1) ? 'success' : 'danger'}} label-inline">{{($value->user->is_verified == 1) ? 'Verified' : 'Pending'}}</span></a>
                    </td>
                   <td>
                        <a href="javascript:void(0)" data-url="{{url('admin/customers/update-status/'.$value->user_id.'/'.$value->user->is_active)}}" onclick="changeStatus(this)">
                            <span class="label label-lg font-weight-bold label-light-{{($value->user->is_active == 1) ? 'success' : 'danger'}} label-inline">
                                {{($value->user->is_active == 1) ? 'Active' : 'InActive'}}
                            </span>
                        </a>
                    </td>
                    <td>
                        <a href="{{url('/admin/customers/edit/'.$value->id)}}" class="btn btn-sm btn-clean btn-icon" title="Edit details" data-toggle="tooltip">
                            <i class="la la-edit"></i>
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



@endsection

{{-- Styles Section --}}
@section('styles')
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection


{{-- Scripts Section --}}
@section('scripts')
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $('.dataTables_filter label input[type=search]').addClass('form-control form-control-sm');
        $('.dataTables_length select').addClass('custom-select custom-select-sm form-control form-control-sm');
    });
</script>
{{-- vendors --}}
<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" type="text/javascript"></script>

{{-- page scripts --}}
@endsection