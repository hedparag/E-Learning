@extends('Frontend.layouts.master')

@section('content')

    <!--====== PAGE BANNER PART START ======-->
    @include('Frontend.teacher-dashboard.breadcrumb')
    <!--====== PAGE BANNER PART ENDS ======-->

    <!--====== DASHBOARD CONTENT START ======-->
    <section id="teachers-singel" class="pt-70 pb-120 gray-bg">
        <div class="container">

            <div class="row justify-content-center">
                @include('frontend.teacher-dashboard.sidebar')

                <div class="col-lg-8">
                    <div class="teachers-right mt-50">

                        <ul class="list-group mt-4">
                            <li class="list-group-item">
                                <a href="{{ route('teacher.profile.index') }}">Profile</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('teacher.courses.index') }}">Create Course</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('teacher.remarks.index') }}">Remarks</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('teacher.announcements.index') }}">Announcement</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('teacher.announcements.index') }}">Comments</a>
                            </li>
                        </ul>
                        <div id="dashboard-tab-content" class="tab-content mt-4">
                            @include('frontend.teacher-dashboard.profile.index') {{-- Default tab --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
