@extends('admin.layout.default')

@section('pressrelease','active menu-item-open')
@section('content')
<div class="card card-custom">

    <div class="card-body">
        <div class="mb-7">
            <div class="row align-items-center">

                <form method="POST" action="" class="w-100" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-lg-9 col-xl-12">
                        <div class="row align-items-center">

                            <div class="form-group col-md-12">
                                <label> Title</label>
                                <div><input type="text" name="title" value="{{old('title')}}" class="form-control" placeholder="Enter title" isrequired="required"></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label> Short Description</label>
                                <div>
                                    <input type="text" name="short_details" value="{{old('short_details')}}" class="form-control" placeholder="Enter short details">
                                </div>
                            </div>
                            <div class="form-group col-md-12">

                            </div>
                            <div class="row form-group col-md-12">
                                <div class="form-group col-md-6">
                                    <label> Date</label>
                                    <div>
                                        <input type="date" name="date" value="{{old('date')}}" class="form-control" placeholder=" date" isrequired="required">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label> Time</label>
                                    <div>
                                        <input type="time" name="time" value="{{old('time')}}" class="form-control" placeholder=" date">
                                    </div>
                                </div>

                            </div> 
                            <div class="form-group col-md-12">
                                <label> Reference Url</label>
                                <div>
                                    <input type="text" name="reference_url" value="{{old('reference_url')}}" class="form-control" placeholder="Reference Url">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Publisher Name</label>
                                <div>
                                    <input type="text" name="posted_by" value="{{old('posted_by')}}" class="form-control" placeholder="Publisher Name" isrequired="required">
                                </div>
                            </div>
                            <div class="row form-group col-md-12">
                                <div class="form-group col-md-6">
                                    <label> Images <small>(Width:1400px, Height: 420px)</small></label>
                                    <div>
                                        <input type="file" name="images[]" class="form-control" multiple>
                                    </div>
                                </div> 
                            </div>
                            <div class="form-group col-md-12">
                                <center><button class="btn btn-success">Submit</button></center>
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