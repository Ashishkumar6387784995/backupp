@extends('company.layout.default')

@section('jobsmaster','active menu-item-open')
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
                                <label>Job Title</label>
                                <div><input type="text" name="job_title" value="{{old('job_title')}}" class="form-control" placeholder="Enter Job Title" isrequired="required"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Experience</label>
                                <div><input type="text" name="experience" value="{{old('experience')}}" class="form-control" placeholder="Enter Experience" isrequired="required"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Location</label>
                                <div><input type="text" name="location" value="{{old('location')}}" class="form-control" placeholder="Enter Location" isrequired="required"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Contact No.</label>
                                <div><input type="text" name="contact_no" value="{{old('contact_no')}}" maxlength="10" minlength="10" class="number form-control" placeholder="Enter contact no"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Job Role</label>
                                <div><input type="text" name="role" value="{{old('role')}}" class="form-control" placeholder="Enter Job Role" isrequired="required"></div>
                            </div>


                            <div class="form-group col-md-6">
                                <label>Minimum Salary</label>
                                <div><input type="text" name="minimum_salary" value="{{old('minimum_salary')}}" class="number form-control" placeholder="Enter Minimum Salary"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Maximum Salary</label>
                                <div><input type="text" name="maximum_salary" value="{{old('maximum_salary')}}" class="number form-control" placeholder="Enter Maximum Salary"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Job Type</label>
                                <div>
                                    <select class="form-control" name="job_type" isrequired="required">
                                        <option value="">--Job Type--</option>
                                        <option value="1">Full Time</option>
                                        <option value="2">Part Time</option>
                                        <option value="3">Work From Home</option>
                                        <option value="4">Freelance/Project</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Gender</label>
                                <div>
                                    <select class="form-control" name="gender" isrequired="required">
                                        <option value="">--Gender--</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                        <option value="3">Male or Female</option>
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
                                <label>No. of Positions</label>
                                <div><input type="text" name="no_positions" value="{{old('no_positions')}}" class="form-control" placeholder="Enter No. of Positions" isrequired="required"></div>
                            </div>
                         
                            <div class="form-group col-md-6">
                                <label>Qualification</label>
                                <div><input type="text" name="qualification" value="{{old('qualification')}}" class="form-control" placeholder="Enter Qualification" isrequired="required"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Application End</label>
                                <div>
                                    <input type="date" name="expiry_date" value="{{old('expiry_date')}}" class="form-control" placeholder="Enter Application End" isrequired="required" min="{{date('Y-m-d')}}">
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Level</label>
                                <div>
                                    <select class="form-control" name="level" isrequired="required">
                                        <option value="">--Level--</option>
                                        <option value="1">Entry-level</option>
                                        <option value="2">Intermediate or experienced (senior)</option>
                                        <option value="3">First-level management</option>
                                        <option value="4"> Middle management</option>
                                        <option value="5">Executive or senior management</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Skills Tags</label>
                                <div><input type="text" name="skills_tags" value="{{old('skills_tags')}}" class="form-control" placeholder="Eg. CSS3, HTML5, Javascript, Bootstrap, Jquery" isrequired="required"></div>
                            </div>

                            <div class="form-group col-md-12">
                                <label>Job Description</label>
                                <textarea class="form-control textEditor" name="jd" id="textEditor3" cols="30" rows="10" placeholder="Enter Job Description" isrequired="required">{{old('jd')}}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Job Responsibilities</label>
                                <textarea class="form-control" name="responsibilities" id="textEditor1" cols="30" rows="10" placeholder="Enter Job Responsibilities" isrequired="required">{{old('responsibilities')}}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Skills</label>
                                <textarea class="form-control " name="skills" id="textEditor2" cols="30" rows="10" placeholder="Enter Job Skills" isrequired="required">{{old('skills')}}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Job Requirements</label>
                                <textarea class="form-control textEditor" name="requirements" id="textEditor4" cols="30" rows="10" placeholder="Enter Job Requirements" isrequired="required">{{old('jd')}}</textarea>
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
<script src="https://ckeditor.com/docs/vendors/4.11.3/ckeditor/ckeditor.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        CKEDITOR.replace('textEditor1');
        CKEDITOR.replace('textEditor2');
        CKEDITOR.replace('textEditor3');
        CKEDITOR.replace('textEditor4');
    });
</script>
@endsection