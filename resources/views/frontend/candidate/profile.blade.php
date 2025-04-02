<div class="profile-dashboard">
    <div class="employers-details-wrap">
        <div class="employers-details-info">
            <div class="thumb">
                <div class="profile-icon">{{isset($users->first_name[0]) ? $users->first_name[0] : ''}}{{isset($users->last_name[0]) ? $users->last_name[0]: ''}}</div>
            </div>
            <div class="content">
                <h4 class="title">{{$users->first_name}} {{$users->last_name}}</h4>
                <h6 class=""><i class="icofont-email"></i> {{$users->email_id}}</h6>
                <ul class="info-list">
                    <li class="de"><i class="icofont-location-pin"></i> {{$users->city ? $users->name : 'NA' }} {{$users->state ? $users->name : 'NA' }}</li>
                    <li class="de"><i class="icofont-phone"></i> +91 {{$users->mobile_no ? $users->mobile_no : 'NA' }}</li>
                </ul>
            </div>
        </div>
        <div class="profile-details">
            <div class="row">
                <div class="edit-profile"><i class="icofont-edit"></i></div>
                <div class="col-md-4">
                    <label>Total Years of Experience</label>
                    <div class="de">{{$users->experience_years ? $users->experience_years : 0 }} Years {{$users->experience_months ? $users->experience_months : 0 }} Months</div>
                </div>
                <div class="col-md-4">
                    <label>Current Company</label>
                    <div class="de">{{isset($users->work[0]) ? $users->work[0]->company : 'NA' }}</div>
                </div>
                <div class="col-md-4">
                    <label>Current Designation</label>
                    <div class="de">{{isset($users->work[0]) ? $users->work[0]->designation : 'NA' }}</div>
                </div>
                <div class="col-md-4">
                    <label>Functional Area</label>
                    <div class="de">@if(isset($users->work[0]) && $users->work[0]->functionalArea)
                        {{ $users->work[0]->functionalArea->title}}
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <label>&nbsp; </label>
                    <div class="cl-border"> <a href="{{url('/account/cv/preview')}}">Preview Resume</a></div>
                </div>
                <div class="col-md-4">
                    <label>&nbsp; </label>
                    <div class="cl-border"> <a href="{{url('/account/cv/build')}}">Build a Resume</a> </div>
                </div>
            </div>
        </div>
    </div>
</div>