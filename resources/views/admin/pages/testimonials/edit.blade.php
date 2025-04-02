@extends('admin.layout.default')

@section('testimonials','active menu-item-open')
@section('content')
<div class="card card-custom">

    <div class="card-body">
        <div class="mb-7">
            <div class="row align-items-center">

                <form method="POST" action="" class="w-100" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-lg-9 col-xl-12">
                        <div class="row align-items-center">
                            <div class="form-group col-md-6">
                                <label>Customer Name</label>
                                <div><input type="text" name="name" value="{{$details->name}}" isrequired="required" class="form-control" placeholder="Enter Customer Name"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Rating</label>
                                <div>
                                    <select name="rating" isrequired="required" class="form-control">
                                        <option value="">Select Rating</option>
                                        <option value="1" {{ runTimeSelection(1, $details->rating)}}>1 star</option>
                                        <option value="2" {{ runTimeSelection(2, $details->rating)}}>2 star</option>
                                        <option value="3" {{ runTimeSelection(3, $details->rating)}}>3 star</option>
                                        <option value="4" {{ runTimeSelection(4, $details->rating)}}>4 star</option>
                                        <option value="5" {{ runTimeSelection(5, $details->rating)}}>5 star</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Testimonial segment</label>
                                <div>
                                    <select name="segment" isrequired="required" class="form-control">
                                        <option value="">Select Type</option>
                                        <option value="1" {{ runTimeSelection(1, $details->segment)}}>Patient</option>
                                        <option value="2" {{ runTimeSelection(2, $details->segment)}}>Doctor</option>
                                        <option value="3" {{ runTimeSelection(3, $details->segment)}}>Partners</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Testimonial Type</label>
                                <div>
                                    <select name="testimonial_type" isrequired="required" class="form-control" onchange="changeTestimonialType(this.value)">
                                        <option value="">Select Type</option>
                                        <option value="1" {{ runTimeSelection(1, $details->testimonial_type)}}>For Text</option>
                                        <option value="2" {{ runTimeSelection(2, $details->testimonial_type)}}>For Video</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6 video_url" @if($details->testimonial_type == 1) style="display: none; @endif">
                                <label>Video URL</label>
                                <div>
                                    <input type="text" name="video_url" value="{{$details->video_url}}" class="form-control" placeholder="Enter video url">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Review</label>
                                <div>
                                    <input type="text" name="comments" value="{{$details->comments}}" isrequired="required" class="form-control" placeholder="Enter comments">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Content</label>
                                <div>
                                    <textarea name="content" isrequired="required" class="form-control" placeholder="Enter Testimonial" rows="8">{{$details->content}}</textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Profile Image <small>(Width: 100px, Height: 100px)</small></label>
                                @if($details->profile_image)
                                <div class="_update_img_action">
                                    <a target="_black" href="{{asset('uploads/testimonials/profile_images/'.$details->profile_image)}}" class="btn btn-success btn-sm">View</a> &nbsp;
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="updateImage()">Update</a>
                                    <br>
                                    <div class="_icon_display">
                                        <img src="{{asset('uploads/testimonials/profile_images/'.$details->profile_image)}}" />
                                    </div>
                                </div>
                                @endif
                                <div class="image_file _update_img_file" style="{{$details->profile_image ? 'display:none' : ''}}">
                                    <input type="file" name="profile_image" class="form-control">
                                </div>
                            </div>


                            <div class="form-group col-md-12 text-center">
                                <button class="btn btn-success">Update</button> 
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
    function changeTestimonialType(val) {
        if (val == 1) {
            $('.video_url').fadeOut();
        } else {
            $('.video_url').fadeIn();

        }
    }
</script>
@endsection