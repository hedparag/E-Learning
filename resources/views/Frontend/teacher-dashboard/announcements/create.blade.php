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
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
                        <h4 class="mb-4">Create New Announcement</h4>

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
                            <button type="submit" class="main-btn">Create Announcement</button>

                            <a href="{{ route('teacher.announcements.index') }}" class="btn btn-outline-secondary">
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
