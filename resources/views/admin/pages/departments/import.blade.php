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

                <form method="POST" action="{{ route('admin.department.import') }}" class="w-100" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-lg-9 col-xl-12">
                        <div class="row align-items-center">
                            
                            <div class="form-group col-md-6">
                                <label>File</label>
                                <div><input type="file" name="file" class="form-control"isrequired="required"></div>
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
<script>
    $('.multi-field-wrapper').each(function() {
        var $wrapper = $('.multi-fields', this);
        $(".addRow2", $(this)).click(function(e) {
            $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
        });
        $('.multi-field .remove-field', $wrapper).click(function() {
            if ($('.multi-field', $wrapper).length > 1)
                $(this).parent('.multi-field').remove();
        });
    });

    var b = 1;

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