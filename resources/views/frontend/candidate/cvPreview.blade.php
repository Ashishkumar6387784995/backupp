@extends('frontend.layout')


@section('c_cvpreview','active menu-item-open')
@section('content')



<main class="main-content">
    <div class="page-header-area sec-overlay sec-overlay-black" data-bg-img="{{url('/')}}/public/frontend/assets/img/photos/bg2.webp">

    </div>
    <section class="job-details-area">
        <div class="container-fluid">
            <div class="row">
                @include('frontend.candidate.cvthemes')
                <div class="col-md-8 c-mob-preview">
                    <div class="tab-content">
                        <h4 class="heading-caption">Resume Preview</h4>
                        <div class="my_job_list row">
                            @if($template)
                            @include($template ? $template->path : '')
                            @else
                            <div class="text-center"><i>Choose template from your left.</i></div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-3 tab-content no-print c-mob-tab-s">
                    <div class="hide-desk c-action-d d-flex">
                        <div class="w-50">
                            <a href="javascript:void(0)" title="Choose template" id="openTemplates">
                                <svg width="40px" height="40px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="#494c4e" d="M28 21.155c-.02-.07-.05-.14-.09-.2.03.04.05.09.07.13.01.02.02.05.02.07zM27.82 20.835c-.02-.03-.05-.06-.08-.09.01.01.02.01.03.02.02.02.04.04.05.07z" />
                                    <path fill="#494c4e" d="M28 21.155c-.02-.07-.05-.14-.09-.2.03.04.05.09.07.13.01.02.02.05.02.07zM27.77 20.765c.02.02.04.04.05.07-.02-.03-.05-.06-.08-.09.01.01.02.01.03.02zM6.5 15H5c-.55 0-1 .45-1 1s.45 1 1 1h2.81c1.18 1.23 2.85 2 4.69 2 1.44 0 2.76-.46 3.832-1.25l.91.91c-.17.67 0 1.4.52 1.93l2.83 2.83c.78.77 2.05.77 2.83 0 .77-.78.77-2.05 0-2.83l-2.83-2.83c-.39-.39-.9-.59-1.42-.58-.17-.01-.34.02-.51.06l-.91-.91c.79-1.07 1.25-2.39 1.25-3.83 0-3.59-2.91-6.5-6.5-6.5-1.28 0-2.47.37-3.47 1H5c-.55 0-1 .45-1 1s.45 1 1 1h2.02c-.39.6-.68 1.28-.84 2H5c-.55 0-1 .45-1 1s.45 1 1 1h1.02c-.01-.17.22 1.38.48 2zm1.76-1h4.742c1.1 0 2-.9 2-2s-.9-2-2-2h-4.24c.81-1.21 2.19-2 3.74-2 2.48 0 4.5 2.02 4.5 4.502s-2.02 4.5-4.5 4.5c-1.95 0-3.62-1.25-4.24-3z" />
                                    <path fill="#494c4e" d="M18 3v1c-.01.54-.46.98-1 .98s-.99-.44-1-.98V3c0-.54-.46-1-1-1H3c-.54 0-1 .46-1 1v18c0 .54.46 1 1 1h11c.55 0 1 .45 1 1s-.45 1-1 1H3c-1.65 0-3-1.35-3-3V3c0-1.65 1.35-3 3-3h12c1.65 0 3 1.35 3 3z" />
                                </svg>
                            </a>
                        </div>
                        <div class="w-50 text-right">
                            <a href="javascript:void(0)" title="Download resume">
                                <svg width="40px" height="40px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">

                                    <title />

                                    <g id="Complete">

                                        <g id="download">

                                            <g>

                                                <path d="M3,12.3v7a2,2,0,0,0,2,2H19a2,2,0,0,0,2-2v-7" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />

                                                <g>

                                                    <polyline data-name="Right" fill="none" id="Right-2" points="7.9 12.3 12 16.3 16.1 12.3" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />

                                                    <line fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="12" x2="12" y1="2.7" y2="14.2" />

                                                </g>

                                            </g>

                                        </g>

                                    </g>

                                </svg>
                            </a> &nbsp;
                            <a href="javascript:void(0)" title="Clear data">
                                <svg fill="#000000" width="40px" height="40px" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg">
                                    <g fill-rule="evenodd">
                                        <path d="M1235.141 1619.922h-190.317l-179.997-179.998 635.15-635.149 275.155 275.155-539.99 539.992Zm667.31-582.472-359.995-359.994c-23.52-23.399-61.44-23.399-84.839 0l-719.989 719.99c-23.519 23.52-23.519 61.438 0 84.957l137.518 137.52H0v119.997h1259.98c15.96 0 31.2-6.36 42.48-17.52l599.99-599.99c23.4-23.52 23.4-61.44 0-84.96Z" />
                                        <path d="M120.034 180.004v119.999h494.993L243.392 1360.066l113.158 39.72L742.105 300.003h457.912V180.004z" />
                                    </g>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div>
                        <h3 class="heading-caption"> Let's start with your header</h3>
                        <h6 class="pt-3"> Include your full name and at least one way for employers to contact you.</h6>
                    </div>
                    <div class="cv-controls">
                        <div class="row">
                            <div class="col-md-6">
                                <label>First Name</label>
                                <div class=""><input type="text" name="firstname" class="form-control inputDataFeed" data-id="cv-c-name" placeholder="First Name" /></div>
                            </div>
                            <div class="col-md-6">
                                <label>Last Name</label>
                                <div class=""><input type="text" name="lastname" class="form-control inputDataFeed" data-id="cv-c-lastname" placeholder="Last Name" /></div>
                            </div>
                            <div class="col-md-6">
                                <label>Email</label>
                                <div class=""><input type="text" name="email" class="form-control inputDataFeed" data-id="cv-email" placeholder="Email" /></div>
                            </div>
                            <div class="col-md-6">
                                <label>Phone</label>
                                <div class=""><input type="text" name="phone" class="form-control inputDataFeed" data-id="cv-phone" placeholder="Phone" /></div>
                            </div>
                            <div class="col-md-6">
                                <label>City</label>
                                <div class=""><input type="text" name="city" class="form-control inputDataFeed" data-id="cv-address-city" placeholder="City" /></div>
                            </div>
                            <div class="col-md-6">
                                <label>State</label>
                                <div class=""><input type="text" name="state" class="form-control inputDataFeed" data-id="cv-address-state" placeholder="State" /></div>
                            </div>
                            <div class="col-md-6">
                                <label>Pincode</label>
                                <div class=""><input type="text" name="pincode" class="form-control inputDataFeed" data-id="cv-address-pincode" placeholder="Pincode" /></div>
                            </div>
                            <div class="col-md-6">
                                <label>Photo</label>
                                <div class="">
                                    <input type="file" name="logo" id="" class="form-control" value="" onchange="readURL(this);">
                                    <img src="" id="logo" width="200px">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>



                            <div class="col-md-12">
                                <div>
                                    <h3>Summary</h3>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="float-right">
                                    <a href="javascript:void(0)" class="btn btn-info btn-xs" data-bs-toggle="modal" data-bs-target="#mySummary" onclick="checkOnLocalStore('cvSummary')">+ Add</a>
                                </div>
                                <div class="cv-Summary-list">
                                    <i>No recored added</i>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>

                            <div class="col-md-12">
                                <div>
                                    <h3>Add your experience</h3>
                                    <h6>Start with your most recent job first. You can also add voluntary work,internships or extracurricular activities.</h6>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="float-right">
                                    <a href="javascript:void(0)" class="btn btn-info btn-xs" data-bs-toggle="modal" data-bs-target="#myexperience" onclick="checkOnLocalStore('myexperience')">+ Add</a>
                                </div>
                                <div class="cv-experience-list">
                                    <i>No recored added</i>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>



                            <div class="col-md-12">
                                <div>
                                    <h3>Add your education</h3>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="float-right">
                                    <a href="javascript:void(0)" class="btn btn-info btn-xs" data-bs-toggle="modal" data-bs-target="#myeducation" onclick="checkOnLocalStore('myeducation')">+ Add</a>
                                </div>
                                <div class="cv-education-list">
                                    <i>No recored added</i>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>




                            <div class="col-md-12">
                                <div>
                                    <h3>Add your Certification</h3>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="float-right">
                                    <a href="javascript:void(0)" class="btn btn-info btn-xs" data-bs-toggle="modal" data-bs-target="#myCertification" onclick="checkOnLocalStore('cvCertification')">+ Add</a>
                                </div>
                                <div class="cv-Certification-list">
                                    <i>No recored added</i>
                                </div>
                            </div>




                            <div class="col-md-12">
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <h3>Add your Awards</h3>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="float-right">
                                    <a href="javascript:void(0)" class="btn btn-info btn-xs" data-bs-toggle="modal" data-bs-target="#myAwards" onclick="checkOnLocalStore('cvAwards')">+ Add</a>
                                </div>
                                <div class="cv-Awards-list">
                                    <i>No recored added</i>
                                </div>
                            </div>





                            <div class="col-md-12">
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <h3>Add your Skills</h3>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="float-right">
                                    <a href="javascript:void(0)" class="btn btn-info btn-xs" data-bs-toggle="modal" data-bs-target="#myskills" onclick="checkOnLocalStore('cv-skills')">+ Add</a>
                                </div>
                                <div class="cv-skills-list">
                                    <i>No recored added</i>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="text-center mt-2 no-print">
                                    <button class="btn btn-primary btn-xs" id="jsPrintAll" onclick="putDataOnModel() "><i class="fa fa-print" aria-hidden="true"></i> Download Resume</button>
                                    <button class="btn btn-danger btn-xs" id="clearAll" onclick="clearFormData() "><i class="fa fa-reload" aria-hidden="true"></i> Clear All</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
</main>


<!-- The Modal -->
<div class="modal" id="mySummary">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Summary</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <table class="table t-Summary-list">
                    <tr class="t-Summary-row t-Summary-0">
                        <td>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Summary:</label>
                                    <textarea type="text" name="_summary" class="form-control editor_summary" /></textarea>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <a href="javascript:void(0)" class="btn btn-success" onclick="saveData('','','','','','mySummary')">Save</a>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<!-- The Modal -->
<div class="modal" id="myexperience">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add your experience</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <table class="table t-experience-list">
                    <tr class="t-experience-row t-experience-0">
                        <td>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Designation :</label>
                                    <input type="text" name="_designation[]" class="form-control" />
                                </div>
                                <div class="col-md-3">

                                    <label>Company :</label>
                                    <input type="text" name="_company[]" class="form-control" />
                                </div>
                                <div class="col-md-3">
                                    <label>Joining Year :</label>
                                    <div>
                                        <select class="form-control d-inline w-50" name="_join_year[]">
                                            <option value="">--Year--</option>
                                            @for($i=2023; $i >= 1975;$i--) <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                        <select class="form-control d-inline w-45" name="_join_month[]">
                                            <option value="">--Month--</option>
                                            @for($i=1; $i <=12;$i++) <option value="{{date('F',strtotime(date("Y-".$i."-d")))}}">{{date('F',strtotime(date("Y-".$i."-d")))}}</option>
                                                @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">

                                    <label>Ending Year :</label>
                                    <div>
                                        <select class="form-control d-inline w-50" name="_end_year[]">
                                            <option value="">--Year--</option>
                                            @for($i=2023; $i >= 1975;$i--) <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                        <select class="form-control d-inline w-45" name="_end_month[]">
                                            <option value="">--Month--</option>
                                            @for($i=1; $i <=12;$i++) <option value="{{date('F',strtotime(date("Y-".$i."-d")))}}">{{date('F',strtotime(date("Y-".$i."-d")))}}</option>
                                                @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label>Address :</label>
                                    <input type="text" name="_location[]" class="form-control" />
                                </div>
                                <div class="col-md-12">
                                    <label>Job Description :</label>
                                    <textarea type="text" name="_description[]" class="form-control editor1" /></textarea>
                                </div>
                            </div>
                        </td>
                        <td>
                            <label>&nbsp;</label>
                            <div class="c-del" title="Delete" onclick="delIt()"><i class="icofont-trash"></i></div>
                        </td>
                    </tr>
                </table>
                <div class="float-right"><a href="javascript:void(0)" onclick="cloneElement('myexperience')">+ Add More</a></div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <a href="javascript:void(0)" class="btn btn-success" onclick="saveData('','','','','','myexperience')">Save</a>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<!-- The Modal -->
<div class="modal" id="myeducation">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add your education</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <table class="table t-education-list">
                    <tr class="t-education-row t-education-0">
                        <td>
                            <label>Stream Name :</label>
                            <input type="text" name="_stream_name[]" class="form-control" />
                        </td>
                        <td>
                            <label>College Name :</label>
                            <input type="text" name="_college[]" class="form-control" />
                        </td>
                        <td>
                            <label>Passing Year :</label>
                            <div>
                                <select class="form-control d-inline" name="_year[]">
                                    <option value="">--Year--</option>
                                    @for($i=2023; $i >= 1975;$i--) <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </td>
                        <td>
                            <label>Location/Address :</label>
                            <input type="text" name="_location[]" class="form-control" />
                        </td>
                        <td>
                            <label>&nbsp;</label>
                            <div class="c-del" title="Delete" onclick="delIt()"><i class="icofont-trash"></i></div>
                        </td>
                    </tr>
                </table>
                <div class="float-right"><a href="javascript:void(0)" onclick="cloneElement('myeducation')">+ Add More</a></div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <a href="javascript:void(0)" class="btn btn-success" onclick="saveData('','','','','','myeducation')">Save</a>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<!-- The Modal -->
<div class="modal" id="myCertification">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add your Certification</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <table class="table t-certification-list">
                    <tr class="t-certification-row t-certification-0">
                        <td>
                            <label>Certification Name :</label>
                            <input type="text" name="_certification_name[]" class="form-control" />
                        </td>
                        <td>
                            <label>Issuing Organization :</label>
                            <input type="text" name="_issuing_organization[]" class="form-control" />
                        </td>
                        <td>
                            <label>From :</label>
                            <div>
                                <select class="form-control d-inline w-50" name="_from_year[]">
                                    <option value="">--Year--</option>
                                    @for($i=2023; $i >= 1975;$i--) <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                                <select class="form-control d-inline w-45" name="_from_month[]">
                                    <option value="">--Month--</option>
                                    @for($i=1; $i <=12;$i++) <option value="{{date('F',strtotime(date("Y-".$i."-d")))}}">{{date('F',strtotime(date("Y-".$i."-d")))}}</option>
                                        @endfor
                                </select>
                            </div>
                        </td>
                        <td>
                            <label>To :</label>
                            <div>
                                <select class="form-control d-inline w-50" name="_to_year[]">
                                    <option value="">--Year--</option>
                                    @for($i=2023; $i >= 1975;$i--) <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                                <select class="form-control d-inline w-45" name="_to_month[]">
                                    <option value="">--Month--</option>
                                    @for($i=1; $i <=12;$i++) <option value="{{date('F',strtotime(date("Y-".$i."-d")))}}">{{date('F',strtotime(date("Y-".$i."-d")))}}</option>
                                        @endfor
                                </select>
                            </div>
                        </td>
                        <td>
                            <label>&nbsp;</label>
                            <div class="c-del" title="Delete" onclick="delIt()"><i class="icofont-trash"></i></div>
                        </td>
                    </tr>
                </table>
                <div class="float-right"><a href="javascript:void(0)" onclick="cloneElement('myCertification')">+ Add More</a></div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <a href="javascript:void(0)" class="btn btn-success" onclick="saveData('','','','','','myCertification')">Save</a>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<!-- The Modal -->
<div class="modal" id="myAwards">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add your Awards & Recognitions</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <table class="table t-award-list">
                    <tr class="t-award-row t-award-0">
                        <td>
                            <label>Certification Name :</label>
                            <input type="text" name="_certification_name[]" class="form-control" />
                        </td>
                        <td>
                            <label>Issuing Organization :</label>
                            <input type="text" name="_issuing_organization[]" class="form-control" />
                        </td>
                        <td>
                            <label>&nbsp;</label>
                            <div class="c-del" title="Delete" onclick="delIt()"><i class="icofont-trash"></i></div>
                        </td>
                    </tr>
                </table>
                <div class="float-right"><a href="javascript:void(0)" onclick="cloneElement('myAwards')">+ Add More</a></div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <a href="javascript:void(0)" class="btn btn-success" onclick="saveData('','','','','','myAwards')">Save</a>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<!-- The Modal -->
<div class="modal" id="myskills">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add your skills</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div>
                    <textarea class="form-control" name="_myskills" id="textEditor1_" placeholder="PHP, Node JS, Bootstrap ..."></textarea>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <a href="javascript:void(0)" class="btn btn-success" onclick="saveData('textarea','name','_myskills','cv-skills-list','cv-skills','skills')">Save</a>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>




@endsection

{{-- Styles Section --}}
@section('styles')
<style>
    .w-45 {
        width: 45%;
    }

    .btn-xs {
        padding: 2px 5px;
        font-size: small;
    }

    input.form-control.inputDataFeed {
        font-size: 14px;
    }
</style>
<style>
    .cv-controls .h3,
    .cv-controls h3 {

        font-size: 20px;
    }

    .cv-controls .h6,
    .cv-controls h6 {
        font-size: 14px;
    }

    .error-log {
        color: #dc3545;
        margin-top: 5px;
    }

    .thumb {
        width: 100px;
    }

    .recent-job-item {
        padding: 15px;
    }

    .tab-content {
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 5px;
    }

    .left-menu {
        border: 1px solid #ddd;
        padding: 10px;
        position: relative;
        border-radius: 5px;
        cursor: pointer;
    }

    .l-menu {
        padding-bottom: 5px;
        padding-top: 5px;
    }

    .r-arrow {
        position: absolute;
        right: 10px;
        font-size: 20px;
        margin-top: 3px;
    }

    .cl-border {
        border: 1px solid #0367a8;
        width: max-content;
        border-radius: 5px;
        padding: 0px 15px;
    }

    .profile-details label {
        font-size: 14px;
    }

    .profile-details {
        width: 58%;
        position: relative;
    }

    .profile-icon {
        width: 100px;
        height: 100px;
        text-align: center;
        padding: 10px 10px;
        border: 2px solid #0367a8;
        font-size: 45px;
        border-radius: 50%;
        background: #fff;
    }

    .employers-details-wrap {
        padding: 25px;
        margin-bottom: 0;
    }

    .job-details-area .container {
        padding-bottom: 0;
    }

    .edit-profile:hover {
        border: 1px solid #0367a8;
        color: #0367a8;
    }

    .edit-profile {
        position: absolute;
        cursor: pointer;
        width: 40px;
        right: 0;
        border: 1px solid transparent;
    }

    .control-myawards,
    cv-experience-p,
    .control-myEducation {
        line-height: 20px;
        font-size: 14px;
        border: 1px solid #ddd;
        padding: 5px;
        border-radius: 5px;
        margin-bottom: 5px;
    }

    h3.heading-caption {
        font-size: 24px;
    }


    @media only screen and (max-width: 767px) {
        .c-mob-preview {
            display: none;
        }

        .mob-view {
            position: absolute;
            top: 0;
            z-index: 9;
            background: #fff;
            width: 100%;
            height: 100%;
            padding: 15px 10px;
            margin: 0;
            display: none;
        }

        .c-close {
            position: absolute;
            right: 10px;
            top: 10px;
            font-size: 40px;
            line-height: 20px;
        }

        .l-menu {
            width: 48%;
            display: inline-block;
            margin-right: 4px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            padding-bottom: 0;
        }

        .c-action-d {
            height: 75px;
            width: 100%;
        }

        .text-right {
            text-align: right;
        }

        .container,
        .container-fluid {
            padding-bottom: 0;
            padding-top: 0;
        }

        .c-mob-tab-s {}
    }
</style>
@endsection

{{-- Scripts Section --}}
@section('scripts')
<script src="https://ckeditor.com/docs/vendors/4.11.3/ckeditor/ckeditor.js" type="text/javascript"></script>
<script type="text/javascript">
    function replaceCKEditor(id = null) {
        // if (!id) {
        //     CKEDITOR.replaceAll(id);
        //     return false;
        // }
        // CKEDITOR.replaceAll('editor1');
        CKEDITOR.replaceAll('editor_summary');
    }
    replaceCKEditor();

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                storeInSession('cvProfilePic', e.target.result)
                $('.cv-profile-pic')
                    .attr('src', e.target.result)
                    .width(200);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script>
    var cvCertification = getLocalStore('cvCertification');
    var cvskills = getLocalStore('cv-skills-list');
    var cvAwards = getLocalStore('cvAwards');
    var cvSummary = getLocalStore('cvSummary');
    var cvEducation = getLocalStore('cvEducation');
    var cvExperience = getLocalStore('cvExperience');
    var cvname = getLocalStore('cv-c-name');
    var cvlastname = getLocalStore('cv-c-lastname');
    var cvEmail = getLocalStore('cv-email');
    var cvPhone = getLocalStore('cv-phone');
    var cvCity = getLocalStore('cv-address-city');
    var cvState = getLocalStore('cv-address-state');
    var cvPincode = getLocalStore('cv-address-pincode');
    var cvProfilePic = getLocalStore('cvProfilePic');

    function clearFormData() {
        localStorage.removeItem('cvCertification');
        localStorage.removeItem('cv-skills-list');
        localStorage.removeItem('cvAwards');
        localStorage.removeItem('cvSummary');
        localStorage.removeItem('cvEducation');
        localStorage.removeItem('cvExperience');
        localStorage.removeItem('cv-c-name');
        localStorage.removeItem('cv-c-lastname');
        localStorage.removeItem('cv-email');
        localStorage.removeItem('cv-phone');
        localStorage.removeItem('cv-address-city');
        localStorage.removeItem('cv-address-state');
        localStorage.removeItem('cv-address-pincode');
        localStorage.removeItem('cvProfilePic');
        localStorage.removeItem('cvDownload');
        localStorage.removeItem('cv-skills');
    }

    function checkOnLocalStore(type) {
        if (type == 'myexperience') {
            if (cvExperience) {
                var arrData = JSON.parse(cvExperience);
                if (arrData.length > 0) {
                    var parEle = 't-experience-list';
                    $('.' + parEle + ' tbody').html('');
                    arrData.map(function(val, index) {
                        cloneElement('myexperience')
                        var maxCount = $('.t-experience-row').length;
                        var designation = val.designation.value;
                        var company = val.company.value;
                        var join_year = val.join_year.value;
                        var join_month = val.join_month.value;
                        var end_year = val.end_year.value;
                        var end_month = val.end_month.value;
                        var location = val.location.value;
                        var description = val.description.value;
                        $('.' + parEle + ' tbody .t-experience-' + maxCount).find('input[name="_designation[]"]').val(designation)
                        $('.' + parEle + ' tbody .t-experience-' + maxCount).find('input[name="_company[]"]').val(company)
                        $('.' + parEle + ' tbody .t-experience-' + maxCount).find('input[name="_location[]"]').val(location)
                        $('.' + parEle + ' tbody .t-experience-' + maxCount).find('textarea[name="_description[]"]').val(description)
                        $('.' + parEle + ' tbody .t-experience-' + maxCount).find('select[name="_join_year[]"]').val(join_year)
                        $('.' + parEle + ' tbody .t-experience-' + maxCount).find('select[name="_join_month[]"]').val(join_month)
                        $('.' + parEle + ' tbody .t-experience-' + maxCount).find('select[name="_end_year[]"]').val(end_year)
                        $('.' + parEle + ' tbody .t-experience-' + maxCount).find('select[name="_end_month[]"]').val(end_month)
                    })
                }
            }
        }
        if (type == 'myeducation') {
            if (cvEducation) {
                var arrData = JSON.parse(cvEducation);
                if (arrData.length > 0) {
                    var parEle = 't-education-list';
                    $('.' + parEle + ' tbody').html('');
                    arrData.map(function(val, index) {
                        cloneElement('myeducation')
                        var maxCount = $('.t-education-row').length;
                        var stream = val.steam.value;
                        var _college = val.college.value;
                        var _location = val.location.value;
                        var year = val.year.value;
                        $('.' + parEle + ' tbody .t-education-' + maxCount).find('input[name="_stream_name[]"]').val(stream)
                        $('.' + parEle + ' tbody .t-education-' + maxCount).find('input[name="_college[]"]').val(_college)
                        $('.' + parEle + ' tbody .t-education-' + maxCount).find('input[name="_location[]"]').val(_location)
                        $('.' + parEle + ' tbody .t-education-' + maxCount).find('select[name="_year[]"]').val(year)
                    })
                }
            }
        }
        if (cvCertification) {
            var arrData = JSON.parse(cvCertification);
            if (arrData.length > 0) {
                var parEle = 't-certification-list';
                $('.' + parEle + ' tbody').html('');
                arrData.map(function(val, index) {
                    cloneElement('myCertification')
                    var maxCount = $('.t-certification-row ').length;
                    // maxCount++;
                    console.log('.' + parEle + ' tbody .t-certification-' + maxCount);
                    var certification_name = val.certification_name.value;
                    var issuing_organization = val.issuing_organization.value;
                    var from_year = val.from_year.value;
                    var from_month = val.from_month.value;
                    var to_month = val.to_month.value;
                    var to_year = val.to_year.value;
                    $('.' + parEle + ' tbody .t-certification-' + maxCount).find('input[name="_certification_name[]"]').val(certification_name)
                    $('.' + parEle + ' tbody .t-certification-' + maxCount).find('input[name="_issuing_organization[]"]').val(issuing_organization)
                    $('.' + parEle + ' tbody .t-certification-' + maxCount).find('select[name="_from_year[]"]').val(from_year)
                    $('.' + parEle + ' tbody .t-certification-' + maxCount).find('select[name="_from_month[]"]').val(from_month)
                    $('.' + parEle + ' tbody .t-certification-' + maxCount).find('select[name="_to_month[]"]').val(to_month)
                    $('.' + parEle + ' tbody .t-certification-' + maxCount).find('select[name="_to_year[]"]').val(to_year)
                })
            }
        }

        if (type == 'cvAwards') {
            if (cvAwards) {
                var arrData = JSON.parse(cvAwards);
                if (arrData.length > 0) {
                    console.log(arrData);
                    $('.t-award-list tbody').html('');
                    arrData.map(function(val, index) {
                        cloneElement('myAwards')
                        var maxCount = $('.t-award-row').length;
                        // maxCount = maxCount-1;
                        console.log('maxCount', maxCount);
                        var certification_name = val.certification_name.value;
                        var issuing_organization = val.issuing_organization.value;
                        $('.t-award-list tbody .t-award-' + maxCount).find('input[name="_certification_name[]"]').val(certification_name)
                        $('.t-award-list tbody .t-award-' + maxCount).find('input[name="_issuing_organization[]"]').val(issuing_organization)
                    })
                }
            }
        }
        if (type == 'cvSummary') {
            if (cvSummary)
                CKEDITOR.instances['_summary'].setData(cvSummary);
        }
        if (type == 'cv-skills') {
            if (cvskills) {
                $('textarea[name=_myskills]').val(cvskills)
            }
        }
    }

    function putDataOnModel() {
        <?php if ($currentURI == 'build-a-resume' && !Auth()->guard('candidate')->user()) { ?>
            var redirectUrl = "{{url('build-a-resume/cv/download')}}";
        <?php } else { ?>
            var redirectUrl = "{{url('/account/cv/download/')}}";
        <?php } ?>
        const element = document.getElementById("print");
        window.localStorage.setItem('cvDownload', element.outerHTML)
        window.open(redirectUrl, '_blank').focus();
    }
    $('.inputDataFeed').keyup(function() {
        var string = $(this).val();
        var itemClass = $(this).attr('data-id');
        $('.' + itemClass).text(string);
        storeInSession(itemClass, string);
    });

    function saveData(elementType, elementName, element, referElement, templateElement, type) {
        $('.error-log').remove();
        if (type == 'myexperience') {
            var inputs = $('#' + type + ' input[name="_designation[]"]');
            var inputs2 = $('#' + type + ' input[name="_company[]"]');
            var join_year = $('#' + type + ' select[name="_join_year[]"]');
            var join_month = $('#' + type + ' select[name="_join_month[]"]');
            var end_year = $('#' + type + ' select[name="_end_year[]"]');
            var end_month = $('#' + type + ' select[name="_end_month[]"]');
            var location = $('#' + type + ' input[name="_location[]"]');
            var description = $('#' + type + ' textarea[name="_description[]"]');
            var data = [];
            inputs.map(function(index, val) {
                var dataValue = val.value;
                var dataName = $(val).attr('name');
                var jsonData = {
                    'designation': {
                        name: dataName,
                        value: dataValue
                    },
                    'company': {
                        name: $(inputs2[index]).attr('name'),
                        value: $(inputs2[index]).val()
                    },
                    'join_year': {
                        name: $(join_year[index]).attr('name'),
                        value: $(join_year[index]).val()
                    },
                    'join_month': {
                        name: $(join_month[index]).attr('name'),
                        value: $(join_month[index]).val()
                    },
                    'end_year': {
                        name: $(end_year[index]).attr('name'),
                        value: $(end_year[index]).val()
                    },
                    'end_month': {
                        name: $(end_month[index]).attr('name'),
                        value: $(end_month[index]).val()
                    },
                    'location': {
                        name: $(location[index]).attr('name'),
                        value: $(location[index]).val()
                    },
                    'description': {
                        name: $(description[index]).attr('name'),
                        value: $(description[index]).val()
                    }
                }
                data.push(jsonData);
            });
            if (data.length > 0) {
                displayExperience(data);
                storeInSession('cvExperience', JSON.stringify(data));
                $('#' + type).modal('hide');
            } else {

            }
        }
        if (type == 'myeducation') {
            var inputs = $('#' + type + ' input[name="_stream_name[]"]');
            var inputs2 = $('#' + type + ' input[name="_college[]"]');
            var year = $('#' + type + ' select[name="_year[]"]');
            var location = $('#' + type + ' input[name="_location[]"]');
            var data = [];
            inputs.map(function(index, val) {
                var dataValue = val.value;
                var dataName = $(val).attr('name');
                var jsonData = {
                    'steam': {
                        name: dataName,
                        value: dataValue
                    },
                    'college': {
                        name: $(inputs2[index]).attr('name'),
                        value: $(inputs2[index]).val()
                    },
                    'year': {
                        name: $(year[index]).attr('name'),
                        value: $(year[index]).val()
                    },
                    'location': {
                        name: $(location[index]).attr('name'),
                        value: $(location[index]).val()
                    }
                }
                data.push(jsonData);
            });
            if (data.length > 0) {
                displayEducation(data);
                storeInSession('cvEducation', JSON.stringify(data));
                $('#' + type).modal('hide');
            } else {

            }
        }
        if (type == 'myCertification') {
            var inputs = $('#' + type + ' input[name="_certification_name[]"]');
            var inputs2 = $('#' + type + ' input[name="_issuing_organization[]"]');
            var from_year = $('#' + type + ' select[name="_from_year[]"]');
            var from_month = $('#' + type + ' select[name="_from_month[]"]');
            var to_year = $('#' + type + ' select[name="_to_year[]"]');
            var to_month = $('#' + type + ' select[name="_to_month[]"]');
            var data = [];
            inputs.map(function(index, val) {
                var dataValue = val.value;
                var dataName = $(val).attr('name');
                var jsonData = {
                    'certification_name': {
                        name: dataName,
                        value: dataValue
                    },
                    'issuing_organization': {
                        name: $(inputs2[index]).attr('name'),
                        value: $(inputs2[index]).val()
                    },
                    'from_year': {
                        name: $(from_year[index]).attr('name'),
                        value: $(from_year[index]).val()
                    },
                    'from_month': {
                        name: $(from_month[index]).attr('name'),
                        value: $(from_month[index]).val()
                    },
                    'to_month': {
                        name: $(to_month[index]).attr('name'),
                        value: $(to_month[index]).val()
                    },
                    'to_year': {
                        name: $(to_year[index]).attr('name'),
                        value: $(to_year[index]).val()
                    }

                }
                data.push(jsonData);
            });
            if (data.length > 0) {
                displayCertification(data);
                storeInSession('cvCertification', JSON.stringify(data));
                $('#' + type).modal('hide');
            } else {

            }
        }
        if (type == 'mySummary') {
            var Summary = CKEDITOR.instances['_summary'].getData();
            var awards = [];

            if (Summary.length > 0) {
                displaySummary(Summary);
                storeInSession('cvSummary', Summary);
                $('#' + type).modal('hide');
            } else {

            }
        }
        if (type == 'myAwards') {
            var inputs = $('#' + type + ' input[name="_certification_name[]"]');
            var inputs2 = $('#' + type + ' input[name="_issuing_organization[]"]');
            var awards = [];
            inputs.map(function(index, val) {
                var dataValue = val.value;
                var dataName = $(val).attr('name');
                var jsonData = {
                    'certification_name': {
                        name: dataName,
                        value: dataValue
                    },
                    'issuing_organization': {
                        name: $(inputs2[index]).attr('name'),
                        value: $(inputs2[index]).val()
                    }

                }
                awards.push(jsonData);
            });
            if (awards.length > 0) {
                displayAwards(awards);
                storeInSession('cvAwards', JSON.stringify(awards));
                $('#' + type).modal('hide');
            } else {

            }
        }
        if (type == 'skills') {
            var valueEle = $(elementType + '[' + elementName + '=' + element + ']');
            var value = valueEle.val();
            if (value.trim()) {
                $('.' + referElement).text(value);
                var skillsArr = value.split(',');
                $('.' + templateElement + ' ul').html('');

                skillsArr.forEach(function(value, index) {
                    $('.' + templateElement + ' ul').append('<li>' + value + '</li>')
                });
                storeInSession(referElement, value);
                storeInSession(templateElement, value);
                $('#myskills').modal('hide');
            } else {
                $(valueEle).after('<div class="error-log">Please enter your skills.</div>')
            }
        }
    }

    function displaySummary(Summary) {
        var htm = '';
        var rightHtm = '';

        htm += Summary;
        rightHtm += Summary;

        $('.cv-summary-p').html(htm);
        $('.cv-Summary-list').html(rightHtm);
        $('.cv-Summary-list').html(rightHtm);
    }

    function displayExperience(json) {
        var htm = '';
        var rightHtm = '';
        json.map(function(val, index) {
            htm += `
            <div class="cv-experience-p">
                <div ><span class="cv-designation">` + val.designation.value + `</span>, <span class="cv-from">` + val.join_month.value + ` ` + val.join_year.value + `</span> - <span class="cv-toyear">` + val.end_month.value + ` ` + val.end_year.value + `</span></div>
                <div><span class="cv-company">` + val.company.value + `</span> - <span class="cv-location">` + val.location.value + `</span></div>
                <div class="cv-job-description">` + val.description.value + `</div>
            </div>
            `;
            rightHtm += `
            <div class="control-myEducation">
                <div>Designation : <span class="cv-designationName">` + val.designation.value + `</span> </div>
                <div>Company : <span class="cv-company">` + val.company.value + `</span></div>
                <div>Location : <span class="cv-location">` + val.location.value + `</span></div> 
            </div>
            `;
        });
        $('.cv-experience-p-list').html(htm);
        $('.cv-experience-list').html(rightHtm);
    }

    function displayEducation(json) {
        var htm = '';
        var rightHtm = '';
        json.map(function(val, index) {
            htm += `
            <div class="cv-education-p">
                <div><span class="cv-stream">` + val.steam.value + `</span> - <span class="cv-edu-year">` + val.year.value + `</span></div>
                <div><span class="cv-college">` + val.college.value + `</span> - <span class="cv-edu-location">` + val.location.value + `</span></div>
            </div>
            `;
            rightHtm += `
            <div class="control-myEducation">
                <div>Stream Name : <span class="cv-awardsName">` + val.steam.value + `</span> - <span class="cv-edu-year">` + val.year.value + `</span></div>
                <div>College : <span class="cv-college">` + val.college.value + `</span></div>
                <div>Location : <span class="cv-location">` + val.location.value + `</span></div> 
            </div>
            `;
        });
        $('.cv-education-p-list').html(htm);
        $('.cv-education-list').html(rightHtm);
    }

    function displayCertification(json) {
        var htm = '';
        var rightHtm = '';
        json.map(function(val, index) {
            htm += `
            <div class="cv-certifications-p">
                <div>Certification Name : <span class="cv-CertificationName">` + val.certification_name.value + `</span></div>
                <div>Issuing Organization : <span class="cv-Organization">` + val.issuing_organization.value + `</span></div>
                <div><span class="cv-cert-from">` + val.from_month.value + `-` + val.from_year.value + `</span> - <span class="cv-cert-to">` + val.to_month.value + `-` + val.to_year.value + `</span></div> 
            </div>
            `;
            rightHtm += `
            <div class="control-myawards">
                <div>Certification Name : <span class="cv-awardsName">` + val.certification_name.value + `</span></div>
                <div>Issuing Organization : <span class="cv-awardsOrganization">` + val.issuing_organization.value + `</span></div>
                <div><span class="cv-cert-from">` + val.from_month.value + `-` + val.from_year.value + `</span> - <span class="cv-cert-to">` + val.to_month.value + `-` + val.to_year.value + `</span></div> 
            </div>
            `;
        });
        $('.cv-certifications-p-list').html(htm);
        $('.cv-Certification-list').html(rightHtm);
    }

    function displayAwards(json) {
        var htm = '';
        var rightHtm = '';
        json.map(function(val, index) {
            htm += `
            <div class="cv-awards-p">
                <div>Certification Name : <span class="cv-awardsName">` + val.certification_name.value + `</span></div>
                <div>Issuing Organization : <span class="cv-awardsOrganization">` + val.issuing_organization.value + `</span></div>
            </div>
            `;
            rightHtm += `
            <div class="control-myawards">
                <div>Certification Name : <span class="cv-awardsName">` + val.certification_name.value + `</span></div>
                <div>Issuing Organization : <span class="cv-awardsOrganization">` + val.issuing_organization.value + `</span></div>
            </div>
            `;
        });
        $('.cv-awards-p-list').html(htm);
        $('.cv-Awards-list').html(rightHtm);
    }

    function cloneElement(type) {

        if (type == 'myexperience') {
            var maxCount = $('.t-experience-row').length;
            maxCount++;
            var htm = `
            <tr class="t-experience-row t-experience-` + maxCount + `">
                <td>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Designation :</label>
                            <input type="text" name="_designation[]" class="form-control" />
                        </div>
                        <div class="col-md-3">

                            <label>Company :</label>
                            <input type="text" name="_company[]" class="form-control" />
                        </div>
                        <div class="col-md-3">
                            <label>Joining Year :</label>
                            <div>
                                <select class="form-control d-inline w-50" name="_join_year[]">
                                    <option value="">--Year--</option>
                                    @for($i=2023; $i >= 1975;$i--) <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                                <select class="form-control d-inline w-45" name="_join_month[]">
                                    <option value="">--Month--</option>
                                    @for($i=1; $i <=12;$i++) <option value="{{date('F',strtotime(date("Y-".$i."-d")))}}">{{date('F',strtotime(date("Y-".$i."-d")))}}</option>
                                        @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">

                            <label>Ending Year :</label>
                            <div>
                                <select class="form-control d-inline w-50" name="_end_year[]">
                                    <option value="">--Year--</option>
                                    @for($i=2023; $i >= 1975;$i--) <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                                <select class="form-control d-inline w-45" name="_end_month[]">
                                    <option value="">--Month--</option>
                                    @for($i=1; $i <=12;$i++) <option value="{{date('F',strtotime(date("Y-".$i."-d")))}}">{{date('F',strtotime(date("Y-".$i."-d")))}}</option>
                                        @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12"> 
                            <label>Address :</label>
                            <input type="text" name="_location[]" class="form-control" />
                        </div>
                        <div class="col-md-12"> 
                            <label>Job Description :</label>
                            <textarea type="text" name="_description[]" class="form-control" /></textarea>
                        </div>
                    </div>
                </td>
                <td>
                    <label>&nbsp;</label>
                    <div class="c-del" title="Delete" onclick="delIt('t-experience-` + maxCount + `')"><i class="icofont-trash"></i></div>
                </td>
            </tr>
            `;
            $('.t-experience-list tbody').append(htm);
            // var editor = CKEDITOR.instances['_description[]'];
            // // if (editor) 
            // {
            // // editor.destroy(true); 
            // // replaceCKEditor('t-experience-' + maxCount);
            // }
        }
        if (type == 'myeducation') {
            var maxCount = $('.t-education-row').length;
            maxCount++;
            var htm = `
            <tr class="t-education-row t-education-` + maxCount + `">
                <td>
                    <label>Stream Name :</label>
                    <input type="text" name="_stream_name[]" class="form-control" />
                </td>
                <td>
                    <label>College Name :</label>
                    <input type="text" name="_college[]" class="form-control" />
                </td>
                <td>
                    <label>Passing Year :</label>
                    <div>
                        <select class="form-control d-inline" name="_year[]">
                            <option value="">--Year--</option>
                            @for($i=2023; $i >= 1975;$i--) <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </td>
                <td>
                    <label>Location/Address :</label>
                    <input type="text" name="_location[]" class="form-control" />
                </td>
                <td>
                    <label>&nbsp;</label>
                    <div class="c-del" title="Delete" onclick="delIt('t-education-` + maxCount + `')"><i class="icofont-trash"></i></div>
                </td>
            </tr>
            `;
            $('.t-education-list tbody').append(htm);
        }
        if (type == 'myCertification') {
            var maxCount = $('.t-certification-row').length;
            console.log('maxCount', maxCount)
            maxCount++;
            var htm = `
            <tr class="t-certification-row t-certification-` + maxCount + `">
                <td>
                    <label>Certification Name :</label>
                    <input type="text" name="_certification_name[]" class="form-control" />
                </td>
                <td>
                    <label>Issuing Organization :</label>
                    <input type="text" name="_issuing_organization[]" class="form-control" />
                </td> 
                <td>
                    <label>From :</label>
                    <div>
                        <select class="form-control d-inline w-50" name="_from_year[]">
                            <option value="">--Year--</option>
                            @for($i=2023; $i >= 1975;$i--) <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                        <select class="form-control d-inline w-45" name="_from_month[]">
                            <option value="">--Month--</option>
                            @for($i=1; $i <=12;$i++) <option value="{{$i}}">{{date('F',strtotime(date("Y-".$i."-d")))}}</option>
                                @endfor
                        </select>
                    </div>
                </td>
                <td>
                    <label>To :</label>
                    <div>
                        <select class="form-control d-inline w-50" name="_to_year[]">
                            <option value="">--Year--</option>
                            @for($i=2023; $i >= 1975;$i--) <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                        <select class="form-control d-inline w-45" name="_to_month[]">
                            <option value="">--Month--</option>
                            @for($i=1; $i <=12;$i++) <option value="{{$i}}">{{date('F',strtotime(date("Y-".$i."-d")))}}</option>
                                @endfor
                        </select>
                    </div>
                </td>
                <td>
                    <label>&nbsp;</label>
                    <div class="c-del" title="Delete" onclick="delIt('t-certification-` + maxCount + `')"><i class="icofont-trash"></i></div>
                </td>
            </tr>
            `;
            $('.t-certification-list tbody').append(htm);
        }
        if (type == 'myAwards') {
            var maxCount = $('.t-award-row').length;
            maxCount++;
            var htm = `
            <tr class="t-award-row t-award-` + maxCount + `">
                <td>
                    <label>Certification Name :</label>
                    <input type="text" name="_certification_name[]" class="form-control" />
                </td>
                <td>
                    <label>Issuing Organization :</label>
                    <input type="text" name="_issuing_organization[]" class="form-control" />
                </td>
                <td>
                    <label>&nbsp;</label>
                    <div class="c-del" title="Delete" onclick="delIt('t-award-` + maxCount + `')"><i class="icofont-trash"></i></div>
                </td>
            </tr>
            `;
            $('.t-award-list tbody').append(htm);
        }
    }

    function delIt(id) {
        $('.' + id).remove();
    }

    function storeInSession(key, value) {
        window.localStorage.setItem(key, value);
    }

    function getLocalStore(itemName) {
        return window.localStorage.getItem(itemName);
    }

    function showStoredData() {

        if (cvProfilePic) {
            $('.cv-profile-pic').attr('src', cvProfilePic);
        }
        if (cvExperience) {
            displayExperience(JSON.parse(cvExperience));
        }
        if (cvEducation) {
            displayEducation(JSON.parse(cvEducation));
        }
        if (cvAwards) {
            displayAwards(JSON.parse(cvAwards));
        }
        if (cvskills) {
            var value = (cvskills);
            $('.cv-skills-list').text(value);
            var skillsArr = value.split(',');
            $('.cv-skills ul').html('');

            skillsArr.forEach(function(value, index) {
                $('.cv-skills' + ' ul').append('<li>' + value + '</li>')
            });
        }
        if (cvCertification) {
            displayCertification(JSON.parse(cvCertification));
        }
        if (cvSummary) {
            displaySummary(cvSummary)
        } else {

        }
        if (cvPincode) {
            $('input[name=pincode]').val(cvPincode);
            $('.cv-address-pincode').text(cvPincode);
        }
        if (cvState) {
            $('input[name=state]').val(cvState);
            $('.cv-address-state').text(cvState);
        }
        if (cvCity) {
            $('input[name=city]').val(cvCity);
            $('.cv-address-city').text(cvCity);
        }
        if (cvPhone) {
            $('input[name=phone]').val(cvPhone);
            $('.cv-phone').text(cvPhone);
        }
        if (cvname) {
            $('input[name=firstname]').val(cvname);
            $('.cv-c-name').text(cvname);
        }
        if (cvlastname) {
            $('input[name=lastname]').val(cvlastname);
            $('.cv-c-lastname').text(cvlastname);
        }
        if (cvEmail) {
            $('input[name=email]').val(cvEmail);
            $('.cv-email').text(cvEmail);
        }
    }
    showStoredData();
    $('#openTemplates').click(function() { 
        $(".mob-view").animate({
            width: "toggle"
        });
    });
    $('.c-close').click(function() { 
        $(".mob-view").animate({
            width: "toggle"
        });
    });
</script>

@endsection