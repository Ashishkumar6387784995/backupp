@extends('admin.layout.default')

@section('packagemaster','active menu-item-open')
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
                                <input type="checkbox" name="priority" id="priority" onclick='addField()' value="1" @if($details->priority_sequence) checked @endif>
                                <label for="priority">Show on top</label> <br>
                                <span class="form-group col-md-12 appendPriority p-0">
                                    @if($details->priority_sequence)
                                    <label>Priority Sequence Number</label><input class="form-control" type="tel" id="" name="prioritysequence" value="{{$details->priority_sequence}}" placeholder="Priority sequence number" maxlength="3" required>
                                    @endif
                                </span>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Package Name </label>
                                <div><input type="text" name="package_name" value="{{$details->package_name}}" isrequired="required" class="form-control" placeholder="Enter Package Name"></div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Package Code </label>
                                <div><input type="text" name="package_code" value="{{$details->package_code}}" isrequired="required" class="form-control" placeholder="Enter Package Code"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Recommendation</label>
                                <div><input type="text" name="recommendation" value="{{$details->recommendation ? $details->recommendation : 'No special preparation required'}}" isrequired="required" class="form-control" placeholder="Enter Recommendation"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Sample Type</label>
                                <div><input type="text" name="sample_type" value="{{$details->sample_type ? $details->sample_type : ''}}" isrequired="required" class="form-control" placeholder="Enter Sample Type"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Gender</label>
                                <select class="form-control" name="gender" id="gender">
                                    <option value="">Select Gender</option>
                                    <option value="both" {{runTimeSelection('both',$details->gender)}}>Both</option>
                                    <option value="male" {{runTimeSelection('male',$details->gender)}}>Male</option>
                                    <option value="female" {{runTimeSelection('female',$details->gender)}}>Female</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Age Group</label>
                                <select class="form-control" name="age_group" id="age_group">
                                    <option value="">Select Age Group</option>
                                    <option value="all" {{runTimeSelection('all',$details->age_group)}}>All</option>
                                    <option value="5" {{runTimeSelection('5',$details->age_group)}}>5yrs+</option>
                                    <option value="18" {{runTimeSelection(18,$details->age_group)}}>18yrs+</option>
                                    <option value="45" {{runTimeSelection(45,$details->age_group)}}>45yrs+</option>
                                    <option value="60" {{runTimeSelection(60,$details->age_group)}}>60yrs+</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>MRP</label>
                                <div><input type="text" name="mrp" value="{{$details->mrp}}" isrequired="required" class="form-control number" placeholder="Enter MRP"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Selling Price</label>
                                <div><input type="text" name="selling_price" value="{{$details->selling_price}}" isrequired="required" class="form-control number" placeholder="Enter Selling Price"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Report TAT</label>
                                <div><input type="text" name="report_tat" value="{{$details->report_tat}}" isrequired="required" class="form-control" placeholder="Enter Report TAT"></div>
                            </div>


                            <div class="form-group col-md-12">
                                <label>Description</label>
                                <textarea class="form-control" id="" name="description" rows="10" cols="80" value="">{{$details->description}}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                @php
                                if ($details->sub_category_ids) {
                                $addedSubCategoryIds = explode(',',$details->sub_category_ids);
                                }else{
                                $addedSubCategoryIds = [];

                                }
                                $subCategories = getSubCategories(1);
                                @endphp
                                <label>Select Categories <small>(multiple)</small></label>
                                <select class="form-control" name="sub_category_ids[]" id="sub_category_ids" multiple>
                                    @if( $subCategories)
                                    @foreach( $subCategories as $subCategory)
                                    <option value="{{$subCategory->id}}" @if(in_array($subCategory->id,$addedSubCategoryIds)) selected @endif>{{$subCategory->category_name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Package Banner <small>(Width: 430px, Height: 555px)</small></label>
                                @if($details->banner)
                                <div class="_update_img_action">
                                    <a target="_black" href="{{asset('uploads/packages/'.$details->banner)}}" class="btn btn-success btn-sm">View</a> &nbsp;
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="updateImage(this)">Update</a>
                                    <br>
                                    <div class="_icon_display">
                                        <img src="{{asset('uploads/packages/'.$details->banner)}}" />
                                    </div>
                                </div>
                                @endif
                                <div class="image_file _update_img_file" style="{{$details->banner ? 'display:none' : ''}}">
                                    <input type="file" name="banner" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Sample Report <small>(Only pdf)</small></label>
                                @if($details->sample_report)
                                <div class="_update_img_action">
                                    <a target="_black" href="{{asset('uploads/sample/'.$details->sample_report)}}" class="btn btn-success btn-sm">View</a> &nbsp;
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="updateImage(this)">Update</a>

                                </div>
                                @endif
                                <div class="image_file _update_img_file" style="{{$details->sample_report ? 'display:none' : ''}}">
                                    <input type="file" name="sample_report" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                @php
                                if ($details->faqs_ids) {
                                $addedFaqs = json_decode($details->faqs_ids,1);
                                }else{
                                $addedFaqs = [];
                                }
                                $faqs = getAllFaqs(1);
                                @endphp
                                <label>Select Faqs <small>(multiple)</small></label>
                                <select class="form-control" name="faqs_ids[]" id="faqs_ids" multiple>
                                    @if( $faqs)
                                    @foreach( $faqs as $faq)
                                    <option value="{{$faq->id}}" @if(in_array($faq->id,$addedFaqs)) selected @endif>{{$faq->title}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Tests Count</label>
                                <div><input type="text" name="component_count" value="{{$details->component_count}}" class="form-control" placeholder="Eg. 10"></div>
                            </div>
                            @include('admin.layout.partials.extras.add-tests')

                            <div class="form-group col-md-12">
                                <div class="text-center"><button class="btn btn-success">Update</button></div>
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
    .search-text {
        width: 200px;
    }

    .test-list {
        border-radius: 5px;
        padding: 4px;
        border: 1px solid #afaeae;
        font-size: 14px;
        margin-left: -40px;
    }
</style>

<link rel="stylesheet" href="{{ asset('multiselect/bootstrap.multiselect.css') }}" />
@endsection

{{-- Scripts Section --}}
@section('scripts')
<script src="{{asset('multiselect/bootstrap.multiselect.js')}}"></script>
<?php $addedTestsArr = [];
if (isset($details->tests) && !empty($details->tests)) {
    $addedTests = json_decode($details->tests, 1);
} else {
    $addedTests = '';
}
if ($addedTests) {
    foreach ($addedTests as $testKey => $test) {
        $addedTestsArr[] = $test['test_id'];
    }
}
?>
<script>
    var stateId = '@if($details->state_id){{$details->state_id}}@endif';
    var cityId = '@if($details->city_id){{$details->city_id}}@endif';


    function addField() {
        var checkbox = document.getElementById('priority').checked;
        if (checkbox == true) {
            $('.appendPriority').append('<label>Priority Sequence Number</label><input class="form-control" type="tel" id="" name="prioritysequence" value="" placeholder="Priority sequence number" maxlength="3" required>');
        } else {
            $('.appendPriority input').remove();
            $('.appendPriority label').remove();
        }
    }
    var addedTest = '<?php if (count($addedTestsArr) > 0) {
                            echo json_encode($addedTestsArr);
                        } ?>';
    $(document).ready(function() {
        $("#searchTest").on("keyup", function() {
            var val = $(this).val().toLowerCase();
            $(".col_test_row").filter(function() {
                $(this).toggle($(this).attr('text-name').toLowerCase().indexOf(val) > -1)
            });
            if (val.length >= 3) {

                $.ajax({
                    type: 'POST',
                    url: APP_URL + '/ajax/fetchtests?query=' + val + '&_token={{csrf_token()}}',
                    dataType: 'json',

                    success: function(response) {
                        // console.log(response);
                        var option = '';

                        if (addedTest) {
                            var addedTestArr = JSON.parse(addedTest);
                        } else {
                            var addedTestArr = [];
                        }
                        console.log(addedTestArr);
                        $.each(response.Result, function(index, value) {
                            selected = '';
                            console.log(value.test_id.toString());
                            if ($.inArray(value.test_id.toString(), addedTestArr) != '-1') {
                                selected = 'checked';
                            } 
                            option += ` 
                            <div class="col-md-3 col_test_row" text-name="` + value.test_name + `">
                                <input type="checkbox" name="" class="form-check-input" id="_test_` + value.test_id + `" component='' value="` + value.test_id + `" testname="` + value.test_name + `" onchange="addRemoveTest(this)">
                                <label class="form-check-label" for="_test_` + value.test_id + `">` + value.test_name + `</label>
                            </div>
                            `;
                        })
                        $('.activeTests').html(option);

                    }
                })
            }
        });
        $('#faqs_ids').multiselect({
            nonSelectedText: 'Select Faqs',
            includeSelectAllOption: true,
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '100%'
        });
        $('#sub_category_ids').multiselect({
            nonSelectedText: 'Select Categories',
            includeSelectAllOption: true,
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '100%'
        });

    });
</script>
@endsection