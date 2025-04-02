@extends('admin.layout.default')

@section('employermaster','active menu-item-open')
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
                                <div><input type="text" name="name" value="{{old('name')}}" isrequired="required" class="form-control" placeholder="Enter User Name"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email/User Name </label>
                                <div><input type="email" name="email" value="{{old('email')}}" isrequired="required" class="form-control" placeholder="Enter Email/User Name"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Mobile No.</label>
                                <div><input type="text" name="mobile" value="{{old('mobile')}}" isrequired="required" class="form-control" placeholder="Enter Mobile Number"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Password </label>
                                <div><input type="password" name="password" class="form-control" placeholder="Enter Password"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>GST </label>
                                <div><input type="text" name="gst" value="{{old('mobile')}}" class="form-control" placeholder="Enter gst"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>State </label>

                                <select class="form-control" name="state_id" id="state" isrequired="required">
                                    <option value="">Select State</option>
                                    @if($states = getStates())
                                    @foreach($states as $state)
                                    <option value="{{$state->id}}" data-name="{{$state->name}}" {{runTimeSelection($state->id,old('state_id'))}}>{{$state->name}}</option>
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
                                <div><input type="text" name="address_line1" value="{{old('address_line1')}}" isrequired="required" class="form-control" placeholder=""></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Address Line 2</label>
                                <div><input type="text" name="address_line2" value="{{old('address_line2')}}" class="form-control" placeholder=""></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Pincode</label>
                                <div><input type="text" name="pincode" value="{{old('pincode')}}" class="form-control number" placeholder=""></div>
                            </div>

                            <div class="form-group col-md-6" style="display:none">
                                <label>User Role</label>
                                <select class="form-control" name="role_id" id="role_id" isrequired="required">
                                    <option value="">Select Role</option>
                                    @if($roles = getSystemRoles())
                                    @foreach($roles as $role )
                                    <option value="{{$role->id}}" {{runTimeSelection(3,$role->id)}}>{{ $role->role }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <hr>
                            </div>

                            <div class="form-group col-md-12">
                                <h4> Company Details</h4>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Company Name</label>
                                <div><input type="text" name="company_name" value="{{old('company_name')}}" isrequired="required" class="form-control" placeholder=""></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Company Type</label>
                                <div>
                                    <select class="form-control" name="company_type" id="company_type" isrequired="required">
                                        <option value="">Company type</option>

                                        @if($roles = companyType())
                                        @foreach($roles as $role )
                                        <option value="{{$role['id']}}" {{runTimeSelection(old('company_type'),$role['id'])}}>{{ $role['name'] }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div> 


                            <div class="form-group col-md-6">
                                <label>Industry</label>
                                <div>
                                    @php $Industry = getIndustry(); @endphp
                                    <select name="industry_id" class="form-control">
                                        <option value="">-Select-</option>
                                        @if($Industry)
                                        @foreach($Industry as $value)
                                        <option value="{{$value['id']}}">{{$value['title']}}</option>
                                        @endforeach
                                        @endif
                                        from db
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Functional Area</label>
                                <div>
                                    @php $functionalArea = getFunctionalArea(); @endphp

                                    <select class="form-control" name="functional_area" isrequired="required">
                                        <option value="">--Functional Area--</option>
                                        @if($functionalArea)
                                        @foreach($functionalArea as $value)
                                        <option value="{{$value['id']}}">{{$value['title']}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Since</label>
                                <div><input type="date" max="{{date('Y-m-d')}}" name="company_since" value="{{old('company_since')}}" isrequired="required" class="form-control" placeholder=""></div>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Company Email Id</label>
                                <div><input type="text" name="company_email" value="{{old('company_email')}}" isrequired="required" class="form-control" placeholder=""></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Company Website</label>
                                <div><input type="text" name="company_website" value="{{old('company_website')}}" class="form-control" placeholder=""></div>
                            </div>





                            <div class="form-group col-md-6">
                                <label>Company Office</label>
                                <div><input type="text" name="company_office_address" value="{{old('company_office_address')}}" isrequired="required" class="form-control" placeholder=""></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Company Corporate Office</label>
                                <div><input type="text" name="company_office_corporate_address" value="{{old('company_office_corporate_address')}}" isrequired="required" class="form-control" placeholder=""></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Company GST</label>
                                <div><input type="text" name="company_gst" value="{{old('company_gst')}}" isrequired="required" class="form-control" placeholder=""></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>No. of employees</label>
                                <div><input type="text" name="employees_count" value="{{old('employees_count')}}" isrequired="required" class="form-control" placeholder=""></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>State </label>

                                <select class="form-control" name="company_state_id" id="company_state" isrequired="required">
                                    <option value="">Select State</option>
                                    @if($states = getStates())
                                    @foreach($states as $state)
                                    <option value="{{$state->id}}" data-name="{{$state->name}}" {{runTimeSelection($state->id,old('state_id'))}}>{{$state->name}}</option>
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
                                <div><input type="text" name="company_pincode" value="{{old('company_pincode')}}" class="form-control number" placeholder=""></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>About Us</label>
                                <div>
                                    <textarea name="about_us" value="" class="form-control" placeholder="">{{old('about_us')}}</textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Policy(s)</label>
                                <div>
                                    <textarea name="policy" value="" class="form-control" placeholder="">{{old('policy')}}</textarea>
                                </div>
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