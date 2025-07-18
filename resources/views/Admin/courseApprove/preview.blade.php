@extends('Admin.layouts.Master')
@section('content')
    <div class="container mt-3">
        <h4>Course Preview: {{ $course->title }}</h4>

        <ul class="nav nav-tabs" id="previewTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="basic-tab" data-toggle="tab" href="#basic" role="tab">Basic Info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="curriculum-tab" data-toggle="tab" href="#curriculum" role="tab">Curriculum</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="mock-tab" data-toggle="tab" href="#mock" role="tab">Mock Test</a>
            </li>
        </ul>
        {{-- modal for video --}}
        <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModal"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Video</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="videoPlayModal" style="height: 100%; width: 100%;" src=""
                                allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="basic" role="tabpanel">
                <p><strong>Title:</strong> {{ $course->title }}</p>
                <p><strong>Teacher:</strong> {{ $course->teacher->name ?? 'N/A' }}</p>
                <p><strong>Subject:</strong> {{ $course->subject->name ?? 'N/A' }}</p>
                <p><strong>Class:</strong> {{ $course->class->name ?? 'N/A' }}</p>
            </div>

            <div class="tab-pane fade" id="curriculum" role="tabpanel">
                <h3 class="mb-4">Course Curriculum</h3>

                @forelse ($course->chapters as $chapter)
                    <div class="mb-4">
                        <h5 class="fw-bold text-primary">📘 Chapter: {{ $chapter->title }}</h5>

                        <ul class="list-group list-group-flush ms-3">
                            @foreach ($chapter->lessons as $lesson)
                                <li class="list-group-item">
                                    <h6 class="mb-1">{{ $lesson->title }}</h6>

                                    @if ($lesson->desc)
                                        <p class="text-muted small">{!! $lesson->desc !!}</p>
                                    @endif

                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <strong>File Type:</strong> {{ $lesson->file_type ?? 'N/A' }}
                                        </div>
                                        <div class="col-md-6 text-end">
                                            @if ($lesson->file_type == 'audio')
                                                <button class="btn btn-sm btn-info videoView" data-url="{{ $lesson->path }}" data-toggle="modal"
                                                    data-target="#videoModal">Listen</button>
                                            @elseif ($lesson->file_type == 'video')
                                                <button class="btn btn-sm btn-info videoView" data-toggle="modal"
                                                    data-target="#videoModal" data-url="{{ $lesson->path }}">View</button>
                                            @else
                                                <button class="btn btn-sm btn-info videoView" data-toggle="modal"
                                                    data-target="#videoModal" data-url="{{ $lesson->path }}">Docs</button>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @empty
                    <div class="alert alert-warning">
                        <h5>No chapters found for this course.</h5>
                    </div>
                @endforelse
            </div>

            <div class="tab-pane fade" id="mock" role="tabpanel">
                <h3>Mock Test with marked correct answers</h3>

                @forelse ($course->mock?->questions ?? [] as $qIndex => $question)
                    <ul>
                        <strong>Q{{ $qIndex + 1 }}:</strong> {{ $question->question_text }}

                        @foreach ($question->options as $oIndex => $option)
                            <li>

                                <input class="form-check-input" type="checkbox" @checked($option->correct_option) disabled>
                                <label class="form-check-label">
                                    {{ $option->option_text }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                @empty
                    <p>No mock test question found for this course</p>
                @endforelse
            </div>

        </div>
    </div>

@endsection
