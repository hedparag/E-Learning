<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
    <title>EduCore - Online Courses & Education HTML Template</title>
    <link rel="icon" type="image/png" href="images/favicon.png">
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
</head>
@vite(['resources/js/frontend.js'])
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


    <!--=================================
        BECOME AN INSTRUCTOR START
    =================================-->
    <section class="become_instructor_page pt_85 xs_pt_65 pb_120 xs_pb_100">
        <div class="container">
            <div class="text-end">
                <a href="{{ route('student.dashboard') }}" class="btn btn-primary">Back</a>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="become_instructor_page_text wow fadeInLeft">
                        <h3>Become An Instructor</h3>
                        <p>It is a long established fact that a reader will be distracted by the readable content of a
                            page when looking at its layout. The point of using Lorem Ipsum is that it has a
                            more-or-less normal distribution of letters, as opposed to using 'Content here, content
                            here', making it look like readable English.</p>

                        <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                            consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam
                            est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non
                            numquam eius modi tempora incidunt ut labore.</p>

                        <h3>Instructor Rules</h3>
                        <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                            consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam
                            est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non
                            numquam eius modi tempora incidunt ut labore.</p>
                        <ul>
                            <li>Basic knowledge and detailed understanding of CSS3 to create.</li>
                            <li>Details Idea about HTMLS, Creating Basic Web Pages using HTMLS</li>
                            <li>Web Page Layout Design and Slider Creation</li>
                            <li>Image Insert method af web site</li>
                            <li>Creating Styling Web Pages Using CSS3</li>
                        </ul>
                        <h3>Start With Courses</h3>
                        <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                            consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam
                            est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non
                            numquam eius modi tempora incidunt ut labore.</p>
                        <ul>
                            <li>Basic knowledge and detailed understanding of CSS3 to create.</li>
                            <li>Details Idea about HTMLS, Creating Basic Web Pages using HTMLS</li>
                            <li>Basic knowledge and detailed understanding of CSS3 to create.</li>
                            <li>Web Page Layout Design and Slider Creation</li>
                        </ul>
                        <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                            consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam
                            est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non
                            numquam eius modi tempora incidunt ut labore.</p>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="become_instructor_page_form wow fadeInRight">
                        <h2>Apply As Instructor</h2>
                        <form action="{{ route('student.become-instructor-store',$id) }}" method="POST" enctype="multipart/form-data">
                           @csrf
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="wsus__login_form_input">
                                        <label>Certificate</label>
                                        <input type="file" placeholder="Upload your qualification certificate" name="document">
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="wsus__login_form_input">
                                        <label>Payout Account</label>
                                        <select class="select_js payout" name="payout">
                                            <option value="">Select</option>
                                            <option value="paypal">Paypal</option>
                                            <option value="scipe">Scipe</option>
                                            <option value="razorpay">Razor Pay</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__login_form_input">
                                        <label>Payout Information</label>
                                        <textarea rows="5" placeholder="Payout Information" name="payout_info" class="payout_info"></textarea>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__login_form_input">
                                        <label>Bio</label>
                                        <textarea rows="3" placeholder="Bio" name="bio"></textarea>
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="wsus__login_form_input m-0">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                id="flexCheckDefault1" name="policy">
                                            <label class="form-check-label" for="flexCheckDefault1">I agree that I have
                                                read and accepted the Terms of Use and Privacy Policy.

                                            </label>
                                        </div>
                                        <button type="submit" class="common_btn">Instructor Sign Up</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=================================
        BECOME AN INSTRUCTOR END
    =================================-->


    <!--===========================
        FOOTER 3 START
    ============================-->
    <footer class="footer_3" style="background: url(images/footer_3_bg.jpg);">
        <div class="footer_3_overlay pt_120 xs_pt_100">
            <div class="wsus__footer_bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 wow fadeInUp">
                            <div class="wsus__footer_3_logo_area">
                                <a class="logo" href="index.html">
                                    <img src="images/footer_logo.png" alt="EduCore" class="img-fluid">
                                </a>
                                <p>Nunc in sollicitudin diam, ut bibendum malesuada sodales porttitor.</p>
                                <h2>Follow Us On</h2>
                                <ul class="d-flex flex-wrap">
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6 col-md-3 wow fadeInUp">
                            <div class="wsus__footer_link">
                                <h2>Courses</h2>
                                <ul>
                                    <li><a href="#">Life Coach</a></li>
                                    <li><a href="#">Business Coach</a></li>
                                    <li><a href="#">Health Coach</a></li>
                                    <li><a href="#">Development</a></li>
                                    <li><a href="#">SEO Optimize</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6 col-md-3 wow fadeInUp">
                            <div class="wsus__footer_link">
                                <h2>Programs</h2>
                                <ul>
                                    <li><a href="#">The Arts</a></li>
                                    <li><a href="#">Human Sciences</a></li>
                                    <li><a href="#">Economics</a></li>
                                    <li><a href="#">Natural Sciences</a></li>
                                    <li><a href="#">Business</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 wow fadeInUp">
                            <div class="wsus__footer_3_subscribe">
                                <h3>Subscribe Our Newsletter</h3>
                                <form action="#">
                                    <input type="text" placeholder="Enter Your Email">
                                    <button type="submit" class="common_btn">Subscribe</button>
                                </form>
                                <ul>
                                    <li>
                                        <div class="icon">
                                            <img src="images/call_icon_white.png" alt="Call" class="img-fluid">
                                        </div>
                                        <div class="text">
                                            <h4>Call us:</h4>
                                            <a href="mailto:example@gmail.com">example@gmail.com</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <img src="images/location_icon_white.png" alt="Call" class="img-fluid">
                                        </div>
                                        <div class="text">
                                            <h4>Office:</h4>
                                            <p>25-02 44th Queens, NY 3645, United States</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wsus__footer_copyright_area mt_140 xs_mt_100">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="wsus__footer_copyright_text">
                                <p>Copyright © 2024 All Rights Reserved by EduCore Education</p>
                                <ul>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Term of Service</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
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
