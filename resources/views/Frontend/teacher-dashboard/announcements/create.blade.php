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
                        <div class="row">
                            <!-- Create Announcement Form -->
                            <div class="col-md-6">
                                <div class="card shadow-sm border-0 mb-4">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0 text-white">Create Announcement</h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ empty($edit) ? route('teacher.announcements.post') : route('teacher.announcements.update',@$data?->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">

                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" class="form-control" name="title"  value="{{ @$data?->title }}"required>
                                            </div>

                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea class="form-control" name="desc" rows="4" placeholder="Write announcement details..." required>{!! @$data?->body !!}</textarea>
                                            </div>

                                            <div class="form-group">
                                                @if(!empty($data))
                                                    <x-image-preview :src="asset($data?->attachment)" />
                                                @endif
                                                <label>Attachment</label>
                                                <input type="file" name="docs" class="form-control-file">
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Start Date</label>
                                                    <input type="date" name="start_date" class="form-control" value="{{ \Carbon\Carbon::parse(@$data?->start_date)->toDateString() }}" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>End Date</label>
                                                    <input type="date" name="end_date" class="form-control" value="{{ \Carbon\Carbon::parse(@$data?->end_date)->toDateString() }}"required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Target Type</label>
                                                <select class="form-control targetClass" name="target" required>
                                                    <option value="">Select Target</option>
                                                    <option value="student" @selected(@$data?->target_type == 'student')>Student</option>
                                                    <option value="class" @selected(@$data?->target_type == 'class')>Class</option>
                                                </select>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 holder {{ @$data?->target_type == 'class' ? '' : 'd-none' }}">
                                                <select name="class" class="form-control">
                                                    <option value="">--Select--</option>
                                                    @foreach ($classes as $class)
                                                        <option value="{{ $class->id }}" @selected(@$data?->target_id == $class->id) >{{ $class->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            </div>



                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Show Teacher Announcements -->
                            <div class="col-md-6">
                                <div class="card shadow-sm border-0 mb-4">
                                    <div class="card-header bg-success text-white">
                                        <h5 class="mb-0 text-white">Your Announcements</h5>
                                    </div>
                                    <div class="card-body" style="max-height: 600px; overflow-y: auto;">
                                        @forelse ($announcements as $announcement)
                                            <div class="mb-3 p-3 border rounded bg-light">
                                                <h6 class="mb-1">{{ $announcement->title }}</h6>
                                                <small class="text-muted">From
                                                    {{ \Carbon\Carbon::parse($announcement->start_date)->toDateString() }}
                                                    to
                                                    {{ \Carbon\Carbon::parse($announcement->end_date)->toDateString() }}</small>
                                                <p class="mt-2 mb-1">{{ $announcement->body }}</p>
                                                <div
                                                    class="row align-items-center mb-3 p-3 border rounded shadow-sm bg-light">
                                                    <div class="col-md-6 mb-2 mb-md-0">
                                                        @if ($announcement->attachment)
                                                            <a href="{{ asset($announcement->attachment) }}"
                                                                class="btn btn-outline-primary btn-sm" target="_blank">
                                                                View Attachment
                                                            </a>
                                                        @else
                                                            <span class="text-muted">No Attachment</span>
                                                        @endif
                                                    </div>

                                                    <div class="col-md-6 text-md-right">
                                                        @if ($announcement->target_type == 'student')
                                                            <span class="badge badge-success px-3 py-2">Student</span>
                                                        @else
                                                            <span
                                                                class="badge badge-info px-3 py-2">{{ $announcement->class->name }}</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="row">
                                                   {{--  <div class="col">
                                                        <span
                                                            class="badge badge-{{ $announcement->is_active ? 'success' : 'secondary' }}">
                                                            {{ $announcement->is_active ? 'Active' : 'Inactive' }}
                                                        </span>
                                                    </div> --}}
                                                    <div class="col text-md-center">
                                                         <a href="{{ route('teacher.announcements.edit',$announcement->id) }}" class="badge badge-primary">Edit</a>
                                                    </div>
                                                    <div class="col text-md-right">
                                                        <a href="{{ route('teacher.announcements.destroy',$announcement->id) }}" class="badge badge-danger delete-item" data-id="{{ $announcement->id }}">Delete Announcement</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <p class="text-muted">No announcements created yet.</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row -->
                    </div> <!-- end dashboard-content -->

                </div>
            </div>
        </div>
    </section>
@endsection
