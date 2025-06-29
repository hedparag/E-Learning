<!doctype html>
<html lang="en">
<head>
   
    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!--====== Title ======-->
    <title>E-Learning</title>
    

    <link rel="shortcut icon" href="{{ asset('frontend/assets/images/favicon.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('fronend/assets/css/jquery.nice-number.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">
  
</head>

<body>
   
    <!--====== HEADER PART START ======-->

    @include('Frontend.layouts.header')

     <!--====== HEADER PART END ======-->
   

    @yield('content')


    <!--====== FOOTER PART START ======-->

    @include('Frontend.layouts.footer')

   <!--====== FOOTER PART END ======-->
    
    
    
    
    
    
    
    <!--====== jquery js ======-->
    @vite('resources/js/app.js')
    <script src="{{ asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/jquery-1.12.4.min.js') }}"></script>

    <!--====== Bootstrap js ======-->
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    
    <!--====== Slick js ======-->
    <script src="{{ asset('frontend/assets/js/slick.min.js') }}"></script>
    
    <!--====== Magnific Popup js ======-->
    <script src="{{ asset('frontend/assets/js/jquery.magnific-popup.min.js') }}"></script>
    
    <!--====== Counter Up js ======-->
    <script src="{{ asset('frontend/assets/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.counterup.min.js') }}"></script>
    
    <!--====== Nice Select js ======-->
    <script src="{{ asset('frontend/assets/js/jquery.nice-select.min.js') }}"></script>
    
    <!--====== Nice Number js ======-->
    <script src="{{ asset('frontend/assets/js/jquery.nice-number.min.js') }}"></script>
    
    <!--====== Count Down js ======-->
    <script src="{{ asset('frontend/assets/js/jquery.countdown.min.js') }}"></script>
    
    <!--====== Validator js ======-->
    <script src="{{ asset('frontend/assets/js/validator.min.js') }}"></script>
    
    <!--====== Ajax Contact js ======-->
    <script src="{{ asset('frontend/assets/js/ajax-contact.js') }}"></script>
    
    <!--====== Main js ======-->
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
    
    <!--====== Map js ======-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDC3Ip9iVC0nIxC6V14CKLQ1HZNF_65qEQ"></script>
    <script src="{{ asset('frontend/assets/js/map-script.js') }}"></script>


    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>
