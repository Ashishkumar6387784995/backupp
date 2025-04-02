@extends('admin.layout.default')

@section('enquiremaster','active menu-item-open')
@section('content')
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-3 pb-0">
        <div class="card-title">
            <h3 class="card-label">Enquiry
            </h3>
        </div>
        <div class="card-toolbar">
            @include('admin.layout.partials.filters.common-filter')
            <!--begin::Button-->
            <!-- <a href="{{url('/admin/specialities/add')}}" class="btn btn-primary font-weight-bolder">
                <i class="la la-plus"></i>Add Query</a> -->
            <!--end::Button-->
        </div>
        <form action="" method="get" class="w-100">

            <div class="row col-lg-12 pl-0 pr-0">
                <div class="col-sm-4">
                    <div class="dataTables_length">
                        <label>Date</label>
                        <div class="d-flex">
                            <input type="date" name="from_date" class="form-control w-50" onchange="$('#to_date').attr('min',this.value)" />
                            <input type="date" name="to_date" id="to_date" class="form-control w-50" />
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="dataTables_length">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="">All Status</option>
                            <option value="-1" {{runTimeSelection(-1,request('status'))}}>New</option>
                            <option value="1" {{runTimeSelection(1,request('status'))}}>Pending</option>
                            <option value="2" {{runTimeSelection(2,request('status'))}}>Converted</option>
                            <option value="3" {{runTimeSelection(3,request('status'))}}>Call back requested</option>
                            <option value="4" {{runTimeSelection(4,request('status'))}}>Not responding</option>
                            <option value="5" {{runTimeSelection(5,request('status'))}}>Not interested</option>
                            <option value="6" {{runTimeSelection(6,request('status'))}}>Follow up</option>
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
                    <th>Date</th>
                    <th>City</th>
                    <th class="">Status</th>
                    <th class="">Created At</th>
                    <th class="">Action</th>
                </tr>
            </thead>
            <tbody>
                @if(count($queries) > 0)
                @foreach($queries as $key => $value)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$value->customer_name }}</td>
                    <td>{{$value->customer_mobile }}</td>
                    <td>{{$value->customer_email }}</td>
                    <td>
                        <div data-toggle="tooltip" title="Next Followup Date">
                            {{$value->next_follow_up_date ? displayDate($value->next_follow_up_date) : 'NA'}}
                        </div>
                        <div>
                            <span data-toggle="tooltip" title="Last Followup Date">
                                {{$value->last_follow_up_date ? displayDate($value->last_follow_up_date) : 'NA'}}
                            </span>
                            <span class="icon-1x flaticon-chat-1" data-toggle="tooltip" title="{{$value->last_follow_up_comment ? $value->last_follow_up_comment : 'NA'}}" style="color:red">
                            </span>
                        </div>
                    </td>

                    <td>{{($value->city_id && isset($value->city)) ?  $value->city->name : 'NA'}}</td>
                    <td>
                        <!-- <a href="javascript:void(0)" data-url="{{url('admin/enquires/update-status/'.$value->id.'/'.$value->status)}}" onclick="changeStatus(this)"> <span class="label label-lg font-weight-bold label-light-{{($value->status == 1) ? 'success' : 'danger'}} label-inline">{{($value->status == 1) ? 'Active' : 'InActive'}}</span></a> -->
                        <select class="form-control form-control-sm @if($value->is_lead_converted ==2 )  disabled @endif" @if($value->is_lead_converted ==2 ) disabled readonly @else data-url="{{url('admin/enquires/update-status/'.$value->id.'/')}}" onChange="changeStatus1(this)" @endif>
                            <option value="0" {{runTimeSelection(0,$value->is_lead_converted)}}>Request Taken/New</option>
                            <option value="1" {{runTimeSelection(1,$value->is_lead_converted)}}>Pending</option>
                            <option value="2" {{runTimeSelection(2,$value->is_lead_converted)}}>Converted/Confirmed</option>
                            <option value="3" {{runTimeSelection(3,$value->is_lead_converted)}}>Call back requested</option>
                            <option value="4" {{runTimeSelection(4,$value->is_lead_converted)}}>Not responding</option>
                            <option value="5" {{runTimeSelection(5,$value->is_lead_converted)}}>Not interested</option>
                            <option value="6" {{runTimeSelection(6,$value->is_lead_converted)}}>Follow up</option>
                            <option value="7" {{runTimeSelection(7,$value->is_lead_converted)}}>Centre Allocated</option>
                            <option value="8" {{runTimeSelection(8,$value->is_lead_converted)}}>Phlebo Allocated</option>
                            <option value="9" {{runTimeSelection(9,$value->is_lead_converted)}}>Sample Collected</option>
                            <option value="10" {{runTimeSelection(10,$value->is_lead_converted)}}>Report Generated</option>
                            <option value="11" {{runTimeSelection(11,$value->is_lead_converted)}}>Cancelled</option>
                            <option value="12" {{runTimeSelection(12,$value->is_lead_converted)}}>Refunded</option>
                        </select>
                    </td>
                    <td>{{displayDateTime($value->created_at) }}</td>
                    <td>
                        <a href="{{url('/admin/enquires/edit/'.$value->id)}}" class="btn btn-sm btn-clean btn-icon" title="Edit value" data-toggle="tooltip">
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