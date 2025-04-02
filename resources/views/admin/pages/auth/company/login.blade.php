@extends('admin.pages.auth.layout',['page_title' => 'Company Login'])

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Company | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/x-icon" href="<?php //echo base_url() 
                                                           ?>public/logo/logo-mini.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <script>
        var flashmsg = '';
    </script>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="<?php //echo base_url() 
                   ?>assets/front/action.js?ver=2167"></script>
    <style>
        body,
        html {
            height: 100%;
        }

        body {
            font-family: Lato;
        }

        .offer-head {
            background-color: #b9e9b8;
            transition: transform 0.2s, box-shadow 0.2s;
            background: rgb(22, 121, 241);
            background: linear-gradient(90deg, #9bcc9a 0%, #03bc00 45%, #79bc78 100%);
            margin: 16px auto 3px;
            width: 97%;
            max-width: 1130px;
            text-align: center;
            color: #fff;
            font-weight: normal;
            padding: 8px 0px 9px;
            border-radius: 9px;
            background-size: 100% 100%;
            font-family: Lato;
        }

        .c-menu {
            padding: 8px 15px 9px;
            width: 100%;
        }

        img.c-logo {
            width: 150px;
            vertical-align: middle;
        }

        .c-logo {
            font-size: 25px;
            color: #93cb92;
        }

        .d-menu ul {
            padding: 0;
            list-style: none;
            transition: .3s;
        }

        .d-menu ul li {
            display: inline-block;
            position: relative;
            line-height: 21px;
            text-align: left;
        }

        .d-menu ul li a {
            display: block;
            padding: 8px 25px;
            color: #333;
            font-size: 14px;
            text-decoration: none;
        }

        .d-menu ul li a:hover {
            color: #83ca82;
        }

        .d-menu ul li ul.dropdown {
            min-width: 100%;
            /* Set width of the dropdown */
            background: #f2f2f2;
            display: none;
            position: absolute;
            z-index: 999;
            transition: .3s;
            left: 0;
            width: 420px;
            background: #fff;
            border-radius: 10px;
            padding: 12px;
            box-shadow: 0 13px 27px -5px rgba(73, 156, 246, 0.25), 0 8px 16px -8px rgba(0, 0, 0, 0.2), 0 -6px 16px -6px rgba(0, 0, 0, 0.025);
            transition: transform 200ms ease-in, visibility 200ms ease-in, opacity 200ms ease-in !important;
        }

        .d-menu ul li:hover ul.dropdown {
            display: block;
            /* Display the dropdown */
            transition: .3s;
        }

        .d-menu ul li ul.dropdown li {
            display: block;
        }

        .c-menu-s {
            display: inline-block;
        }

        ul.dropdown li a {
            color: #000 !important;
        }

        ul.dropdown li:hover {
            background: rgb(131 202 130 / 15%);
            border-radius: 5px;
            color: #000;
        }

        .dropdown:before {
            content: "";
            position: absolute;
            top: -6px;
            left: 30px;
            border-style: solid;
            border-width: 5px 6px 0;
            border-color: #4CAF50 transparent;
            display: block;
            width: 0;
            z-index: 0;
            transform: rotate(180deg);
        }

        .d-menu-r {
            float: right;
            margin-top: 5px;
        }

        .lets-login-btn:hover {
            background: #FFC107;
        }

        .lets-login-btn {
            background: #4CAF50;
            color: #fff !important;
            border-radius: 50px;
            transition: .1s;
        }

        .m-menu-bars {
            display: none;
        }

        .slider-c {
            //  background-image: linear-gradient(to right top, #000000, #c777b9, #ba83ca, #aa8fd8, #9a9ae1, #8aa7ec, #79b3f4, #69bff8, #52cffe, #41dfff, #46eefa, #5ffbf1);
            width: 100%;
            height: 450px;

            position: absolute;
        }

        .slider-c h1 {
            max-width: 100%;
        }

        .slider-c .c-text {
            font-weight: 700;
            font-size: 35px;
            color: #fff;
            text-align: left;
            position: absolute;
            margin: 4% 8% 10px;
            text-transform: capitalize;
            max-width: 35%;
        }

        .slider-c h3 {
            text-align: left;
            font-size: 23px;
            margin-top: 30px;
        }

        .slider-c h4 {
            text-align: left;
            font-size: 18px;
            margin-top: 30px;
            text-transform: none;
        }

        .c-text h1 span {
            color: orange;
            font-style: italic;
        }

        .slider-c .lets-login-btn {
            font-size: 18px;
            font-weight: 500;
            padding: 8px 15px;
            text-decoration: none;
        }

        .main-menu-d {
            display: inline;
        }

        .why-us {
            margin-top: 25px;
        }

        .why-head .c-menu-s {
            display: inline-block;
        }

        .why-head {
            font-size: 25px;
            color: #93cb92;
            font-weight: 600;
        }

        .head-2 {
            font-size: 20px;
        }

        .c-col:hover {
            background-color: #F5F8FB;
            border-style: solid;
            border-width: 1px 1px 1px 1px;
            border-color: #93cb92;
        }

        .c-col {
            text-align: center;
            border-style: solid;
            border-width: 1px 1px 1px 1px;
            border-color: #dbf1da;
            box-shadow: -1px 4px 19px 0px rgb(120 192 97 / 16%);
            transition: background 0.3s, border 0.3s, border-radius 0.3s, box-shadow 0.3s;
            padding: 20px 10px 20px 10px;
            border-radius: 5px;
            margin-top: 20px;
            height: auto;
            box-shadow: 0 23px 40px rgba(0, 0, 0, 0.2);
        }

        .wh-for-arrow {
            margin-top: 10px;
        }

        .wh-sec-head {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .wh-sec-text {
            font-size: 15px;
        }

        .wh-sec-icon img {
            width: 140px;
        }

        .my-footer {
            background: #383a3a;
            background-image: -webkit-linear-gradient(bottom, #171717, #181919) !important;
            font-size: 16px !important;
            color: #fff;
            padding: 1em 0;
            margin-top: 40px;
        }

        .my-footer .heading {
            font-size: 20px;
            color: #4CAF50;
            font-weight: 700;
        }

        .bottom-border-green {
            width: 100px;
            border-top: 3px solid #4CAF50;
            margin-top: 0px;
            margin-bottom: 5px;
        }

        .my-footer ul li {
            list-style: none;
            line-height: 25px;
        }

        .my-footer ul li a:hover {
            text-decoration: none;
            color: #4CAF50 !important;
        }

        .my-footer ul li a {
            color: #fff !important;
            font-size: 14px;
        }

        .my-footer ul {
            margin-left: -38px;
        }

        .my-footer ul li {
            margin-bottom: 10px;
            margin-top: 10px;
        }

        .my-footer .category li {
            display: inline;
            margin-right: 5px;
            cursor: pointer;
        }

        #Layer_1 {
            width: 20px;
            vertical-align: text-top;
        }

        .btn-link.active .q-m-p {
            fill: #007bff !important;
        }

        #accordion .collapsing,
        #accordion2 .collapsing {
            transition: height .3s ease-in-out;
        }

        .card-header {
            padding: 5px;
            margin-bottom: 0;
            background-color: rgb(255 255 255 / 3%);
            border-bottom: 1px solid rgba(0, 0, 0, .125);
            border-radius: 0 !important;
        }

        .card {
            border-radius: 0;
        }

        a:hover {
            text-decoration: none;
        }

        .btn-link.focus,
        .btn-link:focus,
        .btn-link:hover {
            text-decoration: none !important;
        }

        .faq {
            margin-top: 40px;
        }

        .f-head {
            font-size: 30px;
            font-size: 25px;
            color: #93cb92;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .f-head-4 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 20px;
        }

        .btn-link {
            font-weight: 300;
            color: #109200;
            font-size: 18px;
        }

        #slider-svg {
            height: 460px;
        }

        .founder-message svg {
            height: 100%;
            width: 100%;
        }

        .found-call {
            position: absolute;
            width: 100%;
            height: 100px;
            margin-top: 113px;
            z-index: 9;
            font-size: 24px;
        }

        .m-msg {
            color: #1ba53d;
            margin: 0% 10%;
            max-width: 42%;
            font-style: italic;
            font-size: 30px;
        }

        .m-founder {
            color: #000000;
            margin: 0% 10%;
            max-width: 42%;
            font-size: 30px;
            margin-top: 20px;
        }

        img.me {
            width: 100%;
        }

        .me-d {
            max-width: 240px;
            float: right;
            margin-right: 20%;
            margin-top: -15px;
            border: 1px solid #eefcf0;
            border-radius: 50%;
            overflow: hidden;
        }

        .c-h-50 {
            height: 50px !important;
        }

        .in-div input,
        .in-div button {
            color: #3F4547;
            width: 340px;
            padding: 15px 10px;
            outline-width: 0;
            box-shadow: none;
            font-size: 16px;
            border: 1px solid #D9DBE4;
            border-radius: 4px;
            -webkit-appearance: none;
            display: inline-block;
            height: 50px;
        }

        .in-div {
            padding: 10px 0;
            position: relative;
            width: 340px;
            margin: 0 auto;
        }

        .in-div .btn-submit {
            height: 56px;
            color: #fff;
        }

        .login-div {
            max-width: 400px;
            margin: 10% auto;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            height: auto;
            text-align: center;
            margin-top: 0;
        }

        .container-left {
            background: rgb(131 202 130 / 15%);
            position: absolute;
            width: 40%;
            top: 0;
            bottom: 0;
            height: auto;
            z-index: 1;
        }

        .container-right {
            position: absolute;
            top: 0;
            bottom: 0;
            width: auto;
            height: auto;
            right: 0;
            left: 30%;
            right: 0;
        }

        .login-container {
            width: 100%;
            height: 100%;
        }

        .new-announcement {
            background: #fff;
            max-width: 400px;
            position: absolute;
            top: 50%;
            overflow: hidden;
            border-radius: 5px;
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
            display: block;
            grid-template-rows: 150px auto;
            max-height: 600px;
            transform: translate(0, -50%);
            -ms-transform: translate(-50%, -50%);
            width: 90%;
            right: -10%;
            text-align: center;
            padding: 35px;
        }

        .new-announcement .head-2 {
            font-size: 16px;
            margin-top: 25px;
        }

        .login-menu {
            position: absolute;
            z-index: 2;
        }

        .error-class {
            text-align: left;
            color: darkred;
            text-transform: capitalize;
            font-size: 13px;
        }

        .error-border {
            border: 1px solid darkred !important;
        }

        .window-notify {
            position: fixed;
            width: 95%;
            margin: 10px;
            max-width: 400px;
            top: -70px;
            z-index: 99999999;
        }

        .r-div .in-div {
            width: auto;
        }
    </style>
    <style>
        @media (max-width: 640px) {
            .login-menu {
                position: unset;
            }

            .login-div {
                width: 90%;
            }

            .in-div input,
            .in-div button {
                width: 100% !important;
            }

            .in-div {
                display: block !important;
                width: auto;
            }

            .in-div select {
                width: 100% !important;
            }

            .container-left {
                display: none;
            }

            .container-right {
                position: unset;
            }

            .login-div .c-logo {
                display: none;
            }

            .me-d {
                max-width: 120px;
                margin-right: 5%;
            }

            .m-founder {
                max-width: 100%;
                font-size: 25px;
            }

            .m-msg {
                max-width: 100%;
                font-size: 18px;
            }

            .founder-message svg {
                height: 360px;
            }

            .offer-head {
                padding: 8px 1px;
            }

            .slider-c h3 {
                font-size: 18px;
            }

            .slider-c h4 {
                font-size: 14px;
            }

            .slider-c h1 {
                font-size: 30px;
            }

            #d-svg {
                display: none;
            }

            #slider-svg {
                height: 400px;
            }

            .slider-c {
                background-image: linear-gradient(to right top, #000000, #c777b9, #ba83ca, #aa8fd8, #9a9ae1, #8aa7ec, #79b3f4, #69bff8, #52cffe, #41dfff, #46eefa, #5ffbf1);
                height: 395px;
            }

            .head-2 {
                font-size: 18px;
            }

            .d-menu ul li a {
                display: block;
                padding: 5px 8px;
                color: #333;
                font-size: 12px;
                text-decoration: none;
            }

            .m-menu-bars {
                display: block;
                width: 30px;
                float: right;
                cursor: pointer;
                margin-top: -38px;
            }

            .m-menu-bars hr {
                margin: 5px;
                border-top: 3px solid #1fbf1d;
            }

            .d-menu ul {
                margin-bottom: 0px;
            }

            .d-menu-r {
                float: unset;
                margin-top: 0;
            }

            .lets-login-btn {
                width: fit-content;
                margin-left: 7px;
            }

            .c-menu-s {
                display: block;
            }

            .d-menu ul li {
                display: block;
            }

            .d-menu ul li ul.dropdown {
                width: 100%;
            }

            .main-menu-d {
                margin-left: -105%;
                width: 90%;
                min-width: 90% !important;
                box-shadow: 0 13px 27px -5px rgba(73, 156, 246, 0.25), 0 8px 16px -8px rgba(0, 0, 0, 0.2), 0 -6px 16px -6px rgba(0, 0, 0, 0.025) !important;
                border: 1px solid #ddd !important;
                border-radius: 10px;
                height: unset;
                background: #fff;
                padding: 10px;
                margin-top: 10px;
                position: absolute;
                z-index: 9;
            }

            .slider-c .c-text {
                max-width: 100%;
            }

            .r-div {
                position: unset;
                transform: unset;
            }

        }
    </style>

</head>

@php $kt_logo_image = 'hirezy250.png' @endphp
<body>

    <div class="login-container">

        <div class="container-left">
            <div class="new-announcement">
                <div class="why-head">
                    <div class="c-logo c-menu-s"><img class="c-logo" src="{{ asset('frontend/assets/img/logo.png') }}"></div>
                </div>
                <div class="head-2">Company provides you wide range of real-time engagement with your customers </div>
                <hr>
                <div class="head-2">Engage with your customer in real-time for longer time as the visit your website.</div>
                <hr>
                <div class="head-2">Your customer is your and not paying to you for communication, we are just a way to communicate you with your customers.</div>
            </div>
        </div>
        <div class="container-right">
            <div class="login-div text-center">
                <div class="c-logo c-menu-s"><img class="c-logo" src="{{ asset('frontend/assets/img/logo.png') }}"></div>
                <h3 class="mt-2">Company Login</h3>
                <div>
                    @error('email')
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                    @error('password')
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                    @error('error')
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                    @if(request('error'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ request('error') }}</strong>
                    </div>
                    @enderror

                </div>

                <form class="form" novalidate="novalidate" id="kt_login_signin_form" action="{{url('company/auth/login')}}" method="post">
                    {{ csrf_field() }}
                
                    <div class="in-div">
                        <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg" 
                               type="text" name="email" autocomplete="off" required placeholder="Enter Email Id" />
                    </div>
                    
                    <div class="in-div position-relative">
                        <input id="passwordField" class="form-control form-control-solid h-auto py-6 px-6 rounded-lg" 
                               type="password" name="password" autocomplete="off" required placeholder="Enter Password" />
                        <button type="button" id="togglePassword" class="btn position-absolute" 
                                style="left: 145px; top: 50%; transform: translateY(-50%); background: transparent; border: none;">
                            <i id="eyeIcon" class="fa fa-eye"></i>
                        </button>
                    </div>
                    
                    <div class="in-div">
                        <button type="submit" name="submit" class="btn btn-success btn-submit">Sign In <span></span></button> 
                    </div>
                </form>
                


            </div>
        </div>
    </div>

    @endsection

    {{-- Styles Section --}}
    @section('styles')
    <style>

    </style>
    @endsection


    {{-- Scripts Section --}}
    @section('scripts')
    {{-- vendors --}}
    <script>
        document.getElementById("togglePassword").addEventListener("click", function () {
            let passwordField = document.getElementById("passwordField");
            let eyeIcon = document.getElementById("eyeIcon");
    
            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        });
    </script>
    
    <script src="{{url('/')}}/public/js/custom.js" type="text/javascript"></script>
    {{-- page scripts --}}
    @endsection