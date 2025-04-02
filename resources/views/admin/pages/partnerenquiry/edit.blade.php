@extends('admin.layout.default')

@section('partnerenquirymaster','active menu-item-open')
@section('content')
<div class="card card-custom">

    <div class="card-body">
        <div class="mb-7">
            <div class="row align-items-center">

                <form method="POST" action="" class="w-100" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-lg-9 col-xl-12">
                        <div class="row align-items-center">


                            <div class="form-group col-md-6">
                                <label>First Name</label>
                                <div><input type="text" name="first_name" value="{{$details->first_name}}" isrequired="required" class="form-control" placeholder="Enter First Name"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Last Name</label>
                                <div><input type="text" name="last_name" value="{{$details->last_name}}" isrequired="required" class="form-control" placeholder="Enter Last Name"></div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Mobile</label>
                                <div><input type="text" name="mobile" value="{{$details->mobile}}" isrequired="required" class="form-control number" placeholder="Enter Mobile"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <div><input type="email" name="email_id" value="{{$details->email_id}}" isrequired="required" class="form-control" placeholder="Enter Email"></div>
                            </div>

                            <div class="form-group col-md-12">
                                <label>Address</label>
                                <textarea class="form-control" name="address" row="27">{{$details->address}}</textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Pincode</label>
                                <div><input type="text" name="pincode" value="{{$details->pincode}}" isrequired="required" class="form-control" placeholder="Enter Pincode"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>State</label>
                                <select class="form-control" name="state_id" id="state_id" isrequired="required">
                                    <option value="">Select State</option>
                                    @if($states)
                                    @foreach($states as $state)
                                    <option value="{{$state->id}}" {{runTimeSelection($state->id,$details->state_id)}}>{{$state->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>City</label>
                                <select class="form-control" name="city_id" id="city_id" isrequired="required">
                                    <option value="">Select City</option>
                                    @if($cities)
                                    @foreach($cities as $city)
                                    <option value="{{$city->id}}" {{runTimeSelection($city->id,$details->city_id)}}>{{$city->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Status</label>
                                <select name="is_lead_converted" class="form-control">
                                    <option value="0" {{runTimeSelection(0,$details->is_lead_converted)}}>New</option>
                                    <option value="1" {{runTimeSelection(1,$details->is_lead_converted)}}>Pending</option>
                                    <option value="2" {{runTimeSelection(2,$details->is_lead_converted)}}>Convert</option>
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label>Comment</label>
                                <textarea class="form-control" name="message" row="27">{{$details->message}}</textarea>
                            </div>

                             


                            <div class="form-group col-md-12">
                                <center><button class="btn btn-success">Update</button></center>
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

@endsection

{{-- Scripts Section --}}
@section('scripts')
@endsection