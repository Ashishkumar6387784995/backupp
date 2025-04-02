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
                                <div>
                                    <input type="text" name="name" class="form-control" value="{{$details->name}}" isrequired="required" placeholder="Enter Doctor Name">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Doctor Code</label>
                                <div><input type="text" name="doctor_code" value="{{$details->doctor_code}}" isrequired="required" class="form-control" placeholder="Enter Doctor Code"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <div><input type="text" name="email" value="{{$details->email}}" class="form-control" placeholder="Enter Email Address"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Mobile Number</label>
                                <div><input type="text" name="mobile" value="{{$details->mobile}}" class="form-control number" placeholder="Enter Mobile Number"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Date of Birth</label>
                                <div><input type="date" name="dob" class="form-control" value="{{$details->dob}}" max="{{date('Y-m-d',strtotime('-26 years'))}}"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Gender</label>
                                <select class="form-control" name="gender" id="gender" isrequired="required">
                                    <option value="">Select Gender</option>
                                    <option value="male" {{runTimeSelection('male',$details->gender)}}>Male</option>
                                    <option value="female" {{runTimeSelection('female',$details->gender)}}>Female</option>
                                    <option value="other" {{runTimeSelection('other',$details->gender)}}>Other</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Department</label>
                                <select class="form-control" name="department_id" isrequired="required">
                                    <option value="">Select Department</option>
                                    @if($departments)
                                    @foreach($departments as $department)
                                    <option value="{{$department->id}}" {{runTimeSelection($department->id,$details->department_id)}}>{{$department->department_name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>City</label>
                                <?php $getAllCities = getAllCities(); ?>
                                <select class="form-control" name="city_id">
                                    <option value="">Select City</option>
                                    @if($getAllCities)
                                    @foreach($getAllCities as $city)
                                    <option value="{{$city->id}}" {{runTimeSelection($city->id,$details->city_id)}}>{{$city->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Designation</label>
                                <div>
                                    <input type="text" name="designation" value="{{$details->designation}}" isrequired="required" class="form-control" placeholder="Enter Designation">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Qualification</label>
                                <div><input type="text" name="qualification" value="{{$details->qualification}}" isrequired="required" class="form-control" placeholder="Enter Qualification"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Area of Interest</label>
                                <div><input type="text" name="area_of_interest" value="{{$details->area_of_interest}}" class="form-control" placeholder="Enter Area of Interest"></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Expertise</label>
                                <textarea class="form-control" name="expertise" value="{{$details->expertise}}" id="" cols="30" rows="10" placeholder="Enter Doctor Expertise">{{$details->expertise}}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Details</label>
                                <textarea id="editor1" class="form-control" name="details" id="" cols="30" rows="10" placeholder="Enter Doctor Details">{{$details->details}}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Research Publication</label>
                                <textarea id="editor2" class="form-control" name="research_publication" id="" cols="30" rows="10" placeholder="Enter Research Publication Details">{{$details->research_publication}}</textarea>
                            </div>
                            <div class="form-group col-md-12 mb-0">
                                <label>Honors and Awards</label> <br>
                                @php
                                if (isset($details->awards) && !empty($details->awards)>0) {
                                $addAwards = json_decode($details->awards,true);
                                }else{
                                $addAwards = [];
                                }
                                @endphp
                                @if(count($addAwards)> 0)
                                @foreach($addAwards as $aKey => $aList)
                                <div class="row form-group col-md-12 pb-0 mb-5">
                                    <div class="form-group col-md-9 pb-0 mb-0 pr-0">
                                        <input type="text" name="awards[]" value="{{$aList['title']}}" class="form-control" placeholder="Enter Honors and Awards">
                                    </div>
                                    <div class="form-group col-md-2 pb-0 mb-0">
                                        <a href="javascript:void(0);" class="remove_button" style="    margin-left: 18px;">
                                            <div class="btn btn-danger">-</div>
                                        </a>
                                    </div>
                                </div>
                                @endforeach

                                <div class="form-group col-md-12 mb-0" id="newRow"></div>
                                <div class="form-group col-md-10 text-right pr-15">
                                    <div class="btn btn-primary" id="addRow">+</div>
                                </div>
                                @else
                                <div class="row form-group col-md-12 mb-0">

                                    <div class="form-group col-md-9 mb-5 pr-0">
                                        <input type="text" name="awards[]" class="form-control" placeholder="Enter Honors and Awards">
                                    </div>
                                    <div class="form-group col-md-2  mb-0   text-left   pl-8">
                                        <div class="btn btn-primary" id="addRow">+</div>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 mb-0" id="newRow"></div>

                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label>Main Video Youtube Link <small>(Embed url)</small></label>
                                <div>
                                    <input type="text" name="main_video_youtube_link" class="form-control" value="{{$details->main_video_youtube_link}}">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Main Video</label>
                                <div>
                                    <input type="file" name="main_video" class="form-control image_file _update_img_file" style="{{$details->main_video ? 'display:none' : ''}}">
                                </div>
                                @if($details->main_video)
                                <div class="_update_img_action">
                                    <a target="_black" href="{{asset('uploads/doctors/videos/'.$details->main_video)}}" class="btn btn-success btn-sm">View</a> &nbsp;
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="updateImage(this)">Update</a>

                                </div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label>Left Pan Videos</label>
                                <div>
                                    <input type="file" name="left_video[]" multiple class="form-control" onchange="fileValidation(this)">
                                </div>
                                @if(!empty($details->other_videos) && $videos = json_decode($details->other_videos,true))
                                @foreach($videos as $key => $video)
                                <div class="_update_img_action">
                                    <br>
                                    <a target="_black" href="{{asset('uploads/doctors/videos/'.$video['video'])}}" class="btn btn-success btn-sm">View</a> &nbsp;
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deleteImage(this)">Delete</a>
                                </div>
                                @endforeach
                                @endif
                            </div>
                            <div class="form-group col-md-12">
                                <label>Profile Image <small>(Width:390px, Height: 460px)</small></label>

                                @if($details->profile_image)
                                <div class="_update_img_action">
                                    <a target="_black" href="{{asset('uploads/doctors/profiles/'.$details->profile_image)}}" class="btn btn-success btn-sm">View</a> &nbsp;
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="updateImage(this)">Update</a>
                                    <br>
                                    <div class="_icon_display">
                                        <img src="{{asset('uploads/doctors/profiles/'.$details->profile_image)}}" />
                                    </div>
                                </div>
                                @endif
                                <div>
                                    <input type="file" name="profile_image" class="form-control image_file _update_img_file" style="{{$details->profile_image ? 'display:none' : ''}}">
                                </div>
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
<style>
    .margin-top-25 {
        margin-top: 25px;
    }
</style>
@endsection

{{-- Scripts Section --}}
@section('scripts')

<script src="https://ckeditor.com/docs/vendors/4.11.3/ckeditor/ckeditor.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        CKEDITOR.replace('editor1');
    });
    $(function() {
        CKEDITOR.replace('editor2');
    });
</script>
<!-- <script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
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