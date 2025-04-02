@extends('admin.layout.default')

@section('industrymaster','active menu-item-open')
@section('content')
<div class="card card-custom">
    <!-- <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Edit Category
            </h3>
        </div>
    </div> -->
    <div class="card-body">
        <div class="mb-7">
            <div class="row align-items-center">

                <form method="POST" action="" class="w-100" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-lg-9 col-xl-12">
                        <div class="row align-items-center">
                            <div class="form-group col-md-12">
                                <label>Name</label>
                                <div><input type="text" name="name" value="{{$details->name}}" class="form-control" placeholder="Enter Category Name" isrequired="isrequired"></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Description</label>
                                <div>
                                    <textarea name="description" class="form-control" placeholder="Write Short Description">{{$details->description}}</textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <select name="status" id="status" class="form-control select2">
                                    <option value="">--select--</option>
                                    <option value="1"  {{ runTimeSelection('1', $details->status) }}>Active</option>
                                    <option value="2"  {{ runTimeSelection('2', $details->status) }}>Inactive</option>
                                </select>
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