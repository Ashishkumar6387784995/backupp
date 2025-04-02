@extends('company.layout.default')

@section('changePass','active menu-item-open')
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
                                <h4>Change Password</h4>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Old Password</label>
                                <div><input type="password" name="old_password" class="form-control" value="" isrequired="required"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>New Password </label>
                                <div><input type="password" name="password"  isrequired="required" class="form-control"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Confirm Password</label>
                                <div><input type="password" name="password_confirmation"  isrequired="required" class="form-control" ></div>
                            </div>
                           
                            <div class="form-group col-md-12">
                                <button class="btn btn-success" type="submit">Submit</button>
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


@endsection