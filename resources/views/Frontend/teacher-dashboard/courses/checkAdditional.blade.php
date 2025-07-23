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
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/assets/css/vendors.css') }}" />
    <!-- app style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/assets/css/style.css') }}" />
    <!--External-->






    @vite(['resources/js/frontend.js'])
</head>

<body>

    <!--====== HEADER PART START ======-->

    @include('Frontend.layouts.header')

    <!--====== HEADER PART END ======-->


    @include('Frontend.teacher-dashboard.breadcrumb')

    <!--====== PAGE BANNER PART ENDS ======-->

    <!--====== TEACHER PART START ======-->

    <section class="pt-90 pb-90">
        <div class="container">
            <div class="row">
                @include('frontend.teacher-dashboard.sidebar')

                <div class="col-lg-8">
                    @include('frontend.teacher-dashboard.navbar')
                    <div class="dashboard-content">
                        <h4 class="mb-4">Create New Course</h4>

                        <div class="col-xxl-6">
                            <div class="card card-statistics">
                                <div class="card-header">
                                    <div class="card-heading">
                                        <h4 class="card-title">Course Create</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="tab tab-vertical">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link {{ request('step') == 1 ? 'active show' : '' }} courseTab"
                                                    id="home-09-tab" data-toggle="tab" href="#home-09" role="tab"
                                                    aria-controls="home-09" aria-selected="true" data-step="1">Basic
                                                    Information</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link {{ request('step') == 2 ? 'active show' : '' }} courseTab"
                                                    id="profile-09-tab" data-toggle="tab" href="#profile-09"
                                                    role="tab" aria-controls="profile-09" aria-selected="false"
                                                    data-step="2">Additional Settings</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link {{ request('step') == 3 ? 'active' : '' }} courseTab"
                                                    id="portfolio-09-tab" data-toggle="tab" href="#portfolio-09"
                                                    role="tab" aria-controls="portfolio-09" aria-selected="false"
                                                    data-step="3">Curriculum</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link {{ request('step') == 4 ? 'active' : '' }} courseTab"
                                                    id="contact-09-tab" data-toggle="tab" href="#contact-09"
                                                    role="tab" aria-controls="contact-09" aria-selected="false"
                                                    data-step="4">Finish</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link {{ request('step') == 5 ? 'active' : '' }} courseTab"
                                                    id="contact-09-tab" data-toggle="tab" href="#mock-09" role="tab"
                                                    aria-controls="mock-09" aria-selected="false" data-step="5">Mock
                                                    Test</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade active show" id="profile-09" role="tabpanel"
                                                aria-labelledby="profile-09-tab">
                                                <form method="POST" class="course-update course-form"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="course_id" value="">
                                                    <input type="hidden" name="editMode" value="">
                                                    <input type="hidden" name="current_step" value="2">
                                                    <input type="hidden" name="next_step" value="3">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <label for="inputAddress2">Demo Video Source</label>
                                                            <select id="inputState" class="form-control storage"
                                                                name="source">
                                                                <option selected>Select Source</option>
                                                                <option value="upload">
                                                                    Upload</option>
                                                                <option value="youtube">
                                                                    Youtube</option>
                                                                <option value="vimeo">
                                                                    Vimeo</option>
                                                                <option value="external_link">External Link</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-xl-6">
                    <div class="add_course_basic_info_imput upload_source">
                        <label for="#">Path</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                              <a id="lfm-x" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                <i class="fa fa-picture-o"></i> Choose
                              </a>
                            </span>
                            <input id="thumbnail" class="form-control source" type="text" name="file">
                          </div>

                    </div>
                    <div class="add_course_basic_info_imput external_source d-none">
                        <label for="#">Path</label>
                        <input type="text"name="url" class="source">
                    </div>
                </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="inputAddress">Capacity</label>
                                                            <input type="text" class="form-control"
                                                                id="inputAddress" name="capacity" value="">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="inputAddress">Duration</label>
                                                            <input type="text" class="form-control"
                                                                id="inputAddress" name="duration" value="">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="gridCheck" name="qna" value="1">
                                                                <label class="form-check-label" for="gridCheck">
                                                                    QNA
                                                                </label>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Save</button>





                                                </form>
                                            </div>


                                            <!--====== FOOTER PART START ======-->

                                            @include('Frontend.layouts.footer')

                                            <!--====== FOOTER PART END ======-->


                                            <!--Modal-->
                                            <div class="modal fade" id="dynamic-modal" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true"
                                                data-backdrop="static">
                                                <div class="modal-dialog modal-dialog-centered modal-lg"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Modal title
                                                            </h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body dynamic-modal-content">
                                                            <!-- Content will be injected here -->
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



 <!--====== jquery js ======-->


   <script src="{{ asset('frontend/assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="vendor/laravel-filemanager/js/stand-alone-button.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <!--====== Bootstrap js ======-->






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




    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
 {{--   <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script> --}}


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- plugins -->
 <script>
          jQuery(function() {
              jQuery('#lfm-x').filemanager('file', {prefix: laravel-filemanager});
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
