@extends('admin.layout.default')

@section('partnermaster','active menu-item-open')
@section('content')
<div class="card card-custom">

    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <!-- The time line -->
                <ul class="timeline">

                    @if(count($data) > 0)

                    @php $LD = ''; @endphp


                    @foreach($data as $key => $val)

                    @php $CD = date('d M Y',strtotime($val->created_at)); @endphp
                    @if($val->landing_id)
                    @php $l = $val->landing_id ; @endphp
                    @else
                    @php $l = ''; @endphp
                    @endif
                    @if($LD != $CD)
                    <!-- timeline time label -->
                    <li class="time-label">
                        <span class="bg-red">
                            {{date('d M Y',strtotime($val->created_at))}}
                        </span>
                    </li>
                    <li>
                        <i class="fa fa-users"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> {{ date('H:i:s',strtotime($val->created_at))}}</span>
                            <!--h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3-->
                            <div class="timeline-body">
                                {{$val->title}}
                            </div>
                            <div class="timeline-footer">
                                <a href="{{'/admin/'.$val->landing_url.'/'.$l}}" class="{{config('commonFile.notificationsPage.'.$val->notify_type.'.btnbgcolor')}}">View Details</a>
                            </div>
                        </div>
                    </li>
                    @else
                    <li>
                        <i class="fa fa-users"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> {{ date('H:i:s',strtotime($val->created_at))}}</span>
                            <!--h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3-->
                            <div class="timeline-body">
                                {{$val->title}}
                            </div>
                            <div class="timeline-footer">
                                <a href="{{'/admin/'.$val->landing_url.'/'.$l}}" class="{{config('commonFile.notificationsPage.'.$val->notify_type.'.btnbgcolor')}}">View Details</a>
                            </div>
                        </div>
                    </li>
                    @endif
                    @php $LD = $CD; @endphp
                    @endforeach
                    @endif





                </ul>
                <div class="pagination">
                    {{ $data->links() }}
                </div>
            </div><!-- /.col -->
        </div>
    </div>
</div>


@endsection

{{-- Styles Section --}}
@section('styles')
<style>
    .timeline {
        position: relative;
        margin: 0 0 30px 0;
        padding: 0;
        list-style: none;
    }

    .timeline:before {
        content: '';
        position: absolute;
        top: 0px;
        bottom: 0;
        width: 4px;
        background: #ddd;
        left: 31px;
        margin: 0;
        border-radius: 2px;
    }

    ul.timeline li {
        position: relative;
        border-bottom: 1px solid #e8e8e8;
        clear: both;
    }

    .timeline>li:before,
    .timeline>li:after {
        content: " ";
        display: table;
    }

    .timeline>li.time-label>span {
        font-weight: 600;
        padding: 5px;
        display: inline-block;
        background-color: #fff;
        border-radius: 4px;
    }

    .bg-red {
        background: #E74C3C !important;
        border: 1px solid #E74C3C !important;
        color: #fff;
    }

    .timeline>li>.timeline-item {
        -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        border-radius: 3px;
        margin-top: 0px;
        background: #fff;
        color: #444;
        margin-left: 60px;
        margin-right: 15px;
        padding: 0;
        position: relative;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .timeline>li>.timeline-item>.time {
        color: #999;
        float: right;
        padding: 10px;
        font-size: 12px;
    }

    .timeline>li>.timeline-item>.timeline-body,
    .timeline>li>.timeline-item>.timeline-footer {
        padding: 10px;
    }

    .card {
        background-color: #ffffff00;
    }

    .card.card-custom {
        box-shadow: unset;
    }

    .timeline>li>.fa,
    .timeline>li>.glyphicon,
    .timeline>li>.ion {
        width: 30px;
        height: 30px;
        font-size: 15px;
        line-height: 30px;
        position: absolute;
        color: #fff;
        background: #d2d6de;
        border-radius: 50%;
        text-align: center;
        left: 18px;
        top: 12px;
    }

    .pagination {
        display: inline-block;
        padding-left: 0;
        margin: 20px 0;
        border-radius: 4px;
    }

    .pagination>li {
        display: inline;
    }

    .pagination>li>a,
    .pagination>li>span {
        position: relative;
        float: left;
        padding: 6px 12px;
        margin-left: -1px;
        line-height: 1.42857143;
        color: #337ab7;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #ddd;
    }

    .pagination>.disabled>a,
    .pagination>.disabled>a:focus,
    .pagination>.disabled>a:hover,
    .pagination>.disabled>span,
    .pagination>.disabled>span:focus,
    .pagination>.disabled>span:hover {
        color: #777;
        cursor: not-allowed;
        background-color: #fff;
        border-color: #ddd;
    }

    .pagination>li:first-child>a,
    .pagination>li:first-child>span {
        margin-left: 0;
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
    }
</style>
@endsection


{{-- Scripts Section --}}
@section('scripts')

{{-- vendors --}}
@endsection