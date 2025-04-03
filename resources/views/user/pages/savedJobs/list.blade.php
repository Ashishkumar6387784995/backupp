@extends('user.layout.default')

@section('customermaster','active menu-item-open')
@section('content')
<div class="card card-custom">

    <div class="card-body">
        <div class="mb-7">
            <div class="row align-items-center">
                <div class="serp-content grid-content-pane">
                    <div class="jobresults" data-js-serp-email-alert-nudge-card="" id="jobresults">
                        <div class="backupp-sponsored-results">
                            
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
        jQuery(function($) {
            var baseUrl = window.location.origin;

            $.ajax({
                url: baseUrl + '/user/jobsListApi',
                type: 'GET',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success && Array.isArray(response.data)) {
                        console.log('Jobs fetched successfully!');

                        // Update job count
                        $('#total_number_of_jobs').html(response.data.length + ' jobs');

                        // Clear previous results
                        $('.backupp-sponsored-results').empty();

                        // Loop through job data and append to the results container
                        response.data.forEach(job => {

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

                            // Split the description into words and get the first 50 words
                            let first50Words = jobDescription.split(/\s+/).slice(0, 50).join(' ');

                            // If the description has more than 50 words, you can optionally append "..." to indicate truncation
                            if (jobDescription.split(/\s+/).length > 50) {
                                first50Words += '...';
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

                            $('.backupp-sponsored-results').append(`
                     <div id="backupp_jobs_${job.id}" class="job-card result sponsored-job premium-job spon-top" data-job-slug="${job.slug}" data-active="true">
                        <div class="top-container">
                           <div class="column">
                              <div class="first-row">
                                 <div class="freshness-badge-container">
                                    <div class="badge -new-job-badge">
                                       <div class="content">New to you</div>
                                    </div>
                                 </div>
                              </div>
                              <h2 class="job-title -one-line heading -size-medium -weight-500 -mb-0">
                                 ${job.job_title ? job.job_title : 'Job Title Not Available'}
                              </h2>
                           </div>
                        </div>
                        <div class="job-info">
                           <div class="info-container"><span class="job-company">${job.contact_company_name ? job.contact_company_name : 'Company Name Not Available'}</span></div>
                           <div class="info-container -last-row">
                              ${job.contact_address ? job.contact_address : 'Address Not Available'}
                           </div>
                        </div>
                        <div class="badges">
                           <div class="badge -default-badge">
                              <div class="content">${salary}</div>
                           </div>


                           ${experienceBadge}

                           ${jobTypeName}
                           
                           </div>
                        <div class="job-abstract">
                           ${first50Words}
                        </div>
                        <div class="bottom-container">
                           <span class="job-listed-date">${postedText}</span>
                            <a class="open-new-tab -link-cool" href="{{ url('/') }}/user/saved-jobs-details/${job.slug}" rel="nofollow" target="_blank">Open in new tab</a>
                        </div>
                     </div>
                  `);
                        });

                        // Automatically click the first job card if there are jobs available
                        if (response.data.length > 0) {
                            setTimeout(() => {
                                $('.backupp-sponsored-results .job-card:first').trigger('click');
                            }, 500);
                        }

                    } else {
                        // alert('Error: ' + (response.message || 'Unknown error'));
                        $('.backupp-sponsored-results').html('<p style="color: red;">'.response.message || 'Unknown error</p>');
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    // alert('Failed while fetching data. Please try again.');
                    $('.backupp-sponsored-results').html('<p style="color: red;">Failed while fetching data. Please try again.</p>');
                }
            });
        });
    </script>

    @endsection