@extends('company.layout.default')

@section('manageProfile','active menu-item-open')
@section('content')
<div class="card card-custom">

    <div class="card-body">
        <div class="mb-7">
            <div class="row align-items-center">

                <form method="POST" action="{{ route('company.profile.update') }}" class="w-100" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-lg-9 col-xl-12">
                        <div class="row align-items-center">

                            <div class="form-group col-md-12">
                                <h4>Company Profile</h4>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Company Name</label>
                                <div><input type="text" name="name" value="{{$details->user->first_name}}" isrequired="required" class="form-control" placeholder="Company Name"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email </label>
                                <div><input type="email" name="email" value="{{$details->user->email}}" isrequired="required" class="form-control" placeholder="Enter Email"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Phone</label>
                                <div><input type="text" name="phone" value="{{$details->user->phone}}" isrequired="required" class="form-control" placeholder="Enter Mobile Number"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>ABN/GST No</label>
                                <div><input type="text" name="gst_no" value="{{ $details->gst_no }}" isrequired="required" class="form-control" placeholder="ABN/GST No"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Company Website</label>
                                <div><input type="text" name="company_website" value="{{ $details->website }}" class="form-control" placeholder=""></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>No. of Office</label>
                                <div><input type="text" name="no_of_offices" value="{{ $details->no_of_offices }}" isrequired="required" class="form-control" placeholder=""></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Industry</label>
                                <div>
                                    @php $Industry = getIndustry(); @endphp
                                    <select name="industry_id" class="form-control select2">
                                        <option value="">-Select-</option>
                                        @if($Industry)
                                        @foreach($Industry as $value)
                                        <option value="{{$value['id']}}" {{runTimeSelection($value['id'],$details->industry_id)}}>{{$value['name']}}</option>
                                        @endforeach
                                        @endif

                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Ownership Type</label>
                                <div>
                                    @php $ownerShip = getOwnerShipType(); @endphp
                                    <select name="ownership_type_id" class="form-control select2">
                                        <option value="">-Select-</option>
                                        @if($ownerShip)
                                        @foreach($ownerShip as $key => $value)
                                        <option value="{{$key}}" {{runTimeSelection($key,$details->ownership_type_id)}}>{{$value}}</option>
                                        @endforeach
                                        @endif

                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Country </label>
                                @php
                                $countries = getCountries();

                                @endphp
                                <select class="form-control select2" name="country_id" id="country" isrequired="required">
                                    <option value="">Select Country</option>
                                    @if($countries)

                                    @foreach($countries as $key => $country)
                                    <option value="{{$key}}" data-name="{{$country}}" {{runTimeSelection($key,$details->user->country_id)}}>{{$country}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>State </label>

                                <select class="form-control select2" name="state_id" id="state" isrequired="required">
                                    <option value="">-Select-</option>

                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>City </label>
                                <select class="form-control select2" name="city_id" id="city" isrequired="required">
                                    <option value="">Select City</option>

                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Pincode</label>
                                <div><input type="text" name="pincode" value="{{$details->user->pincode}}" class="form-control number" placeholder=""></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Size</label>
                                <div>
                                    <select class="form-control" name="company_size_id" id="state" isrequired="required">
                                        <option value="">Select Size</option>
                                        @if($companySize = getCompanySize())
                                        @foreach($companySize as $key=>$size)
                                        <option value="{{$key}}" data-name="{{$size}}" {{runTimeSelection($key,$details->company_size_id)}}>{{$size}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Established Year</label>
                                <div><select name="established_in" id="established_in" class="form-control">
                                        @for ($i = date('Y'); $i > 1990; $i--)
                                        <option value="{{ $i }}" {{runTimeSelection($i,$details->established_in)}}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>About Company</label>
                                <div>
                                    <textarea class="form-control" name="details" id="" cols="3" rows="5">
                                    {{ $details->details }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-12 mb-2" id="newRow"></div>
                            <div class="form-group col-md-12 mb-0" id="newRow">
                                <hr>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <h3>Company Contact Person Details:</h3>
                            </div>

                            {{-- <div class="form-group col-md-12">
                                    <h5>Contact Person Name</h5>
                                </div> --}}
                            <div class="form-group col-md-4">
                                <label>First Name</label>
                                <div>
                                    <input type="text" name="cp_first_name" value="{{ $details->cp_first_name }}" class="form-control" placeholder="First Name" isrequired="required">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Middle Name</label>
                                <div>
                                    <input type="text" name="cp_middle_name" value="{{ $details->cp_middle_name }}" class="form-control" placeholder="Middle Name" isrequired="required">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Last Name</label>
                                <div>
                                    <input type="text" name="cp_last_name" value="{{ $details->cp_last_name }}" class="form-control" placeholder="Last Name" isrequired="required">
                                </div>
                            </div>


                            <div class="form-group col-md-6">
                                <label>Designation</label>
                                <div>
                                    <select name="cp_designation" id="" class="form-control select2" isrequired="required">
                                        <option value="">-- Select Designation --</option>
                                        @if (!empty($designation_categories))
                                        @foreach ($designation_categories as $designation_cate)
                                        <optgroup label="{{$designation_cate->name}}">
                                            @if (!empty($designation_cate->designation))
                                            @foreach ($designation_cate->designation as $designation)
                                            <option value="{{$designation->id}}" {{runTimeSelection($designation->id,$details->cp_designation)}}>{{$designation->name}}</option>
                                            @endforeach
                                            @endif
                                        </optgroup>
                                        @endforeach
                                        @endif

                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Phone</label>
                                <div><input type="text" name="cp_phone" value="{{ $details->cp_phone }}" class="form-control" placeholder="Phone" isrequired="required"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <div><input type="text" name="cp_email" value="{{ $details->cp_email }}" class="form-control" placeholder="Email" isrequired="required"></div>
                            </div>

                            <div class="form-group col-md-12 mb-2" id="newRow"></div>
                            <div class="form-group col-md-12 mb-0" id="newRow">
                                <hr>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <h3>Office Location:</h3>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="card card-custom">
                                    <div class="card-header flex-wrap border-0 pt-3 pb-0">
                                        <div class="card-title">
                                            <h3 class="card-label">Location</h3>
                                        </div>
                                        <div class="card-toolbar">
                                            <a href="javascript:void(0);" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#exampleModal">
                                                <i class="la la-plus"></i>Add Location</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <!--begin: Datatable-->
                                        <table class="table table-bordered table-hover" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Address</th>
                                                    <th>Managers</th>
                                                    <th>Employes</th>
                                                    <th>Staff Login</th>
                                                    <th class="custom_action">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!empty($company_locations))
                                                @foreach ($company_locations as $clocation)
                                                <tr>
                                                    <td>{{ $clocation->location_name }}</td>
                                                    <td>{{ $clocation->address }}</td>
                                                    <td>{{ $clocation->manager_count }} Manager</td>
                                                    <td>{{ $clocation->employee_count }} Employee</td>
                                                    <td>{{ $clocation->login_url }}</td>
                                                    <td>
                                                        <a href="?edit-location={{$clocation->id}}" class="btn btn-info btn-sm iconBtn_">
                                                            <i class="la la-edit"></i>
                                                        </a>
                                                        <a href="?location-qr={{$clocation->id}}" class="btn btn-info btn-sm iconBtn_" title="View QR Code">
                                                            <i class="las la-eye"></i>
                                                        </a>
                                                        <a href="{{ url('company/location/delete/'.$clocation->id) }}" class="btn btn-danger btn-sm iconBtn_" onclick="return confirm('Do you want to delete?');">
                                                            <i class="las la-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach

                                                @endif
                                            </tbody>
                                        </table>
                                        <!--end: Datatable-->
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12 mb-2" id="newRow"></div>
                            <div class="form-group col-md-12 mb-0" id="newRow">
                                <hr>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <h3>Social Media URLS:</h3>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Facebook URL</label>
                                <div><input type="text" name="facebook_url" value="{{ $details->user->facebook_url }}" class="form-control" placeholder=""></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Twitter URL</label>
                                <div><input type="text" name="twitter_url" value="{{ $details->user->twitter_url }}" class="form-control" placeholder=""></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Linkedin URL</label>
                                <div><input type="text" name="linkedin_url" value="{{ $details->user->linkedin_url }}" class="form-control" placeholder=""></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Google Plus URL</label>
                                <div><input type="text" name="google_plus_url" value="{{ $details->user->google_plus_url }}" class="form-control" placeholder=""></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Pinterest URL</label>
                                <div><input type="text" name="pinterest_url" value="{{ $details->user->pinterest_url }}" class="form-control" placeholder=""></div>
                            </div>
                            <div class="form-group col-md-12 mb-2" id="newRow"></div>
                            <div class="form-group col-md-12 mb-0" id="newRow">
                                <hr>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <h3>Logo:</h3>
                            </div>
                            <div class="form-group col-md-6">
                                <div>
                                    <input type="file" name="profile_logo" value="" class="form-control">
                                    @if ($details->user->profile_logo)
                                    <div class="mt-4">
                                        <img src="{{ asset('uploads/company/logo/'.$details->user->profile_logo) }}" height="30px" alt="">
                                    </div>
                                    @endif
                                </div>
                            </div>


                            <!-- code for manage company sponsers  -->
                            <div class="company_sponsers col-md-12">
                                <div class="form-group col-md-12 mb-3">
                                    <h3>Sponsors Company:</h3>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="card card-custom">
                                        <div class="card-header flex-wrap border-0 pt-3 pb-0">
                                            <div class="card-title">
                                                <h3 class="card-label">Company</h3>
                                            </div>
                                            <div class="card-toolbar">
                                                <a href="javascript:void(0);" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#exampleModalNew">
                                                    <i class="la la-plus"></i>Add Sponser</a>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <!--begin: Datatable-->
                                            <table class="table table-bordered table-hover" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Short Description</th>
                                                        <th>Logo</th>
                                                        <th class="custom_action">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (!empty($company_sponsers))
                                                    @foreach ($company_sponsers as $csponser)
                                                    <tr>
                                                        <td>{{ $csponser->company_name }}</td>
                                                        <td>{{ $csponser->company_description }}</td>
                                                        <td> 
                                                            <a href="{{url('uploads/company/sponsor/' . $csponser->company_logo)}}" target="_blank" rel="noopener noreferrer">
                                                                <img src="{{ asset('uploads/company/sponsor/' . $csponser->company_logo) }}" alt="logo" height="50px;">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="?edit-sponsor={{$csponser->id}}" class="btn btn-info btn-sm iconBtn_">
                                                                <i class="la la-edit"></i>
                                                            </a>
                                                            
                                                            <a href="{{ url('company/sponsor/delete/'.$csponser->id) }}" class="btn btn-danger btn-sm iconBtn_" onclick="return confirm('Do you want to delete?');">
                                                                <i class="las la-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach

                                                    @endif
                                                </tbody>
                                            </table>
                                            <!--end: Datatable-->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <button class="btn btn-success" type="submit">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('company.pages.profile.location_modal')
@include('company.pages.profile.sponsers_modal')

@endsection

{{-- Styles Section --}}
{{-- Styles Section --}}
@section('styles')
<!-- <link href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
<style>
    .iconBtn_ {
        height: 26px;
        width: 28px;
    }

    .iconBtn_ span,
    .iconBtn_ i {
        display: block !important;
        font-size: 27px;
    }

    .iconBtn_ span,
    .iconBtn_ i {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .select2-container {
        width: 100% !important;
    }

    .modal-body {
        max-height: 80vh;
        /* Ensures content is scrollable */
        overflow-y: auto;
    }

    #exampleModal {
        overflow: visible;
    }

    /* Custom Scrollbar for WebKit Browsers */
    #exampleModal .modal-body::-webkit-scrollbar {
        width: 8px;
    }

    #exampleModal .modal-body::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    #exampleModal .modal-body::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }

    #exampleModal .modal-body::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    /* Custom Scrollbar for Firefox */
    #exampleModal .modal-body {
        scrollbar-width: thin;
        scrollbar-color: #888 #f1f1f1;
    }

    #locationQrDetails .modal-content {
        min-width: 700px;
    }
</style>
@endsection

{{-- vendors --}}


{{-- Scripts Section --}}
@section('scripts')
@if (!empty($locationDetails))
<script>
    $(document).ready(() => {
        $('#locationDetails').modal('show');
    });
</script>
@endif
@if (!empty($locationQrDetails))
<script>
    $(document).ready(() => {
        $('#locationQrDetails').modal('show');
    });
</script>
@endif

@if (!empty($sponsorDetails))
<script>
    $(document).ready(() => {
        $('#sponsorDetails').modal('show');
    });
</script>
@endif
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $('.dataTables_filter label input[type=search]').addClass('form-control form-control-sm');
        $('.dataTables_length select').addClass('custom-select custom-select-sm form-control form-control-sm');
    });
    var countryId = '@if(isset($details->user->country_id)){{$details->user->country_id}}@endif';
    var stateId = '@if(isset($details->user->state_id)){{$details->user->state_id}}@endif';
    var cityId = '@if(isset($details->user->city_id)){{$details->user->city_id}}@endif';

    if (countryId) {
        loadStates(countryId, stateId);
    }
    if (stateId) {
        loadCities(stateId, cityId);
    }

    // Function to Load States
    function loadStates(countryId, selectedState) {
        $.ajax({
            url: '{{url("get-states")}}/' + countryId,
            type: 'GET',
            success: function(states) {
                $.each(states, function(key, state) {
                    var selected = (selectedState && state.id == selectedState) ? 'selected' : '';
                    $('#state').append('<option value="' + state.id + '" ' + selected + '>' + state.name + '</option>');
                });

                if (selectedState) {
                    $('#state').val(selectedState).trigger('change');
                }
            }
        });
    }

    // Function to Load Cities
    function loadCities(stateId, selectedCity) {
        $.ajax({
            url: '{{url("get-cities")}}/' + stateId,
            type: 'GET',
            success: function(cities) {
                $.each(cities, function(key, city) {
                    var selected = (selectedCity && city.id == selectedCity) ? 'selected' : '';
                    $('#city').append('<option value="' + city.id + '" ' + selected + '>' + city.name + '</option>');
                });

                if (selectedCity) {
                    $('#city').val(selectedCity).trigger('change');
                }
            }
        });
    }
</script>
<script>
    $(document).ready(function() {
        $('.select2').select2(); // Initialize Select2

        // Load States when a Country is selected
        $('#country').on('change', function() {
            var country_id = $(this).val();
            $('#state').empty().append('<option value="">Select State</option>'); // Reset states
            $('#city').empty().append('<option value="">Select City</option>'); // Reset cities

            if (country_id) {
                $.ajax({
                    url: '{{ url("get-states") }}/' + country_id,
                    type: 'GET',
                    success: function(states) {
                        $.each(states, function(key, state) {
                            console.log(state);
                            $('#state').append('<option value="' + state.id + '">' + state.name + '</option>');
                        });
                    }
                });
            }
        });

        // Load Cities when a State is selected
        $('#state').on('change', function() {
            var _stateId = $(this).val();
            $('#city').empty().append('<option value="">Select City</option>'); // Reset cities

            if (_stateId) {
                $.ajax({
                    url: '{{ url("get-cities") }}/' + _stateId,
                    type: 'GET',
                    success: function(cities) {
                        $.each(cities, function(key, city) {
                            $('#city').append('<option value="' + city.id + '">' + city.name + '</option>');
                        });
                    }
                });
            }
        });
    });
</script>
<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" type="text/javascript"></script>

@endsection