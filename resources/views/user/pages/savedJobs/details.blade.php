@extends('user.layout.default')

@section('customermaster','active menu-item-open')
@section('content')
<div class="card card-custom">

    <div class="card-body">
        <div class="mb-7">
            <div class="row align-items-center">
                <div class="serp-content grid-content-pane">
                    
                    <div class="grid-aside-pane">
                        <div class="sticky-panel" style="display: none;">
                            <div class="jdv-panel" data-error="false" data-hidden="false" style="--offset: 88.59375px;">
                                <div class="jdv-content grid-content" data-hidden="false" id="showJobsDetails">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection

    {{-- Styles Section --}}
    @section('styles')
    <link rel="stylesheet" href="{{ asset('css/jobs.css')}}">
    <style>
        select.select2 {
            opacity: 1;
        }
    </style>
    @endsection

    {{-- Scripts Section --}}
    @section('scripts')

    <script>
        $(document).ready(function() {
            $('.select2').select2(); // Initialize Select2
        });
    </script>

<script>
    // Add a click event listener to job cards to fetch job details
    $(document).ready(function() {
        
        var slug = '{{$slug}}';
        console.log(slug);
        $('#showJobsDetails').empty();

        var baseUrl = window.location.origin;
        $.ajax({
            url: `${baseUrl}/jobDetailsApi/${slug}`,
            type: 'GET',
            dataType: 'json',
            success: function(response) {

            $('#showJobsDetails').empty();
            $('.sticky-panel').show();

            if (response.success && response.data) {
                console.log('Job details fetched:', response.data);
                var job = response.data;

                let salary = (job.price_from && job.price_to) ?
                    `$${job.price_from} - $${job.price_to} ${job.pay_type_required || ''}` :
                    'Salary not specified';

                let experienceBadge = '';
                if (job.job_experience) {
                    experienceBadge = `
                        <div class="badge -default-badge">
                        <div class="content">${job.job_experience.name}</div>
                        </div>`;
                }

                let jobTypeName = '';
                if (job.job_type) {
                    jobTypeName = `
                        <div class="badge -default-badge">
                        <div class="content">${job.job_type.name}</div>
                        </div>`;
                }


                let jobDescription = '';
                if (job.description) {
                    jobDescription = job.description;
                }

                // Calculate "Posted X days ago" from job.created_at
                let postedDate = new Date(job.created_at);
                let currentDate = new Date();

                // Strip the time part by setting both dates to midnight
                postedDate.setHours(0, 0, 0, 0);
                currentDate.setHours(0, 0, 0, 0);

                let postedText = '';

                // If the job was posted today
                if (postedDate.getTime() === currentDate.getTime()) {
                    postedText = 'Posted today';
                } else {
                    // Calculate the difference in days if posted in the past
                    let timeDifference = currentDate - postedDate; // in milliseconds
                    let daysAgo = Math.floor(timeDifference / (1000 * 3600 * 24)); // Convert to days

                    postedText = `Posted ${daysAgo} day${daysAgo > 1 ? 's' : ''} ago`;
                }

                $('#showJobsDetails').append(`
                    <div>
                        <div class="sticky-container">
                        <div class="-desktop-no-padding-top" id="job-info-container">
                            <h3 class="job-title heading -size-xxlarge -weight-700">${job.job_title ? job.job_title : 'Job Title Not Available'}</h3>
                            <div class="font-small" id="company-location-container">
                                <span class="company">${job.contact_company_name ? job.contact_company_name : 'Company Name Not Available'}</span>
                                <span class="divider">–</span><span class="location">${job.contact_address ? job.contact_address : 'Address Not Available'}</span>
                            </div>
                            <div class="badge -verified-employer-badge">
                                <i class="icon verified-employer-icon"></i>
                                <div class="content">Verified employer</div>
                            </div>
                            <div class="badge -default-badge">
                                <div class="content">${salary}</div>
                            </div>

                            ${experienceBadge}
                            
                            ${jobTypeName}

                            <div class="font-xsmall" id="job-meta"><span class="listed-date">${postedText}</span>, from <span class="site">Backupp</span></div>
                        </div>
                        <div class="blank-gap"></div>
                        </div>
                        <div class="job-description-container">
                        <strong>Job summary:</strong>
                        ${jobDescription}
                        </div>
                    </div>
                `);



            } else {
                $('#showJobsDetails').html('<p style="color: red;">Failed to fetch job details</p>');
            }
            },
            error: function(xhr) {
            console.error(xhr.responseText);
            // alert('Error fetching job details');
            $('#showJobsDetails').html('<p style="color: red;">Error fetching job details</p>');
            }
        });
    });
</script>
@endsection