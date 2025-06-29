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
                        <div class="mb-5">
                            <h4 class="mb-2">Welcome Back, {{ auth()->user()->name }} </h3>
                                <p>Let's Teach!</p>
                        </div>

                        <div class="mb-4">
                            <h6>Email</h6>
                            <p>{{ auth()->user()->email }}</p>
                        </div>

                        <div class="mb-4">
                            <h6>Phone</h6>
                            <p>{{ auth()->user()->phone ?? 'Not added' }}</p>
                        </div>

                        <div class="mb-4">
                            <h6>Gender</h6>
                            <p>{{ ucfirst(auth()->user()->gender ?? 'Not set') }}</p>

                        </div>

                        <div class="mb-4">
                            <h6>Headline</h6>
                            <p>{{ auth()->user()->headline ?? 'No headline' }}</p>

                        </div>

                        <div class="mb-4">
                            <h6>Bio</h6>
                            <p>{{ auth()->user()->bio ?? 'No bio' }}</p>

                        </div>

                        <a href="{{ route('teacher.profile.edit') }}" class="main-btn mt-4">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== TEACHER PART START ======-->
@endsection
