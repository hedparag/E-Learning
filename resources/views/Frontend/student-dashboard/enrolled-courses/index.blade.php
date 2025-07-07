@extends('Frontend.layouts.master')

@section('content')
    <!--====== PAGE BANNER PART START ======-->

    @include('Frontend.student-dashboard.breadcrumb')

    <!--====== PAGE BANNER PART ENDS ======-->



    <!--====== TEACHER PART START ======-->

    <section class="pt-90 pb-90">
        <div class="container">
            <div class="row">
                @include('frontend.student-dashboard.sidebar')

                <div class="col-lg-8">
                    @include('frontend.student-dashboard.navbar')
                    <div class="dashboard-content">

                        <div class="container  ajax-area">
                            <h4 class="mb-4">Class {{ auth()->user()->student_classes_id ?? '' }}</h4>
                            <section class="pt-20 pb-20 gray-bg">
                                <div class="container">
                                    <div class="row">
                                        @foreach ($courses as $course)
                                            <div class="col-lg-12">
                                                <div class="singel-event-list mt-10">

                                                    <div class="event-thum">
                                                        <img src="{{ asset('frontend/assets/images/event/e-1.jpg') }}"
                                                            alt="Subject Thumbnail">
                                                    </div>
                                                    <div class="event-cont">
                                                        <span><i class="fa fa-book"></i> Subject</span>
                                                        <a
                                                            href="{{ route('student.enrolled-courses.chapters', $course->id) }}">
                                                            <h4>{{ $course->title }}</h4>
                                                        </a>
                                                        <p>{{ $course->desc ?? 'No description available.' }}</p>
                                                        {{-- <a href="{{ route('student.exam', ['course_id' => $course->id]) }}"
                                                            class="main-btn mcq-quiz-btn mt-2">
                                                            Take Quiz
                                                        </a> --}}
                                                        <a href="{{ route('student.exam', ['course_id' => $course->id]) }}"
                                                            style="display: inline-block; padding: 6px 16px; background-color: #8b5cf6; color: white; border-radius: 5px;">
                                                            Take Quiz
                                                        </a>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </section>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== TEACHER PART END ======-->
@endsection
