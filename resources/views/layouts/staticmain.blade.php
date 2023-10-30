<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <title>@yield('title') | Mankind Medicare</title>
   <meta name="description" content="" />
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <!-- Favicon -->
   <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
   <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
   <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
   <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
   <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
   <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
   <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
   <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
   <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
   <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
   <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
   <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
   <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
   <link rel="manifest" href="/manifest.json">
   <meta name="msapplication-TileColor" content="#ffffff">
   <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
   <meta name="theme-color" content="#ffffff">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" />

    <link rel="stylesheet" href="{{ asset('/css/static-site/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/static-site/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/static-site/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/static-site/magnific-popup.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/static-site/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/static-site/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/static-site/odometer.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/static-site/rangeSlider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/static-site/showMoreItems-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/static-site/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/static-site/meanmenu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/static-site/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/static-site/responsive.css') }}">

    @stack('styles')

    @livewireStyles
</head>
<body>

    <div class="navbar-area">
       <div class="noke-responsive-nav">
          <div class="container">
             <div class="noke-responsive-menu">
                <div class="logo">
                   <a href="/"><img src="{{ asset('images/logo-nav.png') }}" alt="logo" style="width: 200px;"></a>
                </div>
             </div>
          </div>
       </div>
       <div class="noke-nav">
          <div class="container-fluid">
             <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="/"><img src="{{ asset('images/logo-nav.png') }}" alt="logo" style="width: 200px;"></a>
                <div class="collapse navbar-collapse mean-menu">
                   <ul class="navbar-nav">
                      <li class="nav-item {{  request()->routeIs('home') ? 'active' : '' }}">
                         <a href="/" class="nav-link ">Home</a>
                      </li>
                      <li class="nav-item {{  request()->routeIs('search.doctors') ? 'active' : '' }}">
                         <a href="{{ route('search.doctors') }}" class="nav-link ">Doctor Availability Chart</a>
                      </li>
                     @guest
                     <li class="nav-item ">
                         <a href="{{route('login')}}" class="nav-link ">Login</a>
                      </li>
                     @endguest
                     @auth
                      <li class="nav-item">
                         <a href="#" class="dropdown-toggle nav-link">My Profile</a>
                         <ul class="dropdown-menu">
                            <li class="nav-item"><a href="{{route('dashboard')}}" class="nav-link">Dashboard</a></li>
                            <li class="nav-item">
                              <a href="{{route('logout')}}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form1').submit();">Logout</a>
                              <form method="POST" id="logout-form1" action="{{ route('logout') }}">
                                   @csrf
                              </form>
                           </li>
                         </ul>
                      </li>
                      @endauth
                   </ul>
                </div>
             </nav>
          </div>
       </div>
    </div>



    @yield('content')



    <footer class="footer-area bg-faf7f2">
       <div class="container">
          <div class="footer-top">
             <div class="row align-items-center justify-content-between">
                <div class="col-xl-6 col-lg-4 col-md-12">
                   <a href="/" class="logo">
                   <img src="{{asset('images/logo-nav.png')}}" alt="image" style="width:200px;">
                   </a>
                </div>
                <div class="col-xl-6 col-lg-8 col-md-12">
                   <div class="content d-flex justify-content-between align-items-center">
                      <h3>Make an appointment today</h3>
                      <a href="{{ route('booking.form') }}" class="default-btn">Book Now <i class="fas fa-chevron-right"></i></a>
                   </div>
                </div>
             </div>
          </div>
          <div class="row">
             <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                   <h3>Contact Details</h3>
                   <ul class="footer-contact">
                      <li><i class="fas fa-map-marker-alt"></i> 162 5th Ave, Mahiyanganaya Rd, Kandy</li>
                      <li><i class="far fa-envelope"></i> <a href="mailto:info@mankind.io">info@mankind.io</a></li>
                      <li><i class="fas fa-phone-volume"></i> <a href="tel:+9401123365498">(+94) 0112 336 5498</a></li>
                   </ul>
                </div>
             </div>
             <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget pl-4">
                   <h3>Useful Links</h3>
                   <ul class="info-links">
                      <li><a href="/">Home</a></li>
                      <li><a href="#about-us">About</a></li>
                   </ul>
                </div>
             </div>

          </div>
       </div>
       <div class="copyright-area">
          <div class="container">
             <p>Copyright &copy; {{ date('Y') }} Mankind Medicare</p>
          </div>
       </div>
    </footer>
    <div class="go-top"><i class="fas fa-chevron-up"></i></div>


    <!--bootstrap js-->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script> -->
    <script src="{{ asset('/js/static-site/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/static-site/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/js/static-site/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('/js/static-site/appear.min.js') }}"></script>
    <script src="{{ asset('/js/static-site/odometer.min.js') }}"></script>
    <script src="{{ asset('/js/static-site/parallax.min.js') }}"></script>
    <script src="{{ asset('/js/static-site/smooth-scroll.js') }}"></script>
    <script src="{{ asset('/js/static-site/rangeSlider.min.js') }}"></script>
    <script src="{{ asset('/js/static-site/showMoreItems.min.js') }}"></script>
    <script src="{{ asset('/js/static-site/mixitup.min.js') }}"></script>
    <script src="{{ asset('/js/static-site/meanmenu.min.js') }}"></script>
    <script src="{{ asset('/js/static-site/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/js/static-site/form-validator.min.js') }}"></script>
    <script src="{{ asset('/js/static-site/contact-form-script.js') }}"></script>
    <script src="{{ asset('/js/static-site/ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('/js/static-site/main.js') }}"></script>


    @stack('scripts')

    @livewireScripts

</body>


</html>
