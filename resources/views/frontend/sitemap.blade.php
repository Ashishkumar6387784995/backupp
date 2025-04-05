@extends('frontend.layouts.default_layout')
@section('content')

    <h1 style="text-align: center;">sitemap</h1>

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