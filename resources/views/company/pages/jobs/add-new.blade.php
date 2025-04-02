@extends('company.layout.default')

@section('jobsmaster','active menu-item-open')
@section('content')
<div class="col-xl-12">
   <div class="row">
      <div class="col-sm-12">
         <form id="multiStepForm" action="#" method="post" enctype="multipart/form-data">
            <div class="step row" id="step1">
               <div class="col-sm-7">
                  <div class="card">
                     <div class="card-body">
                        <h3 class="text-center">Step 1: Create Job</h3>
                        <div class="mb-3 mt-6">
                           <label for="formFile" class="form-label">Logo(optional)</label>
                           <input class="form-control" name="logo" onchange="loadFile(event)" type="file" accept="image/png, image/jpg, image/jpeg" id="logo">
                        </div>
                        <div class="mb-3">
                           <label class="form-label">Job Title <span class="text-danger">*</span> </label>
                           <input name="title" type="text" id="job_title" onkeyup="copyValue(this.value,'titleprev');" class="form-control" placeholder="Enter Job Title" isrequired="required">
                        </div>
                        <div class="mb-3">
                           <label class="form-label">Job Type <span class="text-danger">*</span></label>
                           <div class="bg-light">
                              <div class="row align-items-center">
                                 <div class="col">
                                    <select class="form-control select2" name="job_type" id="job_type" isrequired="required">
                                       <option class="bs-title-option" value="">Select Job Type
                                       </option>
                                       @php
                                       $jobTypes = jobType();
                                       @endphp
                                       @if (!empty($jobTypes))
                                       @foreach ($jobTypes as $key => $jtype)
                                       <option value="{{ $jtype->id }}">{{ $jtype->name }}</option>
                                       @endforeach
                                       @endif
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="mb-3">
                           <label class="form-label">Job Category<span class="text-danger">*</span></label>
                           <div class="bg-light">
                              <div class="row align-items-center">
                                 <div class="col">
                                    <select class="form-control select2" name="job_category" title="" id="job_category" isrequired="required">
                                       <option selected="" value="">Select Category</option>
                                       @php
                                       $categories = getAllCategories();
                                       @endphp
                                       @if (!empty($categories))
                                       @foreach ($categories as $cate)
                                       <option value="{{ $cate->id }}">{{ $cate->category_name }}</option>
                                       @endforeach
                                       @endif
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="mb-3">
                           <label class="form-label">Job Description <span class="text-danger">*</span></label>
                           <textarea name="description" id="description" onkeyup="copyValue(this.value,'descriptionprev');" class="form-control" rows="3" isrequired="required"></textarea>
                        </div>
                        <div class="row ">
                           <div class="col-md-12 mb-3">
                              <label class="form-label">No. of Staff Required for this Job <span class="text-danger">*</span></label>
                              <input name="No_of_Workers" class="form-control" type="number" min="0" id="No_of_Workers" value="" onkeyup="copyValue(this.value,'No_of_Workers_prev','No_of_Workers_title');" placeholder="No. of Staff required" isrequired="required">
                           </div>
                           <div class="col-md-12 mb-3">
                              <label class="form-label">License &amp; Certification</label>
                              <select class="form-control select2" id="license_required" name="license_required">
                                 <option value="">-Select-</option>
                                 @php
                                 $licenseCertification = getJobLicenseCertifications();
                                 @endphp
                                 @if (!empty($licenseCertification))
                                 @foreach ($licenseCertification as $license)
                                 <option value="{{ $license->id }}">{{ $license->name }}</option>
                                 @endforeach
                                 @endif
                              </select>
                           </div>

                           <div class="col-md-12 mb-3">
                              <label class="form-label">Experience Required for this Job</label>
                              <select class="form-control select2" id="experience" name="experience">
                                 <option value="">-Select-</option>
                                 @php
                                 $job_experiences = getJobExperience();
                                 @endphp
                                 @if (!empty($job_experiences))
                                 @foreach ($job_experiences as $exp)
                                 <option value="{{ $exp->id }}">{{ $exp->name }}</option>
                                 @endforeach
                                 @endif

                              </select>
                           </div>
                        </div>
                        <div class="row ">
                           <div class="col-md-12 mb-3">
                              <label class="form-label">Qualification Required for this Job</label>
                              <select class="form-control select2" id="qualification_required" name="qualification_required">
                                 <option value="">-Select-</option>
                                 @php
                                 $jobQualifications = getJobQualifications();
                                 @endphp
                                 @if (!empty($jobQualifications))
                                 @foreach ($jobQualifications as $qualification)
                                 <option value="{{ $qualification->id }}">{{ $qualification->name }}</option>
                                 @endforeach
                                 @endif
                              </select>
                           </div>
                           <div class="col-md-12 mb-3">
                              <div class="row align-items-center">
                                 <div class="col-md-12">
                                    <label class="form-label">Job Location</label>
                                 </div>
                              </div>
                              <div>
                                 <select class="form-control select2" name="location" data-live-search="true" title="" id="location">
                                    <option value="">-Select-</option>
                                    @php
                                    $getLocations = getJobLocations();
                                    @endphp
                                    @if (!empty($getLocations))
                                    @foreach ($getLocations as $location)
                                    <option value="{{ $location->id }}">{{ $location->location_name }}</option>
                                    @endforeach
                                    @endif
                                 </select>
                              </div>
                           </div>
                        </div>


                        <div class="row">
                           <div class="col-md-6 md-6 text-end"><a href="#" onclick="nextStep(2)" class="btn btn-primary btn-block">Next</a></div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-5 main_card_sticky">
                  <div class="card">
                     <div class="card-body">
                        <h3 class="text-center">Step to create new job</h3>
                        <ul class="step-list">
                           <li class="active"><strong>1.Create Job</strong>Title, Job Type, Category ,Description and location</li>
                           <li><strong>2.Payment Details</strong></li>
                           <li><strong>3.Employer Question</strong></li>
                           <li><strong>4.Contact Details</strong>Company Name, Email and Mobile Number(As per Company Profile)
                           </li>
                           <li><strong>5.Payment details</strong></li>
                           <li><strong>Job Preview and Post the Job</strong>You can see the job preview
                           </li>
                        </ul>
                        <div class="mb-3">
                           <div class="row">
                              <div class="col-md-6 mb-3 text-end"><a href="#" onclick="nextStep(2)" class="btn btn-primary d-block">Next</a></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="step row" id="step2" style="display:none;">
               <div class="col-sm-7">
                  <div class="card">
                     <div class="card-body">
                        <h3 class="text-center">Step 2: Payment Details</h3>
                        <div class="row mt-6" id="payment_info">
                           <div class="col-md-12 mb-6">
                              <div class="mb-3">
                                 <h6 class="o_common_head mb-2">Pay/ wages details <span class="text-danger">*</span></h6>
                              </div>
                              <select class="form-control select2" id="pay_type_required" name="pay_type_required" isrequired="required">
                                 <option value="">Select Pay/Wages Type</option>
                                 @php
                                 $getJobPayWages = getJobPayWages();
                                 @endphp
                                 @if (!empty($getJobPayWages))
                                 @foreach ($getJobPayWages as $paytype)
                                 <option value="{{ $paytype->name }}">
                                    {{$paytype->name }}
                                 </option>
                                 @endforeach
                                 @endif
                              </select>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group mb-4 payment_week">
                                 <label for="basic-url" class="form-label">From <span class="text-danger">*</span></label>
                                 <div class="input-group mb-6">
                                    <span class="input-group-text" id="basic-addon3">$</span>
                                    <input min="0" type="number" class="form-control" name="price_from" id="price_from" value="32" onkeyup="copyValue(this.value,'price_from_prev');" isrequired="required">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group mb-4 payment_week">
                                 <label for="basic-url-1" class="form-label">To <span class="text-danger">*</span></label>
                                 <div class="input-group mb-6">
                                    <span class="input-group-text" id="basic-addon3">$</span>
                                    <input min="0" type="number" class="form-control" name="price_to" id="price_to" value="33" onkeyup="copyValue(this.value,'price_to_prev');" isrequired="required">
                                 </div>
                              </div>
                           </div>


                           <div class="col-md-4 mb-6">
                              <a onclick="previousStep(1)" href="#" class="btn btn-outline-primary d-block">Previous Step</a>
                           </div>
                           <div class="col-md-4 mb-6">
                              <a href="#" onclick="nextStep(3)" class="btn btn-primary d-block">Next</a>
                           </div>

                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-5 main_card_sticky">
                  <div class="card">
                     <div class="card-body">
                        <h3 class="text-center">Step to create new job</h3>
                        <ul class="step-list">
                           <li class="active"><strong>1.Create Job</strong>Title, Job Type, Category ,Description and location</li>
                           <li class="active"><strong>2.Payment Details</strong>
                           </li>
                           <li><strong>3.Employer Question</strong>
                           </li>
                           <li><strong>4.Contact Details</strong>Company Name, Email and Mobile Number(As per Company Profile)
                           </li>
                           <li><strong>5.Payment details</strong></li>
                           <li><strong>Job Preview and Post the Job</strong>You can see the job preview
                           </li>
                        </ul>
                        <div class="mb-3">
                           <div class="row">
                              <div class="col mb-3"><a onclick="previousStep(1)" href="#" class="btn btn-outline-primary d-block">Previous Step</a></div>

                              <div class="col mb-3">
                                 <a href="#" onclick="nextStep(3)" class="btn btn-primary d-block">Next</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="step row" id="step3" style="display:none;">
               <div class="col-sm-7">
                  <div class="card">
                     <div class="card-body">
                        <h3 class="text-center">Step 3: Employer Question</h3>
                        <div class="accordion mt-6" id="accordionExample">
                           <div class="accordion-item">
                              <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                 <div class="accordion-body">
                                    <div class="">
                                       <div class="row mb-3">
                                          <div class="col-md-12 mb-3">
                                             <label class="form-label">Create Employer Question?
                                             </label> <br>
                                             <div class="form-check form-check-inline">
                                                <input class="form-check-input employer_question_status" type="radio" name="employer_question_status" id="employer_question_status" checked="" value="show">
                                                <label class="form-check-label" for="employer_question_status">Yes</label>
                                             </div>
                                             <div class="form-check form-check-inline">
                                                <input class="form-check-input employer_question_status" type="radio" name="employer_question_status" id="employer_question_status" value="hide">
                                                <label class="form-check-label" for="employer_question_status">No</label>
                                             </div>
                                          </div>
                                          <div class="employer_question_div  col-md-12 mb-3">
                                             <label class="form-label">Employer Question </label>
                                             <textarea name="employer_questions" id="employer_questions" onkeyup="copyValue(this.value,'employer_questions_prev');" class="form-control" rows="3" placeholder="Tell your Employer Question...."></textarea>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col mb-3"><a onclick="previousStep(2)" href="#" class="btn btn-outline-primary d-block">Previous Step</a></div>

                                          <div class="col mb-3"><a onclick="nextStep(4)" href="#" class="btn btn-primary d-block">Next</a></div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-5 main_card_sticky">
                  <div class="card">
                     <div class="card-body">
                        <h3 class="text-center">Step to create new job</h3>
                        <ul class="step-list">
                           <li class="active"><strong>1.Create Job</strong>Title, Job Type, Category ,Description and Location</li>
                           <li class="active"><strong>2.Payment Details</strong></li>
                           <li class="active"><strong>3.Employer Question</strong>
                           </li>
                           <li><strong>4.Contact Details</strong>Company Name, Email and Mobile Number(As per Company Profile)
                           </li>
                           <li><strong>5.Payment details</strong></li>
                           <li><strong>Job Preview and Post the Job</strong>You can see the job preview
                           </li>
                        </ul>
                        <div class="mb-3">
                           <div class="row">
                              <div class="col mb-3"><a onclick="previousStep(2)" href="#" class="btn btn-outline-primary d-block">Previous Step</a></div>
                              <div class="col mb-3"><a onclick="nextStep(4)" href="#" class="btn btn-primary d-block">Next</a></div>
                           </div>

                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="step row" id="step4" style="display: none;">
               <div class="col-sm-7">
                  <div class="card">
                     <div class="card-body">
                        <h3 class="text-center">Step 4: Contact Details</h3>
                        <div class="row mt-6 mt-6" id="contact_detail_info">
                           <div class="form-group col-md-6">
                              <label for="contact_company_name">Company Name</label>
                              <input type="text" class="form-control" id="contact_company_name" name="contact_company_name" placeholder="Enter Company Name" isrequired="required">
                           </div>

                           <div class="form-group col-md-6">
                              <label for="contact_email">Email Address</label>
                              <input type="email" class="form-control" id="contact_email" name="contact_email" placeholder="Enter email address" isrequired="required">
                           </div>

                           <div class="form-group col-md-6">
                              <label for="contact_phone">Phone Number</label>
                              <input type="tel" class="form-control" id="contact_phone" name="contact_phone" placeholder="Enter phone number" isrequired="required">
                           </div>
                           <div class="form-group col-md-6">
                              <label for="contact_country">Country</label>
                              <div>
                                 <select name="contact_country" id="contact_country" class="form-control select2" isrequired="required">
                                    @php
                                    $countries = getCountries();
                                    @endphp
                                    <option value="">--select--</option>
                                    @if (!empty($countries))
                                    @foreach($countries as $key => $country)
                                    <option value="{{$key}}" data-name="{{$country}}">
                                       {{$country}}
                                    </option>
                                    @endforeach
                                    @endif
                                 </select>
                              </div>

                           </div>
                           <div class="form-group col-md-6">
                              <label for="contact_state">State/Province</label>
                              <div>
                                 <select class="form-control select2" name="contact_state" id="contact_state" isrequired="required">
                                    <option value="">-Select-</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group col-md-6">
                              <label for="contact_city">City</label>
                              <div>
                                 <select class="form-control select2" name="contact_city" id="contact_city" isrequired="required">
                                    <option value="">Select City</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group col-md-6">
                              <label for="contact_zip">ZIP/Postal Code</label>
                              <input type="text" class="form-control" id="contact_zip" name="contact_zip" placeholder="Enter ZIP code" isrequired="required">
                           </div>
                           <div class="form-group col-md-6">
                              <label for="contact_website">Website URL</label>
                              <input type="url" class="form-control" id="contact_website" name="contact_website" placeholder="Enter website URL">
                           </div>
                           <div class="form-group col-md-12">
                              <label for="contact_address">Address <span class="text-danger">*</span></label>
                              <textarea type="text" cols="3" class="form-control" id="contact_address" name="contact_address" placeholder="Enter address" isrequired="required"></textarea>
                           </div>



                           <div class="form-group col-md-12 d-flex">
                              <div class="col-md-6 mb-3"><a onclick="previousStep(3)" href="#" class="btn btn-outline-primary d-block">Previous Step</a></div>
                              <div class="col-md-6 mb-3"><a href="#" onclick="nextStep(5)" class="btn btn-primary d-block">Next</a></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-5 main_card_sticky">
                  <div class="card">
                     <div class="card-body">
                        <h3 class="text-center">Step to create new job</h3>
                        <ul class="step-list">
                           <li class="active"><strong>1.Create Job</strong>Title, Job Type, Category ,Description and Location</li>
                           <li class="active"><strong>2.Payment Details</strong>
                           </li>
                           <li class="active"><strong>3.Employer Question</strong>
                           </li>
                           <li class="active">
                              <strong>4.Contact Details</strong>Company Name, Email and Mobile Number(As per Company Profile)

                           </li>
                           <li><strong>5.Payment details</strong></li>
                           <li><strong>Job Preview and Post the Job</strong>You can see the job preview
                           </li>
                        </ul>
                        <div class="mb-3">
                           <div class="row">
                              <div class="col mb-3"><a onclick="previousStep(3)" href="#" class="btn btn-outline-primary d-block">Previous Step</a></div>
                              <div class="col mb-3">
                                 <a href="#" onclick="nextStep(5)" class="btn btn-primary d-block">Next</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="step row" id="step5" style="display: none;">
               <div class="col-sm-7">
                  <div class="card">
                     <div class="card-body">
                        <h3 class="text-center">Step 5: Payment details</h3>
                        <div class="row mt-6" id="payment_info">
                           <div class="hourly_info_container role_payment_125 " id="hourly_info_container_125">
                              <label class="form-label">Do you want to show/hide your Payment details?
                              </label> <br>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input company_contact_status" type="radio" name="company_contact_status" id="company_payment_status" checked="" value="show">
                                 <label class="form-check-label" for="company_payment_status">Show</label>
                              </div>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input company_contact_status" type="radio" name="company_contact_status" id="company_payment_status" value="hide">
                                 <label class="form-check-label" for="company_payment_status">Hide</label>
                              </div>
                              <div class="paid_plan_div" style="background: linear-gradient(to bottom, #4dc672, #024917);padding:10px;margin:10px 0px;border-radius:10px;color: #fff;font-weight: bold;">
                                 <div class="form-check form-switch">
                                    <input class="form-check-input plan-post" type="radio" checked="" name="payment_plan" data-title="Premium Posting" id="premium-post" value="100.00">
                                    <label class="form-check-label" for="premium-post">Premium Posting - $100<b>RECOMMENDED</b></label>
                                    <ul>
                                       <li>Top placement in job listing &amp; highlighted to stand out from other postings.</li>
                                       <li>Posted on our social media channels.</li>
                                       <li>Duration: 60 days (+30 days free extension)</li>
                                       <li>Show your Company contact details.</li>
                                       <li>Priority customer support.</li>
                                    </ul>
                                 </div>
                              </div>
                              <div class="paid_plan_div" style="background: linear-gradient(to bottom, #ffc82d, #ff7100);padding:10px;margin:10px 0px;border-radius:10px;color: #000;font-weight: bold;">
                                 <div class="form-check form-switch">
                                    <input class="form-check-input plan-post" type="radio" name="payment_plan" data-title="Gold Posting" id="gold-post" value="60.00">
                                    <label class="form-check-label" for="gold-post">Gold Posting - $60</label>
                                    <ul>
                                       <li>Above standard listings but below premium &amp; highlighted to stand out from standard postings.</li>
                                       <li>Duration: 45 days (+15 days discounted extension)</li>
                                       <li>Standard customer support.</li>
                                    </ul>
                                 </div>
                              </div>
                              <div class="free_plan_div" style="background: linear-gradient(to bottom, #3b3ded, #04034a);padding:10px;margin:10px 0px;border-radius:10px;color: #fff;font-weight: bold;">
                                 <div class="form-check form-switch">
                                    <input class="form-check-input plan-post" type="radio" name="payment_plan" data-title="Standard Posting" value="0.00" id="standard-post">
                                    <label class="form-check-label" for="standard-post">Standard Posting -$0</label>
                                    <ul>
                                       <li>Regular postings.</li>
                                       <li>Duration: 30 days</li>
                                       <li>Standard customer support.</li>
                                    </ul>
                                 </div>
                              </div>
                              <input type="hidden" name="plan_name" id="plan_name" value="Standard Posting">
                              <div class="row">
                                 <div class="col mb-3"><a onclick="previousStep(4)" href="#" class="btn btn-outline-primary d-block">Previous Step</a></div>
                                 <div class="col mb-3"><a href="#" onclick="nextStep(6)" class="btn btn-primary d-block">Next</a></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-5 main_card_sticky">
                  <div class="card">
                     <div class="card-body">
                        <h3 class="text-center">Step to create new job</h3>
                        <ul class="step-list">
                           <li class="active"><strong>1.Create Job</strong>Title, Job Type, Category ,Description and Location</li>
                           <li class="active"><strong>2.Payment Details</strong>
                           </li>
                           <li class="active"><strong>3.Employer Question</strong>
                           </li>
                           <li class="active">
                              <strong>4.Contact Details</strong>Company Name, Email and Mobile Number(As per Company Profile)
                           </li>
                           <li class="active">
                              <strong>5.Payment details</strong>
                              <hr>
                              <div class="row mb-2 bg-success pt-2">
                                 <div class="col-md-12 mb-2 text-white">
                                    <h5 class="mb-1" id="">Plan Name</h5>
                                    <p class="payment_plan_name_prev mb-0 text-white">Standard Posting</p>
                                 </div>
                                 <div class="col-md-12 mb-2">
                                    <h5 class="mb-1" id="" text-white="">Plan Amount</h5>
                                    <p class="text-white"> $<span class="payment_plan_amount_prev text-white">0.00</span></p>
                                 </div>
                              </div>
                           </li>
                           <li><strong>Job Preview and Post the Job</strong>You can see the job preview
                           </li>
                        </ul>
                        <div class="mb-3">
                           <div class="row">
                              <div class="col mb-3"><a onclick="previousStep(4)" href="#" class="btn btn-outline-primary d-block">Previous Step</a></div>

                              <div class="col mb-3">
                                 <a href="#" onclick="nextStep(6)" class="btn btn-primary d-block">Next</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="step row" id="step6" style="display: none;">
               <div class="col-sm-7">
                  <div class="card">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-12">
                              <img class="preview_logo flex-shrink-0 img-fluid border rounded" src="https://app.superino.com.au/images/profile/d5hktuz2YaqrSoPLBS2ff3edU_1700910637.jpeg" alt="" id="preview" style="width: 80px; height: 80px;">
                           </div>
                           <div class="col-md-12">
                              <h3 class="mb-2 mb-2" id="titleprev">Warehouse Storeperson</h3>
                              <div class="text-truncate mb-2">
                                 <h5><span id="location_prev">Coldx </span></h5>
                                 <i class="fa fa-map-marker-alt text-primary me-2"></i><span id="location_address_prev">d, Rowville VIC, Australia</span>
                              </div>
                              <div class="text-truncate mb-2"><i class="far fa-clock text-primary me-2"></i> <span id="job_type_prev">Casual</span> </div>
                              <div class="text-truncate mb-2"><i class="fa fa-industry text-primary me-2"></i> <span id="job_category_prev">
                                    Warehousing and Distribution
                                 </span>
                              </div>
                              <div class="text-truncate mb-2"><i class="far fa-money-bill-alt text-primary me-2"></i>$<span class="site" id="price_from_prev">32</span> - $<span class="site" id="price_to_prev">33</span> / <span class="site" id="pay_type_prev">Per Month</span> </div>
                           </div>
                        </div>
                        <div class="mt-2 mb-2">
                           <button type="button" class="btn btn-danger btn-sm">Quick apply</button>
                           <button type="button" class="btn btn-primary btn-sm">Save</button>
                           <button type="button" class="btn btn-success btn-sm">Share</button>
                        </div>
                        <hr>
                        <div class="d-flex align-items-center mb-2">
                           <div class="text-start">
                              <h4 class="mb-3" id="">Job Description</h4>
                              <div id="descriptionprev">
                                 <p><strong>Our Business</strong></p>
                                 <p>Century Yuasa Batteries is Australia’s oldest and most recognised battery manufacturer, with a history of designing and manufacturing batteries for over 95 years. We pride ourselves on being the first choice for stored energy solutions, employing over 600 people and supplying some of the biggest brands in the marketplace, including Century, the official battery of Supercars.</p>
                                 <p>Backed by a true global leader, our parent company GS Yuasa is one of the world’s largest battery manufacturers and a true leader in quality and innovation, underpinning our vision of providing sustainable energy solutions for today, tomorrow and the future.</p>
                                 <p><strong>The Role</strong></p>
                                 <p>Based in our Keysborough distribution center, your role will be to move and control stock within the warehouse and ensure goods are received and dispatched efficiently and effectively. The workload is high-volume and fast-paced and you will be working within a highly-organised team. It is a full-time permanent role, working Mon-Fri.</p>
                                 <p>As a world-class warehouse facility, we are looking for someone willing to go above and beyond, with great attention to detail and the ability to understand technical concepts.</p>
                                 <p><strong>Requirements</strong></p>
                                 <ul>
                                    <li>LF Forklift licence&nbsp;</li>
                                    <li>a minimum of 2+ years experience in a warehouse environment</li>
                                    <li>Reach Truck experience preferred</li>
                                    <li>Cert 3 in Warehousing is advantageous but not essential</li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="row mb-2">
                           <div class="col-md-12 mb-2" id="No_of_Workers_title" style="display:none">
                              <h5 class="mb-1">Number of staff required for this job.</h5>
                              <p id="No_of_Workers_prev"></p>
                           </div>
                           <div class="col-md-12 mb-2" id="experience_title" style="display:1 Year to 3 Years">
                              <h5 class="mb-1">Experience required for this job.</h5>
                              <p id="experience_prev">1 Year to 3 Years</p>
                           </div>
                           <div class="col-md-12 mb-2" id="qualification_title" style="display:none">
                              <h5 class="mb-1">Qualifications required for this job</h5>
                              <p id="qualification_prev"></p>
                           </div>
                           <div class="col-md-12 mb-2" id="license_title" style="display:Forklift License">
                              <h5 class="mb-1">License/Certification required for this job</h5>
                              <p id="license_prev">Forklift License</p>
                           </div>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                           <div class="text-start" id="employer_questionsprev_div">
                              <br>
                              <h4 class="mb-3" id="">Employer Questions</h4>
                              <div id="employer_questionsprev">
                                 <p><strong>dd</strong></p>
                                 <ul>
                                    <li>LF Forklift licence&nbsp;</li>
                                    <li>a minimum of 2+ years experience in a warehouse environment</li>
                                    <li>Reach Truck experience preferred</li>
                                    <li>Cert 3 in Warehousing is advantageous, but not essential</li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="contact_info_com">
                           <h4>Contact details</h4>
                           <div class="col-md-12">
                              <h5 class="company-name" id="company-name-prev"></h5>
                              <div class="">
                                 <div class="text-truncate mb-2">
                                    <i class="far fa-envelope me-2"></i>Email Id: <span id="email_prev"></span>
                                 </div>
                                 <div class="text-truncate mb-2">
                                    <i class="fas fa-phone-volume"></i>
                                    Phone: <span id="mobile_prev"> </span>
                                 </div>
                              </div>
                              <div class="details-part">
                              </div>
                           </div>
                           <div class="row mb-2 d-none">
                              <div class="col-md-12 mb-2 d-none">
                                 <h5 class="mb-1" id="">Website</h5>
                                 <p id="website_prev"></p>
                              </div>
                              <div class="col-md-12 mb-2 d-none">
                                 <h5 class="mb-1" id="">Email Address</h5>
                                 <p id="email_prev">wali@backupp.com.au</p>
                              </div>
                              <div class="col-md-12 mb-2 d-none">
                                 <h5 class="mb-1" id="">Mobile Number</h5>
                                 <p id="mobile_prev"></p>
                              </div>
                           </div>
                        </div>
                        <br><br>
                        <div class="row">
                           <div class="col-md-12">
                              <h5>Attention: Please Be Careful</h5>
                              <p>When applying for jobs or interacting with any online platforms, <b>DO NOT provide your credit card details, bank account information, passwords, or PINs.</b> Protect your personal and financial information to avoid potential scams or fraud. Stay safe and vigilant!</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-5 main_card_sticky">
                  <div class="card">
                     <div class="card-body">
                        <h3 class="text-center">Step to create new job</h3>
                        <ul class="step-list">
                           <li class="active"><strong>1.Create Job</strong>Title, Job Type, Category ,Description and location</li>
                           <li class="active"><strong>2.Payment Details</strong></li>
                           <li class="active"><strong>3.Employer Question</strong></li>
                           <li class="active"><strong>4.Contact Details</strong>Company Name, Email and Mobile Number(As per Company Profile)
                           </li>
                           <li class="active"><strong>5.Payment details</strong></li>
                           <li class="active"><strong>Job Preview and Post the Job</strong>You can see the job preview
                           </li>
                        </ul>
                        <div class="mb-3">
                           <div class="row mb-3">
                              <div class="col mb-6"><a onclick="previousStep(5)" href="#" class="btn btn-outline-primary d-block">Previous Step</a></div>
                              <div class="col mb-6">
                                 <input type="button" value="Publish" class="btn btn-primary d-block" onclick="handleFormSubmit();">
                              </div>
                           </div>

                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>

@endsection

{{-- Styles Section --}}
@section('styles')
<style>
   .main_card_sticky {
      position: sticky;
      top: 120px;
      height: fit-content;
   }

   .input-group {
      position: relative;
      display: flex;
      flex-wrap: wrap;
      align-items: stretch;
      width: 100%;
   }

   .input-group-text {
      display: flex;
      align-items: center;
      padding: 0.575rem 1rem;
      font-size: 0.875rem;
      font-weight: 400;
      line-height: 1.5;
      color: #293240;
      text-align: center;
      white-space: nowrap;
      background-color: #f8f9fd;
      border: 1px solid #ced4da;
      border-radius: 6px;
   }

   .step-list li.active:before {
      position: absolute;
      top: 20px;
      left: 0;
      content: '';
      background: #c64d8a url("{{ asset('media/checked.svg') }}") no-repeat center center;
      background-size: 50%;
      width: 32px;
      height: 32px;
      border-radius: 50%;
      filter: invert(1);
      /* Invert colors */
   }

   .select2-container {
      width: 100% !important;
   }

   .step-list {
      margin: 0;
      padding: 20px 0;
      list-style: none;
   }

   .step-list li strong {
      font-weight: 600;
      color: #666;
      display: block;
   }

   .step-list li {
      display: block;
      padding: 15px 0 15px 50px;
      position: relative;
      font-size: 14px;
      color: #999;
   }

   .step-list li:before {
      position: absolute;
      top: 20px;
      left: 0;
      content: '';
      background: #999 url('{{ asset(' media/checked.svg') }}') no-repeat center center;
      background-size: 50%;
      width: 32px;
      height: 32px;
      border-radius: 50%;
      filter: invert(1);
      /* Invert colors */
   }
</style>
@endsection

{{-- Scripts Section --}}
@section('scripts')
<script src="https://ckeditor.com/docs/vendors/4.11.3/ckeditor/ckeditor.js" type="text/javascript"></script>
<script type="text/javascript">
   $('.employer_question_status').on('click', () => {
      let enpStatus = $('.employer_question_status:checked').val(); // Fix the selector
      if (enpStatus === 'hide') {
         $('.employer_question_div').hide();
      } else {
         $('.employer_question_div').show();
      }
   });
   $('.company_payment_status').on('click', () => {
      let enpStatus = $('.company_payment_status:checked').val(); // Fix the selector
      if (enpStatus === 'hide') {
         $('.payment_plan_amount_prev').text('0.00');
         $('.payment_plan_name_prev').text('Standard Posting');
         $('.paid_plan_div').hide();
      } else {
         $('.paid_plan_div').show();
      }
   });
   $('.plan-post').on('change', () => { // Use 'change' for radio buttons
      let planVal = $('.plan-post:checked').val();
      let planName = $('.plan-post:checked').attr('data-title');

      if (planVal && planName) { // Check if both values exist
         $('.payment_plan_amount_prev').text(planVal);
         $('.payment_plan_name_prev').text(planName);
         $('#plan_name').val(planName);
      }
   });

   $(function() {
      $('.select2').select2(); // Initialize Select2

      // Load States when a Country is selected
      $('#contact_country').on('change', function() {
         var country_id = $(this).val();
         $('#contact_state').empty().append('<option value="">Select State</option>'); // Reset states
         $('#contact_city').empty().append('<option value="">Select City</option>'); // Reset cities

         if (country_id) {
            $.ajax({
               url: '{{ url("get-states") }}/' + country_id,
               type: 'GET',
               success: function(states) {
                  $.each(states, function(key, state) {
                     console.log(state);
                     $('#contact_state').append('<option value="' + state.id + '">' + state.name + '</option>');
                  });
               }
            });
         }
      });

      // Load Cities when a State is selected
      $('#contact_state').on('change', function() {
         var _stateId = $(this).val();
         $('#contact_city').empty().append('<option value="">Select City</option>'); // Reset cities

         if (_stateId) {
            $.ajax({
               url: '{{ url("get-cities") }}/' + _stateId,
               type: 'GET',
               success: function(cities) {
                  $.each(cities, function(key, city) {
                     $('#contact_city').append('<option value="' + city.id + '">' + city.name + '</option>');
                  });
               }
            });
         }
      });

      CKEDITOR.replace('description');
      CKEDITOR.replace('employer_questions');

      CKEDITOR.replace('contact_address');

      CKEDITOR.instances.description.on('instanceReady', function() {
         var editor = this;

         // Set initial placeholder
         if (editor.getData().trim() === '') {
            editor.setData('<p style="color: #aaa;">Tell your job details...</p>');
         }

         // Clear placeholder on focus
         editor.on('focus', function() {
            if (editor.getData().includes('Tell your job details...')) {
               editor.setData('');
            }
         });

         // Restore placeholder if empty on blur
         editor.on('blur', function() {
            if (editor.getData().trim() === '') {
               editor.setData('<p style="color: #aaa;">Tell your job details...</p>');
            }
         });
      });
   });
</script>
<script>
   // Preview Logo
   $('#logo').on('change', function(e) {
      let reader = new FileReader();
      reader.onload = function(e) {
         $('#preview').attr('src', e.target.result);
      };
      reader.readAsDataURL(this.files[0]);
   });

   // Preview Text Inputs
   function updatePreview(id, previewId) {
      $('#' + id).on('input', function() {
         $('#' + previewId).text($(this).val());
      });
   }

   function updateCKEditorPreview(instance, previewId) {
      let editorDataval = CKEDITOR.instances[instance].getData().trim();
      $('#' + previewId).html(editorDataval);
   }

   const printErrorMsg = function(msg) {
      jQuery(".print-error-msg").find("ul").html('');
      jQuery(".print-error-msg").css('display', 'block');
      jQuery.each(msg, function(key, value) {
         console.log(value);
         jQuery(".print-error-msg").find("ul").append('<li>' + value + '</li>');
      });
   }

   const isEmpty = function(obj) {
      return Object.keys(obj).length === 0;
   }

   // async function nextordraft(step,savedraft=null){
   //    let jsonData={};
   //    let isValidreu=1;
   //    if((step==1)){
   //       jsonData.step=1;

   //    }

   //    if((step==2)){
   //       console.log(step);
   //       jsonData.step=2;
   //    }

   //    if((step==3)){
   //       jsonData.step=3;
   //    }
   //    if((step==4)){
   //       jsonData.step=4;
   //    }
   //    if((step==5)){
   //       jsonData.step=5;
   //    }

   //    jsonData.title=document.getElementById(`title`).value;
   //    jsonData.job_type=document.getElementById(`job_type`).value;
   //    jsonData.job_type_text=document.getElementById(`job_type_text`).value;
   //    jsonData.job_category=document.getElementById(`job_category`).value;
   //    jsonData.job_category_text=document.getElementById(`job_category_text`).value;
   //    jsonData.description=document.getElementById('description').value; //document.getElementById(`description`).value; 
   //    jsonData.No_of_Workers=document.getElementById(`No_of_Workers`).value;
   //    //jsonData.experience_required=document.getElementById(`experience_required`).value;
   //    jsonData.experience=document.getElementById(`experience`).value;
   //    jsonData.qualification_required=document.getElementById(`qualification_required`).value;
   //    jsonData.qualification=document.getElementById(`qualification`).value;
   //    jsonData.license_required=$('#license_required').val();
   //    jsonData.license=document.getElementById(`license`).value;
   //    jsonData.location=document.getElementById(`location`).value;
   //    jsonData.country=document.getElementById(`country`).value;
   //    jsonData.state=document.getElementById(`state`).value;
   //    jsonData.city=document.getElementById(`city`).value;
   //    jsonData.code=document.getElementById(`code`).value;
   //    jsonData.employer_questions=document.getElementById('employer_questions').value;


   //    jsonData.address=document.getElementById(`address`).value;


   //    if (document.querySelector('.company_contact_status:checked').value=="hide") {
   //       $('.contact_info_com').hide();
   //       let maskEmail = maskString(document.getElementById(`email`).value);
   //       document.getElementById(`email_prev`).innerHTML=maskEmail;
   //       let maskmobile = maskString(document.getElementById(`mobile`).value);
   //       document.getElementById(`mobile_prev`).innerHTML=maskmobile;
   //       let maskwebsite = maskString(document.getElementById(`website`).value);
   //       document.getElementById(`website_prev`).innerHTML=maskwebsite;

   //       let localtionAddress=$('#location option:selected').attr('data-address');
   //       let masklocaltionwebsite = removeAddressString(localtionAddress);
   //       document.getElementById(`location_address_prev`).innerHTML=masklocaltionwebsite;
   //       document.getElementById(`location_address_prev_mob`).innerHTML=masklocaltionwebsite;

   //    }else {
   //       $('.contact_info_com').show();
   //       document.getElementById(`email_prev`).innerHTML=document.getElementById(`email`).value;

   //       document.getElementById(`mobile_prev`).innerHTML=document.getElementById(`mobile`).value;

   //       document.getElementById(`website_prev`).innerHTML=document.getElementById(`website`).value;
   //       document.getElementById(`location_address_prev`).innerHTML=$('#location option:selected').attr('data-address');
   //       document.getElementById(`location_address_prev_mob`).innerHTML=$('#location option:selected').attr('data-address');
   //    }

   //    jsonData.company_contact_status=document.querySelector('.company_contact_status:checked').value;
   //    jsonData.employer_question_status=document.querySelector('.employer_question_status:checked').value;
   //    jsonData.website=document.getElementById(`website`).value;
   //    jsonData.email=document.getElementById(`email`).value;
   //    jsonData.mobile=document.getElementById(`mobile`).value;
   //    jsonData.pay_type_required=document.getElementById(`pay_type_required`).value;
   //    jsonData.pay_type=document.getElementById(`pay_type`).value;
   //    jsonData.price_from=document.getElementById(`price_from`).value;
   //    jsonData.price_to=document.getElementById(`price_to`).value;

   //    jsonData.payment_plan=document.querySelector('.plan-post:checked').value;
   //    jsonData.plan_name=document.getElementById(`plan_name`).value;
   //    if(savedraft!=null){
   //          jsonData.savedraft=savedraft;
   //          //jsonData.step=10;
   //          var token = "GDN6kiOzbh3SMy1P8xh7NgOHaClxP5tUPS4sbZdd";
   //          jsonData._token=token;
   //    }
   //    if(isEmpty(jsonData)==false){
   //       await $.ajax({
   //          url: '/post-job-validate-draft',
   //          method: 'post',
   //          data: jsonData,
   //          success: function(data) {
   //             if($.isEmptyObject(data.error)){
   //                   jQuery(".print-error-msg").find("ul").html('');
   //                   jQuery(".print-error-msg").css('display','none');
   //                   if(savedraft==null){
   //                      showStep(step+1);
   //                   }
   //                   if(savedraft!=null){
   //                      window.location = '/manage-job';
   //                   }
   //                   return true;
   //             }else{
   //             printErrorMsg(data.error);
   //             return false;
   //             }
   //          }
   //       });
   //    }else{
   //       return false;
   //    }

   // }

   function showStep(step) {
      const steps = document.querySelectorAll('.step');
      steps.forEach((element, index) => {
         element.style.display = (index + 1 === step) ? 'flex' : 'none';
      });
   }

   function showInputFieldError(field, message) {
      $('.error_class').remove(); // Clear previous error messages
      field.after(`<div class="error_class">${message}</div>`);
      field.focus();
      $('.error_class').css({
         'color': 'darkred',
         'fontSize': '12px'
      });
      return false;
   }

   async function nextStep(step) {
      $('.error_class').remove(); // Clear previous error messages

      let logo = $('#logo')[0]?.files[0]; // optional
      let job_title = $('#job_title').val().trim();
      let job_type = $('#job_type').val();
      let job_category = $('#job_category').val();
      let description = CKEDITOR.instances.description.getData().trim();
      let No_of_Workers = $('#No_of_Workers').val();
      let license_required = $('#license_required').val();
      let experience = $('#experience').val();
      let qualification_required = $('#qualification_required').val();
      let location = $('#location').val().trim();

      if (step === 2) {
         // Step 1: Job Details Validation
         if (!job_title) {
            showInputFieldError($('#job_title'), 'Job title is required');
         } else if (!job_type) {
            showInputFieldError($('#job_type'), 'Job type is required');
         } else if (!job_category) {
            showInputFieldError($('#job_category'), 'Job category is required');
         } else if (!description || description.replace(/<[^>]*>/g, '').trim() === '') {
            showInputFieldError($('#description'), 'Description is required');
         } else if (No_of_Workers === '' || isNaN(No_of_Workers) || No_of_Workers <= 0) {
            showInputFieldError($('#No_of_Workers'), 'Number of workers must be a positive number');
         }
         //   else if (!license_required) {
         //       showInputFieldError($('#license_required'), 'Please specify if a license is required');
         //   } else if (experience === '' || isNaN(experience) || experience < 0) {
         //       showInputFieldError($('#experience'), 'Experience must be a non-negative number');
         //   } else if (!qualification_required) {
         //       showInputFieldError($('#qualification_required'), 'Qualification requirement is required');
         //   } else if (!location) {
         //       showInputFieldError($('#location'), 'Location is required');
         //   } 
         else {
            showStep(step);
         }
      }

      if (step === 3) {
         // Step 2: Payment Details Validation
         let pay_type_required = $('#pay_type_required').val();
         let price_from = $('#price_from').val();
         let price_to = $('#price_to').val();

         if (!pay_type_required) {
            showInputFieldError($('#pay_type_required'), 'Payment type is required');
         } else if (price_from === '' || isNaN(price_from) || price_from <= 0) {
            showInputFieldError($('#price_from'), 'Valid price from is required');
         } else if (price_to === '' || isNaN(price_to) || price_to <= 0 || parseFloat(price_to) < parseFloat(price_from)) {
            showInputFieldError($('#price_to'), 'Valid price to (greater than price from) is required');
         } else {
            showStep(step);
         }
      }

      if (step === 4) {
         // Step 3: Employer Questions Validation
         let employer_question_status = $('#employer_question_status').val();
         let employer_questions = CKEDITOR.instances.employer_questions.getData().trim();
         showStep(step);
         //   if (employer_question_status === 'show' && (!employer_questions || employer_questions.replace(/<[^>]*>/g, '').trim() === '')) {
         //       showInputFieldError($('#employer_questions'), 'Employer questions are required');
         //   } else {

         //   }
      }

      if (step === 5) {
         // Step 4: Contact Details Validation
         let contact_company_name = $('#contact_company_name').val();
         let contact_email = $('#contact_email').val();
         let contact_phone = $('#contact_phone').val();
         let contact_country = $('#contact_country').val();
         let contact_state = $('#contact_state').val();
         let contact_city = $('#contact_city').val();
         let contact_zip = $('#contact_zip').val();
         let contact_website = $('#contact_website').val();
         let contact_address = CKEDITOR.instances.contact_address.getData().trim();

         if (!contact_company_name) {
            showInputFieldError($('#contact_company_name'), 'Company name is required');
         } else if (!contact_email || !validateEmail(contact_email)) {
            showInputFieldError($('#contact_email'), 'Valid email is required');
         } else if (!contact_phone || !validatePhone(contact_phone)) {
            showInputFieldError($('#contact_phone'), 'Valid phone number is required');
         } else if (!contact_country || !contact_state || !contact_city || !contact_zip) {
            showInputFieldError($('#contact_country'), 'Complete address details are required');
         } else {
            showStep(step);
         }
      }

      if (step === 6) {

         // Call the async function to handle everything
         updatePreviewFields();
         showStep(step);
         // await handleFormSubmit();
      }
   }

   const updatePreviewFields = async () => {
      let companyLocationName = await getCompanyLocationName($('#location').val());
      $('#location_prev').text($('#location').val());
      $('#location_address_prev').html(CKEDITOR.instances.contact_address.getData().trim());

      let getJobTypeNames = await getJobTypeName($('#job_type').val());
      $('#job_type_prev').text(getJobTypeNames || '');

      let getJobCategoryNames = await getJobCategoryName($('#job_category').val());
      $('#job_category_prev').text(getJobCategoryNames || '');

      let getjobExperienceNames = await getJobExperienceName($('#experience').val());
      $('#experience_prev').text(getjobExperienceNames || '');

      let getjobLicenseCertificateNames = await getJobLicenseCertificateName($('#license_required').val());
      $('#license_prev').text(getjobLicenseCertificateNames || '');

      $('#company-name-prev').text($('#contact_company_name').val());
      $('#company_name_prev').text($('#contact_company_name').val());
      $('#email_prev').text($('#contact_email').val());
      $('#mobile_prev').text($('#contact_phone').val());

      updatePreview('price_from', 'price_from_prev');
      updatePreview('price_to', 'price_to_prev');
      updatePreview('pay_type_required', 'pay_type_prev');
      updatePreview('No_of_Workers', 'No_of_Workers_prev');
      updatePreview('qualification_required', 'qualification_prev');
      updatePreview('contact_website', 'website_prev');
      updateCKEditorPreview('description', 'descriptionprev');
      updateCKEditorPreview('employer_questions', 'employer_questionsprev');
   };




   const fetchData = async (endpoint, id) => {
      let apiUrl = '{{url("common")}}/' + endpoint + '?id=' + id;

      try {
         const res = await fetch(apiUrl);

         if (!res.ok) {
            throw new Error(`HTTP error! status: ${res.status}`);
         }

         const response = await res.json();

         if (response.status_code === 200) {
            return response.data;
         } else {
            console.error(`Error: ${response.message || `Failed to fetch ${endpoint}`}`);
            return null;
         }
      } catch (error) {
         console.error(`Fetch error for ${endpoint}:`, error);
         return null;
      }
   };

   // Now, use the reusable function for each case
   const getCompanyLocationName = (id) => fetchData("location-name", id);
   const getJobTypeName = (id) => fetchData("job-type-name", id);
   const getJobCategoryName = (id) => fetchData("job-category-name", id);
   const getJobExperienceName = (id) => fetchData("job-experience-name", id);
   const getJobLicenseCertificateName = (id) => fetchData("job-licensecertificate-name", id);

   const handleFormSubmit = async () => {
      let formData = new FormData();
      console.log(formData);
      formData.append('_token', '{{ csrf_token() }}');
      formData.append('logo', $('#logo')[0]?.files[0]);
      formData.append('job_title', $('#job_title').val().trim());
      formData.append('job_type', $('#job_type').val());
      formData.append('job_category', $('#job_category').val());
      formData.append('description', CKEDITOR.instances.description.getData().trim());
      formData.append('No_of_Workers', $('#No_of_Workers').val());
      formData.append('license_required', $('#license_required').val());
      formData.append('experience', $('#experience').val());
      formData.append('qualification_required', $('#qualification_required').val());
      formData.append('location', $('#location').val().trim());

      formData.append('pay_type_required', $('#pay_type_required').val());
      formData.append('price_from', $('#price_from').val());
      formData.append('price_to', $('#price_to').val());

      formData.append('employer_question_status', $('#employer_question_status').val());
      formData.append('employer_questions', CKEDITOR.instances.employer_questions.getData().trim());

      formData.append('contact_company_name', $('#contact_company_name').val());
      formData.append('contact_email', $('#contact_email').val());
      formData.append('contact_phone', $('#contact_phone').val());
      formData.append('contact_country', $('#contact_country').val());
      formData.append('contact_state', $('#contact_state').val());
      formData.append('contact_city', $('#contact_city').val());
      formData.append('contact_zip', $('#contact_zip').val());
      formData.append('contact_website', $('#contact_website').val());
      formData.append('contact_address', CKEDITOR.instances.contact_address.getData().trim());

      let selectedPlan = $('.plan-post:checked');
      formData.append('company_payment_status', $('.company_payment_status:checked').val());

      if (selectedPlan.length > 0) {
         formData.append('paymentPlanType', selectedPlan.attr('data-title'));
         formData.append('paymentPlane', selectedPlan.val());
      }

      // AJAX request to submit the form
      $.ajax({
         url: window.location.href,
         type: 'POST',
         data: formData,
         contentType: false,
         processData: false,
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
         },
         success: function(response) {
            if (response.success) {
               alert('Job posted successfully!');
               window.location.href = '{{ url("company/jobs/list") }}'; // Redirect or show success message
            } else {
               alert('Error: ' + response.message);
            }
         },
         error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('Failed to submit the form. Please try again.');
         }
      });
   }

   // Helper functions
   function validateEmail(email) {
      return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
   }

   function validatePhone(phone) {
      return /^\d{10,15}$/.test(phone);
   }

   function previousStep(step) {
      showStep(step);
   }

   // Initialize the first step
   document.addEventListener('DOMContentLoaded', () => {
      showStep(1);
   });


   function validateStep(stepElement) {
      console.log(stepElement);
      const inputs = stepElement.querySelectorAll('input');
      console.log(stepElement);
      let isValid = true;

      for (let i = 0; i < inputs.length; i++) {
         const element = inputs[i];
         //const errorMessage = element.nextElementSibling;

         if (!element.checkValidity()) {
            isValid = false;
         } else {
            isValid = true;
         }
      }

      if (isValid) {
         alert('Form is valid!');
      } else {
         alert('Form is invalid!');
      }

      return isValid;
   }

   function copyValue(value, prevval, titleval = null) {
      if (value != null || value != '' || value != "") {
         $("#" + prevval).text(value);
         if (prevval == "titleprev") {
            $("#" + prevval + "_mob").text(value);
         }
         if (prevval == "price_to_prev") {
            $("#" + price_to_prev + "_mob").text(value);
         }
         if (prevval == "price_from_prev") {
            $("#" + price_from_prev + "_mob").text(value);
         }
         if (prevval == "descriptionprev") {
            var description = document.getElementById('description').value;
            $("#descriptionprevmob").text(description);
            $("#descriptionprev").text(description);
         }
         if (titleval != null) {
            $("#" + titleval).show();
         }
      }
   }

   // Function to mask the string
   function maskString(str) {
      if (str.length <= 2) {
         return str; // Return the string as is if it's 2 characters or less
      }
      var maskedPart = '*'.repeat(str.length - 2);
      var visiblePart = str.slice(-2);
      return maskedPart + visiblePart;
   }

   function maskAddressString(str) {
      let maskedText = null;
      if (str != null) {
         let words = str.split(' ');

         for (var i = 0; i < Math.min(3, words.length); i++) {
            words[i] = '*'.repeat(words[i].length);
         }

         maskedText = words.join(' ');
      }
      return maskedText;
   }

   function removeAddressString(str) {
      let maskedText = null;
      if (str != null) {
         let words = str.split(' ');

         for (var i = 0; i < Math.min(3, words.length); i++) {
            words[i] = ''.repeat(words[i].length);
         }

         maskedText = words.join(' ');
      }
      return maskedText;
   }
</script>
@endsection