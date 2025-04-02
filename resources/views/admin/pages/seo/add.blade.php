@extends('admin.layout.default')

@section('seomanagement','active menu-item-open')
@section('content')
<div class="card card-custom">

    <div class="card-body">
        <div class="mb-7">
            <div class="row align-items-center">

                <form method="POST" action="" class="w-100">
                    {{ csrf_field() }}
                    <div class="col-lg-9 col-xl-12">
                        <div class="row align-items-center">
                            <div class="form-group col-md-6">
                                <label>Reference Name</label>
                                <input type="text" name="page_name" value="{{old('page_name')}}" isrequired="required" class="form-control" placeholder="Enter Reference  Name" onkeyup="addSlug(this);">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Slug</label>
                                <input type="text" name="slug" id="slug" value="{{old('slug')}}" class="form-control" placeholder="Enter slug" onkeyup="checkSeoSlug(this.value),generateSlug(this)" isrequired="required">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Seo  Title <small>(Recommended upto 60 words by google)</small></label>
                                <div><input type="text" name="seo_title" value="{{old('seo_title')}}" isrequired="required" class="form-control" placeholder="Enter SEO Title"></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Seo  Description <small>(Recommended upto 160 words by google)</small></label>
                                <textarea class="form-control" name="seo_description" id="" cols="30" rows="10" placeholder="Enter Description" isrequired="required">{{old('seo_description')}}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Seo  Keywords <small>(Use keywords comma separated)</small></label>
                                <textarea class="form-control" name="seo_keywords" id="" cols="30" rows="10" placeholder="Enter Keywords">{{old('seo_keywords')}}</textarea>
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
<style>
    .error-success {
        color: green;
    }
</style>
@endsection

{{-- Scripts Section --}}
@section('scripts')
<script>
    function checkSeoSlug(slug, id = null) {
        if (slug) {
            $('.error-class').remove();
            $.ajax({
                type: 'GET',
                url: APP_URL + '/ajax/checkSeoSlug/?id=' + id + '&slug=' + slug,
                dataType: 'json',

                success: function(response) {
                    console.log(response.Success);
                    if (response.Success) {
                        $('#slug').after('<div class="error-class">' + response.Message + '</div>');
                        $('#submitBtn').attr('disabled', 'disabled');
                    } else {
                        $('#slug').after('<div class="error-class error-success">' + response.Message + '</div>');
                        $('#submitBtn').removeAttr('disabled');
                    }
                }
            })
        }
    }

    function addSlug(e) { 
        generateSlug(e, '#slug');
        $('#slug').keyup();
    }
</script>
@endsection