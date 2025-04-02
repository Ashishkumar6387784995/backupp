@extends('user.layout.default')

@section('customermaster','active menu-item-open')
@section('content')
<div class="card card-custom">

    <div class="card-body">
        <div class="mb-7">
            <div class="row align-items-center">

                <form method="POST" action="{{route('user.profile.update')}}" class="w-100" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-lg-9 col-xl-12">
                        <div class="row align-items-center">
                            <div class="form-group col-md-12">
                                <h4>Personal Info</h4>
                            </div>
                            <div class="form-group col-md-6">
                                <label> First Name</label>
                                <div><input type="text" name="first_name" value="{{$details->user->first_name}}" isrequired="required" class="form-control" placeholder="Enter First Name"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label> Last Name</label>
                                <div><input type="text" name="last_name" value="{{$details->user->last_name}}" isrequired="required" class="form-control" placeholder="Enter Last Name"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Mobile</label>
                                <div><input type="text" name="phone" value="{{$details->user->phone}}" isrequired="required" class="form-control" placeholder="Enter Mobile Number"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <div><input type="text" name="email" value="{{$details->user->email}}" isrequired="required" class="form-control" placeholder="Enter Email Address"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Date of Birth</label>
                                <div><input type="date" name="dob" max="{{date('Y-m-d')}}" value="{{$details->user->dob}}" isrequired="required" class="form-control" placeholder="Enter Date Of Birth"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Gender</label>
                                <select class="form-control" name="gender" id="gender" isrequired="required">
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ runTimeSelection($details->user->gender, 'male')}}>Male</option>
                                    <option value="female" {{ runTimeSelection($details->user->gender, 'female')}}>Female</option>
                                    <option value="other" {{ runTimeSelection($details->user->gender, 'other')}}>Other</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Skill</label>
                                <div>
                                    <select name="skills[]" id="skills" class="form-control select2" multiple>
                                        @if($getSkills = getSkills())
                                        @foreach($getSkills as $skill)
                                        <option value="{{$skill->id}}" data-name="{{$skill->name}}" @if (in_array($skill->id,$candidate_skills))
                                            selected 
                                         @endif>{{$skill->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Language</label>
                                <select class="form-control select2" name="language_id[]" id="languages" multiple>
                                    <option value="">Languages</option>
                                    @if($languages = getLanguage())
                                    @foreach($languages as $language)
                                    <option value="{{$language->id}}" data-name="{{$language->name}}" @if (in_array($language->id,$candidate_languages))
                                       selected 
                                    @endif>{{$language->language}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Marital Status</label>
                                <select class="form-control" name="marital_status_id " id="" isrequired="required">
                                    <option value="">Marital Status</option>
                                    @if($getMartialStatus = getMartialStatus())
                                    @foreach($getMartialStatus as $martial)
                                    <option value="{{$martial->id}}" data-name="{{$martial->marital_status}}" {{runTimeSelection($martial->id,$details->marital_status_id)}}>{{$martial->marital_status}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Nationality</label>
                                <div><input type="text" name="nationality" value="{{$details->nationality}}" isrequired="required" class="form-control" placeholder="Enter Email Address"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">National ID Card</label>
                                <div><input type="text" name="national_id_card" value="{{$details->national_id_card}}" isrequired="required" class="form-control" placeholder="Enter Email Address"></div>
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
                                <label>State</label>

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
                                <label>Experience: (In Years)</label>
                                <div><input type="number" name="experience" value="{{$details->experience}}" isrequired="required" class="form-control" placeholder=""></div>
                            </div>
                           
                            <div class="form-group col-md-6">
                                <label>Career Level</label>
                                @php
                                    $getCareerLavel = getCareerLavel();
                                @endphp
                                <div>
                                    <select name="career_level_id" id="" class="form-control">
                                        <option value="">--Select--</option>
                                        @if ($getCareerLavel)
                                            @foreach ($getCareerLavel as $item)
                                             <option value="{{$item->id}}" {{runTimeSelection($item->id,$details->career_level_id)}}>{{$item->level_name}}</option>
                                            @endforeach
                                            
                                        @endif
                                    </select>
                                </div>
                            </div>


                            <div class="form-group col-md-6">
                                <label>Industry</label>
                                <div>
                                    @php $Industry = getIndustry();  @endphp
                                    <select name="industry_id" class="form-control">
                                        <option value="">-Select-</option>
                                        @if($Industry)
                                        @foreach($Industry as $key => $value)
                                        <option value="{{$value['id']}}" {{runTimeSelection($value['id'],$details->industry_id)}}>{{$value['name']}}</option>
                                        @endforeach
                                        @endif
                                        from db
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Functional Area</label>
                                <div>
                                    @php $functionalArea = getFunctionalArea(); @endphp
                                    <select name="functional_area_id" class="form-control">
                                        <option value="">-Select-</option>
                                        @if($functionalArea)
                                        @foreach($functionalArea as $value)
                                        <option value="{{$value['id']}}" {{runTimeSelection($value['id'],$details->functional_area_id)}}>{{$value['title']}}</option>
                                        @endforeach
                                        @endif
                                        
                                    </select>
                                </div>
                            </div>
                           

                            <div class="form-group col-md-6">
                                <label>Current Salary</label>
                                <div>
                                    <input type="text" name="current_salary" value="{{$details->current_salary}}" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Company Name</label>
                                <div>
                                    <input type="text" name="company_name" value="{{$details->company_name}}" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Expected Salary</label>
                                <div>
                                    <input type="text" name="expected_salary" value="{{$details->expected_salary}}" class="form-control" placeholder="">
                                </div>
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
                                <label>Immediate Available</label>
                                <div>
                                    <select id="immediate_available" name="immediate_available" class="form-control">
                                       <option value="">--Select--</option>
                                       <option value="1" {{ ($details->immediate_available == 1) ? 'selected' :'' }}>Available</option>
                                       <option value="2" {{ ($details->immediate_available == 2) ? 'selected' :'' }}>Not Available</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="form-group col-md-6">
                                <label>Status</label>
                                <div>
                                    <select id="is_active" name="is_active" class="form-control">
                                        <option value="">--Select--</option>
                                        <option value="1" {{ ($details->user->is_active == 1) ? 'selected' :'' }}>Active</option>
                                        <option value="2" {{ ($details->user->is_active == 2) ? 'selected' :'' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Is Verified</label>
                                <div>
                                    <select id="is_verified" name="is_verified" class="form-control">
                                        <option value="">--Select--</option>
                                        <option value="1" {{ ($details->user->is_verified == 1) ? 'selected' :'' }}>Yes</option>
                                        <option value="2" {{ ($details->user->is_verified == 2) ? 'selected' :'' }}>No</option>
                                    </select>
                                </div>
                            </div> --}}
                            <div class="form-group col-md-6">
                                <label>Address</label>
                                <div>
                                    <textarea name="address" id="" cols="3" rows="2" class="form-control">
                                        {{ $details->address }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Logo</label>
                                <div>
                                    <input type="file" name="profile_logo" id="" class="form-control">
                                    @if ($details->user->profile_logo)
                                      <img src="{{ asset('uploads/customers/logo/'.$details->user->profile_logo) }}" alt="logo" height="30">  
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <center><button class="btn btn-success" type="submit">Update</button></center>
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
    select.select2 {
        opacity: 1;
    }
</style>
@endsection

{{-- Scripts Section --}}
@section('scripts')
<script>
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
    $(document).ready(function() {
        $('#skills').select2({
            placeholder: "Select skills",
        });
        $('#languages').select2({
            placeholder: "Select language",
        });
        
    });

     

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