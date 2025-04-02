@extends('frontend.layouts.default_layout')
@section('content')
<!-- Banner -->
<div class="banner-area banner-img-one">
   <div class="d-table">
      <div class="d-table-cell">
         <div class="container">
            <div class="banner-text">
               <h1>Find Your <span>Dream Job Now</span></h1>
               <p>5 lakh+ jobs for you to explore</p>
               <div class="banner-form-area">
                  <form>
                     <div class="row  justify-content-center">
                        <div class="col-lg-7">
                           <div class="form-group">
                              <input type="text" class="form-control" required placeholder="Job title, keywords, or company">
                              <label>
                              <i class="icofont-search-1"></i>
                              </label>
                           </div>
                        </div>
                        <div class="col-lg-5">
                           <div class="form-group city">
                              <label>
                              <i class="icofont-location-pin"></i>
                              </label>
                              <input type="text" class="form-control" required placeholder="City, state, zip code, or remote">
                           </div>
                        </div>
                     </div>
                     <button type="submit" class="btn banner-form-btn">Find Job</button>
                  </form>
               </div>
               <div class="scroll">
                  <div class="banner-btn">
                     <img src="{{ asset('frontend/assets/img/Groupimg.png') }}">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- End Banner -->
<!-- Account -->
<div class="account-area">
   <div class="container">
      <div class="row account-wrap">
         <div class="col">  <img src="{{ asset('frontend/assets/img/cate.png') }}"> </div>
      </div>
   </div>
</div>
<!-- End Account -->
<!-- Profile -->
<section class="profile-area ptb-100 ">
   <div class="container">
      <div class="section-title">
         <h2>Most booked services
         </h2>
      </div>
      <div class="profile-slider owl-theme owl-carousel">
         <div class="profile-item">
            <img src="{{ asset('frontend/assets/img/home-1/salone.jpg') }}" alt="Profile">
            <div class="profile-inner">
               <h3>Haircut for men</h3>
               <span>299 INR</span>
               <div class="profile-heart">
                  <a href="#">
                  <i class="icofont-star"></i> 4.89 (498K)</a>
               </div>
            </div>
         </div>
         <div class="profile-item">
            <img src="{{ asset('frontend/assets/img/home-1/salone.jpg') }}" alt="Profile">
            <div class="profile-inner">
               <h3>Haircut for men</h3>
               <span>299 INR</span>
               <div class="profile-heart">
                  <a href="#">
                  <i class="icofont-star"></i> 4.89 (498K)</a>
               </div>
            </div>
         </div>
         <div class="profile-item">
            <img src="{{ asset('frontend/assets/img/home-1/salone.jpg') }}" alt="Profile">
            <div class="profile-inner">
               <h3>Haircut for men</h3>
               <span>299 INR</span>
               <div class="profile-heart">
                  <a href="#">
                  <i class="icofont-star"></i> 4.89 (498K)</a>
               </div>
            </div>
         </div>
         <div class="profile-item">
            <img src="{{ asset('frontend/assets/img/home-1/salone.jpg') }}" alt="Profile">
            <div class="profile-inner">
               <h3>Haircut for men</h3>
               <span>299 INR</span>
               <div class="profile-heart">
                  <a href="#">
                  <i class="icofont-star"></i> 4.89 (498K)</a>
               </div>
            </div>
         </div>
         <div class="profile-item">
            <img src="{{ asset('frontend/assets/img/home-1/salone.jpg') }}" alt="Profile">
            <div class="profile-inner">
               <h3>Haircut for men</h3>
               <span>299 INR</span>
               <div class="profile-heart">
                  <a href="#">
                  <i class="icofont-star"></i> 4.89 (498K)</a>
               </div>
            </div>
         </div>
         <div class="profile-item">
            <img src="{{ asset('frontend/assets/img/home-1/salone.jpg') }}" alt="Profile">
            <div class="profile-inner">
               <h3>Haircut for men</h3>
               <span>299 INR</span>
               <div class="profile-heart">
                  <a href="#">
                  <i class="icofont-star"></i> 4.89 (498K)</a>
               </div>
            </div>
         </div>
         <div class="profile-item">
            <img src="{{ asset('frontend/assets/img/home-1/salone.jpg') }}" alt="Profile">
            <div class="profile-inner">
               <h3>Haircut for men</h3>
               <span>299 INR</span>
               <div class="profile-heart">
                  <a href="#">
                  <i class="icofont-star"></i> 4.89 (498K)</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- End Profile -->
<!-- Category -->
<section class="category-area companies ptb-100 ">
   <div class="container">
      <div class="section-title">
         <h2>Top companies hiring now</h2>
      </div>
      <div class="row  justify-content-center">
         <div class="col-lg-3">
            <div class="companiesname">
               <a href="#">MNCs <i class="icofont-simple-right"></i></a>
               <p>2K+ are Actively Hiring</p>
               <div class="complogo">
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a> 
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a>   
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a>   
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a>     
               </div>
            </div>
         </div>
         <div class="col-lg-3">
            <div class="companiesname">
               <a href="#">MNCs <i class="icofont-simple-right"></i></a>
               <p>2K+ are Actively Hiring</p>
               <div class="complogo">
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a> 
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a>   
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a>   
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a>     
               </div>
            </div>
         </div>
         <div class="col-lg-3">
            <div class="companiesname">
               <a href="#">MNCs <i class="icofont-simple-right"></i></a>
               <p>2K+ are Actively Hiring</p>
               <div class="complogo">
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a> 
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a>   
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a>   
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a>     
               </div>
            </div>
         </div>
         <div class="col-lg-3">
            <div class="companiesname">
               <a href="#">MNCs <i class="icofont-simple-right"></i></a>
               <p>2K+ are Actively Hiring</p>
               <div class="complogo">
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a> 
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a>   
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a>   
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a>     
               </div>
            </div>
         </div>
         <div class="col-lg-3">
            <div class="companiesname">
               <a href="#">MNCs <i class="icofont-simple-right"></i></a>
               <p>2K+ are Actively Hiring</p>
               <div class="complogo">
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a> 
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a>   
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a>   
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a>     
               </div>
            </div>
         </div>
         <div class="col-lg-3">
            <div class="companiesname">
               <a href="#">MNCs <i class="icofont-simple-right"></i></a>
               <p>2K+ are Actively Hiring</p>
               <div class="complogo">
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a> 
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a>   
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a>   
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a>     
               </div>
            </div>
         </div>
         <div class="col-lg-3">
            <div class="companiesname">
               <a href="#">MNCs <i class="icofont-simple-right"></i></a>
               <p>2K+ are Actively Hiring</p>
               <div class="complogo">
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a> 
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a>   
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a>   
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a>     
               </div>
            </div>
         </div>
         <div class="col-lg-3">
            <div class="companiesname">
               <a href="#">MNCs <i class="icofont-simple-right"></i></a>
               <p>2K+ are Actively Hiring</p>
               <div class="complogo">
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a> 
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a>   
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a>   
                  <a href="#"><img src="{{ asset('frontend/assets/img/home-1/companiesiocn.jpg') }}"></a>     
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- End Category -->
<!-- Popular -->
<div class="popular-area pt-100 pb-70 ">
   <div class="container">
      <div class="row align-items-center justify-content-center">
         <div class="col-lg-12">
            <div class="postjob">
               <h2>Better job matches.</h2>
               <p>Find the best candidate from 5 crore+ active job seekers!</p>
               <a href="#" class="postbtn">Post Job</a>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- End Popular -->
<!-- Profile -->
<section class="profile-area ptb-100 ">
   <div class="container">
      <div class="section-title">
         <h2>Salon for women
         </h2>
      </div>
      <div class="profile-slider owl-theme owl-carousel text-center">
         <div class="profile-item">
            <img src="{{ asset('frontend/assets/img/home-1/salone.jpg') }}" alt="Profile">
            <div class="profile-inner">
               <h3>Haircut for men</h3>
            </div>
         </div>
         <div class="profile-item">
            <img src="{{ asset('frontend/assets/img/home-1/salone.jpg') }}" alt="Profile">
            <div class="profile-inner">
               <h3>Haircut for men</h3>
            </div>
         </div>
         <div class="profile-item">
            <img src="{{ asset('frontend/assets/img/home-1/salone.jpg') }}" alt="Profile">
            <div class="profile-inner">
               <h3>Haircut for men</h3>
            </div>
         </div>
         <div class="profile-item">
            <img src="{{ asset('frontend/assets/img/home-1/salone.jpg') }}" alt="Profile">
            <div class="profile-inner">
               <h3>Haircut for men</h3>
            </div>
         </div>
         <div class="profile-item">
            <img src="{{ asset('frontend/assets/img/home-1/salone.jpg') }}" alt="Profile">
            <div class="profile-inner">
               <h3>Haircut for men</h3>
            </div>
         </div>
         <div class="profile-item">
            <img src="{{ asset('frontend/assets/img/home-1/salone.jpg') }}" alt="Profile">
            <div class="profile-inner">
               <h3>Haircut for men</h3>
            </div>
         </div>
         <div class="profile-item">
            <img src="{{ asset('frontend/assets/img/home-1/salone.jpg') }}" alt="Profile">
            <div class="profile-inner">
               <h3>Haircut for men</h3>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- End Profile -->
<!-- Profile -->
<section class="profile-area ptb-100 ">
   <div class="container">
      <div class="section-title">
         <h2>Cleaning & pest control
         </h2>
      </div>
      <div class="profile-slidern owl-theme owl-carousel text-center pestcontrol">
         <div class="profile-item">
            <img src="{{ asset('frontend/assets/img/home-1/salone.jpg') }}" alt="Profile">
            <div class="profile-inner">
               <h3>Haircut for men</h3>
            </div>
         </div>
         <div class="profile-item">
            <img src="{{ asset('frontend/assets/img/home-1/salone.jpg') }}" alt="Profile">
            <div class="profile-inner">
               <h3>Haircut for men</h3>
            </div>
         </div>
         <div class="profile-item">
            <img src="{{ asset('frontend/assets/img/home-1/salone.jpg') }}" alt="Profile">
            <div class="profile-inner">
               <h3>Haircut for men</h3>
            </div>
         </div>
         <div class="profile-item">
            <img src="{{ asset('frontend/assets/img/home-1/salone.jpg') }}" alt="Profile">
            <div class="profile-inner">
               <h3>Haircut for men</h3>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- End Profile -->
<!-- App -->
<div class="app-area ptb-100">
   <div class="container">
      <div class="row  justify-content-center">
         <div class="col-lg-12">
            <div class="app-items app-left">
               <img src="{{ asset('frontend/assets/img/home-1/user.png') }}" alt="Mobile">
            </div>
            <div class="app-item">
               <div class="section-title text-left">
                  <p>Explore New Life</p>
                  <h2>Find your dream job effortlessly. We believe that you deserve better.</h2>
               </div>
               <p>Always find beyond expectations. Use Backupp, and we will enable you to find the 
                  right opportunities you want.
               </p>
               <div class="app-btn">
                  <a class="app-btn-one" href="#">
                  <span>Find Your Dream Job</span>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<section class="profile-area ptb-100">
   <div class="container">
      <div class="section-title">
         <h2>Video</h2>
         <p>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      </div>
      <div class="profile-slidercollection owl-theme owl-carousel collection">
         <div class="profile-item">
            <div class="image_sec">
               <iframe width="100%" height="300" src="https://www.youtube.com/embed/ANOTHER_VIDEO_ID" frameborder="0"></iframe>
            </div>
         </div>
         <div class="profile-item">
            <div class="image_sec">
               <iframe width="100%" height="300" src="https://www.youtube.com/embed/ANOTHER_VIDEO_ID" frameborder="0"></iframe>
            </div>
         </div>
         <div class="profile-item">
            <div class="image_sec">
               <iframe width="100%" height="300" src="https://www.youtube.com/embed/ANOTHER_VIDEO_ID" frameborder="0"></iframe>
            </div>
         </div>
         <div class="profile-item">
            <div class="image_sec">
               <iframe width="100%" height="300" src="https://www.youtube.com/embed/ANOTHER_VIDEO_ID" frameborder="0"></iframe>
            </div>
         </div>
         <div class="profile-item">
            <div class="image_sec">
               <iframe width="100%" height="300" src="https://www.youtube.com/embed/SOME_OTHER_VIDEO_ID" frameborder="0"></iframe>
            </div>
         </div>
      </div>
   </div>
</section>

<!-- End App -->
<!-- Profile -->
<section class="profile-area ptb-100 ">
   <div class="container">
      <div class="section-title">
         <h2>Our Blogs
         </h2>
         <p>Discover wide range of summer collection</p>
      </div>
      <div class="profile-slidercollection owl-theme owl-carousel collection">
         @foreach ($blogs as $blog)
         <div class="profile-item">
            <div class="image_sec">
               <a href="{{ url('blog/'.$blog->slug) }}">
               <img src="{{ asset('frontend/assets/img/posts/'.$blog->image) }}" alt="Profile">
               </a>
            </div>
            <div class="blog_content_">
               <div class="profile-inner">
                  <a href="{{ url('blog/'.$blog->slug) }}">
                     <h3>{{ $blog->title }}</h3>
                  </a>
                  <p class="blog_desc">
                     {!! substr(strip_tags($blog->content), 0, 120) !!}
                  </p>
               </div>
               <div class="profile-heart readmoreBtn">
                  <a href="{{ url('blog/'.$blog->slug) }}">
                  Read More</a>
               </div>
            </div>
         </div>
         @endforeach
      </div>
   </div>
</section>
<section class="profile-area ptb-100 ">
   <div class="container">
      <div class="section-title">
         <h2>Testimonials</h2>
         <p>Discover wide range of summer collection</p>
      </div>
      {{-- 
      <div class="testimonial-container">
         <div class="testimonial-grid">
            <div class="image-container" id="image-container">
               <img src="{{ asset('frontend/assets/img/home-1/user.png') }}" alt="Mobile">
            </div>
            <div class="testimonial-content">
               <div>
                  <h3 class="name" id="name">Tamar Mendelson</h3>
                  <p class="designation" id="designation">Restaurant Critic</p>
                  <p class="quote" id="quote">I was impressed by the food — every dish is bursting with flavor! And I could really tell that they use high-quality ingredients. The staff was friendly and attentive, going the extra mile. I'll definitely be back for more!</p>
               </div>
               <div class="arrow-buttons">
                  <button class="arrow-button prev-button" id="prev-button">
                     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z" />
                     </svg>
                  </button>
                  <button class="arrow-button next-button" id="next-button">
                     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z" />
                     </svg>
                  </button>
               </div>
            </div>
         </div>
      </div>
      --}}
      <div class="container-fluid bg-body-tertiary py-3">
         <div id="testimonialCarousel" class="carousel">
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <div class="card shadow-sm rounded-3">
                     <div class="quotes display-2 text-body-tertiary">
                        <i class="bi bi-quote"></i>
                     </div>
                     <div class="card-body">
                        <p class="card-text">"Some quick example text to build on the card title and make up the
                           bulk of
                           the card's content."
                        </p>
                        <div class="d-flex align-items-center pt-2">
                           <img src="https://codingyaar.com/wp-content/uploads/square-headshot-1.png" alt="bootstrap testimonial carousel slider 2">
                           <div>
                              <h5 class="card-title fw-bold">Jane Doe</h5>
                              <span class="text-secondary">CEO, Example Company</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <div class="card shadow-sm rounded-3">
                     <div class="quotes display-2 text-body-tertiary">
                        <i class="bi bi-quote"></i>
                     </div>
                     <div class="card-body">
                        <p class="card-text">"Some quick example text to build on the card title and make up the
                           bulk of
                           the card's content."
                        </p>
                        <div class="d-flex align-items-center pt-2">
                           <img src="https://codingyaar.com/wp-content/uploads/square-headshot-2.png" alt="bootstrap testimonial carousel slider 2">
                           <div>
                              <h5 class="card-title fw-bold">June Doe</h5>
                              <span class="text-secondary">CEO, Example Company</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <div class="card shadow-sm rounded-3">
                     <div class="quotes display-2 text-body-tertiary">
                        <i class="bi bi-quote"></i>
                     </div>
                     <div class="card-body">
                        <p class="card-text">"Some quick example text to build on the card title and make up the
                           bulk of
                           the card's content."
                        </p>
                        <div class="d-flex align-items-center pt-2">
                           <img src="https://codingyaar.com/wp-content/uploads/bootstrap-profile-card-image.jpg" alt="bootstrap testimonial carousel slider 2">
                           <div>
                              <h5 class="card-title fw-bold">John Doe</h5>
                              <span class="text-secondary">CEO, Example Company</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <div class="card shadow-sm rounded-3">
                     <div class="quotes display-2 text-body-tertiary">
                        <i class="bi bi-quote"></i>
                     </div>
                     <div class="card-body">
                        <p class="card-text">"Some quick example text to build on the card title and make up the
                           bulk of
                           the card's content."
                        </p>
                        <div class="d-flex align-items-center pt-2">
                           <img src="https://codingyaar.com/wp-content/uploads/bootstrap-profile-card-image.jpg" alt="bootstrap testimonial carousel slider 2">
                           <div>
                              <h5 class="card-title fw-bold">John Doe</h5>
                              <span class="text-secondary">CEO, Example Company</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <div class="card shadow-sm rounded-3">
                     <div class="quotes display-2 text-body-tertiary">
                        <i class="bi bi-quote"></i>
                     </div>
                     <div class="card-body">
                        <p class="card-text">"Some quick example text to build on the card title and make up the
                           bulk of
                           the card's content."
                        </p>
                        <div class="d-flex align-items-center pt-2">
                           <img src="https://codingyaar.com/wp-content/uploads/bootstrap-profile-card-image.jpg" alt="bootstrap testimonial carousel slider 2">
                           <div>
                              <h5 class="card-title fw-bold">John Doe</h5>
                              <span class="text-secondary">CEO, Example Company</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <div class="card shadow-sm rounded-3">
                     <div class="quotes display-2 text-body-tertiary">
                        <i class="bi bi-quote"></i>
                     </div>
                     <div class="card-body">
                        <p class="card-text">"Some quick example text to build on the card title and make up the
                           bulk of
                           the card's content."
                        </p>
                        <div class="d-flex align-items-center pt-2">
                           <img src="https://codingyaar.com/wp-content/uploads/bootstrap-profile-card-image.jpg" alt="bootstrap testimonial carousel slider 2">
                           <div>
                              <h5 class="card-title fw-bold">John Doe</h5>
                              <span class="text-secondary">CEO, Example Company</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <div class="card shadow-sm rounded-3">
                     <div class="quotes display-2 text-body-tertiary">
                        <i class="bi bi-quote"></i>
                     </div>
                     <div class="card-body">
                        <p class="card-text">"Some quick example text to build on the card title and make up the
                           bulk of
                           the card's content."
                        </p>
                        <div class="d-flex align-items-center pt-2">
                           <img src="https://codingyaar.com/wp-content/uploads/bootstrap-profile-card-image.jpg" alt="bootstrap testimonial carousel slider 2">
                           <div>
                              <h5 class="card-title fw-bold">John Doe</h5>
                              <span class="text-secondary">CEO, Example Company</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <div class="card shadow-sm rounded-3">
                     <div class="quotes display-2 text-body-tertiary">
                        <i class="bi bi-quote"></i>
                     </div>
                     <div class="card-body">
                        <p class="card-text">"Some quick example text to build on the card title and make up the
                           bulk of
                           the card's content."
                        </p>
                        <div class="d-flex align-items-center pt-2">
                           <img src="https://codingyaar.com/wp-content/uploads/bootstrap-profile-card-image.jpg" alt="bootstrap testimonial carousel slider 2">
                           <div>
                              <h5 class="card-title fw-bold">John Doe</h5>
                              <span class="text-secondary">CEO, Example Company</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <div class="card shadow-sm rounded-3">
                     <div class="quotes display-2 text-body-tertiary">
                        <i class="bi bi-quote"></i>
                     </div>
                     <div class="card-body">
                        <p class="card-text">"Some quick example text to build on the card title and make up the
                           bulk of
                           the card's content."
                        </p>
                        <div class="d-flex align-items-center pt-2">
                           <img src="https://codingyaar.com/wp-content/uploads/bootstrap-profile-card-image.jpg" alt="bootstrap testimonial carousel slider 2">
                           <div>
                              <h5 class="card-title fw-bold">John Doe</h5>
                              <span class="text-secondary">CEO, Example Company</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
            </button>
         </div>
      </div>
   </div>
</section>
<!-- End Profile -->
@endsection
@section('styleSheets')
<style>
   .carousel img {
   width: 70px;
   max-height: 70px;
   border-radius: 50%;
   margin-right: 1rem;
   overflow: hidden;
   }
   .carousel-inner {
   padding: 1em;
   }
   @media screen and (min-width: 576px) {
   .carousel-inner {
   display: flex;
   width: 90%;
   margin-inline: auto;
   padding: 1em 0;
   overflow: hidden;
   }
   .carousel-item {
   display: block;
   margin-right: 0;
   flex: 0 0 calc(100% / 2);
   }
   }
   @media screen and (min-width: 768px) {
   .carousel-item {
   display: block;
   margin-right: 0;
   flex: 0 0 calc(100% / 3);
   }
   }
   .carousel .card {
   margin: 0 0.5em;
   border: 0;
   }
   .carousel-control-prev,
   .carousel-control-next {
   width: 3rem;
   height: 3rem;
   background-color: grey;
   border-radius: 50%;
   top: 50%;
   transform: translateY(-50%);
   }
   .testimonial-container {
   width: 100%;
   max-width: 56rem;
   padding: 2rem;
   }
   .testimonial-grid {
   display: grid;
   gap: 5rem;
   }
   .image-container {
   position: relative;
   width: 100%;
   height: 24rem;
   perspective: 1000px;
   }
   .testimonial-image {
   position: absolute;
   width: 100%;
   height: 100%;
   object-fit: cover;
   border-radius: 1.5rem;
   transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
   box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
   }
   .testimonial-content {
   display: flex;
   flex-direction: column;
   justify-content: space-between;
   }
   .name {
   font-size: 1.5rem;
   font-weight: bold;
   color: #000;
   margin-bottom: 0.25rem;
   }
   .designation {
   font-size: 0.875rem;
   color: #6b7280;
   margin-bottom: 2rem;
   }
   .quote {
   font-size: 1.125rem;
   color: #4b5563;
   line-height: 1.75;
   }
   .arrow-buttons {
   display: flex;
   gap: 1rem;
   padding-top: 3rem;
   }
   .arrow-button {
   width: 1.75rem;
   height: 1.75rem;
   border-radius: 50%;
   background-color: #141414;
   display: flex;
   align-items: center;
   justify-content: center;
   cursor: pointer;
   transition: background-color 0.3s;
   }
   .arrow-button:hover {
   background-color: #00a6fb;
   }
   .arrow-button svg {
   width: 1.25rem;
   height: 1.25rem;
   fill: #f1f1f7;
   transition: transform 0.3s;
   }
   .arrow-button:hover svg {
   fill: #ffffff;
   }
   .prev-button:hover svg {
   transform: rotate(-12deg);
   }
   .next-button:hover svg {
   transform: rotate(12deg);
   }
   @media (min-width: 768px) {
   .testimonial-grid {
   grid-template-columns: 1fr 1fr;
   }
   .arrow-buttons {
   padding-top: 0;
   }
   }
</style>
@endsection
@section('script')
<style>
   const testimonials = [
   {
   quote:
   "I was impressed by the food — every dish is bursting with flavor! And I could really tell that they use high-quality ingredients. The staff was friendly and attentive, going the extra mile. I'll definitely be back for more!",
   name: "Tamar Mendelson",
   designation: "Restaurant Critic",
   src:
   "https://images.unsplash.com/photo-1512316609839-ce289d3eba0a?q=80&w=1368&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
   },
   {
   quote:
   "This place exceeded all expectations! The atmosphere is inviting, and the staff truly goes above and beyond to ensure a fantastic visit. I'll definitely keep returning for more exceptional dining experience.",
   name: "Joe Charlescraft",
   designation: "Frequent Visitor",
   src:
   "https://images.unsplash.com/photo-1628749528992-f5702133b686?q=80&w=1368&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fA%3D%3D"
   },
   {
   quote:
   "Shining Yam is a hidden gem! From the moment I walked in, I knew I was in for a treat. The impeccable service and overall attention to detail created a memorable experience. I highly recommend it!",
   name: "Martina Edelweist",
   designation: "Satisfied Customer",
   src:
   "https://images.unsplash.com/photo-1524267213992-b76e8577d046?q=80&w=1368&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fA%3D%3D"
   }
   ];
   let activeIndex = 0;
   const imageContainer = document.getElementById("image-container");
   const nameElement = document.getElementById("name");
   const designationElement = document.getElementById("designation");
   const quoteElement = document.getElementById("quote");
   const prevButton = document.getElementById("prev-button");
   const nextButton = document.getElementById("next-button");
   function calculateGap(width) {
   const minWidth = 1024;
   const maxWidth = 1456;
   const minGap = 60;
   const maxGap = 86;
   if (width <= minWidth) return minGap;
   if (width >= maxWidth)
   return Math.max(minGap, maxGap + 0.06018 * (width - maxWidth));
   return (
   minGap + (maxGap - minGap) * ((width - minWidth) / (maxWidth - minWidth))
   );
   }
   function updateTestimonial(direction) {
   const oldIndex = activeIndex;
   activeIndex =
   (activeIndex + direction + testimonials.length) % testimonials.length;
   const containerWidth = imageContainer.offsetWidth;
   const gap = calculateGap(containerWidth);
   const maxStickUp = gap * 0.8; // 80% of the calculated gap
   testimonials.forEach((testimonial, index) => {
   let img = imageContainer.querySelector(`[data-index="${index}"]`);
   if (!img) {
   img = document.createElement("img");
   img.src = testimonial.src;
   img.alt = testimonial.name;
   img.classList.add("testimonial-image");
   img.dataset.index = index;
   imageContainer.appendChild(img);
   }
   const offset =
   (index - activeIndex + testimonials.length) % testimonials.length;
   const zIndex = testimonials.length - Math.abs(offset);
   const opacity = index === activeIndex ? 1 : 1;
   const scale = index === activeIndex ? 1 : 0.85;
   let translateX, translateY, rotateY;
   if (offset === 0) {
   translateX = "0%";
   translateY = "0%";
   rotateY = "0deg";
   } else if (offset === 1 || offset === -2) {
   translateX = "20%";
   translateY = `-${(maxStickUp / img.offsetHeight) * 100}%`;
   rotateY = "-15deg";
   } else {
   translateX = "-20%";
   translateY = `-${(maxStickUp / img.offsetHeight) * 100}%`;
   rotateY = "15deg";
   }
   img.style.zIndex = zIndex;
   img.style.opacity = opacity;
   img.style.transform = `translate(${translateX}, ${translateY}) scale(${scale}) rotateY(${rotateY})`;
   });
   nameElement.textContent = testimonials[activeIndex].name;
   designationElement.textContent = testimonials[activeIndex].designation;
   quoteElement.innerHTML = testimonials[activeIndex].quote
   .split(" ")
   .map((word) => `<span class="word">${word}</span>`)
   .join(" ");
   animateWords();
   }
   function animateWords() {
   const words = quoteElement.querySelectorAll(".word");
   words.forEach((word, index) => {
   word.style.opacity = "0";
   word.style.transform = "translateY(10px)";
   word.style.filter = "blur(10px)";
   setTimeout(() => {
   word.style.transition =
   "opacity 0.2s ease-in-out, transform 0.2s ease-in-out, filter 0.2s ease-in-out";
   word.style.opacity = "1";
   word.style.transform = "translateY(0)";
   word.style.filter = "blur(0)";
   }, index * 20);
   });
   }
   function handleNext() {
   updateTestimonial(1);
   }
   function handlePrev() {
   updateTestimonial(-1);
   }
   prevButton.addEventListener("click", handlePrev);
   nextButton.addEventListener("click", handleNext);
   // Initial setup
   updateTestimonial(0);
   // Autoplay functionality
   const autoplayInterval = setInterval(handleNext, 5000);
   // Stop autoplay on user interaction
   [prevButton, nextButton].forEach((button) => {
   button.addEventListener("click", () => {
   clearInterval(autoplayInterval);
   });
   });
   // Handle window resize
   window.addEventListener("resize", () => updateTestimonial(0));
</style>
<script>
   const multipleItemCarousel = document.querySelector("#testimonialCarousel");
   
   if (window.matchMedia("(min-width:576px)").matches) {
   const carousel = new bootstrap.Carousel(multipleItemCarousel, {
    interval: false
   });
   
   var carouselWidth = $(".carousel-inner")[0].scrollWidth;
   var cardWidth = $(".carousel-item").width();
   
   var scrollPosition = 0;
   
   $(".carousel-control-next").on("click", function () {
    if (scrollPosition < carouselWidth - cardWidth * 3) {
      console.log("next");
      scrollPosition = scrollPosition + cardWidth;
      $(".carousel-inner").animate({ scrollLeft: scrollPosition }, 800);
    }
   });
   $(".carousel-control-prev").on("click", function () {
    if (scrollPosition > 0) {
      scrollPosition = scrollPosition - cardWidth;
      $(".carousel-inner").animate({ scrollLeft: scrollPosition }, 800);
    }
   });
   } else {
   $(multipleItemCarousel).addClass("slide");
   }
</script>
@endsection