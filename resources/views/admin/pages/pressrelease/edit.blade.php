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
                                <div><input type="text" name="title" value="{{$details->title}}" class="form-control" placeholder="Enter title" isrequired="required"></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label> Short Description</label>
                                <div>
                                    <input type="text" name="short_details" value="{{$details->short_details}}" class="form-control" placeholder="Enter short details">
                                </div>
                            </div>
                            <div class="form-group col-md-12">

                            </div>
                            <div class="row form-group col-md-12">
                                <div class="form-group col-md-6">
                                    <label> Date</label>
                                    <div>
                                        <input type="date" name="date" value="{{$details->date}}" class="form-control" placeholder=" date" isrequired="required">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label> Time</label>
                                    <div>
                                        <input type="time" name="time" value="{{$details->time}}" class="form-control" placeholder=" time">
                                    </div>
                                </div>

                            </div>
                            <div class="form-group col-md-12">
                                <label> Reference Url</label>
                                <div>
                                    <input type="text" name="reference_url" value="{{$details->reference_url}}" class="form-control" placeholder="Reference Url">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Publisher Name</label>
                                <div>
                                    <input type="text" name="posted_by" value="{{$details->posted_by}}" class="form-control" placeholder="Publisher Name" isrequired="required">
                                </div>
                            </div>
                            <div class="row form-group col-md-12">
                                <div class="form-group col-md-6">
                                    <label> Images <small>(Width:1400px, Height: 420px)</small></label>
                                    <input type="file" name="images[]" class="form-control" multiple>
                                    @if(!empty($details->images) && $images = json_decode($details->images,true))
                                    @foreach($images as $key => $contract_document)


                                    <div class="_update_img_action">
                                        <br>
                                        <a target="_black" href="{{asset('uploads/pressrelease/images/'.$contract_document['image'])}}" class="btn btn-success btn-sm">View</a> &nbsp;
                                        <a href="javascript:void(0)" data-url="{{url('/admin/pressrelease/delete-image/'.$details->id.'/'.$contract_document['image'])}}" class="btn btn-danger btn-sm" onclick="deleteImage(this)">Delete</a>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>

                            </div>
                            <div class="form-group col-md-12">
                                <center><button class="btn btn-success">Update</button></center>
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
<script>
    function deleteImage(e) {
        var url = $(e).attr('data-url');
        if (url) {
            if (confirm('Are you sure want to delete this?')) {
                location.href = url;
            }
        }
    }
</script>
@endsection