<!DOCTYPE html>
<html lang="en">
   <head>
    @include('frontend.layouts.head')
    @yield('styleSheets')
   </head>
   <body>
      <!-- Preloader -->
      <div class="loader">
         <div class="d-table">
            <div class="d-table-cell">
               <div class="spinner">
                  <div class="rect1"></div>
                  <div class="rect2"></div>
                  <div class="rect3"></div>
                  <div class="rect4"></div>
                  <div class="rect5"></div>
               </div>
            </div>
         </div>
      </div>
      <!-- End Preloader -->
      <!-- Start Navbar Area -->
      @include('frontend.layouts.header')
      <!-- End Navbar Area -->
    <!-- Body section Area -->
      @yield('content')
      <!-- End Body section Area -->
      <!-- Footer -->
      @include('frontend.layouts.footer')
      <!-- End Footer -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
      <!-- Essential JS -->
      <script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
      <!-- Meanmenu JS -->
      <script src="{{ asset('frontend/assets/js/jquery.meanmenu.js') }}"></script>
      <!-- Mixitup JS -->
      <script src="{{ asset('frontend/assets/js/jquery.mixitup.min.js') }}"></script>
      <!-- Owl Carousel JS -->
      <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
      <!-- Form Ajaxchimp JS -->
      <script src="{{ asset('frontend/assets/js/jquery.ajaxchimp.min.js') }}"></script>
      <!-- Form Validator JS -->
      <script src="{{ asset('frontend/assets/js/form-validator.min.js') }}"></script>
      <!-- Contact JS -->
      <script src="{{ asset('frontend/assets/js/contact-form-script.js') }}"></script>
      <!-- Wow JS -->
      <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
      <!-- Odometer JS -->
      <script src="{{ asset('frontend/assets/js/odometer.min.js') }}"></script>
      <script src="{{ asset('frontend/assets/js/jquery.appear.min.js') }}"></script>
      <!-- Custom JS -->
      <script src="{{ asset('frontend/assets/js/custom.js') }}"></script>
      <script src="{{ asset('js/toaster.js') }}"></script>
      @yield('script')
 <!-- Select2 -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
 <script>
   $(document).ready(()=>{
      $('#company_industry').select2({
          placeholder: "Select company industry",
          allowClear: false
      });
   });
   
 </script>
   </body>
</html>