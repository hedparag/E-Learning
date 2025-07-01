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
                                                    <a class="nav-link active show" id="home-09-tab" data-toggle="tab" href="#home-09" role="tab" aria-controls="home-09" aria-selected="true">Basic Information</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="profile-09-tab" data-toggle="tab" href="#profile-09" role="tab" aria-controls="profile-09" aria-selected="false">Additional Settings</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="portfolio-09-tab" data-toggle="tab" href="#portfolio-09" role="tab" aria-controls="portfolio-09" aria-selected="false">Curriculum</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="portfolio-09-tab" data-toggle="tab" href="#mock-09" role="tab" aria-controls="portfolio-09" aria-selected="false">Mock Test</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="contact-09-tab" data-toggle="tab" href="#contact-09" role="tab" aria-controls="contact-09" aria-selected="false">Finish</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                               @yield('tab_content')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        {{-- @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('teacher.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label>Avatar</label><br>
                                <img src="{{ asset(auth()->user()->image) }}" class="mb-2" width="100"><br>
                                <input type="file" name="image">
                            </div>

                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ auth()->user()->name }}">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email"
                                    value="{{ auth()->user()->email }}">
                            </div>

                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone"
                                    value="{{ auth()->user()->phone }}">
                            </div>

                            <div class="form-group">
                                <label>Gender</label>
                                <select name="gender" class="form-control">
                                    <option value="">Select</option>
                                    <option value="male" {{ auth()->user()->gender == 'male' ? 'selected' : '' }}>Male
                                    </option>
                                    <option value="female" {{ auth()->user()->gender == 'female' ? 'selected' : '' }}>Female
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Headline</label>
                                <input type="text" class="form-control" name="headline"
                                    value="{{ auth()->user()->headline }}">
                            </div>

                            <div class="form-group">
                                <label>Bio</label>
                                <textarea class="form-control" name="bio">{{ auth()->user()->bio }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Facebook</label>
                                <input type="url" class="form-control" name="facebook"
                                    value="{{ auth()->user()->facebook }}">
                            </div>

                            <div class="form-group">
                                <label>LinkedIn</label>
                                <input type="url" class="form-control" name="linkedin"
                                    value="{{ auth()->user()->linkedin }}">
                            </div>

                            <div class="form-group">
                                <label>GitHub</label>
                                <input type="url" class="form-control" name="github"
                                    value="{{ auth()->user()->github }}">
                            </div>

                            <div class="form-group">
                                <label>Website</label>
                                <input type="url" class="form-control" name="website"
                                    value="{{ auth()->user()->website }}">
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <button type="submit" class="main-btn">Create Course</button>

                                <a href="{{ route('teacher.courses.index') }}" class="btn btn-outline-secondary">
                                    ← Back
                                </a>
                            </div>

                        </form> --}}

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== TEACHER PART START ======-->
@endsection
