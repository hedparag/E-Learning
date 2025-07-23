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
    </ul>

    <div class="tab-content mt-3">
        <div class="tab-pane fade show active" id="basic" role="tabpanel">
            <p><strong>Title:</strong> {{ $course->title }}</p>
            <p><strong>Teacher:</strong> {{ $course->teacher->name ?? 'N/A' }}</p>
            <p><strong>Subject:</strong> {{ $course->subject->name ?? 'N/A' }}</p>
            <p><strong>Class:</strong> {{ $course->class->name ?? 'N/A' }}</p>
        </div>

        <div class="tab-pane fade" id="curriculum" role="tabpanel">
            @foreach ($course->chapters as $chapter)
                <h5>Chapter: {{ $chapter->title }}</h5>
                <ul>
                    @foreach ($chapter->lessons as $lesson)
                        <li>{{ $lesson->title }} ({{ $lesson->file_type ?? 'N/A' }})</li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    </div>
</div>
@endsection
