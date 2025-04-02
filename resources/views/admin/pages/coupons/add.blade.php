@extends('admin.layout.default')

@section('coupons','active menu-item-open')
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
                                <label>Coupon Code</label>
                                <div><input type="text" name="coupon_code" value="{{old('coupon_code')}}" isrequired="required" class="form-control" placeholder="Enter Coupon Code"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Coupon Type</label>
                                <select class="form-control" name="coupon_type" id="coupon_type" isrequired="required">
                                    <option value="">Select Coupon Type</option>
                                    <option value="1" {{runTimeSelection(1,old('coupon_type'))}}>Percentages</option>
                                    <option value="2" {{runTimeSelection(2,old('coupon_type'))}}>Fixed</option>
                                    <option value="3">Conditional</option> 
                                </select>
                            </div>
                            <div class="form-group col-md-12 _Conditions" style="display: none;">
                                <label>Conditions</label>
                                <div>
                                    <input type="radio" name="conditions[]" value="1" class="_conditions_inputs" id="hc_off"> <label for="hc_off">Home Collection Fees Free</label>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Coupon Title</label>
                                <div><input type="text" name="coupon_title" value="{{old('coupon_title')}}" isrequired="required" class="form-control" placeholder="Enter Coupon Title"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Coupon Landing Page <small>(Url)</small></label>
                                <div><input type="text" name="landing_page" value="{{old('landing_page')}}" class="form-control" placeholder="Coupon Landing Page"></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Short Description</label>
                                <div><input type="text" name="short_desc" value="{{old('short_desc')}}" class="form-control" placeholder="Enter Short Description"></div>
                            </div>
                            <!-- <div class="form-group col-md-6">
                                <label>Valid From</label>
                                <div><input type="date" name="valid_from" value="{{old('valid_from')}}" isrequired="required" class="form-control" placeholder="Enter Valid From" onchange="$('#valid_to').attr('min',this.value)"></div>
                            </div> -->
                            <!-- <div class="form-group col-md-6">
                                <label>Valid To</label>
                                <div><input type="date" name="valid_to" id="valid_to" value="{{old('valid_to')}}" isrequired="required" class="form-control" placeholder="Enter Valid To"></div>
                            </div> -->
                            <!-- <div class="form-group col-md-6">
                                <label>Min Value</label>
                                <div><input type="text" name="min_value" value="{{old('min_value')}}" isrequired="required" class="form-control number" placeholder="Enter Min Value"></div>
                            </div> -->
                            <!-- <div class="form-group col-md-6">
                                <label>Max Off</label>
                                <div><input type="text" name="max_off" value="{{old('max_off')}}" isrequired="required" class="form-control number" placeholder="Enter Max Off"></div>
                            </div> -->
                            <!-- <div class="form-group col-md-6">
                                <label>Max No. of Uses</label>
                                <div><input type="text" name="max_usage" value="{{old('max_usage')}}" isrequired="required" class="form-control number" placeholder="Max No. of Uses"></div>
                            </div> -->
                            <!-- <div class="form-group col-md-6">
                                <label>Max No. of Uses / User</label>
                                <div><input type="text" name="max_per_user" value="{{old('max_per_user')}}" isrequired="required" class="form-control number" placeholder="Max No. of Uses / User"></div>
                            </div> -->
                            

                            <div class="form-group col-md-12">
                                <label>Description</label>
                                <div>
                                    <textarea id="editor1"  type="text" name="description" class="form-control">{{old('description')}}</textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Offer Icon <small>(Width: 430px, Height: 554px)</small></label>
                                <div class="">
                                    <input type="file" name="coupon_icon" isrequired="required" class="form-control">
                                </div>

                            </div>
                            <div class="form-group col-md-6">
                                <label>Offer Banners <small>(Width: 1400px, Height: 420px)</small></label>
                                <div>
                                    <input type="file" name="coupon_banners[]" multiple class="form-control">
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
    $('#coupon_type').change(function() {
        var val = $(this).val();
        if (val == 3) {
            $('._Conditions').show();
            $('input[name="conditions[]"]').prop('checked', false);
        } else {
            $('input[name="conditions[]"]').prop('checked', false);
            $('._Conditions').hide();
        }
    });
</script>
@endsection