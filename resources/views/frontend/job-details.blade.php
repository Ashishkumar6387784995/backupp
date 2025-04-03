@extends('frontend.layouts.default_layout')
@section('content')
<section class="jobs">
   <main>
      <div class="searchBoxHeader_">
         <div class="search-form-container content-container -width-xl">
            <form action="" class="search-form desktop-top-search-form -desktop-only" method="get">
               <input name="sp" type="hidden" value="search">
               <input name="trigger_source" type="hidden" value="serp">
               <div class="keyword-input search-input-field input-field">
                  <label for="desktop-top-q">What</label>
                  <input id="desktop-top-q" maxlength="512" name="q" placeholder="Job title, company, keyword" type="search" value="" autocomplete="off" aria-expanded="false">
               </div>
               <div class="location-input search-input-field input-field">
                  <label for="desktop-top-l">Where</label>
                  <input id="desktop-top-l" maxlength="64" name="l" placeholder="City, district, state" type="search" value="" autocomplete="off">
               </div>
               <div class="searchButton">
                  <label for=""></label>
                  <button type="submit" class="search-jobs-button rounded-button -primary -size-lg -w-full">
                     <span class="content">Search jobs</span>
                  </button>
               </div>
            </form>
         </div>
      </div>

      <!-- start show job details  -->
         <div id="showJobsDetails">
            {{--<div class="job-details-page content-container -width-xl grid-container -two-columns">
               <div class="job-view-content grid-content" id="job-view" job-id="j_52488ba16b2c398e0675805b4eb44dc6">
                  <div class="-desktop-no-padding-top" id="job-info-container">
                     <h1 class="job-title heading -size-xxlarge -weight-700">Entry Level Office</h1>
                     <div class="font-small" id="company-location-container"><span class="company">The Harbour Agency</span><span class="divider">–</span><span class="location">Beaconsfield NSW</span></div>
                     <div class="badge -default-badge">
                        <div class="content">Full time</div>
                     </div>
                     <div class="badge -default-badge">
                        <div class="content">No experience required</div>
                     </div>
                     <div class="font-xsmall" id="job-meta"><span class="listed-date">2h ago</span>, from <span class="site">seek.com.au</span></div>
                  </div>
                  <div class="job-view-actions-container top-actions-container">
                     <div class="action-buttons-container"><a class="apply-button rounded-button -primary -size-lg -w-full" data-gtm="apply-job" data-ga4-on-click="true" data-ga4="{&quot;name&quot;:&quot;job_detail__view_or_apply&quot;,&quot;params&quot;:{&quot;job_feed&quot;:&quot;organic&quot;,&quot;user_id&quot;:null,&quot;site_id&quot;:&quot;au&quot;}}" data-action="click->hubble--job#track" data-hubble--job-events-param="[{&quot;name&quot;:&quot;job_apply_linkout_displayed&quot;,&quot;properties&quot;:{&quot;jobId&quot;:&quot;52488ba16b2c398e0675805b4eb44dc6&quot;}},{&quot;name&quot;:&quot;job_apply_pressed&quot;,&quot;properties&quot;:{&quot;jobId&quot;:&quot;52488ba16b2c398e0675805b4eb44dc6&quot;,&quot;linkout&quot;:true,&quot;thirdPartyLink&quot;:true}}]" data-js-open-ea-modal="true" data-rank="2" rel="nofollow noopener" target="_blank" href="/job/rd/52488ba16b2c398e0675805b4eb44dc6?abstract_type=extended_llm&amp;asp=jdv&amp;disallow=true&amp;fsv=true&amp;sp=viewjob&amp;sponsored=false&amp;sq=Entry+Level&amp;sr=2&amp;tk=vUqKxTDJNWMurmdJASUY-44zC8lqOoyloTxgE_FmL"><span class="content">View or apply for job</span></a><button type="submit" class="save-job-button rounded-button -secondary -size-lg" data-disabled="" data-job-id="52488ba16b2c398e0675805b4eb44dc6" data-saved="" data-ga4="{&quot;name&quot;:&quot;save_job__create&quot;,&quot;params&quot;:{&quot;trigger_source&quot;:&quot;job_details_page&quot;,&quot;job_feed&quot;:&quot;organic&quot;,&quot;user_id&quot;:null,&quot;site_id&quot;:&quot;au&quot;}}" data-tk="vUqKxTDJNWMurmdJASUY-44zC8lqOoyloTxgE_FmL" data-label-save="Save job" data-label-saved="Saved"><span class="content">Save job</span></button></div>
                  </div>
                  <div class="-desktop-no-padding-top" id="job-description-container">
                     <p>This entry-level Office position is based in our Sydney office, ideal for those looking to become a booking agent</p>
                     <p>Applicants should be able to perform a wide variety of duties in the day-to-day running of a fast paced, busy office.</p>
                     <p>The successful candidate will work alongside the team of agents, performing a variety of administrative duties, with development opportunities available.&nbsp;</p>
                     <p>Applicants should have a strong knowledge of Microsoft Outlook programs.&nbsp;</p>
                     <p>Successful applicants will be contacted for interviews.</p>
                  </div>
                  <div class="job-view-actions-container bottom-actions-container">
                     <div class="action-buttons-container"><a class="apply-button rounded-button -primary -size-lg -w-full" data-gtm="apply-job" data-ga4-on-click="true" data-ga4="{&quot;name&quot;:&quot;job_detail__view_or_apply&quot;,&quot;params&quot;:{&quot;job_feed&quot;:&quot;organic&quot;,&quot;user_id&quot;:null,&quot;site_id&quot;:&quot;au&quot;}}" data-action="click->hubble--job#track" data-hubble--job-events-param="[{&quot;name&quot;:&quot;job_apply_linkout_displayed&quot;,&quot;properties&quot;:{&quot;jobId&quot;:&quot;52488ba16b2c398e0675805b4eb44dc6&quot;}},{&quot;name&quot;:&quot;job_apply_pressed&quot;,&quot;properties&quot;:{&quot;jobId&quot;:&quot;52488ba16b2c398e0675805b4eb44dc6&quot;,&quot;linkout&quot;:true,&quot;thirdPartyLink&quot;:true}}]" data-js-open-ea-modal="true" data-rank="2" rel="nofollow noopener" target="_blank" href="/job/rd/52488ba16b2c398e0675805b4eb44dc6?abstract_type=extended_llm&amp;asp=jdv&amp;disallow=true&amp;fsv=true&amp;sp=viewjob&amp;sponsored=false&amp;sq=Entry+Level&amp;sr=2&amp;tk=vUqKxTDJNWMurmdJASUY-44zC8lqOoyloTxgE_FmL"><span class="content">View or apply for job</span></a><button type="submit" class="save-job-button rounded-button -secondary -size-lg" data-disabled="" data-job-id="52488ba16b2c398e0675805b4eb44dc6" data-saved="" data-ga4="{&quot;name&quot;:&quot;save_job__create&quot;,&quot;params&quot;:{&quot;trigger_source&quot;:&quot;job_details_page&quot;,&quot;job_feed&quot;:&quot;organic&quot;,&quot;user_id&quot;:null,&quot;site_id&quot;:&quot;au&quot;}}" data-tk="vUqKxTDJNWMurmdJASUY-44zC8lqOoyloTxgE_FmL" data-label-save="Save job" data-label-saved="Saved"><span class="content">Save job</span></button></div>
                     <div class="scam-warning font-xxsmall"><span class="branded-links">Be careful - Don’t provide your bank or credit card details when applying for jobs. Don't transfer any money or complete suspicious online surveys. If you see something suspicious, <a href="/support/job_ad_reports/new?job_id=52488ba16b2c398e0675805b4eb44dc6" rel="nofollow">report this job ad</a>.</span></div>
                  </div>
                  <div class="email-job-container">
                     <form class="email-job-form" id="mobile_new_job_message" data-ga4="{&quot;name&quot;:&quot;job_detail__share&quot;,&quot;params&quot;:{&quot;job_feed&quot;:&quot;organic&quot;,&quot;user_id&quot;:null,&quot;site_id&quot;:&quot;au&quot;}}" data-ga4-saved-search="{&quot;name&quot;:&quot;save_search__create&quot;,&quot;params&quot;:{&quot;trigger_source&quot;:&quot;job_details_page&quot;,&quot;user_id&quot;:null,&quot;site_id&quot;:&quot;au&quot;}}" action="/job_messages" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="✓" autocomplete="off"><input type="hidden" name="authenticity_token" value="lHW-VFCDXEv_shsw8cVBm8ohZ9AbR3TUkN0i7RJcAXAaQ1GuGzlxYdNHkc0EleWGZHAzDMsH4Wp9wwe-p1y9jg" autocomplete="off">
                        <div class="email-job-heading heading-with-icon"><svg class="icon icon-email" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M3.87 5.5h16.26c.2 0 .37.168.37.382v12.236a.377.377 0 01-.37.382H3.87c-.2 0-.37-.168-.37-.382V5.882c0-.214.163-.382.37-.382z" stroke="#0e8136" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path d="M3.5 5.775l8.5 7.647 8.5-7.647M9.45 11.128L3.5 16.481M20.5 16.481l-5.95-5.353" stroke="#0e8136" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                           </svg>
                           <h3 class="heading -size-medium -weight-700 -mb-0">Email to yourself or a friend</h3>
                        </div><input autocomplete="off" type="hidden" value="52488ba16b2c398e0675805b4eb44dc6" name="job_message[job_id]" id="mobile_job_message_job_id"><input class="to-email-field" placeholder="Enter your email" required="required" type="email" name="job_message[to_email]" id="mobile_job_message_to_email"><input type="hidden" name="query" id="query" value="Entry Level" autocomplete="off"><input type="hidden" name="raw_location" id="raw_location" autocomplete="off"><input type="hidden" name="radius" id="radius" autocomplete="off"><input type="hidden" name="job_type_id" id="job_type_id" autocomplete="off"><input type="hidden" name="salary_min" id="salary_min" autocomplete="off"><label class="email-subscribe checkbox-wrap -display-flex" for="mobile_subscribe_to_alerts"><input type="checkbox" name="subscribe_to_alerts" id="mobile_subscribe_to_alerts" value="true" class="checkbox-tag"><span class="font-xsmall">Send daily alerts for similar jobs</span></label><button type="submit" class="email-job-button rounded-button -secondary -size-lg -w-full" data-gtm="email_job"><span class="content">Email job</span></button>
                     </form>
                     <div class="successful-email-job-container closed">
                        <div class="heading-with-icon"><svg class="icon icon-email" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M3.87 5.5h16.26c.2 0 .37.168.37.382v12.236a.377.377 0 01-.37.382H3.87c-.2 0-.37-.168-.37-.382V5.882c0-.214.163-.382.37-.382z" stroke="#0e8136" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path d="M3.5 5.775l8.5 7.647 8.5-7.647M9.45 11.128L3.5 16.481M20.5 16.481l-5.95-5.353" stroke="#0e8136" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                           </svg>
                           <h3 class="heading -size-medium -weight-700 -mb-0">Email sent</h3>
                        </div>
                        <p>We have sent this job to <b class="to-email"></b>.</p><button type="submit" class="email-another-button rounded-button -secondary -size-lg -w-full"><span class="content">Send to another email</span></button>
                     </div>
                  </div>
                  <div id="bottom_afs" style="height: auto;"><iframe frameborder="0" marginwidth="0" marginheight="0" allowtransparency="true" scrolling="no" width="100%" name="master-a-1|{&quot;name&quot;:&quot;master-1&quot;,&quot;master-a-1&quot;:{&quot;container&quot;:&quot;bottom_afs&quot;,&quot;styleId&quot;:&quot;6270669194&quot;,&quot;fexp&quot;:&quot;21404,17300002,17301431,17301432,17301436,17301548,17301266,72717107&quot;,&quot;masterNumber&quot;:1,&quot;number&quot;:0,&quot;pubId&quot;:&quot;pub-2856288649011803&quot;,&quot;query&quot;:&quot;Entry Level Office jobs in Beaconsfield NSW&quot;,&quot;role&quot;:&quot;s&quot;,&quot;adLoadedCallback&quot;:null,&quot;resultsPageQueryParam&quot;:&quot;query&quot;,&quot;ie&quot;:&quot;UTF-8&quot;,&quot;maxTop&quot;:0,&quot;minTop&quot;:0,&quot;oe&quot;:&quot;UTF-8&quot;,&quot;type&quot;:&quot;ads&quot;,&quot;linkTarget&quot;:&quot;_blank&quot;},&quot;master-b-1&quot;:{&quot;container&quot;:&quot;bottom_afs&quot;,&quot;styleId&quot;:&quot;6270669194&quot;,&quot;fexp&quot;:&quot;21404,17300002,17301431,17301432,17301436,17301548,17301266,72717107&quot;,&quot;masterNumber&quot;:1,&quot;number&quot;:0,&quot;pubId&quot;:&quot;pub-2856288649011803&quot;,&quot;query&quot;:&quot;Entry Level Office jobs in Beaconsfield NSW&quot;,&quot;role&quot;:&quot;s&quot;,&quot;adLoadedCallback&quot;:null,&quot;resultsPageQueryParam&quot;:&quot;query&quot;,&quot;ie&quot;:&quot;UTF-8&quot;,&quot;maxTop&quot;:0,&quot;minTop&quot;:0,&quot;oe&quot;:&quot;UTF-8&quot;,&quot;type&quot;:&quot;ads&quot;,&quot;linkTarget&quot;:&quot;_blank&quot;},&quot;master-1&quot;:{&quot;container&quot;:&quot;bottom_afs&quot;,&quot;styleId&quot;:&quot;6270669194&quot;,&quot;channel&quot;:&quot;7950009880&quot;,&quot;fexp&quot;:&quot;21404,17300002,17301431,17301432,17301436,17301548,17301266,72717107&quot;,&quot;masterNumber&quot;:1,&quot;number&quot;:3,&quot;pubId&quot;:&quot;pub-2856288649011803&quot;,&quot;query&quot;:&quot;Entry Level Office jobs in Beaconsfield NSW&quot;,&quot;role&quot;:&quot;m&quot;,&quot;sct&quot;:&quot;ID=6af024eccbf5aec7:T=1743404786:RT=1743404786:S=ALNI_MZZmtP9RLggE3G0TNeM33v8CFBn0Q&quot;,&quot;sc_status&quot;:6,&quot;adLoadedCallback&quot;:null,&quot;hl&quot;:&quot;en&quot;,&quot;resultsPageQueryParam&quot;:&quot;query&quot;,&quot;ie&quot;:&quot;UTF-8&quot;,&quot;maxTop&quot;:0,&quot;minTop&quot;:0,&quot;oe&quot;:&quot;UTF-8&quot;,&quot;type&quot;:&quot;ads&quot;,&quot;linkTarget&quot;:&quot;_blank&quot;}}" id="master-a-1" src="https://syndicatedsearch.goog/afs/ads/i/iframe.html" data-observe="1" allow="attribution-reporting" style="visibility: hidden; height: 0px; display: block;" data-lle="1"></iframe><iframe frameborder="0" marginwidth="0" marginheight="0" allowtransparency="true" scrolling="no" width="100%" name="{&quot;name&quot;:&quot;master-1&quot;,&quot;master-a-1&quot;:{&quot;container&quot;:&quot;bottom_afs&quot;,&quot;styleId&quot;:&quot;6270669194&quot;,&quot;fexp&quot;:&quot;21404,17300002,17301431,17301432,17301436,17301548,17301266,72717107&quot;,&quot;masterNumber&quot;:1,&quot;number&quot;:0,&quot;pubId&quot;:&quot;pub-2856288649011803&quot;,&quot;query&quot;:&quot;Entry Level Office jobs in Beaconsfield NSW&quot;,&quot;role&quot;:&quot;s&quot;,&quot;adLoadedCallback&quot;:null,&quot;resultsPageQueryParam&quot;:&quot;query&quot;,&quot;ie&quot;:&quot;UTF-8&quot;,&quot;maxTop&quot;:0,&quot;minTop&quot;:0,&quot;oe&quot;:&quot;UTF-8&quot;,&quot;type&quot;:&quot;ads&quot;,&quot;linkTarget&quot;:&quot;_blank&quot;},&quot;master-b-1&quot;:{&quot;container&quot;:&quot;bottom_afs&quot;,&quot;styleId&quot;:&quot;6270669194&quot;,&quot;fexp&quot;:&quot;21404,17300002,17301431,17301432,17301436,17301548,17301266,72717107&quot;,&quot;masterNumber&quot;:1,&quot;number&quot;:0,&quot;pubId&quot;:&quot;pub-2856288649011803&quot;,&quot;query&quot;:&quot;Entry Level Office jobs in Beaconsfield NSW&quot;,&quot;role&quot;:&quot;s&quot;,&quot;adLoadedCallback&quot;:null,&quot;resultsPageQueryParam&quot;:&quot;query&quot;,&quot;ie&quot;:&quot;UTF-8&quot;,&quot;maxTop&quot;:0,&quot;minTop&quot;:0,&quot;oe&quot;:&quot;UTF-8&quot;,&quot;type&quot;:&quot;ads&quot;,&quot;linkTarget&quot;:&quot;_blank&quot;},&quot;master-1&quot;:{&quot;container&quot;:&quot;bottom_afs&quot;,&quot;styleId&quot;:&quot;6270669194&quot;,&quot;channel&quot;:&quot;7950009880&quot;,&quot;fexp&quot;:&quot;21404,17300002,17301431,17301432,17301436,17301548,17301266,72717107&quot;,&quot;masterNumber&quot;:1,&quot;number&quot;:3,&quot;pubId&quot;:&quot;pub-2856288649011803&quot;,&quot;query&quot;:&quot;Entry Level Office jobs in Beaconsfield NSW&quot;,&quot;role&quot;:&quot;m&quot;,&quot;sct&quot;:&quot;ID=6af024eccbf5aec7:T=1743404786:RT=1743404786:S=ALNI_MZZmtP9RLggE3G0TNeM33v8CFBn0Q&quot;,&quot;sc_status&quot;:6,&quot;adLoadedCallback&quot;:null,&quot;hl&quot;:&quot;en&quot;,&quot;resultsPageQueryParam&quot;:&quot;query&quot;,&quot;ie&quot;:&quot;UTF-8&quot;,&quot;maxTop&quot;:0,&quot;minTop&quot;:0,&quot;oe&quot;:&quot;UTF-8&quot;,&quot;type&quot;:&quot;ads&quot;,&quot;linkTarget&quot;:&quot;_blank&quot;}}" id="master-1" src="https://syndicatedsearch.goog/afs/ads?adtest=off&amp;psid=6270669194&amp;channel=7950009880&amp;client=pub-2856288649011803&amp;q=Entry%20Level%20Office%20jobs%20in%20Beaconsfield%20NSW&amp;r=m&amp;sct=ID%3D6af024eccbf5aec7%3AT%3D1743404786%3ART%3D1743404786%3AS%3DALNI_MZZmtP9RLggE3G0TNeM33v8CFBn0Q&amp;sc_status=6&amp;hl=en&amp;type=0&amp;oe=UTF-8&amp;ie=UTF-8&amp;fexp=21404%2C17300002%2C17301431%2C17301432%2C17301436%2C17301548%2C17301266%2C72717107&amp;format=n3&amp;ad=n3&amp;nocache=4241743404999123&amp;num=0&amp;output=uds_ads_only&amp;v=3&amp;bsl=8&amp;pac=2&amp;u_his=1&amp;u_tz=330&amp;dt=1743404999124&amp;u_w=1536&amp;u_h=864&amp;biw=1521&amp;bih=703&amp;psw=1521&amp;psh=1280&amp;frm=0&amp;uio=-&amp;cont=bottom_afs&amp;drt=0&amp;jsid=csa&amp;nfp=1&amp;jsv=740324255&amp;rurl=https%3A%2F%2Fau.jora.com%2Fjob%2FEntry-Level-Office-52488ba16b2c398e0675805b4eb44dc6%3Fabstract_type%3Dextended_llm%26disallow%3Dtrue%26from_url%3Dhttps%253A%252F%252Fau.jora.com%252Fjob%252Fdescription%252F52488ba16b2c398e0675805b4eb44dc6%253Fabstract_type%253Dextended_llm%2526cp%253D1%2526sol_key%253Df65ce677e8b0db7942f3ae5f8b9974ed%2526sp%253Dserp%2526sq%253DEntry%252520Level%2526sr%253D2%2526tk%253DvUqKxTDJNWMurmdJASUY-44zC8lqOoyloTxgE_FmL%26fsv%3Dtrue%26sol_key%3Df65ce677e8b0db7942f3ae5f8b9974ed%26sp%3Dserp_jdv%26sq%3DEntry%2BLevel%26sr%3D2%26tk%3DvUqKxTDJNWMurmdJASUY-44zC8lqOoyloTxgE_FmL%26trigger_source%3Djob_details_page&amp;referer=https%3A%2F%2Fau.jora.com%2FEntry-Level-jobs%3Fsp%3Dtrending_popular" data-observe="1" allow="attribution-reporting" style="visibility: visible; height: 562px; display: block;" data-lle="1" title="Ads by Google"></iframe><iframe frameborder="0" marginwidth="0" marginheight="0" allowtransparency="true" scrolling="no" width="100%" name="master-b-1|{&quot;name&quot;:&quot;master-1&quot;,&quot;master-a-1&quot;:{&quot;container&quot;:&quot;bottom_afs&quot;,&quot;styleId&quot;:&quot;6270669194&quot;,&quot;fexp&quot;:&quot;21404,17300002,17301431,17301432,17301436,17301548,17301266,72717107&quot;,&quot;masterNumber&quot;:1,&quot;number&quot;:0,&quot;pubId&quot;:&quot;pub-2856288649011803&quot;,&quot;query&quot;:&quot;Entry Level Office jobs in Beaconsfield NSW&quot;,&quot;role&quot;:&quot;s&quot;,&quot;adLoadedCallback&quot;:null,&quot;resultsPageQueryParam&quot;:&quot;query&quot;,&quot;ie&quot;:&quot;UTF-8&quot;,&quot;maxTop&quot;:0,&quot;minTop&quot;:0,&quot;oe&quot;:&quot;UTF-8&quot;,&quot;type&quot;:&quot;ads&quot;,&quot;linkTarget&quot;:&quot;_blank&quot;},&quot;master-b-1&quot;:{&quot;container&quot;:&quot;bottom_afs&quot;,&quot;styleId&quot;:&quot;6270669194&quot;,&quot;fexp&quot;:&quot;21404,17300002,17301431,17301432,17301436,17301548,17301266,72717107&quot;,&quot;masterNumber&quot;:1,&quot;number&quot;:0,&quot;pubId&quot;:&quot;pub-2856288649011803&quot;,&quot;query&quot;:&quot;Entry Level Office jobs in Beaconsfield NSW&quot;,&quot;role&quot;:&quot;s&quot;,&quot;adLoadedCallback&quot;:null,&quot;resultsPageQueryParam&quot;:&quot;query&quot;,&quot;ie&quot;:&quot;UTF-8&quot;,&quot;maxTop&quot;:0,&quot;minTop&quot;:0,&quot;oe&quot;:&quot;UTF-8&quot;,&quot;type&quot;:&quot;ads&quot;,&quot;linkTarget&quot;:&quot;_blank&quot;},&quot;master-1&quot;:{&quot;container&quot;:&quot;bottom_afs&quot;,&quot;styleId&quot;:&quot;6270669194&quot;,&quot;channel&quot;:&quot;7950009880&quot;,&quot;fexp&quot;:&quot;21404,17300002,17301431,17301432,17301436,17301548,17301266,72717107&quot;,&quot;masterNumber&quot;:1,&quot;number&quot;:3,&quot;pubId&quot;:&quot;pub-2856288649011803&quot;,&quot;query&quot;:&quot;Entry Level Office jobs in Beaconsfield NSW&quot;,&quot;role&quot;:&quot;m&quot;,&quot;sct&quot;:&quot;ID=6af024eccbf5aec7:T=1743404786:RT=1743404786:S=ALNI_MZZmtP9RLggE3G0TNeM33v8CFBn0Q&quot;,&quot;sc_status&quot;:6,&quot;adLoadedCallback&quot;:null,&quot;hl&quot;:&quot;en&quot;,&quot;resultsPageQueryParam&quot;:&quot;query&quot;,&quot;ie&quot;:&quot;UTF-8&quot;,&quot;maxTop&quot;:0,&quot;minTop&quot;:0,&quot;oe&quot;:&quot;UTF-8&quot;,&quot;type&quot;:&quot;ads&quot;,&quot;linkTarget&quot;:&quot;_blank&quot;}}" id="master-b-1" src="https://syndicatedsearch.goog/afs/ads/i/iframe.html" data-observe="1" allow="attribution-reporting" style="visibility: hidden; height: 0px; display: block;" data-lle="1"></iframe></div>
               </div>
               <div class="job-view-right-pane grid-right-pane">
                  <div class="email-job-container">
                     <form class="email-job-form" id="desktop_new_job_message" data-ga4="{&quot;name&quot;:&quot;job_detail__share&quot;,&quot;params&quot;:{&quot;job_feed&quot;:&quot;organic&quot;,&quot;user_id&quot;:null,&quot;site_id&quot;:&quot;au&quot;}}" data-ga4-saved-search="{&quot;name&quot;:&quot;save_search__create&quot;,&quot;params&quot;:{&quot;trigger_source&quot;:&quot;job_details_page&quot;,&quot;user_id&quot;:null,&quot;site_id&quot;:&quot;au&quot;}}" action="/job_messages" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="✓" autocomplete="off"><input type="hidden" name="authenticity_token" value="lHW-VFCDXEv_shsw8cVBm8ohZ9AbR3TUkN0i7RJcAXAaQ1GuGzlxYdNHkc0EleWGZHAzDMsH4Wp9wwe-p1y9jg" autocomplete="off">
                        <div class="email-job-heading heading-with-icon"><svg class="icon icon-email" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M3.87 5.5h16.26c.2 0 .37.168.37.382v12.236a.377.377 0 01-.37.382H3.87c-.2 0-.37-.168-.37-.382V5.882c0-.214.163-.382.37-.382z" stroke="#0e8136" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path d="M3.5 5.775l8.5 7.647 8.5-7.647M9.45 11.128L3.5 16.481M20.5 16.481l-5.95-5.353" stroke="#0e8136" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                           </svg>
                           <h3 class="heading -size-medium -weight-700 -mb-0">Email to yourself or a friend</h3>
                        </div><input autocomplete="off" type="hidden" value="52488ba16b2c398e0675805b4eb44dc6" name="job_message[job_id]" id="desktop_job_message_job_id"><input class="to-email-field" placeholder="Enter your email" required="required" type="email" name="job_message[to_email]" id="desktop_job_message_to_email"><input type="hidden" name="query" id="query" value="Entry Level" autocomplete="off"><input type="hidden" name="raw_location" id="raw_location" autocomplete="off"><input type="hidden" name="radius" id="radius" autocomplete="off"><input type="hidden" name="job_type_id" id="job_type_id" autocomplete="off"><input type="hidden" name="salary_min" id="salary_min" autocomplete="off"><label class="email-subscribe checkbox-wrap -display-flex" for="desktop_subscribe_to_alerts"><input type="checkbox" name="subscribe_to_alerts" id="desktop_subscribe_to_alerts" value="true" class="checkbox-tag"><span class="font-xsmall">Send daily alerts for similar jobs</span></label><button type="submit" class="email-job-button rounded-button -secondary -size-lg -w-full" data-gtm="email_job"><span class="content">Email job</span></button>
                     </form>
                     <div class="successful-email-job-container closed">
                        <div class="heading-with-icon"><svg class="icon icon-email" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M3.87 5.5h16.26c.2 0 .37.168.37.382v12.236a.377.377 0 01-.37.382H3.87c-.2 0-.37-.168-.37-.382V5.882c0-.214.163-.382.37-.382z" stroke="#0e8136" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path d="M3.5 5.775l8.5 7.647 8.5-7.647M9.45 11.128L3.5 16.481M20.5 16.481l-5.95-5.353" stroke="#0e8136" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                           </svg>
                           <h3 class="heading -size-medium -weight-700 -mb-0">Email sent</h3>
                        </div>
                        <p>We have sent this job to <b class="to-email"></b>.</p><button type="submit" class="email-another-button rounded-button -secondary -size-lg -w-full"><span class="content">Send to another email</span></button>
                     </div>
                  </div><ins class="adsbygoogle" data-ad-client="ca-pub-2856288649011803" data-ad-format="fluid" data-ad-layout-key="-gt-4+15-47+6g" data-ad-slot="2713136245" style="display: block; height: 157px;" data-adsbygoogle-status="done" data-ad-status="unfilled">
                     <div id="aswift_1_host" style="border: none; height: 157px; width: 307px; margin: 0px; padding: 0px; position: relative; visibility: visible; background-color: transparent; display: inline-block;"><iframe id="aswift_1" name="aswift_1" browsingtopics="true" style="left:0;position:absolute;top:0;border:0;width:307px;height:157px;" sandbox="allow-forms allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts allow-top-navigation-by-user-activation" width="307" height="157" frameborder="0" marginwidth="0" marginheight="0" vspace="0" hspace="0" allowtransparency="true" scrolling="no" allow="attribution-reporting; run-ad-auction" src="https://googleads.g.doubleclick.net/pagead/ads?client=ca-pub-2856288649011803&amp;output=html&amp;h=157&amp;slotname=2713136245&amp;adk=1283385188&amp;adf=3578161254&amp;pi=t.ma~as.2713136245&amp;w=307&amp;abgtt=13&amp;lmt=1743404999&amp;rafmt=11&amp;channel=7190019996&amp;format=307x157&amp;url=https%3A%2F%2Fau.jora.com%2Fjob%2FEntry-Level-Office-52488ba16b2c398e0675805b4eb44dc6%3Fabstract_type%3Dextended_llm%26disallow%3Dtrue%26from_url%3Dhttps%253A%252F%252Fau.jora.com%252Fjob%252Fdescription%252F52488ba16b2c398e0675805b4eb44dc6%253Fabstract_type%253Dextended_llm%2526cp%253D1%2526sol_key%253Df65ce677e8b0db7942f3ae5f8b9974ed%2526sp%253Dserp%2526sq%253DEntry%252520Level%2526sr%253D2%2526tk%253DvUqKxTDJNWMurmdJASUY-44zC8lqOoyloTxgE_FmL%26fsv%3Dtrue%26sol_key%3Df65ce677e8b0db7942f3ae5f8b9974ed%26sp%3Dserp_jdv%26sq%3DEntry%2BLevel%26sr%3D2%26tk%3DvUqKxTDJNWMurmdJASUY-44zC8lqOoyloTxgE_FmL%26trigger_source%3Djob_details_page&amp;wgl=1&amp;uach=WyJXaW5kb3dzIiwiOC4wLjAiLCJ4ODYiLCIiLCIxMzQuMC42OTk4LjE3OCIsbnVsbCwwLG51bGwsIjY0IixbWyJDaHJvbWl1bSIsIjEzNC4wLjY5OTguMTc4Il0sWyJOb3Q6QS1CcmFuZCIsIjI0LjAuMC4wIl0sWyJHb29nbGUgQ2hyb21lIiwiMTM0LjAuNjk5OC4xNzgiXV0sMF0.&amp;dt=1743404999033&amp;bpp=34&amp;bdt=188&amp;idt=144&amp;shv=r20250327&amp;mjsv=m202503260101&amp;ptt=9&amp;saldr=aa&amp;abxe=1&amp;cookie_enabled=1&amp;eoidce=1&amp;prev_fmts=0x0&amp;nras=1&amp;correlator=119678001261&amp;frm=20&amp;pv=1&amp;u_tz=330&amp;u_his=1&amp;u_h=864&amp;u_w=1536&amp;u_ah=824&amp;u_aw=1536&amp;u_cd=24&amp;u_sd=1.25&amp;dmc=8&amp;adx=1087&amp;ady=512&amp;biw=1521&amp;bih=703&amp;scr_x=0&amp;scr_y=0&amp;eid=31091333%2C42532523%2C95331833%2C95332925%2C95356500%2C95356505%2C31091324%2C95355301%2C95356787%2C95356927&amp;oid=2&amp;pvsid=322011239812650&amp;tmod=683461793&amp;uas=0&amp;nvt=1&amp;ref=https%3A%2F%2Fau.jora.com%2FEntry-Level-jobs%3Fsp%3Dtrending_popular&amp;fc=1920&amp;brdim=0%2C0%2C0%2C0%2C1536%2C0%2C1536%2C824%2C1536%2C703&amp;vis=1&amp;rsz=%7C%7CeE%7C&amp;abl=CS&amp;pfx=0&amp;fu=128&amp;bc=31&amp;bz=1&amp;td=1&amp;tdf=2&amp;psd=W251bGwsbnVsbCxudWxsLDNd&amp;nt=1&amp;ifi=2&amp;uci=a!2&amp;fsb=1&amp;dtd=152" data-google-container-id="a!2" tabindex="0" title="Advertisement" aria-label="Advertisement" data-google-query-id="CLrAzd3hs4wDFcdZwgUd1MwW0w" data-load-complete="true"></iframe></div>
                  </ins>
                  <script>
                     (adsbygoogle = window.adsbygoogle || []).push({
                        params: {
                           google_ad_channel: "7190019996"
                        }
                     });
                  </script>
               </div>
            </div>--}}
         </div>
      <!-- start show job details  -->

   </main>
</section>
@endsection
@section('styleSheets')
<link rel="stylesheet" href="{{ asset('css/jobs.css')}}">
@endsection
@section('script')
<script>
   document.addEventListener("DOMContentLoaded", function() {
      // Select all dropdown containers
      const dropdowns = document.querySelectorAll(".dropdown-container");

      dropdowns.forEach(dropdown => {
         const dropdownBtn = dropdown.querySelector("button");
         const dropdownMenu = dropdown.querySelector("ul");

         // Toggle dropdown menu on button click
         dropdownBtn.addEventListener("click", function(event) {
            event.stopPropagation(); // Prevent event bubbling
            dropdownMenu.classList.toggle("hidden");

            // Close other open dropdowns
            dropdowns.forEach(otherDropdown => {
               if (otherDropdown !== dropdown) {
                  otherDropdown.querySelector("ul").classList.add("hidden");
               }
            });
         });

         // Close dropdown if clicked outside
         document.addEventListener("click", function(event) {
            if (!dropdown.contains(event.target)) {
               dropdownMenu.classList.add("hidden");
            }
         });

         // Handle clicking on dropdown items (Optional: Redirect)
         // dropdownMenu.querySelectorAll(".dropdown-item").forEach(item => {
         //    item.addEventListener("click", function () {
         //       window.location.href = item.getAttribute("data-href");
         //    });
         // });
      });
   });
</script>


<script>
   // Add a click event listener to job cards to fetch job details
   $(document).ready(function() {
      $('#showJobsDetails').empty();
      var slug = '{{$slug}}';
       
      var baseUrl = window.location.origin;
      $.ajax({
         url: `${baseUrl}/jobDetailsApi/${slug}`, // Adjust the URL as necessary
         type: 'GET',
         dataType: 'json',
         success: function(response) {

            $('#showJobsDetails').empty();
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
                  <div class="job-details-page content-container -width-xl grid-container -two-columns">
                     <div class="job-view-content grid-content" id="job-view">
                        <div class="-desktop-no-padding-top" id="job-info-container">
                           <h1 class="job-title heading -size-xxlarge -weight-700">${job.job_title ? job.job_title : 'Job Title Not Available'}</h1>
                           <div class="font-small" id="company-location-container">
                              <span class="company">${job.contact_company_name ? job.contact_company_name : 'Company Name Not Available'}</span>
                              <span class="divider">–</span>
                              <span class="location">${job.contact_address ? job.contact_address : 'Address Not Available'}</span>
                           </div>

                           
                           ${jobTypeName}

                           ${experienceBadge}

                           <div class="font-xsmall" id="job-meta">
                              <span class="listed-date">${postedText}</span>, from <span class="site">Backupp</span>
                           </div>
                        </div>
                        <div class="job-view-actions-container top-actions-container">
                           <div class="action-buttons-container"><a class="apply-button rounded-button -primary -size-lg -w-full" data-gtm="apply-job" data-ga4-on-click="true" data-ga4="{&quot;name&quot;:&quot;job_detail__view_or_apply&quot;,&quot;params&quot;:{&quot;job_feed&quot;:&quot;organic&quot;,&quot;user_id&quot;:null,&quot;site_id&quot;:&quot;au&quot;}}" data-action="click->hubble--job#track" data-hubble--job-events-param="[{&quot;name&quot;:&quot;job_apply_linkout_displayed&quot;,&quot;properties&quot;:{&quot;slug&quot;:&quot;52488ba16b2c398e0675805b4eb44dc6&quot;}},{&quot;name&quot;:&quot;job_apply_pressed&quot;,&quot;properties&quot;:{&quot;jobId&quot;:&quot;52488ba16b2c398e0675805b4eb44dc6&quot;,&quot;linkout&quot;:true,&quot;thirdPartyLink&quot;:true}}]" data-js-open-ea-modal="true" data-rank="2" rel="nofollow noopener" target="_blank" href="/job/rd/52488ba16b2c398e0675805b4eb44dc6?abstract_type=extended_llm&amp;asp=jdv&amp;disallow=true&amp;fsv=true&amp;sp=viewjob&amp;sponsored=false&amp;sq=Entry+Level&amp;sr=2&amp;tk=vUqKxTDJNWMurmdJASUY-44zC8lqOoyloTxgE_FmL"><span class="content">View or apply for job</span></a>
                              <button type="submit" class="save-job-button rounded-button -secondary -size-lg">
                                 <span class="content SaveJob" SaveJob="${job.slug}" style="min-width: 100px;">Save job</span>
                              </button>
                           </div>
                        </div>

                        <div class="-desktop-no-padding-top" id="job-description-container">
                           <strong>Job summary:</strong>
                           ${jobDescription}

                           <div class="job-view-actions-container top-actions-container">
                              <div class="action-buttons-container"><a class="apply-button rounded-button -primary -size-lg -w-full" data-gtm="apply-job" data-ga4-on-click="true" data-ga4="{&quot;name&quot;:&quot;job_detail__view_or_apply&quot;,&quot;params&quot;:{&quot;job_feed&quot;:&quot;organic&quot;,&quot;user_id&quot;:null,&quot;site_id&quot;:&quot;au&quot;}}" data-action="click->hubble--job#track" data-hubble--job-events-param="[{&quot;name&quot;:&quot;job_apply_linkout_displayed&quot;,&quot;properties&quot;:{&quot;jobId&quot;:&quot;52488ba16b2c398e0675805b4eb44dc6&quot;}},{&quot;name&quot;:&quot;job_apply_pressed&quot;,&quot;properties&quot;:{&quot;jobId&quot;:&quot;52488ba16b2c398e0675805b4eb44dc6&quot;,&quot;linkout&quot;:true,&quot;thirdPartyLink&quot;:true}}]" data-js-open-ea-modal="true" data-rank="2" rel="nofollow noopener" target="_blank" href="/job/rd/52488ba16b2c398e0675805b4eb44dc6?abstract_type=extended_llm&amp;asp=jdv&amp;disallow=true&amp;fsv=true&amp;sp=viewjob&amp;sponsored=false&amp;sq=Entry+Level&amp;sr=2&amp;tk=vUqKxTDJNWMurmdJASUY-44zC8lqOoyloTxgE_FmL"><span class="content">View or apply for job</span></a><button type="submit" class="save-job-button rounded-button -secondary -size-lg">
                                 <span class="content SaveJob" SaveJob="${job.slug}" style="min-width: 100px;">Save job</span>
                              </div>
                           </div>
                        </div>
                     </div>
                     
                     <div class="job-view-right-pane grid-right-pane">
                        <div class="email-job-container">
                           <form class="email-job-form" id="desktop_new_job_message" method="post">
                              <input name="utf8" type="hidden" value="✓" autocomplete="off">
                              <input type="hidden" name="authenticity_token" value="lHW-VFCDXEv_shsw8cVBm8ohZ9AbR3TUkN0i7RJcAXAaQ1GuGzlxYdNHkc0EleWGZHAzDMsH4Wp9wwe-p1y9jg" autocomplete="off">
                              <div class="email-job-heading heading-with-icon"><svg class="icon icon-email" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.87 5.5h16.26c.2 0 .37.168.37.382v12.236a.377.377 0 01-.37.382H3.87c-.2 0-.37-.168-.37-.382V5.882c0-.214.163-.382.37-.382z" stroke="#0e8136" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M3.5 5.775l8.5 7.647 8.5-7.647M9.45 11.128L3.5 16.481M20.5 16.481l-5.95-5.353" stroke="#0e8136" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                 </svg>
                                 <h3 class="heading -size-medium -weight-700 -mb-0">Email to yourself or a friend</h3>
                              </div>
                              <input autocomplete="off" type="hidden" value="52488ba16b2c398e0675805b4eb44dc6" name="job_message[job_id]" id="desktop_job_message_job_id"><input class="to-email-field" placeholder="Enter your email" required="required" type="email" name="job_message[to_email]" id="desktop_job_message_to_email"><input type="hidden" name="query" id="query" value="Entry Level" autocomplete="off"><input type="hidden" name="raw_location" id="raw_location" autocomplete="off">
                              <input type="hidden" name="radius" id="radius" autocomplete="off"><input type="hidden" name="job_type_id" id="job_type_id" autocomplete="off"><input type="hidden" name="salary_min" id="salary_min" autocomplete="off">
                              <label class="email-subscribe checkbox-wrap -display-flex" for="desktop_subscribe_to_alerts">
                              <input type="checkbox"><span style="font-size:12px;">Send daily alerts for similar jobs</span></label>
                              <button type="submit" class="email-job-button rounded-button -secondary -size-lg -w-full" style="width:100%;">
                                 <span class="content">Email job</span>
                              </button>
                           </form>
                           <div class="successful-email-job-container closed">
                              <div class="heading-with-icon"><svg class="icon icon-email" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.87 5.5h16.26c.2 0 .37.168.37.382v12.236a.377.377 0 01-.37.382H3.87c-.2 0-.37-.168-.37-.382V5.882c0-.214.163-.382.37-.382z" stroke="#0e8136" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M3.5 5.775l8.5 7.647 8.5-7.647M9.45 11.128L3.5 16.481M20.5 16.481l-5.95-5.353" stroke="#0e8136" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                 </svg>
                                 <h3 class="heading -size-medium -weight-700 -mb-0">Email sent</h3>
                              </div>
                              <p>We have sent this job to <b class="to-email"></b>.</p><button type="submit" class="email-another-button rounded-button -secondary -size-lg -w-full"><span class="content">Send to another email</span></button>
                           </div>
                        </div>
                        </ins>
                     </div>
                  </div>
               `);
            } else {
               // alert('Failed to fetch job details');
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

<!-- code for Save Job -->
<script>
   // Event listener for clicks on .SaveJob elements
   jQuery(document).on('click', '.SaveJob', function() {

      var baseUrl = window.location.origin;
      
      // Get the value of the SaveJob attribute (job.slug)
      var  btn = $(this);
      const jobSlug = btn.attr('SaveJob');
      const firstText = btn.text();
      btn.attr('diasbled', true);

      var loggedUser = "{{auth()->guard('user')->user()}}";
      if(!loggedUser){
         window.location.href = "{{url('login-first')}}";
         return false;
      }

      // Get CSRF token from meta tag
      var csrfToken = $('meta[name="csrf-token"]').attr('content');

      // Send AJAX request to the server
      $.ajax({
         url: `${baseUrl}/jobSaveApi`,
         type: 'POST',
         headers: {
            'X-CSRF-TOKEN': csrfToken  // Include CSRF token in the header
         },
         data: {
            job_slug: jobSlug
         },
         beforeSend: function(){
            btn.html('<span class="spinner-border spinner-border-md text-success-role=" status"="" aria-hidden="true"></span>');
         },
         success: function(response) {
            // Handle successful response
            console.log(response);
            if (response.success) {
               showToast(response.message, "success");
            }else{
               showToast(response.message, "error");
            }
            btn.html(firstText);
            btn.attr('diasbled', false);
         },
         error: function(xhr, status, error) {
            // Handle errors
            showToast("There was an error applying for the job.", "error");
            console.error('Error:', error);
            
            btn.html(firstText);
            btn.attr('diasbled', false);
         }
      });
   });
</script>

@endsection