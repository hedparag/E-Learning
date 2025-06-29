@extends('Frontend.layouts.master')

@section('content')
    <!--====== PAGE BANNER PART START ======-->

    <section id="page-banner" class="pt-105 pb-130 bg_cover" data-overlay="8"
        style="background-image: url(images/page-banner-3.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>Student Dashboard</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Teachers</li>
                            </ol>
                        </nav>
                    </div> <!-- page banner cont -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== PAGE BANNER PART ENDS ======-->

    <!--====== STUDENT PART START ======-->

    <section id="teachers-singel" class="pt-70 pb-120 gray-bg">
    <div class="container">
        <div class="row justify-content-center">
            @include('frontend.student-dashboard.sidebar')

            <div class="col-lg-8">
                <div class="teachers-right mt-50">
                    <ul class="nav nav-justified" id="dashboard-tabs">
                        <li class="nav-item">
                            {{-- <a href="{{ route('student.profile.index') }}" class="nav-link active" data-tab="profile">Profile</a> --}}
                        </li>
                        <li class="nav-item">
{{--                             <a href="{{ route('student.enrolled-courses.index') }}" class="nav-link" data-tab="courses">Courses</a> --}}
                        </li>
                        <li class="nav-item">
                            {{-- <a href="{{ route('student.announcements.index') }}" class="nav-link" data-tab="announcements">Announcements</a> --}}
                        </li>
                    </ul>

                    <div id="dashboard-tab-content" class="tab-content mt-4">
                        @include('frontend.student-dashboard.profile.index') {{-- Default tab --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
