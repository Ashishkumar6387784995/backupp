<div class="navbar-area fixed-top">
   <div class="top">
      <p>Explore various opportunities to get the most suitable job in the perfect company culture.</p>
   </div>
   <!-- Menu For Mobile Device -->
   <div class="mobile-nav">
      <a href="{{url('/')}}" class="logo">
      <img src="{{ asset('frontend/assets/img/logo.png') }}" alt="Logo">
      </a>
   </div>
   <!-- Menu For Desktop Device -->
   <div class="main-nav">
      <div class="container">
         <nav class="navbar navbar-expand-md navbar-light">
            <a class="navbar-brand" href="{{url('/')}}">
            <img src="{{ asset('frontend/assets/img/logo.png') }}" alt="Logo">
            </a>
            <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
               <ul class="navbar-nav">
                  <li class="nav-item">
                     <a href="{{ route('home.postTask') }}" class="nav-link dropdown-toggle active">Post Task <i class="icofont-simple-down"></i></a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('home.categories') }}" class="nav-link">Categorys </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('home.jobs') }}" class="nav-link dropdown-toggle">Jobs <i class="icofont-simple-down"></i></a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('home.companies') }}" class="nav-link dropdown-toggle">Companies  <i class="icofont-simple-down"></i></a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('home.services') }}" class="nav-link dropdown-toggle">Services <i class="icofont-simple-down"></i></a>
                  </li>
               </ul>
               <div class="common-btn d-flex">
                  <div class="nav-item dropdown">
                     <a class="login-btn navBtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                       Login
                     </a>
                     <ul class="dropdown-menu">
                       <li><a class="dropdown-item" href="{{ url('company/login') }}">Company</a></li>
                       <li><a class="dropdown-item" href="{{ url('user/login') }}">Job Seeker</a></li>
                     </ul>
                   </div>
                   <div class="nav-item dropdown">
                     <a class="sign-up-btn navBtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Register
                     </a>
                     <ul class="dropdown-menu">
                       <li><a class="dropdown-item" href="{{ url('company/registration') }}">Company</a></li>
                       <li><a class="dropdown-item" href="{{ url('user/registration') }}">Job Seeker</a></li>
                     </ul>
                   </div>
                  
               </div>
            </div>
         </nav>
      </div>
   </div>
</div>
