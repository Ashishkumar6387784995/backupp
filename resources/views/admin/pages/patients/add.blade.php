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
                                    <option value="{{$list->id}}" {{runTimeSelection($list->id,old('customer_id'))}}> {{$list->first_name}} {{$list->last_name}}</option>
                                    @endforeach
                                    @endif 
                                </select>
                            </div>
                            @endif
                            <div class="form-group col-md-6">
                                <label> First Name</label>
                                <div><input type="text" name="first_name" value="{{old('first_name')}}" isrequired="required" class="form-control" placeholder="Enter  First Name"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label> Last Name</label>
                                <div><input type="text" name="last_name" value="{{old('last_name')}}" isrequired="required" class="form-control" placeholder="Enter  Last Name"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Mobile</label>
                                <div><input type="text" name="mobile_no" value="{{old('mobile_no')}}" isrequired="required" class="form-control number" placeholder="Enter Mobile Number"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <div><input type="text" name="email_id" value="{{old('email_id')}}" isrequired="required" class="form-control" placeholder="Enter Email Address"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Date of Birth</label>
                                <div><input type="date" name="dob" value="{{old('dob')}}" isrequired="required" class="form-control" placeholder="Enter Date Of Birth"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Gender</label>
                                <select class="form-control" name="gender" id="gender" isrequired="required">
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ runTimeSelection(old('gender'), 'male')}}>Male</option>
                                    <option value="female" {{ runTimeSelection(old('gender'), 'female')}}>Female</option>
                                    <option value="other" {{ runTimeSelection(old('gender'), 'other')}}>Other</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Booking For</label>
                                <select class="form-control" name="relation" id="relation" isrequired="required">
                                    <option value="1" {{runTimeSelection(1,old('relation'))}}>Self</option>
                                    <option value="2" {{runTimeSelection(2,old('relation'))}}>Other</option>

                                </select>
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

@endsection

{{-- Scripts Section --}}
@section('scripts')
@endsection