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
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Base URL -->
    <meta name="base-url" content="{{ url('/') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('fronend/assets/css/jquery.nice-number.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/assets/css/vendors.css') }}" />
    <!-- app style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/assets/css/style.css') }}" />
    @vite(['resources/js/frontend.js', 'resources/js/Frontend/home.js'])
    <!--External-->






    @vite(['resources/js/frontend.js'])
</head>

<body>


    <!--====== HEADER PART START ======-->

    @include('Frontend.layouts.header')

    <!--====== HEADER PART END ======-->


    @yield('content')


    <!--====== FOOTER PART START ======-->

    @include('Frontend.layouts.footer')

    <!--====== FOOTER PART END ======-->


    <!--Modal-->
    <div class="modal fade" id="dynamic-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body dynamic-modal-content">
                    <!-- Content will be injected here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>




    <!--====== jquery js ======-->

    <script src="{{ asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
   <script src="{{ asset('frontend/assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="vendor/laravel-filemanager/js/stand-alone-button.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
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

    <!--====== Ajax Teacher Modal js ======-->
    <script src="{{ asset('frontend/assets/js/ajax-teacher_modal.js') }}"></script>

    <!--====== Main js ======-->
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>

    <!--====== Map js ======-->
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDC3Ip9iVC0nIxC6V14CKLQ1HZNF_65qEQ"></script>
    <script src="{{ asset('frontend/assets/js/map-script.js') }}"></script> --}}

    <!--====== Ajax ======-->
    <script src="{{ asset('frontend/assets/js/ajax-part.js') }}"></script>

    <!--====== Sweetalert ======-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    {{--   <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- plugins -->

    <!--admin js-->
    <script src="{{ asset('admin_template/assets/js/vendors.js') }}"></script>

    <!-- custom app -->
    <script src="{{ asset('admin_template/assets/js/app.js') }}"></script>
    @stack('scripts')
    <script>
        $(function() {
            $('#lfm').filemanager('file');
        });
    </script>


    <script>
        var notyf = new Notyf({
            duration: 6000,
            dismissible: true
        });
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                notyf.error("{{ $error }}");
            @endforeach
        @endif
    </script>

</body>

</html>
