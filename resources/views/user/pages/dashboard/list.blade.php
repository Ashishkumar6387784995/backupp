@extends('user.layout.default')

@section('dashboardmaster','active menu-item-open')
@section('content')
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-3 pb-0">
        <div class="card-title">
            <h3 class="card-label">{{ auth()->guard('user')->user()->first_name; }} Dashboard</h3>
        </div>
        
        <form action="" method="get" class="w-100" style="position: absolute;    right: 0;    top: 10px;">
            <div class="row pl-0 pr-0">
                <div class=" col-lg-12 text-right">
                    <div class="dataTables_length">
                        <input type="text" name="fromtodate" id="fromtodate" class="" placeholder="From Date" autocomplete="off" value="" style="opacity:0; width:0;position:absolute;right:20%">
                        <button type="button" class="btn" onclick="$('#fromtodate').click(),setSubmitAtt()"><i class="icon-2x text-dark-50 ki ki-calendar "></i></button>
                        <button type="submit" class="btn btn-success btn-sm d-none" id="Filter_ME" data-toggle="tooltip" title="Apply Filter">Filter</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
   
</div>

@endsection

{{-- Styles Section --}}
@section('styles')
@endsection


{{-- Scripts Section --}}
@section('scripts')
@endsection