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
    <div class="tab-pane fade show active" id="courses-grid" role="tabpanel" aria-labelledby="courses-grid-tab">
        <div class="row g-4">
            @foreach ($courses as $c)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="course-card">
                        <div>
                            <div class="course-img-wrapper">
                                <img src="{{ asset($c->thumbnail) }}" alt="Course">
                                <div class="price-badge">Free</div>
                            </div>
                            <ul class="rating list-unstyled mb-1">
                                @for ($i = 0; $i < 5; $i++)
                                    <li class="d-inline"><i class="fa fa-star"></i></li>
                                @endfor
                            </ul>
                            <small class="text-muted d-block mb-1">(20 Reviews)</small>
                            <div class="course-title">{{ $c->title }}</div>
                        </div>
                        <div class="course-footer mt-2">
                            <div class="teacher-info d-flex align-items-center">
                                <img src="{{ asset('images/course/teacher/t-1.jpg') }}" alt="teacher">
                                <small>{{ $c->teacher->name }}</small>
                            </div>
                            <div>
                                <small class="me-2"><i class="fa fa-user"></i> 31</small>
                                <small><i class="fa fa-heart"></i> 10</small>
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
                                            <nav class="courses-pagination mt-50">
                                                <ul class="pagination justify-content-center">
                                                    <li class="page-item">
                                                        <a href="#" aria-label="Previous">
                                                            <i class="fa fa-angle-left"></i>
                                                        </a>
                                                    </li>
                                                    <li class="page-item"><a class="active" href="#">1</a></li>
                                                    <li class="page-item"><a href="#">2</a></li>
                                                    <li class="page-item"><a href="#">3</a></li>
                                                    <li class="page-item">
                                                        <a href="#" aria-label="Next">
                                                            <i class="fa fa-angle-right"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </nav> <!-- courses pagination -->
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
