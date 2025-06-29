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
