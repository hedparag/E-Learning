<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
    <title>EduCore - Online Courses & Education HTML Template</title>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animated_barfiller.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/venobox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/scroll_button.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/pointer.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/jquery.calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/range_slider.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/startRating.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/video_player.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/jquery.simple-bar-graph.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/sticky_menu.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.css') }}">

    <link rel=" stylesheet" href="{{ asset('frontend/assets/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/notyf@3.10.0/notyf.min.css" rel="stylesheet">
@vite(['resources/js/frontend.js'])
</head>

<body class="home_3">


    <!--============ PRELOADER START ===========-->
    <div id="preloader">
        <div class="preloader_icon">
            <img src="images/preloader.png" alt="Preloader" class="img-fluid">
        </div>
    </div>
    <!--============ PRELOADER START ===========-->


    <!--===========================
        HEADER START
    ============================-->
    @include('Frontend.layouts.header')
    <!--===========================
        HEADER END
    ============================-->


    <!--===========================
        MAIN MENU 3 START
    ============================-->
    @include('Frontend.layouts.mainMenu')
    <div class="wsus__menu_3_search_area">
        <form action="#">
            <input type="text" placeholder="Search School, Online.....">
            <button class="common_btn" type="submit">Search</button>
            <span class="close_search"><i class="far fa-times"></i></span>
        </form>
    </div>
    <!--===========================
        MAIN MENU 3 END
    ============================-->


    <!--============================
        STICKY MENU START
    ==============================-->
    @include('Frontend.layouts.sticky')
    <!--============================
        STICKY MENU END
    ==============================-->


    <!--===========================
        BREADCRUMB START
    ============================-->
    @include('Frontend.layouts.breadcrumb')
    <!--===========================
        BREADCRUMB END
    ============================-->


    <!--===========================
        DASHBOARD STUDENT START
    ============================-->
    <section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                @include('Frontend.layouts.studentSidebar')
                <div class="col-xl-9 col-md-8 wow fadeInRight">
                    <div class="wsus__dashboard_contant">
                        <div class="wsus__dashboard_contant_top">
                            <div class="wsus__dashboard_heading">
                                <h5>Students</h5>
                                <p>Manage your courses and its update like live, draft and insight.</p>
                            </div>
                        </div>

                        @if (Auth::guard('web')->user()->approved_status == 'pending')
                            <div class="alert alert-warning" role="alert">
                                you will receive an email when your request will be approved.
                            </div>
                        @elseif(Auth::guard('web')->user()->approved_status == 'approved')
                            <form action="{{ route('student.become-instructor', auth::guard('web')->user()->id) }}"
                                method="GET">
                                <div class="text-end">
                                    <button class="common_btn becomeInstructor btn-lg">Become Instructor</button>
                                </div>
                            </form>
                        @endif
                        <div class="wsus__dash_student_table">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th class="name">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="inlineCheckbox1" value="option1">
                                                            <label class="form-check-label"
                                                                for="inlineCheckbox1">STUDENT NAME</label>
                                                        </div>
                                                    </th>
                                                    <th class="date">
                                                        ENROLLED
                                                    </th>
                                                    <th class="progres">
                                                        PROGRESS
                                                    </th>
                                                    <th class="location">
                                                        LOCATIONS
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td class="name">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="inlineCheckbox11" value="option1">
                                                        </div>
                                                        <div class="img">
                                                            <img src="images/dash_student_1.png" alt="student"
                                                                class="img-fluid w-100">
                                                        </div>
                                                        <a href="#">Hanson Deck</a>
                                                    </td>
                                                    <td class="date">
                                                        <p>12-03-24 </p>
                                                    </td>
                                                    <td class="progres">
                                                        <p>20%</p>
                                                    </td>
                                                    <td class="location">
                                                        <p>United State</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="name">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="inlineCheckbox12" value="option1">
                                                        </div>
                                                        <div class="img">
                                                            <img src="images/dash_student_2.png" alt="student"
                                                                class="img-fluid w-100">
                                                        </div>
                                                        <a href="#">Jake Weary</a>
                                                    </td>
                                                    <td class="date">
                                                        <p>06-07-24 </p>
                                                    </td>
                                                    <td class="progres">
                                                        <p>50%</p>
                                                    </td>
                                                    <td class="location">
                                                        <p>Davos, Switzerland</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="name">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="inlineCheckbox2" value="option1">
                                                        </div>
                                                        <div class="img">
                                                            <img src="images/dash_student_3.png" alt="student"
                                                                class="img-fluid w-100">
                                                        </div>
                                                        <a href="#">Elon Gated</a>
                                                    </td>
                                                    <td class="date">
                                                        <p>18-04-24 </p>
                                                    </td>
                                                    <td class="progres">
                                                        <p>80%</p>
                                                    </td>
                                                    <td class="location">
                                                        <p>Rjukan, Norway</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="name">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="inlineCheckbox3" value="option1">
                                                        </div>
                                                        <div class="img">
                                                            <img src="images/dash_student_4.png" alt="student"
                                                                class="img-fluid w-100">
                                                        </div>
                                                        <a href="#">Barry Tone</a>
                                                    </td>
                                                    <td class="date">
                                                        <p>23-05-24 </p>
                                                    </td>
                                                    <td class="progres">
                                                        <p>20%</p>
                                                    </td>
                                                    <td class="location">
                                                        <p>Bynesveien 98A</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="name">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="inlineCheckbox4" value="option1">
                                                        </div>
                                                        <div class="img">
                                                            <img src="images/dash_student_5.png" alt="student"
                                                                class="img-fluid w-100">
                                                        </div>
                                                        <a href="#">Gunther Beard</a>
                                                    </td>
                                                    <td class="date">
                                                        <p>16-08-24 </p>
                                                    </td>
                                                    <td class="progres">
                                                        <p>40%</p>
                                                    </td>
                                                    <td class="location">
                                                        <p>Banff, Canada</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="name">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="inlineCheckbox5" value="option1">
                                                        </div>
                                                        <div class="img">
                                                            <img src="images/dash_student_6.png" alt="student"
                                                                class="img-fluid w-100">
                                                        </div>
                                                        <a href="#">Albert Ross</a>
                                                    </td>
                                                    <td class="date">
                                                        <p>09-04-24 </p>
                                                    </td>
                                                    <td class="progres">
                                                        <p>30%</p>
                                                    </td>
                                                    <td class="location">
                                                        <p>Chamonix, France</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="name">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="inlineCheckbox6" value="option1">
                                                        </div>
                                                        <div class="img">
                                                            <img src="images/dash_student_7.png" alt="student"
                                                                class="img-fluid w-100">
                                                        </div>
                                                        <a href="#">Doug Lyphek</a>
                                                    </td>
                                                    <td class="date">
                                                        <p>14-09-24 </p>
                                                    </td>
                                                    <td class="progres">
                                                        <p>90%</p>
                                                    </td>
                                                    <td class="location">
                                                        <p>Festplassen, Bergen</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="name">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="inlineCheckbox7" value="option1">
                                                        </div>
                                                        <div class="img">
                                                            <img src="images/dash_student_8.png" alt="student"
                                                                class="img-fluid w-100">
                                                        </div>
                                                        <a href="#">Bodrum Salvador</a>
                                                    </td>
                                                    <td class="date">
                                                        <p>31-12-24 </p>
                                                    </td>
                                                    <td class="progres">
                                                        <p>70%</p>
                                                    </td>
                                                    <td class="location">
                                                        <p>Banff, Canada</p>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
        DASHBOARD STUDENT END
    ============================-->



    <!--===========================
        FOOTER 3 START
    ============================-->
    @include('Frontend.layouts.footer')
    <!--===========================
        FOOTER 3 END
    ============================-->


    <!--================================
        SCROLL BUTTON START
    =================================-->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!--================================
        SCROLL BUTTON END
    =================================-->


    <!--jquery library js-->
    <script src="{{ asset('frontend/assets/js/jquery-3.7.1.min.js') }}"></script>
    <!--bootstrap js-->
    <script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--font-awesome js-->
    <script src="{{ asset('frontend/assets/js/Font-Awesome.js') }}"></script>
    <!--marquee js-->
    <script src="{{ asset('frontend/assets/js/jquery.marquee.min.js') }}"></script>
    <!--slick js-->
    <script src="{{ asset('frontend/assets/js/slick.min.js') }}"></script>
    <!--countup js-->
    <script src="{{ asset('frontend/assets/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.countup.min.js') }}"></script>
    <!--venobox js-->
    <script src="{{ asset('frontend/assets/js/venobox.min.js') }}"></script>
    <!--nice-select js-->
    <script src="{{ asset('frontend/assets/js/jquery.nice-select.min.js') }}"></script>
    <!--Scroll Button js-->
    <script src="{{ asset('frontend/assets/js/scroll_button.js') }}"></script>
    <!--pointer js-->
    <script src="{{ asset('frontend/assets/js/pointer.js') }}"></script>
    <!--range slider js-->
    <script src="{{ asset('frontend/assets/js/range_slider.js') }}"></script>
    <!--barfiller js-->
    <script src="{{ asset('frontend/assets/js/animated_barfiller.js') }}"></script>
    <!--calendar js-->
    <script src="{{ asset('frontend/assets/js/jquery.calendar.js') }}"></script>
    <!--starRating js-->
    <script src="{{ asset('frontend/assets/js/starRating.js') }}"></script>
    <!--Bar Graph js-->
    <script src="{{ asset('frontend/assets/js/jquery.simple-bar-graph.min.js') }}"></script>
    <!--select2 js-->
    <script src="{{ asset('frontend/assets/js/select2.min.js') }}"></script>
    <!--Video player js-->
    <script src="{{ asset('frontend/assets/js/video_player.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/video_player_youtube.js') }}"></script>
    <!--wow js-->
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>

    <!--main/custom js-->
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3.10.0/notyf.min.js"></script>
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
