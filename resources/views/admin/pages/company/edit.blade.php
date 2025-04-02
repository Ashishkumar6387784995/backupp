@extends('admin.layout.default')

@section('employermaster','active menu-item-open')
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
                                <h4>Edit Company</h4>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Company Name</label>
                                <div><input type="text" name="name" value="{{$details->user->first_name}}" isrequired="required" class="form-control" placeholder="Enter User Name"></div>
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
                                <label>CEO Name</label>
                                <div><input type="text" name="ceo_name" value="{{ $details->ceo }}" isrequired="required" class="form-control" placeholder="Enter Mobile Number"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Industry</label>
                                <div>
                                    @php $Industry = getIndustry(); @endphp
                                    <select name="industry_id" class="form-control select2" id="industryID_">
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
                            <div class="form-group col-md-6">
                                <label>Location</label>
                                <div><input type="text" name="locaction" value="{{ $details->location }}" class="form-control" placeholder=""></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>2nd Office Location</label>
                                <div><input type="text" name="locaction2" value="{{ $details->location2 }}" class="form-control" placeholder=""></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Company Details</label>
                                <div>
                                    <textarea class="form-control" name="details" id="" cols="3" rows="5">
                                        {{ $details->details }}
                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>No. of Office</label>
                                <div><input type="text" name="no_of_offices" value="{{ $details->no_of_offices }}" isrequired="required" class="form-control" placeholder=""></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>No. of employees</label>
                                <div><input type="text" name="employees_count" value="{{ $details->employees_count }}" isrequired="required" class="form-control" placeholder=""></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Company Website</label>
                                <div><input type="text" name="company_website" value="{{ $details->website }}" class="form-control" placeholder=""></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Fax</label>
                                <div><input type="text" name="fax" value="{{ $details->fax }}" class="form-control" placeholder=""></div>
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
                            <div class="form-group col-md-6">
                                <label>Logo</label>
                                <div><input type="file" name="profile_logo" class="form-control"></div>
                                @if ($details->user->profile_logo)
                                    <img src="{{asset('uploads/company/logo/'.$details->user->profile_logo)}}" alt="logo" height="30">
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label>Status</label>
                                <div>
                                    <select name="is_active" id="status" class="form-control">
                                        <option value="">-Select-</option>
                                        <option value="1" {{ $details->user->is_active == 1 ? 'selected' : ''  }}>Active</option>
                                        <option value="2" {{ $details->user->is_active == 2 ? 'selected' : ''  }}>Inactive</option>
                                    </select>
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

@endsection

{{-- Styles Section --}}
@section('styles')

@endsection

{{-- Scripts Section --}}
@section('scripts')
<script>
    var countryId = '@if(isset($details->user->country_id)){{$details->user->country_id}}@endif';
    var stateId = '@if(isset($details->user->state_id)){{$details->user->state_id}}@endif';
    var cityId = '@if(isset($details->user->city_id)){{$details->user->city_id}}@endif';
    // var company_state_id = '{{$details->company_state_id}}';
    // var company_city_id = '{{$details->company_city_id}}';
    // setTimeout(function() {
    //     if (stateId) {
    //         console.log($('select[name=state_id]'));
    //         $('select[name=state_id]').focus().change();
    //     }
    //     if (company_state_id) {
    //         $('#company_state').change();
    //     }
    // }, 500);
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
                    $('#state').append('<option value="'+ state.id +'" '+ selected +'>'+ state.name +'</option>');
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
                    $('#city').append('<option value="'+ city.id +'" '+ selected +'>'+ city.name +'</option>');
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
                        $('#state').append('<option value="'+ state.id +'">'+ state.name +'</option>');
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
                        $('#city').append('<option value="'+ city.id +'">'+ city.name +'</option>');
                    });
                }
            });
        }
    });
});

</script>
@endsection