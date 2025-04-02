@extends('admin.layout.default')

@section('industrymaster','active menu-item-open')
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
                                <label>Name</label>
                                <div><input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Enter Category Name" isrequired="required"></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Description</label>
                                <div>
                                    <textarea name="description" class="form-control" placeholder="Write Description"></textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Status</label>
                                <div>
                                    <select name="status" id="" class="form-control select2">
                                        <option value="">--select--</option>
                                        <option value="1">Active</option>
                                        <option value="2">Inactive</option>
                                    </select>
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
<style>
    .select2-container {
        width: 100% !important;
    }
</style>
@endsection

{{-- Scripts Section --}}
@section('scripts')
<script>
    $(document).ready(()=>{
        $('.select2').select2();
    });
</script>
@endsection