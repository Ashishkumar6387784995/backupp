@extends('admin.layout.default')

@section('ordermaster','active menu-item-open')
@section('content')
<div class="card card-custom gutter-b">
    <div class="card-body">
        <!--begin::Example-->
        <div class="example">
            <div class="example-preview">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#OrderDetails">
                            <span class="nav-icon">
                                <i class="flaticon2-layers-1"></i>
                            </span>
                            <span class="nav-text">Order Details</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#CentreAllocation" aria-controls="profile">
                            <span class="nav-icon">
                                <i class="flaticon2-layers-1"></i>
                            </span>
                            <span class="nav-text">Centre Allocation</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#PatientDetails" aria-controls="contact">
                            <span class="nav-icon">
                                <i class="flaticon2-layers-1"></i>
                            </span>
                            <span class="nav-text">Patient Details</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#CustomerDetails" aria-controls="contact">
                            <span class="nav-icon">
                                <i class="flaticon2-layers-1"></i>
                            </span>
                            <span class="nav-text">Customer Details</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content mt-5" id="myTabContent">
                    <div class="tab-pane fade active show" id="OrderDetails" role="tabpanel" aria-labelledby="home-tab">
                        <form method="POST" action="" class="w-100" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{$details->order_status}}" name="order_status">
                            <div class="col-lg-12">
                                <div class="row align-items-center">
                                    <div class="form-group col-md-3">
                                        <label>Order Date</label>
                                        <input type="text" class="form-control" readonly disabled value="{{displayDateTime($details->created_at)}}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Order Status</label>
                                        <select name="order_status" class="form-control">
                                            <option value="">Order Status</option>
                                            @php
                                            $orderStatus = getAllOrderStatus();
                                            @endphp
                                            @if( $orderStatus )
                                            @foreach( $orderStatus as $list)
                                            <option value="{{ $list->id}}" {{runTimeSelection( $list->id, $details->order_status)}}  >{{ $list->status_title}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Schedule Date</label>
                                        <input type="date" class="form-control" value="{{$details->schedule_date}}" name="schedule_date">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Schedule Time</label>
                                        <input type="time" class="form-control" value="{{$details->schedule_time}}" name="schedule_time">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Last Followup Date</label>
                                        <input type="text" class="form-control" readonly disabled value="{{$details->last_follow_up_date ? date('d-m-Y',strtotime($details->last_follow_up_date)) : 'NA'}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Last Followup Comment</label>
                                        <textarea type="text" class="form-control" readonly disabled value="">{{$details->last_follow_up_comment ? $details->last_follow_up_comment : 'NA'}}</textarea>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Comment</label>
                                        <textarea type="text" class="form-control" value="" name="last_follow_up_comment"></textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Next Followup Date</label>
                                        <input type="date" min="{{$details->last_follow_up_date ? date('Y-m-d',strtotime($details->last_follow_up_date)) : date('Y-m-d')}}" class="form-control" value="{{$details->next_follow_up_date ? date('Y-m-d',strtotime($details->next_follow_up_date)) : ''}}" name="next_follow_up_date">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Prescriptions</label>

                                        @if(!empty($details->prescription) && $images = json_decode($details->prescription,true))
                                        @foreach($images as $key => $contract_document)


                                        <div class="_update_img_action">
                                            <br>
                                            @if(str_contains($contract_document, '.pdf'))
                                            <a target="_blank" href="{{asset('uploads/bookings/prescriptions/'.$contract_document)}}" class="btn btn-primary btn-sm">View PDF </a>
                                            @else
                                            <img src="{{asset('uploads/bookings/prescriptions/'.$contract_document)}}" class="btn btn-primary btn-sm" onclick="window.open('{{asset('uploads/bookings/prescriptions/'.$contract_document)}}', '_blank');" style="width: 200px;"> &nbsp;
                                            @endif
                                            <!-- <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deleteImage(this)">Delete</a> -->
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="">
                                            NA
                                        </div>
                                        @endif


                                    </div>

                                    <div class="form-group col-md-12">
                                        <h6>Order Items</h6>
                                    </div>
                                    <div class="form-group col-md-12">
                                        @php
                                        $orderDetails = json_decode($details->updated_order_details,true);
                                        @endphp
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>SNo.</th>
                                                <th>Item Type</th>
                                                <th>Item Code</th>
                                                <th>Item Name</th>
                                                <th>Item Qty</th>
                                                <th>Item MRP</th>
                                                <th>Item Selling Price</th>
                                                <th>#Total</th>
                                            </tr>
                                            @if( $orderDetails)
                                            @foreach( $orderDetails as $orderDetail)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>
                                                    <div class="btn {{($orderDetail['type']=='test') ? 'btn-success' : 'btn-primary' }} btn-sm">{{strtoupper($orderDetail['type'])}}

                                                    </div>
                                                </td>
                                                <td>{{(isset($orderDetail['code'])) ? $orderDetail['code'] : 'NA'}}</td>
                                                <td>{{(isset($orderDetail['name'])) ? $orderDetail['name'] : 'NA'}}</td>
                                                <td>{{$orderDetail['qty']}}</td>
                                                <td>₹{{$orderDetail['mrp']}}</td>
                                                <td>₹{{$orderDetail['selling_price']}}</td>
                                                <td>₹{{$orderDetail['sub_total']}}</td>
                                            </tr>
                                            @endforeach
                                            @else
                                            @endif
                                            <tr>
                                                <th colspan="7">Sub Total</th>
                                                <td>₹{{$details->order_items_total}}</td>
                                            </tr>
                                            <tr>
                                                <th colspan="7">Discount</th>
                                                <td>₹{{$details->order_discount}}</td>
                                            </tr>
                                            <tr>
                                                <th colspan="7">Home Collection Charges</th>
                                                <td>₹{{$details->hc_charges}}</td>
                                            </tr>
                                            <tr>
                                                <th colspan="7">Grand Total</th>
                                                <td>₹{{$details->order_total}}</td>
                                            </tr>
                                            <tr>
                                                <th colspan="7">Advance Paid</th>
                                                <td>₹{{$details->advance_paid}}</td>
                                            </tr>
                                            <tr>
                                                <th colspan="7">Payment Mode</th>
                                                <td>{{strtoupper($details->payment_type)}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="form-group col-md-12 text-center">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="CustomerDetails" role="tabpanel" aria-labelledby="profile-tab">
                        <form method="POST" action="{{url('/admin/orders/edit/updateCustomer/'.$details->id)}}" class="w-100" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" class="form-control" value="{{$details->address_id}}" name="address_id">
                            <input type="hidden" class="form-control" value="{{$details->customer_id}}" name="customer_id">
                            <input type="hidden" value="{{$details->order_status}}" name="order_status">
                            <div class="col-lg-12">
                                <div class="row align-items-center">
                                    <div class="form-group col-md-6">
                                        <label>Customer Mobile</label>
                                        <input type="text" class="form-control" readonly disabled value="{{$details->customer ? $details->customer->mobile_no :''}}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" value="{{$details->customer_firstname}}" name="first_name">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" value="{{$details->customer_lastname}}" name="last_name">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <h6>Address Details</h6>
                                        <hr>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Address</label>
                                        <input type="text" class="form-control" value="{{$details->address}}" name="flat_no">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Locality Name</label>
                                        <input type="text" class="form-control" value="{{$details->locality}}" name="locality_name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Pincode</label>
                                        <input type="text" class="form-control number" value="{{$details->pincode}}" name="pincode">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>State</label>
                                        <select class="form-control" name="state_id" id="state" isrequired="required">
                                            <option value="">Select State</option>
                                            @if($states)
                                            @foreach($states as $state)
                                            <option value="{{$state->id}}" {{runTimeSelection($state->id,$details->state_id)}}>{{$state->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>City</label>
                                        <select class="form-control" name="city_id" id="city" isrequired="required">
                                            <option value="">Select City</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Address Tag</label>
                                        <select class="form-control" name="address_tag" id="address_tag" isrequired="required">
                                            <option value="">Address Tag</option>
                                            <option value="home" {{runTimeSelection('home',$details->address_tag)}}>Home</option>
                                            <option value="work" {{runTimeSelection('work',$details->address_tag)}}>Work</option>
                                            <option value="others" {{runTimeSelection('others',$details->address_tag)}}>Others</option>
                                        </select>
                                    </div>
                                    <!-- <div class="form-group col-md-6">
                                        <label>Customer Relation</label>
                                        <select class="form-control" name="address_tag" id="address_tag" isrequired="required">
                                            <option value="">Customer Relation</option>
                                            <option value="1" {{runTimeSelection('1',$details->customerAddress->relation)}}>Self</option>
                                            <option value="2" {{runTimeSelection('2',$details->customerAddress->relation)}}>Other</option>
                                        </select>
                                    </div> -->

                                    <div class="form-group col-md-12 text-center">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="PatientDetails" role="tabpanel" aria-labelledby="contact-tab">
                        <form method="POST" action="{{url('/admin/orders/edit/updatePatient/'.$details->id)}}" class="w-100" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{$details->order_status}}" name="order_status">
                            <!-- <input type="hidden" class="form-control" value="{{$details->patient? $details->patient->id : ''}}" name="patient_id"> -->
                            <input type="hidden" class="form-control" value="{{ $details->customer_id}}" name="customer_id">
                            <div class="col-lg-12">
                                <div class="row align-items-center">
                                    <div class="form-group col-md-4">
                                        <label>Mobile</label>
                                        <input maxlength="10" type="text" class="form-control number" value="{{$details->patient_number}}" name="mobile_no">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Patient First Name</label>
                                        <input type="text" class="form-control" value="{{$details->patient_firstname}}" name="patient_firstname">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Patient Last Name</label>
                                        <input type="text" class="form-control" value="{{$details->patient_lastname}}" name="patient_lastname">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Gender</label>
                                        <select class="form-control" name="gender" id="gender" isrequired="required">
                                            <option value="">Select Gender</option>
                                            <option value="male" {{runTimeSelection('male',$details->gender)}} {{runTimeSelection('Male',$details->gender)}}>Male</option>
                                            <option value="female" {{runTimeSelection('female',$details->gender)}} {{runTimeSelection('Female',$details->gender)}}>Female</option>
                                            <option value="other" {{runTimeSelection('other',$details->gender)}} {{runTimeSelection('Other',$details->gender)}}>Other</option>
                                        </select>
                                    </div>



                                    <div class="form-group col-md-6">
                                        <label>DOB</label>
                                        <input type="date" class="form-control" value="{{$details->patient_dob}}" name="dob">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Age</label>
                                        <input type="text" readonly class="form-control number" value="{{$details->patient_age}}" name="patient_age">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Email</label>
                                        <input type="text" class="form-control" value="{{$details->patient_email}}" name="email_id">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Customer Relation</label>
                                        <select class="form-control text-uppercase" name="relation" id="relation" isrequired="required">
                                            <option value="">Customer Relation</option> 

                                            <option  value="1" {{runTimeSelection('1',$details->patient_relation)}}>Self</option>
                                            <option  value="2" {{runTimeSelection('2',$details->patient_relation)}}>Father</option>
                                            <option  value="3" {{runTimeSelection('3',$details->patient_relation)}}>Mother</option>
                                            <option  value="4" {{runTimeSelection('4',$details->patient_relation)}}>Daughter</option>
                                            <option  value="5" {{runTimeSelection('5',$details->patient_relation)}}>Son</option>
                                            <option  value="6" {{runTimeSelection('6',$details->patient_relation)}}>Husband</option>
                                            <option  value="7" {{runTimeSelection('7',$details->patient_relation)}}>wife</option>
                                            <option value="8" {{runTimeSelection('8',$details->patient_relation)}}>Other</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12 text-center">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="CentreAllocation" role="tabpanel" aria-labelledby="contact-tab">
                        <form method="POST" action="{{url('/admin/orders/edit/centreAllocation/'.$details->id)}}" class="w-100" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{$details->order_status}}" name="order_status">
                            <div class="col-lg-12">
                                <div class="row align-items-center">
                                    <div class="form-group col-md-6">
                                        <label>Allocate Centre</label>
                                        <select class="form-control" name="centre_id" id="relation" isrequired="required">
                                            <option value="">Allocate Centre</option>
                                            @if($centres)
                                            @foreach($centres as $key => $centre)
                                            <option value="{{$centre->id}}" {{runTimeSelection($details->centre_id,$centre->id)}}>{{$centre->centre_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6 text-center mt-7">
                                        <button type="submit" class="btn btn-success">Allocate Centre</button>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <hr>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Centre Name</label>
                                        <input type="text" class="form-control" value="{{$details->centre ?$details->centre->centre_name : ''}}" readonly disabled>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Centre Address</label>
                                        <input type="text" class="form-control" value="{{$details->centre ?$details->centre->address_line1 : ''}} @if(isset($details->centre->address_line2) && !empty($details->centre->address_line2)){{$details->centre ?$details->centre->address_line2 : ''}}@endif" readonly disabled>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Centre City</label>
                                        <input type="text" class="form-control" value="{{$details->centre ?$details->centre->city_name : ''}}" readonly disabled>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Centre State</label>
                                        <input type="text" class="form-control" value="{{$details->centre ?$details->centre->state_name : ''}}" readonly disabled>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <hr>
                                    </div>


                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Example-->
    </div>
</div>

<div class="card card-custom gutter-b">
    <div class="card-body">
        <div class="form-group col-md-12">
            <h6> Order History </h6>
        </div>
        <div class="form-group col-md-12" style="    max-height: 201px; overflow: auto;">
            @php
            $orderHistory = $details->OrderHistory;
            @endphp
            <table class="table table-bordered">
                <tr>
                    <th>SNo.</th>
                    <th>Action</th>
                    <th>Comments</th>
                    <th>Action By</th>
                    <th>Created At</th>
                </tr>
                @if( $orderHistory)
                @foreach( $orderHistory as $History)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{getOrderStatus($History->order_status)}}</td>
                    <td>{{$History->comments}}</td>
                    <td>{{getUserName($History->updated_by)}}</td>
                    <td>{{displayDateTime($History->created_at)}}</th>
                </tr>
                @endforeach
                @endif
            </table>
        </div>
    </div>
</div>
@endsection

{{-- Styles Section --}}
@section('styles')
<style>
</style>
@endsection

{{-- Scripts Section --}}
@section('scripts')
<script>
    var stateId = '@if($details->state_id){{$details->state_id}}@endif';
    var cityId = '@if($details->city_id){{$details->city_id}}@endif';
    $(document).ready(function() {

        if (stateId) {
            $('#state').change();
        }
    });
</script>
@endsection