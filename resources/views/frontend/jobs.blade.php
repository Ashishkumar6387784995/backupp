@extends('frontend.layouts.default_layout')
@section('content')
<section class="jobs">
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
      <div class="search-header-content content-container -width-xl">
         <div class="pill-desktop-filters" data-js-pill-desktop-filters="true">
            <div class="sort-container">
               <span class="sort-label">Sort by:</span>
               <span class="sort-selected">Relevance</span> / <a class="sort-link -link-cool" data-href="/j?l=&amp;q=Legal+Intern&amp;sp=trending_popular&amp;st=date">Date</a>
            </div>
            <div class="pill-filters">
               <!-- Dropdown 1 -->
               <div class="personalized-tags-pill-dropdown pill-dropdown dropdown-container" data-js-linking-dropdown="true">
                  <button class="dropdownBtn inline-flex justify-center w-full rounded-full border border-gray-300 shadow-sm px-8 py-3 bg-white text-lg font-medium text-gray-700 hover:bg-gray-50 focus:outline-none">
                     Job Freshness
                     <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l5 5 5-5" />
                     </svg>
                  </button>
                  <ul class="dropdown-options-container hidden absolute bg-white border shadow-lg mt-2 w-full">
                     <li class="dropdown-item px-4 py-2 cursor-pointer hover:bg-gray-100">Any jobs</li>
                     <li class="dropdown-item px-4 py-2 cursor-pointer hover:bg-gray-100">New to you</li>
                     <li class="dropdown-item px-4 py-2 cursor-pointer hover:bg-gray-100">Seen</li>
                     <li class="dropdown-item px-4 py-2 cursor-pointer hover:bg-gray-100">Viewed details</li>
                     <li class="dropdown-item px-4 py-2 cursor-pointer hover:bg-gray-100">Started applying</li>
                     <li class="dropdown-item px-4 py-2 cursor-pointer hover:bg-gray-100">Applied</li>
                  </ul>
               </div>
               <div class="personalized-tags-pill-dropdown pill-dropdown dropdown-container" data-js-linking-dropdown="true">
                  <button class="dropdownBtn inline-flex justify-center w-full rounded-full border border-gray-300 shadow-sm px-8 py-3 bg-white text-lg font-medium text-gray-700 hover:bg-gray-50 focus:outline-none">
                     Job type
                     <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l5 5 5-5" />
                     </svg>
                  </button>
                  <ul class="dropdown-options-container hidden absolute bg-white border shadow-lg mt-2 w-full">
                     <li class="dropdown-item px-4 py-2 cursor-pointer hover:bg-gray-100">Any job type</li>
                     <li class="dropdown-item px-4 py-2 cursor-pointer hover:bg-gray-100">Volunteer</li>
                     <li class="dropdown-item px-4 py-2 cursor-pointer hover:bg-gray-100">Full time</li>
                     <li class="dropdown-item px-4 py-2 cursor-pointer hover:bg-gray-100">Casual/Temporary</li>
                     <li class="dropdown-item px-4 py-2 cursor-pointer hover:bg-gray-100">Apprenticeship</li>
                     <li class="dropdown-item px-4 py-2 cursor-pointer hover:bg-gray-100">Permanent</li>
                  </ul>
               </div>
               <a class="dropdownBtn inline-flex justify-center w-full rounded-full border border-gray-300 shadow-sm px-8 py-3 bg-white text-lg font-medium text-gray-700 hover:bg-gray-50 focus:outline-none">Quick apply</a>
               <div class="personalized-tags-pill-dropdown pill-dropdown dropdown-container" data-js-linking-dropdown="true">
                  <button class="dropdownBtn inline-flex justify-center w-full rounded-full border border-gray-300 shadow-sm px-8 py-3 bg-white text-lg font-medium text-gray-700 hover:bg-gray-50 focus:outline-none">
                     Listed date
                     <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l5 5 5-5" />
                     </svg>
                  </button>
                  <ul class="dropdown-options-container hidden absolute bg-white border shadow-lg mt-2 w-full">
                     <li class="dropdown-item px-4 py-2 cursor-pointer hover:bg-gray-100">Any time</li>
                     <li class="dropdown-item px-4 py-2 cursor-pointer hover:bg-gray-100">Last 24 hours</li>
                     <li class="dropdown-item px-4 py-2 cursor-pointer hover:bg-gray-100">Last 7 days</li>
                     <li class="dropdown-item px-4 py-2 cursor-pointer hover:bg-gray-100">Last 14 days</li>
                     <li class="dropdown-item px-4 py-2 cursor-pointer hover:bg-gray-100">Last 30 days</li>
                  </ul>
               </div>
               <div class="personalized-tags-pill-dropdown pill-dropdown dropdown-container" data-js-linking-dropdown="true">
                  <button class="dropdownBtn inline-flex justify-center w-full rounded-full border border-gray-300 shadow-sm px-8 py-3 bg-white text-lg font-medium text-gray-700 hover:bg-gray-50 focus:outline-none">
                     Salary estimate
                     <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l5 5 5-5" />
                     </svg>
                  </button>
                  <ul class="dropdown-options-container hidden absolute bg-white border shadow-lg mt-2 w-full">
                     <li class="dropdown-item px-4 py-2 cursor-pointer hover:bg-gray-100">Any Salary</li>
                     <li class="dropdown-item px-4 py-2 cursor-pointer hover:bg-gray-100">$30,000+</li>
                     <li class="dropdown-item px-4 py-2 cursor-pointer hover:bg-gray-100">$50,000+</li>
                     <li class="dropdown-item px-4 py-2 cursor-pointer hover:bg-gray-100">$70,000+</li>
                     <li class="dropdown-item px-4 py-2 cursor-pointer hover:bg-gray-100">$90,000+</li>
                     <li class="dropdown-item px-4 py-2 cursor-pointer hover:bg-gray-100">$110,000+</li>
                  </ul>
               </div>
            </div>
            <a class="reset-filters -link-cool" data-href="/j?a=&amp;disallow=true&amp;jt=&amp;l=&amp;pt=&amp;q=Legal+Intern&amp;sa=&amp;sp=reset_all_filters">Reset all filters</a>
         </div>
      </div>
   </div>
</section>
<div class="search-results-page content-container split-serp -width-xl grid-container" data-auto-open-first-jdv="true" data-js-split-view="">
   <div class="serp-content grid-top-pane">
      <div class="search-bar-container">
         <span class="search-bar-title -no-margin-bottom open-modal" data-focus="input#search-modal-q" data-lock-scroll="true" data-open="search-modal">Search jobs</span>
         <div class="closed" id="search-modal">
            <button class="quinary close-modal" data-close="search-modal" data-lock-release="true" icon="chevron-left">Back</button>
            <form action="/j" class="search-form" method="get">
               <input name="sp" type="hidden" value="search"><input name="trigger_source" type="hidden" value="serp">
               <div class="keyword-input search-input-field input-field -visible-label autocomplete-container" data-controller="hubble--keyword-autocomplete" data-hubble--keyword-autocomplete-hubble--main-outlet="[data-controller='hubble--main']">
                  <label for="search-modal-q">What</label><input data-action="autocomplete-selectcomplete-&gt;hubble--keyword-autocomplete#track" data-url="/rpc/search_keywords/suggest" icon="search" icon-position="right" id="search-modal-q" maxlength="512" name="q" placeholder="Job title, company, keyword" type="search" value="Legal Intern" autocomplete="off" aria-expanded="false" aria-owns="autocomplete_list_5" role="combobox">
                  <ul hidden="" role="listbox" id="autocomplete_list_5"></ul>
                  <span class="visually-hidden" role="status" aria-live="assertive" aria-atomic="true">Begin typing for results.</span>
               </div>
               <div class="location-input search-input-field input-field -visible-label autocomplete-container">
                  <label for="search-modal-l">Where</label><input data-url="/rpc/search_locations/suggest" icon="location" icon-position="right" id="search-modal-l" maxlength="64" name="l" placeholder="City, district, state" type="search" value="" autocomplete="off" aria-expanded="false" aria-owns="autocomplete_list_6" role="combobox">
                  <ul hidden="" role="listbox" id="autocomplete_list_6"></ul>
                  <span class="visually-hidden" role="status" aria-live="assertive" aria-atomic="true">Begin typing for results.</span>
               </div>
               <button type="submit" class="search-jobs-button rounded-button -primary -size-lg -w-full"><span class="content">Search jobs</span></button>
            </form>
         </div>
         <div class="closed" id="refine-search-modal">
            <div class="refine-search-title-bar">
               <button class="quinary close-modal" data-close="refine-search-modal" data-lock-release="true" data-reset-form="" icon="chevron-left">Back</button>
               <h3 class="heading -size-large -weight-700 -mb-0">Filters</h3>
               <button class="quaternary refine-search-clear-button" data-reset-form="">Reset all filters</button>
            </div>
            <form class="refine-search-form refine-search-container">
               <input id="source_page" name="sp" type="hidden" value="facet"><input id="keyword" name="q" type="hidden" value="Legal Intern"><input id="location" name="l" type="hidden" value="">
               <fieldset class="refine-search-facet">
                  <h4 class="heading -size-medium -weight-500 -mb-0">Sort by</h4>
                  <input checked="checked" class="facet-input" id="st-relevance" name="st" type="radio" value=""><label class="button tertiary facet-button" for="st-relevance">Relevance</label><input class="facet-input" id="st-date" name="st" type="radio" value="date"><label class="button tertiary facet-button" for="st-date">Date</label>
               </fieldset>
               <fieldset class="refine-search-facet freshness-filter">
                  <h4 class="heading -size-medium -weight-500 -mb-0">Job freshness</h4>
                  <input checked="checked" class="facet-input" id="freshness-filter-all" name="pt" type="radio" value=""><label class="button tertiary facet-button" for="freshness-filter-all">Any jobs</label><input class="facet-input" id="freshness-filter-unseen" name="pt" type="radio" value="unseen"><label class="button tertiary facet-button" for="freshness-filter-unseen">New to you</label><input class="facet-input" id="freshness-filter-seen" name="pt" type="radio" value="seen"><label class="button tertiary facet-button" for="freshness-filter-seen">Seen</label><input class="facet-input" id="freshness-filter-viewed" name="pt" type="radio" value="viewed"><label class="button tertiary facet-button" for="freshness-filter-viewed">Viewed details</label><input class="facet-input" id="freshness-filter-started_applying" name="pt" type="radio" value="started_applying"><label class="button tertiary facet-button" for="freshness-filter-started_applying">Started applying</label><input class="facet-input" id="freshness-filter-applied" name="pt" type="radio" value="applied"><label class="button tertiary facet-button" for="freshness-filter-applied">Applied</label>
               </fieldset>
               <fieldset class="refine-search-facet">
                  <h4 class="heading -size-medium -weight-500 -mb-0">Job type</h4>
                  <input checked="checked" class="facet-input" id="jt-all" name="jt" type="radio" value=""><label class="button tertiary facet-button" for="jt-all">Any job type</label><input class="facet-input" id="jt-3" name="jt" type="radio" value="3"><label class="button tertiary facet-button" for="jt-3">Full time</label><input class="facet-input" id="jt-5" name="jt" type="radio" value="5"><label class="button tertiary facet-button" for="jt-5">Internship</label><input class="facet-input" id="jt-1" name="jt" type="radio" value="1"><label class="button tertiary facet-button" for="jt-1">Part time</label><input class="facet-input" id="jt-6" name="jt" type="radio" value="6"><label class="button tertiary facet-button" for="jt-6">Permanent</label><input class="facet-input" id="jt-2" name="jt" type="radio" value="2"><label class="button tertiary facet-button" for="jt-2">Casual/Temporary</label>
               </fieldset>
               <fieldset class="refine-search-facet popular-filters">
                  <h4 class="heading -size-medium -weight-500 -mb-0">Popular filters</h4>
                  <input class="facet-input" id="quick-apply-filter" name="qa" type="checkbox" value="y"><label class="button tertiary facet-button" for="quick-apply-filter">Quick apply</label>
               </fieldset>
               <fieldset class="refine-search-facet">
                  <h4 class="heading -size-medium -weight-500 -mb-0">Listed date</h4>
                  <input checked="checked" class="facet-input" id="a-all" name="a" type="radio" value=""><label class="button tertiary facet-button" for="a-all">Any time</label><input class="facet-input" id="a-24h" name="a" type="radio" value="24h"><label class="button tertiary facet-button" for="a-24h">Last 24 hours</label><input class="facet-input" id="a-7d" name="a" type="radio" value="7d"><label class="button tertiary facet-button" for="a-7d">Last 7 days</label><input class="facet-input" id="a-14d" name="a" type="radio" value="14d"><label class="button tertiary facet-button" for="a-14d">Last 14 days</label><input class="facet-input" id="a-30d" name="a" type="radio" value="30d"><label class="button tertiary facet-button" for="a-30d">Last 30 days</label>
               </fieldset>
               <fieldset class="refine-search-facet">
                  <h4 class="heading -size-medium -weight-500 -mb-0">Salary estimate</h4>
                  <input checked="checked" class="facet-input" id="sa-all" name="sa" type="radio" value=""><label class="button tertiary facet-button" for="sa-all">Any salary</label><input class="facet-input" id="sa-30000" name="sa" type="radio" value="30000"><label class="button tertiary facet-button" for="sa-30000">$30,000+</label><input class="facet-input" id="sa-50000" name="sa" type="radio" value="50000"><label class="button tertiary facet-button" for="sa-50000">$50,000+</label><input class="facet-input" id="sa-70000" name="sa" type="radio" value="70000"><label class="button tertiary facet-button" for="sa-70000">$70,000+</label><input class="facet-input" id="sa-90000" name="sa" type="radio" value="90000"><label class="button tertiary facet-button" for="sa-90000">$90,000+</label><input class="facet-input" id="sa-110000" name="sa" type="radio" value="110000"><label class="button tertiary facet-button" for="sa-110000">$110,000+</label>
               </fieldset>
               <div class="full-height-container" data-fix-ios-viewport-height="true">
                  <div class="action-container">
                     <div class="safe"><button type="submit" class="rounded-button -primary -size-lg -w-full"><span class="content">Update</span></button></div>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <h1 class="search-results-title heading -size-small -weight-normal -mb-0">
         <strong id="total_number_of_jobs">0 jobs</strong>
         <!-- – <strong>Legal Intern</strong> -->
      </h1>
      <div class="mweb-filter-bar">
         <button class="quinary button-with-filter-icon" data-lock-scroll="true" data-open="refine-search-modal" data-scroll-top="true"></button>
         <div class="personalized-tags-pill-dropdown pill-dropdown dropdown-container" data-js-linking-dropdown="true">
            <button name="button" type="button" class="dropdown-button">Job freshness</button>
            <ul class="dropdown-options-container">
               <li class="dropdown-item" data-href="/Legal-Intern-jobs?sp=trending_popular">Any jobs</li>
               <li class="dropdown-item" data-href="/Legal-Intern-jobs?pt=unseen&amp;sp=trending_popular">New to you</li>
               <li class="dropdown-item" data-href="/Legal-Intern-jobs?pt=seen&amp;sp=trending_popular">Seen</li>
               <li class="dropdown-item" data-href="/Legal-Intern-jobs?pt=viewed&amp;sp=trending_popular">Viewed details</li>
               <li class="dropdown-item" data-href="/Legal-Intern-jobs?pt=started_applying&amp;sp=trending_popular">Started applying</li>
               <li class="dropdown-item" data-href="/Legal-Intern-jobs?pt=applied&amp;sp=trending_popular">Applied</li>
            </ul>
         </div>
         <div class="facet-pill-dropdown-job-type pill-dropdown dropdown-container" data-js-linking-dropdown="true">
            <button name="button" type="button" class="dropdown-button">Job type</button>
            <ul class="dropdown-options-container">
               <li class="dropdown-item" data-href="/j?disallow=true&amp;jt=&amp;l=&amp;q=Legal+Intern&amp;sp=facet_job_type">Any job type</li>
               <li class="dropdown-item" data-href="/j?disallow=true&amp;jt=3&amp;l=&amp;q=Legal+Intern&amp;sp=facet_job_type">Full time</li>
               <li class="dropdown-item" data-href="/j?disallow=true&amp;jt=5&amp;l=&amp;q=Legal+Intern&amp;sp=facet_job_type">Internship</li>
               <li class="dropdown-item" data-href="/j?disallow=true&amp;jt=1&amp;l=&amp;q=Legal+Intern&amp;sp=facet_job_type">Part time</li>
               <li class="dropdown-item" data-href="/j?disallow=true&amp;jt=6&amp;l=&amp;q=Legal+Intern&amp;sp=facet_job_type">Permanent</li>
               <li class="dropdown-item" data-href="/j?disallow=true&amp;jt=2&amp;l=&amp;q=Legal+Intern&amp;sp=facet_job_type">Casual/Temporary</li>
            </ul>
         </div>
         <a class="tertiary quick-apply-filter-pill pill button" rel="nofollow" href="/j?disallow=true&amp;l=&amp;q=Legal+Intern&amp;qa=y&amp;sp=facet_quick_apply">Quick apply</a>
         <div class="facet-pill-dropdown-listed-date pill-dropdown dropdown-container" data-js-linking-dropdown="true">
            <button name="button" type="button" class="dropdown-button">Listed date</button>
            <ul class="dropdown-options-container">
               <li class="dropdown-item" data-href="/j?a=&amp;disallow=true&amp;l=&amp;q=Legal+Intern&amp;sp=facet_listed_date">Any time</li>
               <li class="dropdown-item" data-href="/j?a=24h&amp;disallow=true&amp;l=&amp;q=Legal+Intern&amp;sp=facet_listed_date">Last 24 hours</li>
               <li class="dropdown-item" data-href="/j?a=7d&amp;disallow=true&amp;l=&amp;q=Legal+Intern&amp;sp=facet_listed_date">Last 7 days</li>
               <li class="dropdown-item" data-href="/j?a=14d&amp;disallow=true&amp;l=&amp;q=Legal+Intern&amp;sp=facet_listed_date">Last 14 days</li>
               <li class="dropdown-item" data-href="/j?a=30d&amp;disallow=true&amp;l=&amp;q=Legal+Intern&amp;sp=facet_listed_date">Last 30 days</li>
            </ul>
         </div>
         <div class="facet-pill-dropdown-salary-min pill-dropdown dropdown-container" data-js-linking-dropdown="true">
            <button name="button" type="button" class="dropdown-button">Salary estimate</button>
            <ul class="dropdown-options-container">
               <li class="dropdown-item" data-href="/j?disallow=true&amp;l=&amp;q=Legal+Intern&amp;sa=&amp;sp=facet_salary_min">Any salary</li>
               <li class="dropdown-item" data-href="/j?disallow=true&amp;l=&amp;q=Legal+Intern&amp;sa=30000&amp;sp=facet_salary_min">$30,000+</li>
               <li class="dropdown-item" data-href="/j?disallow=true&amp;l=&amp;q=Legal+Intern&amp;sa=50000&amp;sp=facet_salary_min">$50,000+</li>
               <li class="dropdown-item" data-href="/j?disallow=true&amp;l=&amp;q=Legal+Intern&amp;sa=70000&amp;sp=facet_salary_min">$70,000+</li>
               <li class="dropdown-item" data-href="/j?disallow=true&amp;l=&amp;q=Legal+Intern&amp;sa=90000&amp;sp=facet_salary_min">$90,000+</li>
               <li class="dropdown-item" data-href="/j?disallow=true&amp;l=&amp;q=Legal+Intern&amp;sa=110000&amp;sp=facet_salary_min">$110,000+</li>
            </ul>
         </div>
      </div>
   </div>
   <div class="serp-content grid-content-pane">
      <div class="jobresults" data-js-serp-email-alert-nudge-card="" id="jobresults">

         <div class="backupp-sponsored-results">
            {{--
            <div id="backupp_jobs" class="job-card result sponsored-job premium-job spon-top" data-active="true">
               <div class="top-container">
                  <div class="column">
                     <div class="first-row">
                        <div class="freshness-badge-container">
                           <div class="badge -new-job-badge">
                              <div class="content">New to you</div>
                           </div>
                        </div>
                     </div>
                     <h2 class="job-title -one-line heading -size-medium -weight-500 -mb-0"><a rel="nofollow noopener sponsored" target="_blank" data-sponsor-name="Jora" data-rank="1" class="job-link -no-underline -desktop-only show-job-description" href="/job/Immigration-Lawyer-92bc418ac5216867c3514528bfc5bf76?abstract_type=extended_llm&amp;disallow=true&amp;fsv=true&amp;sl=&amp;sol_key=21db94fc51bea2b669f483a1d4a2ea1a&amp;sp=sserp_top&amp;sponsored=true&amp;sq=Legal+Intern&amp;sr=1&amp;tk=BsQVBvhU0bg58TyzoSQW-2R1JTN1i0ujJ1EFgm8dl&amp;trigger_source=serp">Immigration Lawyer</a><a rel="nofollow noopener sponsored" target="_blank" data-sponsor-name="Jora" data-rank="1" class="job-link -mobile-only" href="/job/Immigration-Lawyer-92bc418ac5216867c3514528bfc5bf76?abstract_type=extended_llm&amp;disallow=true&amp;fsv=false&amp;sl=&amp;sol_key=21db94fc51bea2b669f483a1d4a2ea1a&amp;sp=sserp_top&amp;sponsored=true&amp;sq=Legal+Intern&amp;sr=1&amp;tk=BsQVBvhU0bg58TyzoSQW-2R1JTN1i0ujJ1EFgm8dl&amp;trigger_source=serp">Immigration Lawyer</a></h2>
                  </div>
               </div>
               <div class="job-info">
                  <div class="info-container"><span class="job-company">Backupp</span></div>
                  <div class="info-container -last-row"><a class="job-location clickable-link" href="/jobs-in-Melbourne-VIC?sp=sserp_top_job_location">Melbourne VIC</a></div>
               </div>
               <div class="badges">
                  <div class="badge -quick-apply-badge">
                     <div class="content">Quick apply</div>
                  </div>
                  <div class="badge -default-badge">
                     <div class="content">$55,000 - $75,000 per month</div>
                  </div>
                  <div class="badge -default-badge">
                     <div class="content">No experience required</div>
                  </div>
                  <div class="badge -default-badge">
                     <div class="content">Full time</div>
                  </div>
               </div>
               <div class="job-abstract">
                  <ul>
                     <li>Assist with diverse caseload including visa applications</li>
                     <li>Recently admitted legal practitioner passionate about migration law and justice</li>
                     <li>Collaborate with legal team, manage consultations, and follow up</li>
                  </ul>
               </div>
               <div class="bottom-container"><span class="job-listed-date">Posted 1 day ago</span><button name="button" type="submit" class="tertiary save-job-button" icon="true" data-job-id="92bc418ac5216867c3514528bfc5bf76" data-tk="BsQVBvhU0bg58TyzoSQW-2R1JTN1i0ujJ1EFgm8dl" data-saved="false" data-disabled="" data-ga4="{&quot;name&quot;:&quot;save_job__create&quot;,&quot;params&quot;:{&quot;trigger_source&quot;:&quot;serp&quot;,&quot;job_feed&quot;:&quot;sponsored&quot;,&quot;user_id&quot;:null,&quot;site_id&quot;:&quot;au&quot;}}" data-label-saved="Saved" data-label-save="Save">Save</button></div>
            </div>
            --}}
         </div>
         <div class="email-alert-nudge-card" data-ga4="{&quot;name&quot;:&quot;save_search__create&quot;,&quot;params&quot;:{&quot;trigger_source&quot;:&quot;serp&quot;,&quot;user_id&quot;:null,&quot;site_id&quot;:&quot;au&quot;}}">
            <div class="header">
               <div class="icon iconized green-bell-svg"></div>
               <div class="text">
                  <h3 class="heading -size-medium -weight-500 -mb-0">Don't miss out!</h3>
                  <p>We will notify you when new <b>Legal Intern</b> jobs are posted.</p>
               </div>
            </div>
            <form data-registered-user="false" class="email-alert-nudge-card-form" id="email-alert-nudge-card-form" action="" accept-charset="UTF-8" method="post">
               <input name="utf8" type="hidden" value="✓" autocomplete="off"><input type="hidden" name="authenticity_token" value="J4Zwnq-c7B-O-JpEzajjoICVBFvktLaW2AOYPcZ-Px2yMXRmj0Ase-Ozsr1P7OIaIRLDzficmNB5ynudBF8G8w" autocomplete="off"><input autocomplete="off" type="hidden" value="Legal Intern" name="email_alert[query]" id="email_alert_query"><input autocomplete="off" type="hidden" value="" name="email_alert[raw_location]" id="email_alert_raw_location"><input autocomplete="off" type="hidden" name="email_alert[radius]" id="email_alert_radius"><input autocomplete="off" type="hidden" name="email_alert[job_type_id]" id="email_alert_job_type_id"><input autocomplete="off" type="hidden" name="email_alert[salary_min]" id="email_alert_salary_min"><input value="nudge_card_bottom" autocomplete="off" type="hidden" name="email_alert[creation_method]" id="email_alert_creation_method"><input value="desktop" autocomplete="off" type="hidden" name="email_alert[creation_device]" id="email_alert_creation_device"><input value="web" autocomplete="off" type="hidden" name="email_alert[creation_platform]" id="email_alert_creation_platform"><input autocomplete="off" type="hidden" name="email_alert[facet_listed_date]" id="email_alert_facet_listed_date"><input autocomplete="off" type="hidden" name="email_alert[facet_sort_by]" id="email_alert_facet_sort_by"><input type="hidden" name="nudge_card_form" id="nudge_card_form" value="true" autocomplete="off">
               <div class="input-button-group"><input placeholder="Enter your email" required="required" type="email" name="email_alert[email]" id="email_alert_email"><button type="submit" class="email-alert-nudge-card-submit-button button-for-anonymous-user rounded-button -primary -size-lg" data-js-open-suggest-better-alert-modal="true" data-click-origin="nudge_card_bottom"><span class="content">Notify me</span></button></div>
            </form>
            <div class="footer">
               <div class="privacy-statement font-xxsmall -margin-sm"><span class="branded-links">By creating an email alert, I agree to Jora's <a href="/cms/terms-of-service">Terms</a> and <a href="/cms/privacy">Privacy Policy</a> and can unsubscribe anytime.</span></div>
            </div>
         </div>
         <div id="bottom_afs"><iframe frameborder="0" marginwidth="0" marginheight="0" allowtransparency="true" scrolling="no" width="100%" name="slave-1-1|{&quot;name&quot;:&quot;master-1&quot;,&quot;slave-0-1&quot;:{&quot;container&quot;:&quot;top_afs&quot;,&quot;styleId&quot;:&quot;6270669194&quot;,&quot;adPage&quot;:1,&quot;channel&quot;:&quot;5686808622&quot;,&quot;fexp&quot;:&quot;21404,17300003,17301431,17301432,17301436,17301548,17301266,72717107,21404,17300003,17301431,17301432,17301436,17301548,17301266,72717107&quot;,&quot;masterNumber&quot;:1,&quot;number&quot;:0,&quot;pubId&quot;:&quot;pub-2856288649011803&quot;,&quot;query&quot;:&quot;Legal Intern jobs&quot;,&quot;role&quot;:&quot;s&quot;,&quot;slaveNumber&quot;:&quot;0&quot;,&quot;hl&quot;:&quot;en&quot;,&quot;resultsPageQueryParam&quot;:&quot;query&quot;,&quot;ie&quot;:&quot;UTF-8&quot;,&quot;maxTop&quot;:1,&quot;minTop&quot;:0,&quot;oe&quot;:&quot;UTF-8&quot;,&quot;type&quot;:&quot;ads&quot;,&quot;linkTarget&quot;:&quot;_blank&quot;},&quot;master-a-1&quot;:{&quot;container&quot;:&quot;top_afs&quot;,&quot;styleId&quot;:&quot;6270669194&quot;,&quot;fexp&quot;:&quot;21404,17300003,17301431,17301432,17301436,17301548,17301266,72717107&quot;,&quot;masterNumber&quot;:1,&quot;number&quot;:0,&quot;pubId&quot;:&quot;pub-2856288649011803&quot;,&quot;query&quot;:&quot;Legal Intern jobs&quot;,&quot;role&quot;:&quot;s&quot;,&quot;adLoadedCallback&quot;:null,&quot;resultsPageQueryParam&quot;:&quot;query&quot;,&quot;ie&quot;:&quot;UTF-8&quot;,&quot;maxTop&quot;:0,&quot;minTop&quot;:0,&quot;oe&quot;:&quot;UTF-8&quot;,&quot;type&quot;:&quot;ads&quot;,&quot;linkTarget&quot;:&quot;_blank&quot;},&quot;master-b-1&quot;:{&quot;container&quot;:&quot;top_afs&quot;,&quot;styleId&quot;:&quot;6270669194&quot;,&quot;fexp&quot;:&quot;21404,17300003,17301431,17301432,17301436,17301548,17301266,72717107&quot;,&quot;masterNumber&quot;:1,&quot;number&quot;:0,&quot;pubId&quot;:&quot;pub-2856288649011803&quot;,&quot;query&quot;:&quot;Legal Intern jobs&quot;,&quot;role&quot;:&quot;s&quot;,&quot;adLoadedCallback&quot;:null,&quot;resultsPageQueryParam&quot;:&quot;query&quot;,&quot;ie&quot;:&quot;UTF-8&quot;,&quot;maxTop&quot;:0,&quot;minTop&quot;:0,&quot;oe&quot;:&quot;UTF-8&quot;,&quot;type&quot;:&quot;ads&quot;,&quot;linkTarget&quot;:&quot;_blank&quot;},&quot;slave-1-1&quot;:{&quot;container&quot;:&quot;bottom_afs&quot;,&quot;styleId&quot;:&quot;6270669194&quot;,&quot;adPage&quot;:1,&quot;channel&quot;:&quot;5686808622&quot;,&quot;fexp&quot;:&quot;21404,17300003,17301431,17301432,17301436,17301548,17301266,72717107&quot;,&quot;masterNumber&quot;:1,&quot;number&quot;:3,&quot;pubId&quot;:&quot;pub-2856288649011803&quot;,&quot;query&quot;:&quot;Legal Intern jobs&quot;,&quot;role&quot;:&quot;s&quot;,&quot;slaveNumber&quot;:1,&quot;hl&quot;:&quot;en&quot;,&quot;resultsPageQueryParam&quot;:&quot;query&quot;,&quot;ie&quot;:&quot;UTF-8&quot;,&quot;maxTop&quot;:0,&quot;minTop&quot;:0,&quot;oe&quot;:&quot;UTF-8&quot;,&quot;type&quot;:&quot;ads&quot;,&quot;linkTarget&quot;:&quot;_blank&quot;},&quot;master-1&quot;:{&quot;styleId&quot;:&quot;6270669194&quot;,&quot;adPage&quot;:1,&quot;channel&quot;:&quot;5686808622&quot;,&quot;fexp&quot;:&quot;21404,17300003,17301431,17301432,17301436,17301548,17301266,72717107&quot;,&quot;masterNumber&quot;:1,&quot;number&quot;:0,&quot;pubId&quot;:&quot;pub-2856288649011803&quot;,&quot;query&quot;:&quot;Legal Intern jobs&quot;,&quot;role&quot;:&quot;m&quot;,&quot;hl&quot;:&quot;en&quot;,&quot;resultsPageQueryParam&quot;:&quot;query&quot;,&quot;ie&quot;:&quot;UTF-8&quot;,&quot;maxTop&quot;:1,&quot;minTop&quot;:0,&quot;oe&quot;:&quot;UTF-8&quot;,&quot;type&quot;:&quot;ads&quot;,&quot;linkTarget&quot;:&quot;_blank&quot;}}" id="slave-1-1" src="https://syndicatedsearch.goog/afs/ads/i/iframe.html" data-observe="1" allow="attribution-reporting" style="visibility: hidden; height: 0px; display: block;" data-lle="1"></iframe></div>
         <!-- <div class="search-results-page-number" data-position="bottom">Page <strong>1</strong> of <strong>12</strong></div>
         <div class="mobile-pagination pagination-container"><a class="rounded-button -primary -size-lg -w-full" rel="nofollow" href="/j?disallow=true&amp;l=&amp;p=2&amp;q=Legal+Intern&amp;sp=trending_popular&amp;surl=0&amp;tk=BsQVBvhU0bg58TyzoSQW-2R1JTN1i0ujJ1EFgm8dl"><span class="content">Next</span></a></div>
         <div class="multi-pages-pagination pagination-container"><span class="current-page">1</span><a rel="nofollow" class="pagination-page" href="/j?disallow=true&amp;l=&amp;p=2&amp;q=Legal+Intern&amp;sp=trending_popular&amp;surl=0&amp;tk=BsQVBvhU0bg58TyzoSQW-2R1JTN1i0ujJ1EFgm8dl">2</a><a rel="nofollow" class="pagination-page" href="/j?disallow=true&amp;l=&amp;p=3&amp;q=Legal+Intern&amp;sp=trending_popular&amp;surl=0&amp;tk=BsQVBvhU0bg58TyzoSQW-2R1JTN1i0ujJ1EFgm8dl">3</a><a rel="nofollow" class="pagination-page" href="/j?disallow=true&amp;l=&amp;p=4&amp;q=Legal+Intern&amp;sp=trending_popular&amp;surl=0&amp;tk=BsQVBvhU0bg58TyzoSQW-2R1JTN1i0ujJ1EFgm8dl">4</a><a rel="nofollow" class="pagination-page" href="/j?disallow=true&amp;l=&amp;p=5&amp;q=Legal+Intern&amp;sp=trending_popular&amp;surl=0&amp;tk=BsQVBvhU0bg58TyzoSQW-2R1JTN1i0ujJ1EFgm8dl">5</a><a class="next-page-button" href="/j?disallow=true&amp;l=&amp;p=2&amp;q=Legal+Intern&amp;sp=trending_popular&amp;surl=0&amp;tk=BsQVBvhU0bg58TyzoSQW-2R1JTN1i0ujJ1EFgm8dl" rel="nofollow" remote="false"></a></div> -->
      </div>
      <h2 class="heading -size-medium -weight-700">People also searched</h2>
      <div class="people-also-searched-section">
         <div class="related-searches-section">
            <h3 class="heading -size-xsmall -weight-700">Jobs</h3>
            <a class="searched-tag rounded-button -secondary -size-md -iconed" data-js-add-query-params-on-click="true" data-psi="a8cab586-95fb-4713-909f-7fe4615cfdb1-ac5e7436c77eeb478b55f73154a64f4b-BsQVBvhU0bg58TyzoSQW" data-trigger-source="serp" data-ssr="1" data-sp="suggested" href="/Law-Student-jobs">
               <svg class="icon icon-search" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M10.5 17.5a7 7 0 100-14 7 7 0 000 14zM15.5 16l5 4.5" stroke="#0e8136" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
               </svg>
               <span class="content">Law Student</span>
            </a>
            <a class="searched-tag rounded-button -secondary -size-md -iconed" data-js-add-query-params-on-click="true" data-psi="a8cab586-95fb-4713-909f-7fe4615cfdb1-ac5e7436c77eeb478b55f73154a64f4b-BsQVBvhU0bg58TyzoSQW" data-trigger-source="serp" data-ssr="2" data-sp="suggested" href="/Legal-Assistant-jobs">
               <svg class="icon icon-search" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M10.5 17.5a7 7 0 100-14 7 7 0 000 14zM15.5 16l5 4.5" stroke="#0e8136" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
               </svg>
               <span class="content">Legal Assistant</span>
            </a>
            <a class="searched-tag rounded-button -secondary -size-md -iconed" data-js-add-query-params-on-click="true" data-psi="a8cab586-95fb-4713-909f-7fe4615cfdb1-ac5e7436c77eeb478b55f73154a64f4b-BsQVBvhU0bg58TyzoSQW" data-trigger-source="serp" data-ssr="3" data-sp="suggested" href="/Paralegal-jobs">
               <svg class="icon icon-search" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M10.5 17.5a7 7 0 100-14 7 7 0 000 14zM15.5 16l5 4.5" stroke="#0e8136" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
               </svg>
               <span class="content">Paralegal</span>
            </a>
            <a class="searched-tag rounded-button -secondary -size-md -iconed" data-js-add-query-params-on-click="true" data-psi="a8cab586-95fb-4713-909f-7fe4615cfdb1-ac5e7436c77eeb478b55f73154a64f4b-BsQVBvhU0bg58TyzoSQW" data-trigger-source="serp" data-ssr="4" data-sp="suggested" href="/Entry-Level-Legal-jobs">
               <svg class="icon icon-search" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M10.5 17.5a7 7 0 100-14 7 7 0 000 14zM15.5 16l5 4.5" stroke="#0e8136" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
               </svg>
               <span class="content">Entry Level Legal</span>
            </a>
            <a class="searched-tag rounded-button -secondary -size-md -iconed" data-js-add-query-params-on-click="true" data-psi="a8cab586-95fb-4713-909f-7fe4615cfdb1-ac5e7436c77eeb478b55f73154a64f4b-BsQVBvhU0bg58TyzoSQW" data-trigger-source="serp" data-ssr="5" data-sp="suggested" href="/Legal-Internship-jobs">
               <svg class="icon icon-search" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M10.5 17.5a7 7 0 100-14 7 7 0 000 14zM15.5 16l5 4.5" stroke="#0e8136" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
               </svg>
               <span class="content">Legal Internship</span>
            </a>
            <a class="searched-tag rounded-button -secondary -size-md -iconed" data-js-add-query-params-on-click="true" data-psi="a8cab586-95fb-4713-909f-7fe4615cfdb1-ac5e7436c77eeb478b55f73154a64f4b-BsQVBvhU0bg58TyzoSQW" data-trigger-source="serp" data-ssr="6" data-sp="suggested" href="/Lawyer-jobs">
               <svg class="icon icon-search" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M10.5 17.5a7 7 0 100-14 7 7 0 000 14zM15.5 16l5 4.5" stroke="#0e8136" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
               </svg>
               <span class="content">Lawyer</span>
            </a>
            <a class="searched-tag rounded-button -secondary -size-md -iconed" data-js-add-query-params-on-click="true" data-psi="a8cab586-95fb-4713-909f-7fe4615cfdb1-ac5e7436c77eeb478b55f73154a64f4b-BsQVBvhU0bg58TyzoSQW" data-trigger-source="serp" data-ssr="7" data-sp="suggested" href="/Intern-jobs">
               <svg class="icon icon-search" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M10.5 17.5a7 7 0 100-14 7 7 0 000 14zM15.5 16l5 4.5" stroke="#0e8136" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
               </svg>
               <span class="content">Intern</span>
            </a>
            <a class="searched-tag rounded-button -secondary -size-md -iconed" data-js-add-query-params-on-click="true" data-psi="a8cab586-95fb-4713-909f-7fe4615cfdb1-ac5e7436c77eeb478b55f73154a64f4b-BsQVBvhU0bg58TyzoSQW" data-trigger-source="serp" data-ssr="8" data-sp="suggested" href="/Legal-jobs">
               <svg class="icon icon-search" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M10.5 17.5a7 7 0 100-14 7 7 0 000 14zM15.5 16l5 4.5" stroke="#0e8136" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
               </svg>
               <span class="content">Legal</span>
            </a>
         </div>
         <div class="related-searches-section">
            <h3 class="heading -size-xsmall -weight-700">Locations</h3>
            <a class="searched-tag rounded-button -secondary -size-md -iconed" data-sp="facet_location" data-js-add-query-params-on-click="true" href="/Legal-Intern-jobs-in-Adelaide-SA">
               <svg class="icon icon-location" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M18.5 9.636C18.5 12.766 12 20.5 12 20.5S5.5 12.766 5.5 9.636C5.5 6.506 8.613 3.5 12 3.5s6.5 3.007 6.5 6.136z" stroke="#0e8136" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                  <path d="M12 12.667c1.5 0 3-1.417 3-2.834C15 8.417 13.5 7 12 7S9 8.417 9 9.833c0 1.417 1.5 2.834 3 2.834z" fill="#0e8136"></path>
               </svg>
               <span class="content">Adelaide SA</span>
            </a>
            <a class="searched-tag rounded-button -secondary -size-md -iconed" data-sp="facet_location" data-js-add-query-params-on-click="true" href="/Legal-Intern-jobs-in-New-South-Wales">
               <svg class="icon icon-location" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M18.5 9.636C18.5 12.766 12 20.5 12 20.5S5.5 12.766 5.5 9.636C5.5 6.506 8.613 3.5 12 3.5s6.5 3.007 6.5 6.136z" stroke="#0e8136" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                  <path d="M12 12.667c1.5 0 3-1.417 3-2.834C15 8.417 13.5 7 12 7S9 8.417 9 9.833c0 1.417 1.5 2.834 3 2.834z" fill="#0e8136"></path>
               </svg>
               <span class="content">New South Wales</span>
            </a>
            <a class="searched-tag rounded-button -secondary -size-md -iconed" data-sp="facet_location" data-js-add-query-params-on-click="true" href="/Legal-Intern-jobs-in-City-of-Sydney-NSW">
               <svg class="icon icon-location" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M18.5 9.636C18.5 12.766 12 20.5 12 20.5S5.5 12.766 5.5 9.636C5.5 6.506 8.613 3.5 12 3.5s6.5 3.007 6.5 6.136z" stroke="#0e8136" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                  <path d="M12 12.667c1.5 0 3-1.417 3-2.834C15 8.417 13.5 7 12 7S9 8.417 9 9.833c0 1.417 1.5 2.834 3 2.834z" fill="#0e8136"></path>
               </svg>
               <span class="content">City of Sydney NSW</span>
            </a>
            <a class="searched-tag rounded-button -secondary -size-md -iconed" data-sp="facet_location" data-js-add-query-params-on-click="true" href="/Legal-Intern-jobs-in-Sydney-NSW">
               <svg class="icon icon-location" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M18.5 9.636C18.5 12.766 12 20.5 12 20.5S5.5 12.766 5.5 9.636C5.5 6.506 8.613 3.5 12 3.5s6.5 3.007 6.5 6.136z" stroke="#0e8136" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                  <path d="M12 12.667c1.5 0 3-1.417 3-2.834C15 8.417 13.5 7 12 7S9 8.417 9 9.833c0 1.417 1.5 2.834 3 2.834z" fill="#0e8136"></path>
               </svg>
               <span class="content">Sydney NSW</span>
            </a>
            <a class="searched-tag rounded-button -secondary -size-md -iconed" data-sp="facet_location" data-js-add-query-params-on-click="true" href="/Legal-Intern-jobs-in-South-Australia">
               <svg class="icon icon-location" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M18.5 9.636C18.5 12.766 12 20.5 12 20.5S5.5 12.766 5.5 9.636C5.5 6.506 8.613 3.5 12 3.5s6.5 3.007 6.5 6.136z" stroke="#0e8136" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                  <path d="M12 12.667c1.5 0 3-1.417 3-2.834C15 8.417 13.5 7 12 7S9 8.417 9 9.833c0 1.417 1.5 2.834 3 2.834z" fill="#0e8136"></path>
               </svg>
               <span class="content">South Australia</span>
            </a>
            <a class="searched-tag rounded-button -secondary -size-md -iconed" data-sp="facet_location" data-js-add-query-params-on-click="true" href="/Legal-Intern-jobs-in-Victoria">
               <svg class="icon icon-location" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M18.5 9.636C18.5 12.766 12 20.5 12 20.5S5.5 12.766 5.5 9.636C5.5 6.506 8.613 3.5 12 3.5s6.5 3.007 6.5 6.136z" stroke="#0e8136" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                  <path d="M12 12.667c1.5 0 3-1.417 3-2.834C15 8.417 13.5 7 12 7S9 8.417 9 9.833c0 1.417 1.5 2.834 3 2.834z" fill="#0e8136"></path>
               </svg>
               <span class="content">Victoria</span>
            </a>
            <a class="searched-tag rounded-button -secondary -size-md -iconed" data-sp="facet_location" data-js-add-query-params-on-click="true" href="/Legal-Intern-jobs-in-Queensland">
               <svg class="icon icon-location" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M18.5 9.636C18.5 12.766 12 20.5 12 20.5S5.5 12.766 5.5 9.636C5.5 6.506 8.613 3.5 12 3.5s6.5 3.007 6.5 6.136z" stroke="#0e8136" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                  <path d="M12 12.667c1.5 0 3-1.417 3-2.834C15 8.417 13.5 7 12 7S9 8.417 9 9.833c0 1.417 1.5 2.834 3 2.834z" fill="#0e8136"></path>
               </svg>
               <span class="content">Queensland</span>
            </a>
            <a class="searched-tag rounded-button -secondary -size-md -iconed" data-sp="facet_location" data-js-add-query-params-on-click="true" href="/Legal-Intern-jobs-in-Brisbane-QLD">
               <svg class="icon icon-location" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M18.5 9.636C18.5 12.766 12 20.5 12 20.5S5.5 12.766 5.5 9.636C5.5 6.506 8.613 3.5 12 3.5s6.5 3.007 6.5 6.136z" stroke="#0e8136" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                  <path d="M12 12.667c1.5 0 3-1.417 3-2.834C15 8.417 13.5 7 12 7S9 8.417 9 9.833c0 1.417 1.5 2.834 3 2.834z" fill="#0e8136"></path>
               </svg>
               <span class="content">Brisbane QLD</span>
            </a>
         </div>
      </div>
   </div>
   <div class="grid-aside-pane">
      <div class="sticky-panel">
         <div class="jdv-panel" data-error="false" data-hidden="false" style="--offset: 88.59375px;">
            <div class="jdv-content grid-content" data-hidden="false" id="showJobsDetails">
               <div>
                  {{--<div class="sticky-container">
                     @php
                     $stckyJobs = $jobs[0];
                     @endphp
                     <div class="-desktop-no-padding-top" id="job-info-container">
                        <h3 class="job-title heading -size-xxlarge -weight-700">{{ $stckyJobs->job_title }}</h3>
                        <div class="font-small" id="company-location-container"><span class="company">Backupp</span><span class="divider">–</span><span class="location">Melbourne VIC</span></div>
                        <div class="badge -verified-employer-badge">
                           <i class="icon verified-employer-icon"></i>
                           <div class="content">Verified employer</div>
                        </div>
                        <div class="badge -default-badge">
                           <div class="content">${{ $stckyJobs->price_from }} - ${{ $stckyJobs->price_to }} per month</div>
                        </div>
                        <div class="badge -default-badge">
                           <div class="content">Full time</div>
                        </div>
                        <div class="badge -default-badge">
                           <div class="content">No experience required</div>
                        </div>
                        <div class="font-xsmall" id="job-meta"><span class="listed-date">1 day ago</span>, from <span class="site">Jora</span></div>
                     </div>
                     <div class="job-view-actions-container top-actions-container">
                        <div class="action-buttons-container">
                           <a class="rounded-button -primary -size-lg -w-full">
                              <span class="content">Quick apply</span>
                           </a>
                           <button type="submit" class="save-job-button rounded-button -secondary -size-lg" data-disabled="">
                              <span class="content">Save job</span>
                           </button>
                           <a class="open-new-tab -link-cool" href="{{ url('/') }}/job/{{$stckyJobs->slug}}" rel="nofollow" target="_blank">Open in new tab</a>
                        </div>
                     </div>
                     <div class="blank-gap"></div>
                  </div>
                  <div class="job-description-container">
                     <strong>Job summary:</strong>
                     <ul>
                        {!!$stckyJobs->description !!}
                        <li>
                           Looking for candidates available to work:
                           <ul>
                              <li>Monday: Morning, Afternoon</li>
                              <li>Tuesday: Morning, Afternoon</li>
                              <li>Wednesday: Morning, Afternoon</li>
                              <li>Thursday: Morning, Afternoon</li>
                              <li>Friday: Morning, Afternoon</li>
                           </ul>
                        </li>
                        <li>No experience required for this role</li>
                        <li>Working rights required for this role</li>
                        <li>Expected salary: $55,000 - $75,000 per month</li>
                        <li>Immediate start available</li>
                     </ul>
                     <br>
                     <p><strong>Junior Immigration Lawyer</strong></p>
                     <p>📍 <strong>Melbourne, VIC</strong> 🕒 <strong>Full Time | </strong>💼 <strong>Start your legal career with impact and purpose</strong></p>
                     <p><strong>About Us</strong></p>
                     <p>At <strong>Emigrate Lawyers</strong>, we believe that behind every visa application is a human story. We specialise in complex migration matters including protection visas, partner visas, judicial reviews, and employer-sponsored visas. We also practice Family and General law. Our team is multilingual, diverse, and united by a simple but powerful purpose: to help people start new lives, reunite with loved ones, and find safety, security, and opportunity in Australia.</p>
                     <p>Founded by <strong>Madhab Kharel</strong>, a Deakin Law Alumni and fierce advocate for migrants, we are a boutique but growing law firm that thrives on dedication, empathy, and excellence. Whether we’re challenging a visa refusal at the ART or securing a partner visa for a young couple, we approach each case with care, compassion, and expertise.</p>
                     <p>We’re expanding, and we’re looking for a <strong>Junior Immigration Lawyer</strong> who wants more than just a job – someone who wants to <strong>make a difference</strong>.</p>
                     <p></p>
                     <p><strong>Why Join Emigrate Lawyers?</strong></p>
                     <p>✨ A supportive team culture that celebrates wins together </p>
                     <p>✨ Direct mentorship from senior legal professionals and exposure to complex matters </p>
                     <p>✨ Ongoing training in protection, partner, and judicial review matters </p>
                     <p>✨ Hands-on experience with real client stories and impactful legal work </p>
                     <p>✨ We value people, not timesheets – fixed-fee billing means you focus on quality, not the clock </p>
                     <p>✨ We are a growing firm, be part of the growth and grow together. </p>
                     <p></p>
                     <p><strong>About the Role</strong></p>
                     <p>As a <strong>Junior Immigration Lawyer</strong>, you’ll support our team in managing a diverse caseload and advocating for people who need it most. This is an exciting opportunity to grow your legal career in one of the most meaningful and fast-evolving areas of law.</p>
                     <p><strong>Your role will involve:</strong></p>
                     <ul>
                        <li>
                           <p>Providing accurate and timely migration law advice</p>
                        </li>
                        <li>
                           <p>Preparing and lodging a range of visa applications (e.g., protection, partner, visitor, 482, 485)</p>
                        </li>
                        <li>
                           <p>Assisting with responses to RFIs, NOICs, and PIC 4020 matters</p>
                        </li>
                        <li>
                           <p>Drafting legal submissions and client statements</p>
                        </li>
                        <li>
                           <p>Supporting ART and Federal Circuit Court matters</p>
                        </li>
                        <li>
                           <p>Managing client communications and case updates</p>
                        </li>
                        <li>
                           <p>Collaborating closely with our legal and paralegal team</p>
                        </li>
                        <li>
                           <p>Following up with prospective clients and booking and managing consultations. </p>
                        </li>
                     </ul>
                     <p></p>
                     <p><strong>About You</strong></p>
                     <p>We’re looking for someone who is:</p>
                     <p>✔️ Recently admitted (or about to be) as a legal practitioner in Victoria </p>
                     <p>✔️ Passionate about migration law and social justice </p>
                     <p>✔️ Familiar with the Migration Act and visa subclasses (preferred) </p>
                     <p>✔️ Compassionate, detail-oriented, and an excellent communicator </p>
                     <p>✔️ Able to learn quickly and take initiative </p>
                     <p>✔️ Eager to learn and grow with a forward-thinking firm</p>
                     <p>✔️ Passionate about commercial side of legal business </p>
                     <p></p>
                     <p><strong>Bonus if you:</strong></p>
                     <ul>
                        <li>
                           <p>Speak a second language </p>
                        </li>
                        <li>
                           <p>Have experience as a paralegal or intern in immigration law</p>
                        </li>
                     </ul>
                     <p></p>
                     <p><strong>How to Apply</strong></p>
                     <p>If you’re ready to kick-start a rewarding career in immigration law, we’d love to hear from you.</p>
                     <p>Please submit your <strong>CV and a short cover letter</strong> telling us why you're interested in this role and what makes you a great fit.</p>
                     <p></p>
                     <p>📧 Send to: <strong>********@emigratelawyers.com.au</strong> </p>
                     <p>📅 Applications closes soon.</p>
                     <p></p>
                     <p></p>
                     <p></p>
                  </div>--}}
               </div>
            </div>
            <div class="jdv-error" data-hidden="true">
               <img src="/assets/job-description-error-d70bb2d065b1538d289518fdb588c149f2607ce6ad444df32e3075ede7a31fde.png">
               <div class="error-title">We couldn't find the job you were looking for.</div>
            </div>
            <div class="jdv-panel-placeholder" data-hidden="true">
               <div class="header-placeholder">
                  <div class="flex">
                     <div class="skeleton -default -w-75 -h-6"></div>
                  </div>
                  <div class="flex">
                     <div class="skeleton -default -w-15 -h-3"></div>
                     <div class="skeleton -default -w-25 -h-3"></div>
                  </div>
                  <div class="flex">
                     <div class="skeleton -default -w-40 -h-3"></div>
                  </div>
                  <div class="flex">
                     <div class="skeleton -default -w-25 -h-3"></div>
                  </div>
                  <div class="flex">
                     <div class="skeleton -success -w-25 -h-10"></div>
                     <div class="skeleton -default -w-25 -h-10"></div>
                     <div class="skeleton -info -w-15 -h-3"></div>
                  </div>
               </div>
               <div class="body-placeholder">
                  <div class="skeleton -default -w-75 -h-3"></div>
                  <div class="skeleton -default -w-100 -h-3"></div>
                  <div class="skeleton -default -w-100 -h-3"></div>
                  <div class="skeleton -default -w-90 -h-3"></div>
                  <div class="skeleton -default -w-50 -h-3"></div>
                  <div class="skeleton -default -w-75 -h-3"></div>
                  <div class="skeleton -default -w-100 -h-3"></div>
                  <div class="skeleton -default -w-100 -h-3"></div>
                  <div class="skeleton -default -w-90 -h-3"></div>
                  <div class="skeleton -default -w-50 -h-3"></div>
                  <div class="skeleton -default -w-75 -h-3"></div>
                  <div class="skeleton -default -w-100 -h-3"></div>
                  <div class="skeleton -default -w-100 -h-3"></div>
                  <div class="skeleton -default -w-90 -h-3"></div>
                  <div class="skeleton -default -w-50 -h-3"></div>
                  <div class="skeleton -default -w-75 -h-3"></div>
                  <div class="skeleton -default -w-100 -h-3"></div>
                  <div class="skeleton -default -w-100 -h-3"></div>
                  <div class="skeleton -default -w-90 -h-3"></div>
                  <div class="skeleton -default -w-50 -h-3"></div>
                  <div class="skeleton -default -w-75 -h-3"></div>
                  <div class="skeleton -default -w-100 -h-3"></div>
                  <div class="skeleton -default -w-100 -h-3"></div>
                  <div class="skeleton -default -w-90 -h-3"></div>
                  <div class="skeleton -default -w-50 -h-3"></div>
                  <div class="skeleton -default -w-75 -h-3"></div>
                  <div class="skeleton -default -w-100 -h-3"></div>
                  <div class="skeleton -default -w-100 -h-3"></div>
                  <div class="skeleton -default -w-90 -h-3"></div>
                  <div class="skeleton -default -w-50 -h-3"></div>
                  <div class="skeleton -default -w-75 -h-3"></div>
                  <div class="skeleton -default -w-100 -h-3"></div>
                  <div class="skeleton -default -w-100 -h-3"></div>
                  <div class="skeleton -default -w-90 -h-3"></div>
                  <div class="skeleton -default -w-50 -h-3"></div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
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
   jQuery(function($) {
      var baseUrl = window.location.origin;

      $.ajax({
         url: baseUrl + '/jobsListApi',
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
                     <div id="backupp_jobs_${job.id}" class="job-card result sponsored-job premium-job spon-top" data-job-slug="${job.slug}" data-active="">
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
                           <div class="badge -quick-apply-badge">
                              <div class="content QuickApply" QuickApply="${job.slug}">Quick apply</div>
                           </div>
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
                           <button name="button" type="submit" class="tertiary save-job-button" data-label-save="Save">Save</button>
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
               $('#showJobsDetails').html('<p style="color: red;">'.response.message || 'Unknown error</p>');
            }
         },
         error: function(xhr) {
            console.error(xhr.responseText);
            // alert('Failed while fetching data. Please try again.');
            $('#showJobsDetails').html('<p style="color: red;">Failed while fetching data. Please try again.</p>');
         }
      });
   });
</script>

<script>
   // Add a click event listener to job cards to fetch job details
   $(document).on('click', '.backupp-sponsored-results .job-card', function() {
      $('.backupp-sponsored-results .job-card').attr('data-active', false);
      $(this).attr('data-active', true);
      var slug = $(this).data('job-slug');
      fetchJobsDetails(slug);
      console.log(slug);
      $('#showJobsDetails').empty();

      // Function to fetch job details
      function fetchJobsDetails(slug) {

         var baseUrl = window.location.origin;
         $.ajax({
            url: `${baseUrl}/jobDetailsApi/${slug}`,
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
                           <div class="job-view-actions-container top-actions-container">
                              <div class="action-buttons-container">
                                 <a class="rounded-button -primary -size-lg -w-full">
                                    <span class="content QuickApply" QuickApply="${job.slug}">Quick apply</span>
                                 </a>
                                 <button type="submit" class="save-job-button rounded-button -secondary -size-lg" data-disabled="">
                                    <span class="content SaveJob" SaveJob="${job.slug}" style="min-width: 100px;">Save job</span>
                                 </button>
                                 <a class="open-new-tab -link-cool" href="{{ url('/') }}/job/${job.slug}" rel="nofollow" target="_blank">Open in new tab</a>
                              </div>
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
      }
   });
</script>

<!-- code for Quick Apply -->
<script>
   // Event listener for clicks on .QuickApply elements
   jQuery(document).on('click', '.QuickApply', function() {
      // Get the value of the QuickApply attribute (job.slug)
      const jobSlug = $(this).attr('QuickApply');

      var loggedUser = "{{auth()->guard('user')->user()}}";
      if(!loggedUser){
         window.location.href = "{{url('login-first')}}";
         return false;
      }

      // Send AJAX request to the server
      $.ajax({
         url: 'apply-job.php',
         type: 'POST',
         data: {
            job_slug: jobSlug
         },
         success: function(response) {
            // Handle successful response
            alert('Application successful for job: ' + jobSlug);
            console.log(response);
         },
         error: function(xhr, status, error) {
            // Handle errors
            alert('There was an error applying for the job.');
            console.error('Error:', error);
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