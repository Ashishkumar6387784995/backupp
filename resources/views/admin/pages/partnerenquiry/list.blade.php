@extends('admin.layout.default')

@section('partnerenquirymaster','active menu-item-open')
@section('content')
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-3 pb-0">
        <div class="card-title">
            <h3 class="card-label">Partner Enquiry
            </h3>
        </div>
        <div class="card-toolbar">
            {{-- @include('admin.layout.partials.filters.common-filter') --}}
            <!--begin::Button-->
            <!-- <a href="{{url('/admin/specialities/add')}}" class="btn btn-primary font-weight-bolder">
                <i class="la la-plus"></i>Add Query</a> -->
            <!--end::Button-->
        </div>
        <form action="" method="get" class="w-100">
            <div class="row col-lg-12 pl-0 pr-0">
                <div class="col-sm-3">
                    <div class="dataTables_length">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="">All Status</option>
                            <option value="1" @if(request('status')=='1' ) {{runTimeSelection(0, request('status'))}} @endif>New</option>
                            <option value="2" @if(request('status')=='2' ) {{runTimeSelection(1, request('status'))}} @endif>Pending</option>
                            <option value="3" @if(request('status')=='3' ) {{runTimeSelection(1, request('status'))}} @endif>Convert</option>

                        </select>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="dataTables_length">
                        <label cla>&#160; </label>
                        <button type="submit" class="btn btn-success mt-7" data-toggle="tooltip" title="Apply Filter">Filter</button>
                        <a href="{{url('/admin/enquires/list')}}" class="btn btn-default mt-7" data-toggle="tooltip" title="Reset">Reset</a>
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
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Ownership</th>
                    <th>Business Profession</th>
                    <th>Association With LPL</th>
                    <th>City Name</th> 
                    <th class="">Status</th>
                    <th class="">Created At</th>
                    <th class="">Action</th>
                </tr>
            </thead>
            <tbody>


                @if(count($queries) > 0)
                @foreach($queries as $key => $value)
                @php
                if($value->ownership == 1){
                $ownership = 'Individual';
                }elseif($value->ownership == 2){
                $ownership = 'HUF';
                }elseif($value->ownership == 3){
                $ownership = 'Partnership/Firm';
                }else{
                $ownership = '';
                }
                if($value->business_profession == 1){
                $business_profession = 'Technician';
                }elseif($value->business_profession == 2){
                $business_profession = 'Phlebotomist';
                }elseif($value->business_profession == 3){
                $business_profession = 'Doctor';
                }elseif($value->business_profession == 4){
                $business_profession = 'Businessman';
                }else{
                $business_profession = 'Other';
                }
                if($value->association_with_lpl == 1){
                $association_with_lpl = 'Business Partnership';
                }elseif($value->association_with_lpl == 2){
                $association_with_lpl = 'Supplier';
                } else{
                $association_with_lpl = 'None';
                }
                @endphp
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$value->first_name.' '.$value->last_name }}</td>
                    <td>{{$value->mobile }}</td>
                    <td>{{$value->email_id }}</td>
                    <td>{{ $ownership }}</td>
                    <td>{{ $business_profession }}</td>
                    <td>{{$association_with_lpl }}</td>
                    <td>{{$value->city_name }}</td> 
                    <td>
                        <!-- <a href="javascript:void(0)" data-url="{{url('admin/enquires/update-status/'.$value->id.'/'.$value->status)}}" onclick="changeStatus(this)"> <span class="label label-lg font-weight-bold label-light-{{($value->status == 1) ? 'success' : 'danger'}} label-inline">{{($value->status == 1) ? 'Active' : 'InActive'}}</span></a> -->
                        <select class="form-control form-control-sm @if($value->status ==3 )  disabled @endif" @if($value->status ==3 ) disabled readonly @else data-url="{{url('admin/partnerenquiry/update-status/'.$value->id.'/')}}" onChange="changeStatus1(this)" @endif>
                            <option value="1" {{runTimeSelection(1,$value->status)}}>New</option>
                            <option value="2" {{runTimeSelection(2,$value->status)}}>Pending</option>
                            <option value="3" {{runTimeSelection(3,$value->status)}}>Convert</option>
                        </select>
                    </td>
                    <td>{{displayDateTime($value->created_at) }}</td>
                    <td>
                        <a href="{{url('/admin/partnerenquiry/edit/'.$value->id)}}" class="btn btn-sm btn-clean btn-icon" title="Edit details" data-toggle="tooltip">
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
<script>
    function changeStatus1(e) {
        if (confirm("Do you want to change status?")) {
            location.href = $(e).attr('data-url') + '/' + $(e).val();
        }
    }

    function deleteTest() {
        confirm("Do you want to delete speciality ?");
    }
</script>
@endsection

{{-- Styles Section --}}
@section('styles')
<!-- <link href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
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
<!-- <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script> -->

{{-- page scripts --}}
<!-- <script src="{{ asset('js/pages/crud/datatables/basic/basic.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script> -->
@endsection