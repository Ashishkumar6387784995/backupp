[@extends('admin.layout.default')

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
                                <div><input type="text" name="title" value="{{$details->title}}" class="form-control" placeholder="Enter title" isrequired="required"></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label> Short Description</label>
                                <div>
                                    <input type="text" name="short_details" value="{{$details->short_details}}" class="form-control" placeholder="Enter short details" isrequired="required">
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
                                <label> Venue</label>
                                <div>
                                    <input type="text" name="location" value="{{$details->location}}" class="form-control" placeholder=" location" isrequired="required">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label> Description</label>
                                <div>
                                    <textarea id="editor1" name="description" class="form-control" placeholder="Enter Description">{{$details->details}}</textarea>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label>Youtube Link <small>(Embed url)</small></label>
                                <div>
                                    <input type="text" name="youtube_link" value="{{$details->youtube_link}}" class="form-control" placeholder="Youtube link only">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                    <label> Videos</label>

                                    <div>
                                        <input type="file" name="videos[]" class="form-control" multiple onchange="fileValidation(this)">
                                    </div>
                                    @if(!empty($details->videos) && $videos = json_decode($details->videos,true))
                                    @foreach($videos as $key => $video) 
                                    <div class="_update_img_action">
                                        <br>
                                        <a target="_black" href="{{asset('uploads/cme/videos/'.$video['video'])}}" class="btn btn-success btn-sm">View</a> &nbsp;
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deleteImage(this)">Delete</a>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            <div class="row form-group col-md-12">
                                <div class="form-group col-md-6">
                                    <label> Images <small>(Width:1400px, Height: 420px)</small></label>
                                    <input type="file" name="images[]" class="form-control" multiple>
                                    @if(!empty($details->images) && $images = json_decode($details->images,true))
                                    @foreach($images as $key => $contract_document)


                                    <div class="_update_img_action">
                                        <br>
                                        <a target="_black" href="{{asset('uploads/cme/images/'.$contract_document['image'])}}" class="btn btn-success btn-sm">View</a> &nbsp;
                                        <a href="javascript:void(0)"  data-url="{{url('/admin/cme/delete-image/'.$details->id.'/'.$contract_document['image'])}}"  class="btn btn-danger btn-sm" onclick="deleteImage(this)">Delete</a>
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

<script src="https://ckeditor.com/docs/vendors/4.11.3/ckeditor/ckeditor.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        CKEDITOR.replace('editor1');
    });
    
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