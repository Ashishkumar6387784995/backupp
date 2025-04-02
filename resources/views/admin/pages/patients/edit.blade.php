@extends('admin.layout.default')

@section('customermaster','active menu-item-open')
@section('content')
<div class="card card-custom">

    <div class="card-body">
        <div class="mb-7">
            <div class="row align-items-center">

                <form method="POST" action="" class="w-100">
                    {{ csrf_field() }}
                    <div class="col-lg-9 col-xl-12">
                        <div class="row align-items-center">

                            @if($customerId)
                            <input type="hidden" name="customer_id" value="{{$customerId}}">
                            @else
                            <div class="form-group col-md-6">
                                <label>Select Customer</label>
                                <select class="form-control" name="customer_id" id="customer_id" isrequired="required">
                                    <option value="1">Select Customer</option>
                                    @if($customers)
                                    @foreach($customers as $key => $list)
                                    <option value="{{$list->id}}" {{runTimeSelection($list->id,$details->customer_id)}}> {{$list->first_name}} {{$list->last_name}}</option>
                                    @endforeach
                                    @endif

                                </select>
                            </div>
                            @endif
                            <div class="form-group col-md-6">
                                <label> First Name</label>
                                <div><input type="text" name="first_name" value="{{$details->first_name}}" isrequired="required" class="form-control" placeholder="Enter  First Name"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label> Last Name</label>
                                <div><input type="text" name="last_name" value="{{$details->last_name}}" isrequired="required" class="form-control" placeholder="Enter  Last Name"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Mobile</label>
                                <div><input type="text" name="mobile_no" value="{{$details->mobile_no}}" isrequired="required" class="form-control number" placeholder="Enter Mobile Number"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <div><input type="text" name="email_id" value="{{$details->email_id}}" isrequired="required" class="form-control" placeholder="Enter Email Address"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Date of Birth</label>
                                <div><input type="date" name="dob" value="{{$details->dob}}" isrequired="required" class="form-control" placeholder="Enter Date Of Birth"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Gender</label>
                                <select class="form-control" name="gender" id="gender" isrequired="required">
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ runTimeSelection($details->gender, 'male')}}>Male</option>
                                    <option value="female" {{ runTimeSelection($details->gender, 'female')}}>Female</option>
                                    <option value="other" {{ runTimeSelection($details->gender, 'other')}}>Other</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Booking For</label>
                                <select class="form-control" name="relation" id="relation" isrequired="required">
                                    <option value="1" {{ runTimeSelection($details->relation, '1')}}>Self</option>
                                    <option value="2" {{ runTimeSelection($details->relation, '2')}}>Other</option>

                                </select>
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