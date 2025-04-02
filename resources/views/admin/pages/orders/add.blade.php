@extends('admin.layout.default')

@section('doctormaster','active menu-item-open')
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
                                <label>Doctor Name</label>
                                <div><input type="text" name="name" class="form-control" value="{{old('name')}}" isrequired="required" placeholder="Enter Doctor Name"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Doctor Code</label>
                                <div><input type="text" name="doctor_code" value="{{old('doctor_code')}}" isrequired="required" class="form-control" placeholder="Enter Doctor Code"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <div><input type="text" name="email" value="{{old('email')}}" isrequired="required" class="form-control" placeholder="Enter Email Address"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Mobile Number</label>
                                <div><input type="text" name="mobile" value="{{old('mobile')}}" isrequired="required" class="form-control number" placeholder="Enter Mobile Number"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Date of Birth</label>
                                <div><input type="date" name="dob" class="form-control" value="{{old('dob')}}" max="{{date('Y-m-d',strtotime('-26 years'))}}" isrequired="required"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Gender</label>
                                <select class="form-control" name="gender" id="gender" isrequired="required">
                                    <option value="">Select Gender</option>
                                    <option value="male" {{runTimeSelection('male',old('gender'))}}>Male</option>
                                    <option value="female" {{runTimeSelection('female',old('gender'))}}>Female</option>
                                    <option value="other" {{runTimeSelection('other',old('gender'))}}>Other</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Department</label>
                                <select class="form-control" name="department_id" isrequired="required">
                                    <option value="">Select Department</option>
                                    @if($departments)
                                    @foreach($departments as $department)
                                    <option value="{{$department->id}}" {{runTimeSelection($department->id,old('department_id'))}}>{{$department->department_name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Qualification</label>
                                <div><input type="text" name="qualification" value="{{old('qualification')}}" isrequired="required" class="form-control" placeholder="Enter Qualification"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Area of Interest</label>
                                <div><input type="text" name="area_of_interest" value="{{old('area_of_interest')}}" isrequired="required" class="form-control" placeholder="Enter Area of Interest"></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Expertise</label>
                                <textarea class="form-control" name="expertise" value="{{old('expertise')}}" isrequired="required" id="" cols="30" rows="10" placeholder="Enter Doctor Expertise">{{old('expertise')}}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Details</label>
                                <textarea class="form-control" name="details" id="" cols="30" rows="10" placeholder="Enter Doctor Details">{{old('details')}}</textarea>
                            </div>
                            <div class="form-group col-md-9">
                                <label>Honors and Awards</label> <br>
                                <input type="text" name="awards[]" class="form-control" placeholder="Enter Honors and Awards">
                            </div>
                            <div class="form-group col-md-2 margin-top-25">
                                <div class="btn btn-primary" id="addRow">+</div>
                            </div>
                            <div class="form-group col-md-12" id="newRow"></div>
                            <div class="form-group col-md-6">
                                <label>Main Video</label>
                                <div><input type="file" name="main_video" class="form-control"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Left videos</label>
                                <div><input type="file" name="left_video[]" multiple class="form-control"></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Profile Image</label>
                                <div><input type="file" name="profile_image" class="form-control"></div>
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
<style>
    .margin-top-25 {
        margin-top: 25px;
    }
</style>
@endsection

{{-- Scripts Section --}}
@section('scripts')
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $("#addRow").click(function() {
        var html = '';
        html += '<div class="inputFormRow row"><div class="form-group col-md-9"><input class="form-control" id="" placeholder="Enter Honors and Awards" name="awards[]" value="" ></div><div class="form-group col-md-2"><a href="javascript:void(0);" class="remove_button"><div class="btn btn-danger">-</div></a></div></div>';
        $('#newRow').append(html);
    });
    $(document).on('click', '.remove_button', function() {
        $(this).parent('div').parent('div').remove();
    });
</script>
@endsection