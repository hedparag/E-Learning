@extends('Frontend.layouts.master')

@section('content')

@include('Frontend.student-dashboard.breadcrumb')

<section class="pt-90 pb-90">
    <div class="container">
        <div class="row">
            @include('frontend.student-dashboard.sidebar')

            <div class="col-lg-8">
                @include('frontend.student-dashboard.navbar')

                <div class="dashboard-content ajax-area">
                    <h4 class="mb-4 font-weight-bold text-primary">Your Doubts & Replies</h4>

                    <section class="pt-10 pb-10 gray-bg">
                        <div class="container">
                            <div class="row">
                                @forelse ($doubts as $doubt)
                                    <div class="col-md-6 mb-4">
                                        <div class="card shadow-sm border-0 h-100">
                                            <div class="card-body">
                                                <h6 class="text-secondary mb-2"><i class="fas fa-book-open mr-1"></i>Course: <span class="text-dark">{{ $doubt->course->title }}</span></h6>

                                                <p class="mb-1"><strong class="text-dark">Your Question:</strong> <span class="text-muted">{{ $doubt->message }}</span></p>

                                                @if ($doubt->reply)
                                                    <p class="mb-2"><strong class="text-dark">Teacher Reply:</strong> <span class="text-success">{{ $doubt->reply }}</span></p>
                                                @else
                                                    <p class="text-muted mb-2"><em>No reply yet</em></p>
                                                @endif

                                                <div class="text-right">
                                                    <small class="text-muted"><i class="far fa-clock mr-1"></i>Asked at: {{ \Carbon\Carbon::parse($doubt->asked_at)->format('d M, Y h:i A') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <div class="alert alert-info text-center shadow-sm">
                                            <i class="fas fa-info-circle mr-1"></i> No doubts have been asked yet.
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </section>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
