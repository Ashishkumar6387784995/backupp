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
                                <div><input type="text" name="name" value="{{old('name')}}" isrequired="required" class="form-control" placeholder="Enter Customer Name"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Rating</label>
                                <div>
                                    <select name="rating" isrequired="required" class="form-control">
                                        <option value="">Select Rating</option>
                                        <option value="1" {{runTimeSelection(1,old('testimonial_type'))}}>1 star</option>
                                        <option value="2" {{runTimeSelection(2,old('testimonial_type'))}}>2 star</option>
                                        <option value="3" {{runTimeSelection(3,old('testimonial_type'))}}>3 star</option>
                                        <option value="4" {{runTimeSelection(4,old('testimonial_type'))}}>4 star</option>
                                        <option value="5" {{runTimeSelection(5,old('testimonial_type'))}}>5 star</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Testimonial segment</label>
                                <div>
                                    <select name="segment" isrequired="required" class="form-control">
                                        <option value="">Select Type</option>
                                        <option value="1" {{ runTimeSelection(1,old('segment'))}}>Patient</option>
                                        <option value="2" {{ runTimeSelection(2, old('segment'))}}>Doctor</option>
                                        <option value="3" {{ runTimeSelection(3,old('segment'))}}>Partners</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Testimonial Type</label>
                                <div>
                                    <select name="testimonial_type" isrequired="required" class="form-control" onchange="changeTestimonialType(this.value)">
                                        <option value="">Select Type</option>
                                        <option value="1" {{runTimeSelection(1,old('testimonial_type'))}}>For Text</option>
                                        <option value="2" {{runTimeSelection(2,old('testimonial_type'))}}>For Video</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6 video_url" style="display: none;">
                                <label>Video URL</label>
                                <div>
                                    <input type="text" name="video_url" value="{{old('video_url')}}" class="form-control" placeholder="Enter video url">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Review</label>
                                <div>
                                    <input type="text" name="comments" value="{{old('comments')}}" isrequired="required" class="form-control" placeholder="Enter comments">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Content</label>
                                <div>
                                    <textarea name="content" isrequired="required" class="form-control" placeholder="Enter Testimonial" rows="8">{{old('content')}}</textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Profile Image <small>(Width: 100px, Height: 100px)</small></label>
                                <div><input type="file" name="profile_image" class="form-control"></div>
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