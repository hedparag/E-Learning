@extends('Frontend.layouts.master')

@section('content')
    <!--====== PAGE BANNER PART START ======-->

    <section id="page-banner" class="pt-105 pb-130 bg_cover" data-overlay="8"
        style="background-image: url(images/page-banner-3.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>Teacher Dashboard</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Teacher</li>
                            </ol>
                        </nav>
                    </div> <!-- page banner cont -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== PAGE BANNER PART ENDS ======-->



    <!--====== TEACHER PART START ======-->

    <section class="pt-90 pb-90">
        <div class="container">
            <div class="row">
                @include('frontend.teacher-dashboard.sidebar')

                <div class="col-lg-8">
                    @include('frontend.teacher-dashboard.navbar')
                    <div class="dashboard-content">
                        <h4 class="mb-4">Courses</h4>

                        <div class="col-lg-12 mt-5">
                            <a href="{{ route('teacher.courses.create') }}" class="main-btn">+ Create New Course</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== TEACHER PART END ======-->
@endsection
