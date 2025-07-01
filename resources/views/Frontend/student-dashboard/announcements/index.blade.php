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

                        <div class="row">
                            @forelse($announcements as $announcement)
                                <div class="col-lg-12">
                                    <div class="singel-event-list mt-30">
                                        <div class="event-thum">
                                            <img src="{{ $announcement->attachment ? asset($announcement->attachment) : asset('frontend/assets/images/event/e-1.jpg') }}"
                                                alt="Announcement Image">
                                        </div>
                                        <div class="event-cont">
                                            <span><i class="fa fa-calendar"></i>
                                                {{ \Carbon\Carbon::parse($announcement->start_date)->format('d M Y') }}</span>
                                            <h4>{{ $announcement->title }}</h4>
                                            <span><i class="fa fa-clock-o"></i>
                                                {{ \Carbon\Carbon::parse($announcement->start_date)->format('h:i A') }}
                                                -
                                                {{ $announcement->end_date ? \Carbon\Carbon::parse($announcement->end_date)->format('h:i A') : 'N/A' }}
                                            </span>
                                            <span><i class="fa fa-user"></i>
                                                {{ $announcement->created_by_id == auth()->id() ? 'You' : 'Admin / Others' }}</span>
                                            <p>{{ $announcement->body }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-lg-12 mt-4">
                                    <p>No announcements found.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== TEACHER PART END ======-->
@endsection
