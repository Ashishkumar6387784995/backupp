@extends('admin.layout.default')

@section('partnermaster','active menu-item-open')
@section('content')
<div class="card card-custom">

    <div class="card-body">
        <div class="mb-7">
            <div class="row align-items-center">

                <form method="POST" action="" class="w-100">
                    {{ csrf_field() }}
                    <div class="col-lg-9 col-xl-12">
                        <div class="row align-items-center">
                            <div class="form-group col-md-12">
                                <h4> Basic Details</h4>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Name</label>
                                <div><input type="text" name="name" value="{{$details->name}}" isrequired="required" class="form-control" placeholder="Enter User Name"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email/User Name </label>
                                <div><input type="email" name="email" value="{{$details->email }}" isrequired="required" class="form-control" placeholder="Enter Email"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Mobile No.</label>
                                <div><input type="text" name="mobile" value="{{$details->mobile}}" isrequired="required" class="form-control" placeholder="Enter Mobile Number"></div>
                            </div> 
                           
                            <div class="form-group col-md-6">
                                <label>GST </label>
                                <div><input type="text" name="gst" value="{{$details->gst}}" class="form-control" placeholder="Enter gst"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>State </label>

                                <select class="form-control" name="state_id" id="state" isrequired="required">
                                    <option value="">Select State</option>
                                    @if($states = getStates())
                                    @foreach($states as $state)
                                    <option value="{{$state->id}}" data-name="{{$state->name}}" {{runTimeSelection($state->id,$details->state_id)}}>{{$state->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>City </label>
                                <select class="form-control" name="city_id" id="city" isrequired="required">
                                    <option value="">Select City</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Address Line 1</label>
                                <div><input type="text" name="address_line1" value="{{$details->address_line1}}" isrequired="required" class="form-control" placeholder=""></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Address Line 2</label>
                                <div><input type="text" name="address_line2" value="{{$details->address_line2}}" class="form-control" placeholder=""></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Pincode</label>
                                <div><input type="text" name="pincode" value="{{$details->pincode}}" class="form-control number" placeholder=""></div>
                            </div>



                            <div class="form-group col-md-12">
                                <hr>
                            </div>

                            <div class="form-group col-md-12">
                                <h4> Company Details</h4>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Company Name</label>
                                <div><input type="text" name="company_name" value="{{$details->company_name}}" isrequired="required" class="form-control" placeholder=""></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Company Type</label>
                                <div>
                                    <select class="form-control" name="company_type" id="company_type" isrequired="required">
                                        <option value="">Company type</option>

                                        @if($roles = companyType())
                                        @foreach($roles as $role )
                                        <option value="{{$role['id']}}" {{runTimeSelection($details->company_type,$role['id'])}}>{{ $role['name'] }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Company Office</label>
                                <div><input type="text" name="company_office_address" value="{{$details->company_office_address}}" isrequired="required" class="form-control" placeholder=""></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Company Corporate Office</label>
                                <div><input type="text" name="company_office_corporate_address" value="{{$details->company_office_corporate_address}}" isrequired="required" class="form-control" placeholder=""></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Company GST</label>
                                <div><input type="text" name="company_gst" value="{{$details->company_gst}}" isrequired="required" class="form-control" placeholder=""></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>No. of employees</label>
                                <div><input type="text" name="employees_count" value="{{$details->employees_count}}" isrequired="required" class="form-control" placeholder=""></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>State </label>

                                <select class="form-control" name="company_state_id" id="company_state" isrequired="required">
                                    <option value="">Select State</option>
                                    @if($states = getStates())
                                    @foreach($states as $state)
                                    <option value="{{$state->id}}" data-name="{{$state->name}}" {{runTimeSelection($state->id,$details->company_state_id)}}>{{$state->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>City </label>
                                <select class="form-control" name="company_city_id" id="company_city" isrequired="required">
                                    <option value="">Select City</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Pincode</label>
                                <div><input type="text" name="company_pincode" value="{{$details->company_pincode}}" class="form-control number" placeholder=""></div>
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
<script>
    var stateId = '{{$details->state_id}}';
    var cityId = '{{$details->city_id}}';
    var company_state_id = '{{$details->company_state_id}}';
    var company_city_id = '{{$details->company_city_id}}';
    setTimeout(function() {
        if (stateId) {
            console.log($('select[name=state_id]'));
            $('select[name=state_id]').focus().change();
        }
        if (company_state_id) {
            $('#company_state').change();
        }
    }, 500);
</script>
@endsection