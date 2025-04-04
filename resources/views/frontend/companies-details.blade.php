@extends('frontend.layouts.default_layout')

@section('content')
<div class="profile">
<div class="container">
    <div class="row">
    <div class="col-md-6">     
<div class="job-item">
                            <img src="https://backupp.com/assets/img/1.jpg" alt="Job">
                            <div class="job-inner align-items-center">
                                <div class="job-inner-left">
                                    <h3>
                                        <a href="job-details.html">backupp</a>
                                    </h3>
                                    <a class="company" href="company-details.html">3.9 <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> 6,820 reviews</a>
                                    
                                </div>
                                
                            </div>
                        </div>
                        </div>
                        </div>
  <ul class="nav nav-pills mb-3 border-bottom border-2" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link text-primary fw-semibold active position-relative" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Snapshot</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link text-primary fw-semibold position-relative" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Why Join Us</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link text-primary fw-semibold position-relative" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Questions</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link text-primary fw-semibold position-relative" id="Interviews" data-bs-toggle="pill" data-bs-target="#Interviews" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Interviews</button>
    </li>
  </ul>
  <div class="tab-content border rounded-3 border-primary p-3 text-dan" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
      
    <div class="containers">
    <div class="row">
    <div class="col-md-3">    
    <img src="https://backupp.com/assets/img/1.jpg" alt="Job">
    </div>
    <div class="col-md-9">    
    <div class="row">
    <div class="col-md-6">    
    <div class="card">   
    <div class="card-body">
    <h5 class="card-title">CEO</h5>
    <p>C.S. Venkatakrishnan (“Venkat”)
    </p>
    <div class="progressbar"> <div class="progress">
  75% <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
</div>
</div>
    <h6 class="card-subtitle mb-2  mt-3 text-muted">CEO approval rating
    </h6>
    </div>
  </div>
    </div>
    <div class="col-md-3"> 
    <div class="card">    
<div class="card-body">
    <h5 class="card-title">Founded</h5>
    <h6 class="card-subtitle mb-2 text-muted">1690</h6>
    </div>
  </div> 
</div>
<div class="col-md-3">
<div class="card">    
<div class="card-body">
    <h5 class="card-title">Company size
    </h5>
    <h6 class="card-subtitle mb-2 text-muted"><small>more than</small>
    10,000</h6>
    </div>
  </div> 
</div>


<div class="col-md-3">
<div class="card">    
<div class="card-body">
    <h5 class="card-title">Revenue
    </h5>
    <h6 class="card-subtitle mb-2 text-muted"><small>more than</small>
    10,000</h6>
    </div>
  </div> 
</div>

<div class="col-md-3">
<div class="card">    
<div class="card-body">
    <h5 class="card-title">Link
    </h5>
    <h6 class="card-subtitle mb-2 text-muted"><small>more than</small>
    10,000</h6>
    </div>
  </div> 
</div>

<div class="col-md-3">
<div class="card">    
<div class="card-body">
    <h5 class="card-title">Industry
    </h5>
    <h6 class="card-subtitle mb-2 text-muted"><small>more than</small>
    10,000</h6>
    </div>
  </div> 
</div>

<div class="col-md-3">
<div class="card">    
<div class="card-body">
    <h5 class="card-title">Headquarters

    </h5>
    <h6 class="card-subtitle mb-2 text-muted"><small>more than</small>
    10,000</h6>
    </div>
  </div> 
</div>

    </div>
</div>
     </div>
   </div>
    </div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    <h2>  About Barclays    </h2> 
    <p>Finance is the oxygen of the economy. Acting transparently and with expertise, we deploy finance responsibly to support people and businesses, acting with empathy and integrity, championing innovation and sustainability, for the common good and the long term. We have the capability and capital, the operational resilience and the commitment, to make a real and lasting difference to the economic lives of customers and communities. This is as true today as it was when our bank was founded over 330 years ago.</p>


    </div>
    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
    <div class="faq-section">
  <header>
    <h2>FAQs</h2> 
    <p>Answers to the most frequently asked questions.</p>
  </header>
   
 <! Adding the name atribute to details will enable to have only one disclosure box open>
  
  <details name="question">
    <summary>
      <h4>Why is Raycast free for personal use?</h4>
      <span class="material-symbols-outlined">expand_more</span>  
    </summary>
    <p>We think of Raycast as a productivity layer that everybody should use to get work done faster. To make it accessible, we don't charge for the individual plan. The plan covers all built-in extensions, such as Clipboard History, Calendar or Window Management and provides access to all public extensions built by our community.</p>
  </details>
  
  <hr>
  
  <details name="question">
    <summary>
      <h4>When is Raycast for teams available?</h4>
      <span class="material-symbols-outlined">expand_more</span>  
    </summary>
    <p>We don't have an exact date right now, but we will launch Raycast for Teams in 2022. You can sign up to get early access above, and be the first to hear when we're launching it.</p>
  </details> 
  
  <hr>
  
  <details name="question">
    <summary>
      <h4>How many seats do I get in a Team plan?</h4>
      <span class="material-symbols-outlined">expand_more</span>  
    </summary>
    <p>We don't have an exact date right now, but we will launch Raycast for Teams in 2022. You can sign up to get early access above, and be the first to hear when we're launching it.</p>
  </details>
  
  <hr>
  
  <details name="question">
    <summary>
      <h4>Can I have personal Extensions and Team Extensions?</h4>
      <span class="material-symbols-outlined">expand_more</span>  
    </summary>
    <p>Yes, you can create personal Extensions that are personalized to you, and speed up your productivity, and have team Extensions that can be shared around in your organization for everyone to use. Team Extensions will be available in the Store command, behind a filter for your Team. This is where all of your Team Extensions will live, and where you can install them.</p>
  </details>
  
  <hr>
  
  <details name="question">
    <summary>
      <h4>How much will Team features cost?</h4>
      <span class="material-symbols-outlined">expand_more</span>  
    </summary>
    <p>Team features will cost $10 per user, per month.</p>
  </details>
  
</div>
    </div>
    <div class="tab-pane fade" id="Interviews" role="tabpanel" aria-labelledby="Interviews">
      <h2>Profile</h2>
      <p>Please check our more design @ <a target="_blank" href="https://codepen.io/Gaurav-Rana-the-reactor">Codepen</a></p>
    </div>
  </div>
</div>

</div>
@endsection


@section('styleSheets')
<style>
    .job-item {
    margin-bottom: 30px;
    border: 0px solid #c1c1c1;
    padding: 0px;
    position: relative;
}
.profile {
    margin-top: 155px;
    margin-bottom: 60px;
}.profile .tab-content>.active, .profile .tab-content {
    border: 0px !important;
    padding: 0px 0px !important;
}
.job-item img {
    position: absolute;
    top: 0%;
    width: 10%;
    border-radius: 10px;
    box-shadow: 0px 3px 3px 1px #ededed;
}
.nav .nav-item button.active {
  background-color: transparent;
  color:#022162 !important;
}
.nav .nav-item button.active::after {
  content: "";
  border-bottom: 4px solid #022162;
  width: 100%;
  position: absolute;
  left: 0;
  bottom:-1px;
  border-radius: 5px 5px 0 0;
}


</style>

@endsection