@extends('frontend.layout')


@section('customermaster','active menu-item-open')
@section('content')



<main class="main-content">
    <div class="page-header-area sec-overlay sec-overlay-black" data-bg-img="{{url('/')}}/public/frontend/assets/img/photos/bg2.webp">

    </div>
    <section class="job-details-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include('frontend.candidate.profile')
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @include('frontend.candidate.left-menu')
                <div class="col-md-8">
                    <div class="tab-content">
                        <h4 class="heading-caption">Education</h4>
                        <div class="my_job_list row">
                            <div class="addnewworkexp text-right">
                                <a href="javascript:void(0)" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myeducation">+ Add</a>
                            </div>
                            @if($education)
                            @foreach($education as $key => $list)
                            <div class="col-md-12 work-exp-list">
                                <div class="row ">
                                    <div class="c-action">
                                        <div class="c-edit" title="Edit" onclick="editWork()"><i class="icofont-edit"></i></div>
                                        <div class="c-del" title="Delete" onclick="delWork()"><i class="icofont-trash"></i></div>
                                    </div>
                                    <div class="col-md-4 work-item">
                                        <label>Qualification :</label>
                                        <div class="de">{{$list->QualificationType ? $list->QualificationType->title:'NA'}}</div>
                                    </div>
                                    <div class="col-md-4 work-item">
                                        <label>School/College/University Name :</label>
                                        <div class="de">{{$list->CollegeUniversityName ? $list->CollegeUniversityName->title:'NA'}}</div>
                                    </div>
                                    <div class="col-md-4 work-item">
                                        <label>Joined From :</label>
                                        <div class="de">{{$list->from_education_years}} {{$list->from_education_months}}</div>
                                    </div>
                                    <div class="col-md-4 work-item">
                                        <label>Joined Till :</label>
                                        <div class="de">{{$list->to_education_years}} {{$list->to_education_months}}</div>
                                    </div> 
                                    
                                    <div class="col-md-4 work-item">
                                        <label>Location :</label>
                                        <div class="de">{{$list->education_location ? $list->education_location : 'NA'}}</div>
                                    </div> 
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="no-record-found text-center">Work Experience not found.<br><br> <a href="javascript:void(0)" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myeducation">+ Add</a></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
</main>


<!-- The Modal -->
<div class="modal" id="myeducation">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                Modal body..
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


@endsection

{{-- Styles Section --}}
@section('styles')
<style>
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
</style>
@endsection

{{-- Scripts Section --}}
@section('scripts')
@endsection