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
                        <div class="row d-flex justify-content-between align-items-center mb-3">
                            <div class="col-md-auto">
                                <h4 class="mb-0">Courses</h4>
                            </div>
                            <div class="col-md-auto">
                                <a href="{{ route('teacher.courses.create') }}" class="main-btn">+ Create New Course</a>
                            </div>
                        </div>

                        <!--====== COURSES PART START ======-->

                        <section id="courses-part" class="pt-100 pb-100 gray-bg">
                            <div class="container">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="courses-grid" role="tabpanel"
                                            aria-labelledby="courses-grid-tab">
                                            <div class="row g-4">
                                                @foreach ($courses as $c)
                                                    <div class="col-lg-6 col-md-6 mb-4">
                                                        <div
                                                            class="course-card p-3 shadow-sm rounded bg-white h-100 d-flex flex-column justify-content-between">

                                                            <!-- Course Image -->
                                                            <div class="course-img-wrapper mb-3">
                                                                <img src="{{ asset($c->thumbnail) }}" alt="Course Thumbnail"
                                                                    class="w-100"
                                                                    style="height: 200px; object-fit: cover; border-radius: 8px;">
                                                            </div>

                                                            <!-- Course Title -->
                                                            <h5 class="fw-bold text-dark" style="min-height: 48px;">
                                                                {{ $c->title }}</h5>

                                                            <!-- Rating & Reviews -->
                                                            <div class="d-flex align-items-center mb-2">
                                                                @for ($i = 0; $i < 5; $i++)
                                                                    <i class="fa fa-star text-warning me-1"></i>
                                                                @endfor
                                                                <small class="text-muted ms-2">(20 Reviews)</small>
                                                            </div>

                                                            <!-- View & Edit Buttons -->
                                                            <div class="mb-3">
                                                                <a href="#"
                                                                    class="btn btn-sm main-btn">View</a>
                                                                <a href="{{ route('teacher.fullCourses.edit',$c->id) }}"
                                                                    class="btn btn-sm main-btn">Edit</a>
                                                            </div>

                                                            <!-- Footer -->
                                                            <div
                                                                class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="{{ asset('images/course/teacher/t-1.jpg') }}"
                                                                        class="rounded-circle me-2"
                                                                        style="width: 32px; height: 32px;" alt="Teacher">
                                                                    <small>{{ $c->teacher->name }}</small>
                                                                </div>
                                                                <div>
                                                                    <small class="me-2"><i class="fa fa-user me-1"></i>
                                                                        31</small>
                                                                    <small><i class="fa fa-heart me-1"></i> 10</small>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                @endforeach


                                            </div> <!-- row -->
                                        </div>
                                    </div>

                                    <!-- tab content -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mt-4 d-flex justify-content-center">
                                                {{ $courses->links('pagination::bootstrap-4') }}
                                            </div>
                                            <!-- courses pagination -->
                                        </div>
                                    </div> <!-- row -->
                                </div> <!-- container -->
                        </section>

                        <!--====== COURSES PART ENDS ======-->

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== TEACHER PART END ======-->
@endsection
