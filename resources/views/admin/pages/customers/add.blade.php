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
                            <div class="form-group col-md-12">
                                <h4>Personal Info</h4>
                            </div>
                            <div class="form-group col-md-6">
                                <label> First Name</label>
                                <div><input type="text" name="first_name" value="{{old('first_name')}}" isrequired="required" class="form-control" placeholder="Enter First Name"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label> Last Name</label>
                                <div><input type="text" name="last_name" value="{{old('last_name')}}" isrequired="required" class="form-control" placeholder="Enter Last Name"></div>
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
                                <div><input type="date" name="dob" value="{{old('dob')}}" max="{{date('Y-m-d')}}" isrequired="required" class="form-control" placeholder="Enter Date Of Birth"></div>
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
                                <select class="form-control" name="state_id" id="state" isrequired="required">
                                    <option value="">Select State</option>
                                    @if($states)
                                    @foreach($states as $state)
                                    <option value="{{$state->id}}" data-name="{{$state->name}}" {{runTimeSelection($state->id,old('state_id'))}}>{{$state->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="form-group col-md-6">
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





                            <div class="form-group col-md-12">
                                <h4>Work Experience</h4>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Designation</label>
                                <div>
                                    <input type="text" name="designation" value="{{old('designation')}}" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Company Name</label>
                                <div>
                                    <input type="text" name="company" value="{{old('company')}}" class="form-control" placeholder="">
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Years*</label>
                                <div>
                                    <select id="experience_years" name="experience_years" class="form-control">
                                        <option value="0" selected="">0 Years</option>
                                        @for($i=1; $i <=30;$i++) <option value="{{$i}}">{{$i}} Years</option>
                                            @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Months</label>
                                <div>
                                    <select id="experience_months" name="experience_months" class="form-control">
                                        <option value="0" selected="">0 Months</option>
                                        @for($i=1; $i <=12;$i++) <option value="{{$i}}">{{$i}} Months</option>
                                            @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Please enter the duration*</label>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Years*</label>
                                        <div>
                                            <select id="from_experience_years" name="from_experience_years" class="form-control">
                                                <option value="0" selected="">Year</option>
                                                @for($i=2023; $i >= 1975;$i--) <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Months</label>
                                        <div>
                                            <select id="from_experience_months" name="from_experience_months" class="form-control">
                                                <option value="" selected="">Month</option>
                                                @for($i=1; $i <=12;$i++) <option value="{{$i}}">{{date('F',strtotime(date("Y-".$i."-d")))}}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Years*</label>
                                        <div>
                                            <select id="to_experience_years" name="to_experience_years" class="form-control">
                                                <option value="0" selected="">Year</option>
                                                @for($i=2023; $i >= 1975;$i--) <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Months</label>
                                        <div>
                                            <select id="to_experience_months" name="to_experience_months" class="form-control">
                                                <option value="" selected="">Month</option>
                                                @for($i=1; $i <=12;$i++) <option value="{{$i}}">{{date('F',strtotime(date("Y-".$i."-d")))}}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Functional Area</label>
                                <div>
                                    @php $functionalArea = getFunctionalArea(); @endphp
                                    <select name="functional_area" class="form-control">
                                        <option value="">-Select-</option>
                                        @if($functionalArea)
                                        @foreach($functionalArea as $value)
                                        <option value="{{$value['id']}}">{{$value['title']}}</option>
                                        @endforeach
                                        @endif 
                                    </select>
                                </div>
                            </div>


                            <div class="form-group col-md-6">
                                <label>Industry</label>
                                <div>
                                    @php $Industry = getIndustry(); @endphp
                                    <select name="industry" class="form-control">
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
                                <label>Location</label>
                                <div>
                                    <input type="text" name="location" value="{{old('location')}}" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Describe your work experience</label>
                                <div>
                                    <textarea type="text" name="work_experience_description" value="{{old('work_experience_description')}}" class="form-control" placeholder=""></textarea>
                                </div>
                            </div>


                            <div class="form-group col-md-12">
                                <h4>Skills</h4>
                            </div>

                            <div class="form-group col-md-12">
                                <div>
                                    <textarea type="text" name="skills" value="{{old('skills')}}" class="form-control" placeholder=""></textarea>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <h4>Education</h4>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Qualification</label>
                                <div>
                                    @php $Qualification = getQualification(); @endphp
                                    <select name="qualification" class="form-control">
                                        <option value="">-Select-</option>
                                        @if($Qualification)
                                        @foreach($Qualification as $value)
                                        <option value="{{$value['id']}}">{{$value['title']}}</option>
                                        @endforeach
                                        @endif
                                        from db
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>School/ College/ University Name</label>
                                <div>
                                    @php $university_name = getschool_college_university_name(); @endphp
                                    <select name="school_college_university_name" class="form-control">
                                        <option value="">-Select-</option>
                                        @if($university_name)
                                        @foreach($university_name as $value)
                                        <option value="{{$value['id']}}">{{$value['title']}}</option>
                                        @endforeach
                                        @endif
                                        from db
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Please enter the duration*</label>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Years*</label>
                                        <div>
                                            <select id="from_education_years" name="from_education_years" class="form-control">
                                                <option value="0" selected="">Year</option>
                                                @for($i=2023; $i >= 1975;$i--) <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Months</label>
                                        <div>
                                            <select id="from_education_months" name="from_education_months" class="form-control">
                                                <option value="" selected="">Month</option>
                                                @for($i=1; $i <=12;$i++) <option value="{{$i}}">{{date('F',strtotime(date("Y-".$i."-d")))}}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Years*</label>
                                        <div>
                                            <select id="to_education_years" name="to_education_years" class="form-control">
                                                <option value="0" selected="">Year</option>
                                                @for($i=2023; $i >= 1975;$i--) <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Months</label>
                                        <div>
                                            <select id="to_education_months" name="to_education_months" class="form-control">
                                                <option value="" selected="">Month</option>
                                                @for($i=1; $i <=12;$i++) <option value="{{$i}}">{{date('F',strtotime(date("Y-".$i."-d")))}}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Location</label>
                                <div>
                                    <input type="text" name="education_location" value="{{old('education_location')}}" class="form-control" placeholder="">
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <h4>Certification</h4>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Name of certification</label>
                                <div>
                                    <input type="text" name="certification_name" value="{{old('certification_name')}}" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Issuing Organization</label>
                                <div>
                                    <input type="text" name="issuing_organization" value="{{old('issuing_organization')}}" class="form-control" placeholder="">
                                </div>
                            </div>
                          
                            <div class="form-group col-md-12">
                                <label>Issue Date*</label>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Years*</label>
                                        <div>
                                            <select id="from_certification_years" name="from_certification_years" class="form-control">
                                                <option value="0" selected="">Year</option>
                                                @for($i=2023; $i >= 1975;$i--) <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Months</label>
                                        <div>
                                            <select id="from_certification_months" name="from_certification_months" class="form-control">
                                                <option value="" selected="">Month</option>
                                                @for($i=1; $i <=12;$i++) <option value="{{$i}}">{{date('F',strtotime(date("Y-".$i."-d")))}}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">

                                        <label>Expire Date*</label>
                                        <label>Years*</label>
                                        <div>
                                            <select id="to_certification_years" name="to_certification_years" class="form-control">
                                                <option value="0" selected="">Year</option>
                                                @for($i=2023; $i >= 1975;$i--) <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Months</label>
                                        <div>
                                            <select id="to_certification_months" name="to_certification_months" class="form-control">
                                                <option value="" selected="">Month</option>
                                                @for($i=1; $i <=12;$i++) <option value="{{$i}}">{{date('F',strtotime(date("Y-".$i."-d")))}}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="form-group col-md-12">
                                <h4>							Awards and Recognition						</h4>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Title</label>
                                <div>
                                    <input type="text" name="recognition_title" value="{{old('recognition_title')}}" class="form-control" placeholder="">
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Awarded by</label>
                                <div>
                                    <input type="text" name="recognition_awarded_by" value="{{old('recognition_awarded_by')}}" class="form-control" placeholder="">
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