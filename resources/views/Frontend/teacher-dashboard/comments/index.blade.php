@extends('Frontend.layouts.master')

@section('content')

@include('Frontend.teacher-dashboard.breadcrumb')

<section class="pt-90 pb-90">
    <div class="container">
        <div class="row">
            @include('frontend.teacher-dashboard.sidebar')

            <div class="col-lg-8">
                @include('frontend.teacher-dashboard.navbar')

                <div class="dashboard-content">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">Student Doubts & Replies</h4>
                    </div>

                    @forelse ($data ?? [] as $d)
                        <div class="card shadow-sm mb-4 border-left-warning">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="mb-1">{{ $d?->student->name }}</h5>
                                        <small class="text-muted">Class: {{ $d?->student->hasClass->name }} | Course: {{ $d?->course->title }}</small>
                                    </div>
                                </div>

                                <hr>

                                <p class="mb-2">
                                    <strong>Message:</strong> {{ $d?->message }}
                                </p>

                                <form action="{{ route('teacher.commentPost',$d?->id) }}" class="commentSubmit mt-3">
                                    @csrf
                                    <div class="form-group">
                                        <textarea name="reply" class="form-control" rows="2" placeholder="Write your reply..." required></textarea>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-warning">
                                            <i class="fas fa-reply"></i> Reply
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                       <div class="col-12 mb-2">
                                                <div class="alert alert-inverse-info" role="alert">
                                                   No doubts have been posted yet!
                                                </div>
                                            </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
