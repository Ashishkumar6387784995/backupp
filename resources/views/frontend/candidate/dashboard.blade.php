@extends('frontend.layouts.default_layout')
@section('customermaster','active menu-item-open')
@section('content')
<main class="main-content">
    <div class="page-header-area sec-overlay sec-overlay-black" data-bg-img="{{asset('frontend/assets/img/photos/bg2.webp')}}">

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
                        <h4 class="heading-caption"> Applied Jobs</h4>
                        <div class="my_job_list row">
                            <div class="col-md-6">
                                <div class="recent-job-item recent-job-style2-item">
                                    <div class="company-info">
                                        <div class="logo">
                                            <a href="company-details.html"><img src="http://hirezy.local/public/frontend/assets/img/companies/1.jpg" width="75" height="75" alt="Image-HasTech"></a>
                                        </div>
                                        <div class="content">
                                            <h4 class="name"><a href="company-details.html">ANKIT CO LTD</a></h4>
                                            <p class="address">noida</p>
                                        </div>
                                    </div>
                                    <div class="main-content">
                                        <h3 class="title"><a href="job-details.html">Teaching</a></h3>
                                        <h5 class="work-type">Full Time</h5>
                                        <p class="desc"></p>
                                    </div>
                                    <div class="recent-job-info">
                                        <div class="salary">
                                            <h4>₹20000</h4>
                                            <p>/monthly</p>
                                        </div>
                                        <a class="btn-theme btn-sm" href="http://hirezy.local/jobs/teachingeducationlanguage-specialist/3">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="recent-job-item recent-job-style2-item">
                                    <div class="company-info">
                                        <div class="logo">
                                            <a href="company-details.html"><img src="http://hirezy.local/public/frontend/assets/img/companies/1.jpg" width="75" height="75" alt="Image-HasTech"></a>
                                        </div>
                                        <div class="content">
                                            <h4 class="name"><a href="company-details.html">ANKIT CO LTD</a></h4>
                                            <p class="address">noida</p>
                                        </div>
                                    </div>
                                    <div class="main-content">
                                        <h3 class="title"><a href="job-details.html">Teaching</a></h3>
                                        <h5 class="work-type">Full Time</h5>
                                        <p class="desc"></p>
                                    </div>
                                    <div class="recent-job-info">
                                        <div class="salary">
                                            <h4>₹20000</h4>
                                            <p>/monthly</p>
                                        </div>
                                        <a class="btn-theme btn-sm" href="http://hirezy.local/jobs/teachingeducationlanguage-specialist/3">Apply Now</a>
                                    </div>
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

<style>
    .profile-dashboard {
        color: #656565;
        font-family: "Jost", sans-serif;
        font-weight: 400;

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
    .employers-details-wrap {
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    background-color: #f4f7f7;
    border-radius: 5px;
    margin-bottom: 50px;
    padding: 45px 50px 45px;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
}.employers-details-info {
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
}.job-details-area {
    margin-top: 150px;
    padding-bottom: 170px;
}.employers-details-info .content {
    margin-top: -3px;
    margin-left: 30px;
}.employers-details-info .content .title {
    font-size: 24px;
    margin-bottom: 13px;
}.employers-details-info .content .info-list {
    display: flex;
    margin-bottom: 18px;
    margin-left: -35px;
}.employers-details-info .content .info-list li + li {
    margin-left: 19px;
}ul li {
    list-style: none;
}.de {
    color: #656565;
    font-weight: 500;
    line-height: 20px;
    font-size: 14px;
}.row > [class*="col-"] {
    padding-right: 15px;
    padding-left: 15px;
}.employers-details-info .content .info-list li {
    color: #656565;
    font-size: 14px;
    line-height: 1;
}
</style>

@endsection
