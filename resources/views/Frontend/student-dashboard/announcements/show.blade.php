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
                        <h4 class="mb-5">Announcements</h4>

                        <section id="event-singel" class="pt-20 pb-20 gray-bg">
                            <div class="container rounded">
                                <div class="events-area">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="events-left">
                                                <h3>{{ $announcement->title }}</h3>

                                                <a href="#">
                                                    <span><i class="fa fa-calendar"></i>
                                                        {{ \Carbon\Carbon::parse($announcement->start_date)->format('j F Y') }}
                                                    </span>
                                                </a>

                                                <a href="#">
                                                    <span><i class="fa fa-clock-o"></i>
                                                        {{ \Carbon\Carbon::parse($announcement->start_date)->format('g:i A') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($announcement->end_date)->format('g:i A') }}
                                                    </span>
                                                </a>

                                                <a href="#"><span><i class="fa fa-map-marker"></i> Rc
                                                        Auditorim</span></a>

                                                {{-- Image with no class, using your original structure --}}
                                                <img src="{{ $announcement->attachment ? asset($announcement->attachment) : asset('frontend/assets/images/event/e-1.jpg') }}"
                                                    alt="Announcement Image">

                                                <p>{{ $announcement->body }}</p>
                                            </div> <!-- events-left -->
                                        </div>
                                    </div> <!-- row -->
                                </div> <!-- events-area -->
                            </div> <!-- container -->
                        </section>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== TEACHER PART END ======-->
@endsection
