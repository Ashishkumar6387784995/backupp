@extends('admin.layout.default')

@section('lifestylemaster_edit','active menu-item-open')
@section('content')
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Edit Lifestyle
            </h3>
        </div>
    </div>
    <div class="card-body">
        <div class="mb-7">
            <div class="row align-items-center">


                <form method="POST" action="" class="w-100">
                    <div class="col-lg-9 col-xl-8">
                        <div class="row align-items-center">
                            <div class="form-group col-md-12">
                                <label>Name </label>
                                <div><input type="text" name="lifestyle_name" class="form-control"></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Description </label>
                                <div><textarea name="lifestyle_description" class="form-control"></textarea></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Icon </label>
                                <div><input type="file" name="lifestyle_icon" class="form-control"></div>
                            </div>
                            <div class="form-group col-md-12">
                                <div><button class="btn btn-success">Submit</button></div>
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

@endsection

{{-- Scripts Section --}}
@section('scripts')
@endsection