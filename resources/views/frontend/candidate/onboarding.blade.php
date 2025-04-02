@extends('frontend.layout')


@section('c_onboarding','active menu-item-open')
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
                        <h4 class="heading-caption">OnBoarding</h4>
                        <div class="my_job_list row">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
</main>



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