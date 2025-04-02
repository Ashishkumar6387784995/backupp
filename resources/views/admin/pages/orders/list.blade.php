@extends('admin.layout.default')

@section('ordermaster','active menu-item-open')
@section('content')
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-3 pb-0">
        <div class="card-title">
            <h3 class="card-label">Orders List
                <!-- <div class="text-muted pt-2 font-size-sm">Datatable initialized from HTML table</div> -->
            </h3>
        </div>
        <div class="card-toolbar">
            @include('admin.layout.partials.filters.common-filter')
            <!--begin::Button-->
            <!-- <a href="{{url('/admin/doctors/add')}}" class="btn btn-primary font-weight-bolder">
                <i class="la la-plus"></i>Add Doctor</a> -->
            <!--end::Button-->
        </div>
        <form action="" method="get" class="w-100">
            <div class="row col-lg-12 pl-0 pr-0">
                <div class="col-sm-3">
                    <div class="dataTables_length">
                        <label>Date Range</label>
                        <input style="width:100%;" type="text" name="fromtodate" id="fromtodate" class="form-control input-sm" placeholder="Date Range" autocomplete="off" value="{{request('fromtodate')}}" readonly>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="dataTables_length">
                        <label>Order Status</label>
                        <select name="status" class="form-control">
                            <option value="">All Order Status</option>
                            @php
                            $orderStatus = getAllOrderStatus();
                            @endphp
                            @if( $orderStatus )
                            @foreach( $orderStatus as $list)
                            <option value="{{ $list->id}}" @if(request('status')==$list->id ) {{runTimeSelection( $list->id, request('status'))}} @endif>{{ $list->status_title}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="dataTables_length">
                        <label>City</label>
                        <?php $getAllCities = getAllCities(); ?>
                        <select class="form-control" name="city_id">
                            <option value="">Select City</option>
                            @if($getAllCities)
                            @foreach($getAllCities as $city)
                            <option value="{{$city->id}}" {{runTimeSelection($city->id,request('city_id'))}}>{{$city->name }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="dataTables_length">
                        <label cla>&#160; </label>
                        <button type="submit" class="btn btn-success" data-toggle="tooltip" title="Apply Filter" style="margin-top: 20px;">Filter</button>
                        <a href="{{url('/')}}/admin/orders/list" class="btn btn-default mt-7" data-toggle="tooltip" title="" data-original-title="Reset">Reset</a>
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
                    <th>Order ID</th>
                    <th>Patient Name</th>
                    <th>Patient Mobile</th>
                    <th>City</th>
                    <th style="width: 120px;">Date</th>
                    <th>Schedule Date Time</th>
                    <th>Order Amount</th>
                    <th>Payment Mode</th>
                    <th class="custom_status">Status</th>
                    <th class="custom_action">Action</th>
                </tr>
            </thead>
            <tbody>

                @if(count($orders) > 0)
                @foreach($orders as $key => $value)
                @php

                @endphp
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>ORD{{$value->id }}</td>
                    <td>{{$value->patient_firstname .' '.$value->patient_lastname }}</td>
                    <td>{{$value->patient_number }}</td>
                    <td>{{$value->city ? $value->city->name : '' }}</td>
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
                        <div data-toggle="tooltip" title="Order Date">
                            {{displayDateTime($value->created_at) }}
                        </div>
                        <!-- <div data-toggle="tooltip" title="Schedule Date Time">
                            {{$value->schedule_date ? displayDateTime($value->schedule_date.' '. $value->schedule_time) : 'NA' }}
                        </div> -->
                    </td>
                    <td>
                        {{$value->schedule_date ? displayDateTime2($value->schedule_date.' '. $value->schedule_time) : 'NA' }}

                    </td>
                    <td>₹{{$value->order_total }}</td>
                    <td>{{strtoupper($value->payment_type) }}</td>
                    <td>
                        <span class="">{{$value->orderStatus->status_title}}</span>
                    </td>
                    <td>
                        <a href="{{url('/admin/orders/edit/'.$value->id)}}" class="btn btn-sm btn-clean btn-icon" title="Edit details" data-toggle="tooltip">
                            <i class="la la-edit"></i>
                        </a>
                        <!-- <a href="javascript:void(0)" class="btn btn-sm btn-clean btn-icon">
                            <i class=" text-dark-50 flaticon-whatsapp whatsapp-color"></i>
                        </a> -->
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
    function changeStatus() {
        confirm("Do you want to change status ?");
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