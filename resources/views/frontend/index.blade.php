@extends('frontend.layouts.default_layout')

@section('content')

<!-- Banner -->

<div class="banner-area banner-img-one">

   <div class="d-table">

      <div class="d-table-cell">

         <div class="container">
            <div class="row">

               <div class="col-lg-6">
               <div class="banner-text">

               <div class="slider-text-container">
	<ul class="dynamic-text">
		<li><span>Find Your Dream Job Now</span></li>
	
	</ul>
</div>

<div class="banner-form-area">

   <form>

      <div class="row  justify-content-center">

         <div class="col-lg-12">

            <div class="form-group">

               <input type="text" class="form-control" required placeholder="Job title, keywords, or company">

               <label>

                  <i class="icofont-search-1"></i>

               </label>

            </div>

         </div>

         <div class="col-lg-12">

            <div class="form-group city">

               <label>

                  <i class="icofont-location-pin"></i>

               </label>

               <input type="text" class="form-control" required placeholder="City, state, zip code, or remote">

            </div>

         </div>
         <div class="col-lg-12">
            <button type="submit" class="btn banner-form-btn">Find Job</button>
         </div>
      </div>



   </form>

</div>



</div>
                
               </div>
               <div class="col-lg-6">
                  <div class="videos">
                     <video width="100%" height="240" controls>
                        <source src="https://cdn.pixabay.com/video/2022/10/31/137186-765701394_large.mp4" type="video/mp4">
                     </video>

                  </div>
               </div>
            </div>



            <div class="banner-text">
               <div class="heading commons">Latest Jobs</div>
               <div class="scroll">
                  <div class="banner-btn">
                     @foreach($categories as $categorie)
                        <a href="#">
                           <img src="{{ asset('uploads/category/icons/' . $categorie->category_icon) }}" alt="icon">
                           <span><strong>{{$categorie->category_name}}</strong>{{$categorie->category_short_description}}</span> 
                        </a>
                     @endforeach
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
   <div class="section-title">
         <h2>Services Provider 
         </h2>
      </div>
      <div class="row account-wrap">
         <!-- <div class="col">  <img src="assets/img/cate.png"> </div> -->

         <div class="col">
            <div class="cat">
               <a href="#">

                  <div class="catimgblock"><img src="assets/img/hotel.jpg"></div>
                  <p>Restaurant </p>
               </a>
            </div>
         </div>

         <div class="col">
            <div class="cat">
               <a href="#">

                  <div class="catimgblock"><img src="assets/img/hotel.jpg"></div>
                  <p>Restaurant </p>
               </a>
            </div>
         </div>

         <div class="col">
            <div class="cat">
               <a href="#">

                  <div class="catimgblock"><img src="assets/img/hotel.jpg"></div>
                  <p>Restaurant </p>
               </a>
            </div>
         </div>
         <div class="col">
            <div class="cat">
               <a href="#">

                  <div class="catimgblock"><img src="assets/img/hotel.jpg"></div>
                  <p>Restaurant </p>
               </a>
            </div>
         </div>
         <div class="col">
            <div class="cat">
               <a href="#">

                  <div class="catimgblock"><img src="assets/img/hotel.jpg"></div>
                  <p>Restaurant </p>
               </a>
            </div>
         </div>
         <div class="col">
            <div class="cat">
               <a href="#">

                  <div class="catimgblock"><img src="assets/img/hotel.jpg"></div>
                  <p>Restaurant </p>
               </a>
            </div>
         </div>
         <div class="col">
            <div class="cat">
               <a href="#">

                  <div class="catimgblock"><img src="assets/img/hotel.jpg"></div>
                  <p>Restaurant </p>
               </a>
            </div>
         </div>
         <div class="col">
            <div class="cat">
               <a href="#">

                  <div class="catimgblock"><img src="assets/img/hotel.jpg"></div>
                  <p>Restaurant </p>
               </a>
            </div>
         </div>
         <div class="col">
            <div class="cat">
               <a href="#">

                  <div class="catimgblock"><img src="assets/img/hotel.jpg"></div>
                  <p>Restaurant </p>
               </a>
            </div>
         </div>
         <div class="col">
            <div class="cat">
               <a href="#">

                  <div class="catimgblock"><img src="assets/img/hotel.jpg"></div>
                  <p>Restaurant </p>
               </a>
            </div>
         </div>
      </div>
      <div class="row account-wrap">
         <div class="col">
            <div class="cat">
               <a href="#">

                  <div class="catimgblock"><img src="assets/img/hotel.jpg"></div>
                  <p>Restaurant </p>
               </a>
            </div>
         </div>
         <div class="col">
            <div class="cat">
               <a href="#">

                  <div class="catimgblock"><img src="assets/img/hotel.jpg"></div>
                  <p>Restaurant </p>
               </a>
            </div>
         </div>
         <div class="col">
            <div class="cat">
               <a href="#">

                  <div class="catimgblock"><img src="assets/img/hotel.jpg"></div>
                  <p>Restaurant </p>
               </a>
            </div>
         </div>
         <div class="col">
            <div class="cat">
               <a href="#">

                  <div class="catimgblock"><img src="assets/img/hotel.jpg"></div>
                  <p>Restaurant </p>
               </a>
            </div>
         </div>
         <div class="col">
            <div class="cat">
               <a href="#">

                  <div class="catimgblock"><img src="assets/img/hotel.jpg"></div>
                  <p>Restaurant </p>
               </a>
            </div>
         </div>
         <div class="col">
            <div class="cat">
               <a href="#">

                  <div class="catimgblock"><img src="assets/img/hotel.jpg"></div>
                  <p>Restaurant </p>
               </a>
            </div>
         </div>
         <div class="col">
            <div class="cat">
               <a href="#">

                  <div class="catimgblock"><img src="assets/img/hotel.jpg"></div>
                  <p>Restaurant </p>
               </a>
            </div>
         </div>
         <div class="col">
            <div class="cat">
               <a href="#">

                  <div class="catimgblock"><img src="assets/img/hotel.jpg"></div>
                  <p>Restaurant </p>
               </a>
            </div>
         </div>
         <div class="col">
            <div class="cat">
               <a href="#">

                  <div class="catimgblock"><img src="assets/img/hotel.jpg"></div>
                  <p>Restaurant </p>
               </a>
            </div>
         </div>
         <div class="col">
            <div class="cat">
               <a href="#">

                  <div class="catimgblock"><img src="assets/img/hotel.jpg"></div>
                  <p>Restaurant </p>
               </a>
            </div>
         </div>


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


         @foreach($services as $service)
            <div class="profile-item">
               <img src="{{ asset('uploads/services/icons/' . $service->icon) }}" alt="Icon">
               <div class="profile-inner">
                  <h3>{{$service->name}}</h3>
                  <!-- <span>299 INR</span> -->
                  <div class="profile-heart">
                     <!-- <a href="#"><i class="icofont-star"></i> 4.89 (498K)</a> -->
                  </div>
               </div>
            </div>
         @endforeach

         <!-- <div class="profile-item">
            <img src="{{ asset('frontend/assets/img/home-1/salone.jpg') }}" alt="Profile">
            <div class="profile-inner">
               <h3>Haircut for men</h3>
               <span>299 INR</span>
               <div class="profile-heart">
                  <a href="#">
                     <i class="icofont-star"></i> 4.89 (498K)</a>
               </div>
            </div>
         </div> -->
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
               <a class="sc" href="company-details.html">3.9 <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></a>
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
               <a class="sc" href="company-details.html">3.9 <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></a>
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





<!-- End App -->

<!-- Profile -->

<section class="profile-area ptb-100 blogbg">

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
                  <span>21 May, 2024</span>
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

<section class="client pt-3 pb-5">
   <div class="container">
      <div class="row text-center">
         <div class="col-12">
            <h2 class="p-text text-white h43">What our clients are saying</h2>
         </div>
      </div>
      <div class="row align-items-md-center text-white">
         <div class="col-lg-12 col-md-12 col-sm-12">
            <div id="carouselExampleCaptions" class="carousel slide " data-bs-ride="carousel">
               <!-- Wrapper for slides -->
               <div class="carousel-inner">

                  <div class="carousel-item active">
                     <div class="row p-4">
                        <div class="col-sm-12 pt-4 align-items-center">
                           <img src="{{ asset('frontend/assets/img/home-1/user.png') }}" class="rounded-circle img-responsive img-fluid">
                        </div>
                        <div class="t-card">

                           <p class="lh-lg"> <i class="fa fa-quote-left" aria-hidden="true"></i>Lorem Ipsum ist ein einfacher Demo-Text für die Print- und Schriftindustrie. Lorem Ipsum ist in der Industrie bereits der Standard Demo-Text "Sed ut . Lorem Ipsum ist
                              ein einfacher Demo-Text für die Print- und Schriftindustrie. Lorem Ipsum ist in der Industrie bereits der Standard Demo-Text "Sed ut . <i class="fa fa-quote-right" aria-hidden="true"></i></p>
                           <br>
                        </div>
                        <div class="row text-lg-start">

                           <div class="col-sm-12">
                              <h4><strong>Patrick muriungi</strong></h4>

                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="row p-4">
                        <div class="col-sm-12 pt-4 align-items-center">
                           <img src="https://backupp.com/backupp/public/frontend/assets/img/home-1/user.png" class="rounded-circle img-responsive img-fluid">
                        </div>
                        <div class="t-card">

                           <p class="lh-lg"> <i class="fa fa-quote-left" aria-hidden="true"></i>Lorem Ipsum ist ein einfacher Demo-Text für die Print- und Schriftindustrie. Lorem Ipsum ist in der Industrie bereits der Standard Demo-Text "Sed ut . Lorem Ipsum ist
                              ein einfacher Demo-Text für die Print- und Schriftindustrie. Lorem Ipsum ist in der Industrie bereits der Standard Demo-Text "Sed ut . <i class="fa fa-quote-right" aria-hidden="true"></i></p>
                           <br>
                        </div>
                        <div class="row text-lg-start">

                           <div class="col-sm-12">
                              <h4><strong>Patrick muriungi</strong></h4>

                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

         </div>
      </div>
   </div>
</section>

<!-- End Profile -->

@endsection

@section('styleSheets')


@endsection

@section('script')

<style>
   const testimonials=[ {

      quote:

         "I was impressed by the food — every dish is bursting with flavor! And I could really tell that they use high-quality ingredients. The staff was friendly and attentive, going the extra mile. I'll definitely be back for more!",

         name: "Tamar Mendelson",

         designation: "Restaurant Critic",

         src: "https://images.unsplash.com/photo-1512316609839-ce289d3eba0a?q=80&w=1368&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"

   }

   ,

   {

   quote:

      "This place exceeded all expectations! The atmosphere is inviting, and the staff truly goes above and beyond to ensure a fantastic visit. I'll definitely keep returning for more exceptional dining experience.",

      name: "Joe Charlescraft",

      designation: "Frequent Visitor",

      src: "https://images.unsplash.com/photo-1628749528992-f5702133b686?q=80&w=1368&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fA%3D%3D"

   }

   ,

   {

   quote:

      "Shining Yam is a hidden gem! From the moment I walked in, I knew I was in for a treat. The impeccable service and overall attention to detail created a memorable experience. I highly recommend it!",

      name: "Martina Edelweist",

      designation: "Satisfied Customer",

      src: "https://images.unsplash.com/photo-1524267213992-b76e8577d046?q=80&w=1368&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fA%3D%3D"

   }

   ];

   let activeIndex=0;

   const imageContainer=document.getElementById("image-container");

   const nameElement=document.getElementById("name");

   const designationElement=document.getElementById("designation");

   const quoteElement=document.getElementById("quote");

   const prevButton=document.getElementById("prev-button");

   const nextButton=document.getElementById("next-button");

   function calculateGap(width) {

      const minWidth=1024;

      const maxWidth=1456;

      const minGap=60;

      const maxGap=86;

      if (width <=minWidth) return minGap;

      if (width >=maxWidth) return Math.max(minGap, maxGap + 0.06018 * (width - maxWidth));

      return (minGap + (maxGap - minGap) * ((width - minWidth) / (maxWidth - minWidth)));

   }

   function updateTestimonial(direction) {

      const oldIndex=activeIndex;

      activeIndex=(activeIndex + direction + testimonials.length) % testimonials.length;

      const containerWidth=imageContainer.offsetWidth;

      const gap=calculateGap(containerWidth);

      const maxStickUp=gap * 0.8; // 80% of the calculated gap

      testimonials.forEach((testimonial, index)=> {

            let img=imageContainer.querySelector(`[data-index="${index}"]`);

            if ( !img) {

               img=document.createElement("img");

               img.src=testimonial.src;

               img.alt=testimonial.name;

               img.classList.add("testimonial-image");

               img.dataset.index=index;

               imageContainer.appendChild(img);

            }

            const offset=(index - activeIndex + testimonials.length) % testimonials.length;

            const zIndex=testimonials.length - Math.abs(offset);

            const opacity=index===activeIndex ? 1 : 1;

            const scale=index===activeIndex ? 1 : 0.85;

            let translateX, translateY, rotateY;

            if (offset===0) {

               translateX="0%";

               translateY="0%";

               rotateY="0deg";

            }

            else if (offset===1 || offset===-2) {

               translateX="20%";

               translateY=`-$ {
                  (maxStickUp / img.offsetHeight) * 100
               }

               %`;

               rotateY="-15deg";

            }

            else {

               translateX="-20%";

               translateY=`-$ {
                  (maxStickUp / img.offsetHeight) * 100
               }

               %`;

               rotateY="15deg";

            }

            img.style.zIndex=zIndex;

            img.style.opacity=opacity;

            img.style.transform=`translate($ {
                  translateX
               }

               , $ {
                  translateY

               }) scale($ {
                  scale

               }) rotateY($ {
                  rotateY
               })`;

         });

      nameElement.textContent=testimonials[activeIndex].name;

      designationElement.textContent=testimonials[activeIndex].designation;

      quoteElement.innerHTML=testimonials[activeIndex].quote .split(" ") .map((word)=> `<span class="word" >$ {
            word
         }

         </span>`) .join(" ");

      animateWords();

   }

   function animateWords() {

      const words=quoteElement.querySelectorAll(".word");

      words.forEach((word, index)=> {

            word.style.opacity="0";

            word.style.transform="translateY(10px)";

            word.style.filter="blur(10px)";

            setTimeout(()=> {

                  word.style.transition="opacity 0.2s ease-in-out, transform 0.2s ease-in-out, filter 0.2s ease-in-out";

                  word.style.opacity="1";

                  word.style.transform="translateY(0)";

                  word.style.filter="blur(0)";

               }

               , index * 20);

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

   const autoplayInterval=setInterval(handleNext, 5000);

   // Stop autoplay on user interaction

   [prevButton,
   nextButton].forEach((button)=> {

         button.addEventListener("click", ()=> {

               clearInterval(autoplayInterval);

            });

      });

   // Handle window resize

   window.addEventListener("resize", ()=> updateTestimonial(0));
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



      $(".carousel-control-next").on("click", function() {
         if (scrollPosition < carouselWidth - cardWidth * 3) {
            console.log("next");
            scrollPosition = scrollPosition + cardWidth;
            $(".carousel-inner").animate({
               scrollLeft: scrollPosition
            }, 800);
         }
      });

      $(".carousel-control-prev").on("click", function() {

         if (scrollPosition > 0) {

            scrollPosition = scrollPosition - cardWidth;

            $(".carousel-inner").animate({
               scrollLeft: scrollPosition
            }, 800);

         }
      });

   } else {
      $(multipleItemCarousel).addClass("slide");
   }
</script>
@endsection