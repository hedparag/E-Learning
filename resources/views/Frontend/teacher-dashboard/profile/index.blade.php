@extends('Frontend.layouts.master')

@section('content')
    <!--====== PAGE BANNER PART START ======-->

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
