@extends('admin.layout.default')

@section('departmentmaster','active menu-item-open')
@section('content')
<style>
    .btn.btn-danger.remove-field.text-right {
        right: 60px;
        position: absolute;
        bottom: 23px;
    }
</style>
<div class="card card-custom">

    <div class="card-body">
        <div class="mb-7">
            <div class="row align-items-center">

                <form method="POST" action="" class="w-100" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-lg-9 col-xl-12">
                        <div class="row align-items-center">
                            
                            <div class="form-group col-md-6">
                                <label>Department Name</label>
                                <div><input type="text" name="department_name" class="form-control" value="{{$details->department_name}}" isrequired="required" placeholder="Enter Department Name"></div>
                            </div>
                        
                            <div class="form-group col-md-6">
                                <label for="status">Status</label>
                                <div>
                                    <select name="is_active" id="status" class="form-control">
                                        <option value="">--select--</option>
                                        <option value="1" {{runTimeSelection('1',$details->is_active)}}>Active</option>
                                        <option value="2" {{runTimeSelection('0',$details->is_active)}}>Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <center><button class="btn btn-success" type="submit">Submit</button></center>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://ckeditor.com/docs/vendors/4.11.3/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(function() {
        CKEDITOR.replace('editor1');
    });
</script>
<script>
    var wrapper = $('.multi-fields');
    $(".addRow2").click(function(e) {
        $('.multi-field:first-child').clone(true).appendTo('.multi-field-wrapper .multi-fields').find('input').val('');
    });
    $('.multi-field .remove-field', wrapper).click(function() {
        if ($('.multi-field', wrapper).length > 1)
            $(this).parent('.multi-field').remove();
    });
</script>
@endsection

{{-- Styles Section --}}
@section('styles')
@endsection

{{-- Scripts Section --}}
@section('scripts')
<script>
    var structure = `<?php if (isset($details->structure) && !empty($details->structure)) {
                            echo $details->structure;
                        } ?>`;
    if (structure) {
        var structureArr = JSON.parse(structure);
        if (structureArr.length > 0) {
            var strHtml = '';
            structureArr.map((value, index) => {
                strHtml += `
                <div class="form-group col-md-6">
                    <input type="text" name="field_title[]" class="form-control" value="` + value.title + `">
                </div>
                <div class="form-group col-md-6">
                    <input type="text" name="field_value[]" value="` + value.value + `" class="form-control">
                </div>`;
            });
            $('._structureHTML').html(strHtml);
        }
    }
    var b = '@if(isset($brochures)){{count($brochures)}}@else{{0}}@endif';

    function addNewBrochureRow() {
        b = ++b;
        var htm = `
        <div class="row mt-3 _b_row_` + b + `">
                                    <div class="col-6">
                                        <input type="text" name="brochures_title[` + b + `]" class="form-control">
                                    </div>
                                    <div class="col-5 image_file _update_img_file">
                                        <input type="file" name="brochures[` + b + `]" class="form-control" accept=".pdf">
                                    </div>
                                    <div class="col-1">
                                        <div class="btn btn-danger btn-sm" onclick="removeB(` + b + `)"><i class="fa fa-minus"></i></div>
                                    </div>
                                </div>
                                `;
        $('._brochure_new_rows').append(htm);
    }

    function removeB(id) {
        $('._b_row_' + id).remove();
    }
</script>
@endsection