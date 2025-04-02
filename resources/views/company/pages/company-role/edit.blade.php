@extends('company.layout.default')

@section('jobsmaster','active menu-item-open')
@section('content')
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-3 pb-0">
        <div class="card-title">
            <h3 class="card-label">Edit Role & User</h3>
        </div>
    </div>
    <div class="card-body">
        <div class="mb-7">
            <div class="row align-items-center">
                <form method="POST" action="" class="w-100" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-lg-9 col-xl-12">
                        <div class="row align-items-center">
                            <div class="form-group col-md-6">
                                <label>Name</label>
                                <div><input type="text" name="name" value="{{$details->name}}" isrequired="required" class="form-control" placeholder="Enter User Name"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email/User Name </label>
                                <div><input type="email" name="email" value="{{$details->email }}" isrequired="required" class="form-control" placeholder="Enter Email/User Name"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Mobile No.</label>
                                <div><input type="text" name="mobile" value="{{$details->mobile}}" isrequired="required" class="form-control" placeholder="Enter Mobile Number"></div>
                            </div>
                            {{-- <div class="form-group col-md-6">
                                <label>Password</label>
                                <div><input type="password" name="password" class="form-control" placeholder="Enter Password" isrequired="required"></div>
                            </div> --}}
                            <div class="form-group col-md-6">
                                <label>Department</label>
                                <div>
                                    <select name="department_id" id="" class="form-control select2" isrequired="required">
                                        <option value="">--select--</option>
                                        @if ($departments)
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}" {{runTimeSelection($details->department_id,$department->id)}}>{{ $department->department->department_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label>Role</label>
                                <div>
                                    <select name="role_id" id="" class="form-control select2" isrequired="required">
                                        <option value="">--select--</option>
                                        @if ($roles)
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}" {{runTimeSelection($details->role_id,$role->id)}}>{{ $role->role }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Status</label>
                                <select name="status" id="" class="form-control select2" isrequired="required">
                                    <option value="">--select--</option>
                                    <option value="1" {{runTimeSelection($details->status,1)}}>Active</option>
                                    <option value="2" {{runTimeSelection($details->status,2)}}>Inactive</option>
                                </select>
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
    .modal .modal-header .close span {
        display: block;
        font-size: 27px;
        color: #000;
        /* background: darkred; */
    }
    .select2-container {
        width: 100% !important;
    }
</style>
@endsection

{{-- Scripts Section --}}
@section('scripts')
<script type="text/javascript">
    $(function() {
        $('.select2').select2();
    });
</script>
@endsection