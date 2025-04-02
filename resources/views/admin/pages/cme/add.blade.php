@extends('admin.layout.default')

@section('cmemaster','active menu-item-open')
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
                                    <input type="text" name="short_details" value="{{old('short_details')}}" class="form-control" placeholder="Enter short details" isrequired="required">
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
                                <label> Venue</label>
                                <div>
                                    <input type="text" name="location" value="{{old('location')}}" class="form-control" placeholder=" location" isrequired="required">
                                </div>
                            </div>
                            <!-- <div class="form-group col-md-12">
                                <label> Posted By</label>
                                <div>
                                    <input type="text" name="posted_by" value="{{old('posted_by')}}" class="form-control" placeholder=" posted by" isrequired="required">
                                </div>
                            </div> -->
                            <div class="form-group col-md-12">
                                <label> Description</label>
                                <div>
                                    <textarea id="editor1" name="description" class="form-control" placeholder="Enter Description" isrequired="required">{{old('description')}}</textarea>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Youtube Link <small>(Embed url)</small></label>
                                <div>
                                    <input type="text" name="youtube_link" value="" class="form-control" placeholder="Youtube link only">
                                </div>
                            </div>
                            
                            <div class="form-group col-md-6">
                                    <label> Videos</label>
                                    <div>
                                        <input type="file" name="videos[]" class="form-control" multiple>
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

<script src="https://ckeditor.com/docs/vendors/4.11.3/ckeditor/ckeditor.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        CKEDITOR.replace('editor1');
    });
</script>
@endsection