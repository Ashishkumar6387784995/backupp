@extends('frontend.layouts.default_layout')
@section('content')

    <h1 style="text-align: center;">contact us</h1>
    <div class="contact-form-area ptb-100">
            <div class="container-fluid">
                <form id="contactForm" novalidate="true">
                    <div class="row contact-wrap">
                        <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                                <input type="text" name="name" id="name" class="form-control" required="" data-error="Please enter your name" placeholder="Your Full Name">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
    
                        <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                                <input type="email" name="email" id="email" class="form-control" required="" data-error="Please enter your email" placeholder="Your Email">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
    
                        <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                                <input type="text" name="phone_number" id="phone_number" required="" data-error="Please enter your number" class="form-control" placeholder="Your Phone">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
    
                        <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                                <input type="text" name="msg_subject" id="msg_subject" class="form-control" required="" data-error="Please enter your subject" placeholder="Subject">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
    
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <textarea name="message" class="form-control" id="message" cols="30" rows="8" required="" data-error="Write your message" placeholder="Job Description"></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
 
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <div class="form-check agree-label">
                                    <input name="gridCheck" value="I agree to the terms and privacy policy." class="form-check-input" type="checkbox" id="gridCheck" required="">
                                    <label class="form-check-label" for="gridCheck">
                                        Accept <a href="terms-condition.html">Terms &amp; Conditions</a> And <a href="privacy-policy.html">Privacy Policy.</a>
                                    </label>
                                    <div class="help-block with-errors gridCheck-error"></div>
                                </div>
                            </div>
                        </div>
 
                        <div class="col-md-12 col-lg-12">
                            <div class="text-center">
                                <button type="submit" class="btn contact-btn disabled">Submit</button>
                            </div>
                            <div id="msgSubmit" class="h3 text-center hidden"></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

@endsection
@section('styleSheets')
    <style>
        .fixed-top {
            position: static;
            margin-bottom: 10px;
        }
        .main-nav {
            position: static;
        }
        .wt-bnr-inr {
    height: 250px;
    background-size: cover;
    background-position: center center;
    display: table;
    width: 100%;
    position: relative;
}

.wt-bnr-inr-entry .banner-title-outer {
    position: relative;
}
.wt-bnr-inr-entry {
    display: table-cell;
    vertical-align: bottom;
    text-align: center;
    padding-bottom: 30px;
}
.wt-bnr-inr-entry .banner-title-outer .banner-title-name {
    display: inline-block;
    margin-bottom: 30px;
}
.wt-bnr-inr-entry .banner-title-outer .banner-title-name .wt-title {
    color: #17171d;
}
.wt-bnr-inr-entry .banner-title-outer .wt-title {
    font-size: 28px;
    margin-bottom: 0px;
    position: relative;
}
h2 {
    font-size: 56px;
    font-weight: 500;
}

    </style>
@endsection