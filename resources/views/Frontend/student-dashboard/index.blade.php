@extends('Frontend.layouts.master')

@section('content')
    <!--====== PAGE BANNER PART START ======-->
    @include('Frontend.student-dashboard.breadcrumb')
    <!--====== PAGE BANNER PART ENDS ======-->

    <!--====== DASHBOARD CONTENT START ======-->
    <section id="teachers-singel" class="pt-70 pb-120 gray-bg">
        <div class="container">
            <div class="row justify-content-center">
                @include('frontend.student-dashboard.sidebar')

                <div class="col-lg-8">
                    <div class="teachers-right mt-50">

                        <div class="col-lg-8">
                            @include('frontend.student-dashboard.navbar')

                            <div class="ajax-area">
                                @include('frontend.student-dashboard.profile.index')
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection




                            {{-- <ul class="list-group mt-4">
                                <li class="list-group-item">
                                    <a href="{{ route('student.profile.index') }}">Profile</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('student.enrolled-courses.index') }}">Courses</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('student.remarks.index') }}">Remarks</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('student.announcements') }}">Announcements</a>
                                </li>
                            </ul>

                            <div id="dashboard-tab-content" class="tab-content mt-4">
                                @include('frontend.student-dashboard.profile.index')
                            </div> --}}