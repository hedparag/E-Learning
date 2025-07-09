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
                        <h4 class="mb-4">Chapters</h4>

                        <div class="curriculam-cont">
                            <div class="title">
                                <h6>{{ $course->title }} Lecture Series</h6>
                            </div>
                            <div class="accordion" id="accordionExample">
                                @forelse($chapters as $index => $chapter)
                                    <div class="card">
                                        <div class="card-header" id="heading{{ $index }}">
                                            <a href="#" data-toggle="collapse"
                                                data-target="#collapse{{ $index }}"
                                                aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                                aria-controls="collapse{{ $index }}">
                                                <ul>
                                                    <li><i class="fa fa-book"></i></li>
                                                    <li><span class="lecture">Lecture
                                                            {{ $chapter->order ?? $index + 1 }}</span></li>
                                                    <li><span class="head">{{ $chapter->title }}</span></li>
                                                    <li>
                                                        <span class="time d-none d-md-block">
                                                            <i class="fa fa-clock-o"></i>
                                                            <span>{{ gmdate('H:i:s', $chapter->duration ?? 0) }}</span>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </a>
                                        </div>
                                        <div id="collapse{{ $index }}"
                                            class="collapse {{ $index == 0 ? 'show' : '' }}"
                                            aria-labelledby="heading{{ $index }}" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <p>{{ $chapter->desc ?? 'No description available.' }}</p>

                                                {{-- LESSONS --}}
                                                @forelse($chapter->lessons as $lesson)
                                                    <div class="lesson-box mt-3 mb-3 d-flex align-items-start">
                                                        {{-- Icon based on file_type --}}
                                                        <div class="lesson-icon mr-3">
                                                            @if ($lesson->file_type === 'video')
                                                                <i class="fa fa-play-circle fa-2x text-danger"></i>
                                                            @elseif($lesson->file_type === 'audio')
                                                                <i class="fa fa-headphones fa-2x text-primary"></i>
                                                            @elseif($lesson->file_type === 'doc')
                                                                <i class="fa fa-file-text fa-2x text-info"></i>
                                                            @elseif($lesson->file_type === 'file')
                                                                <i class="fa fa-file-archive fa-2x text-secondary"></i>
                                                            @endif
                                                        </div>
                                                        <div class="lesson-info">
                                                            <strong>{{ $lesson->title }}</strong><br>
                                                            <small>{{ $lesson->desc ?? 'No description.' }}</small><br>
                                                            <small class="text-muted">Duration:
                                                                {{ gmdate('H:i:s', $lesson->duration ?? 0) }}</small>
                                                            {{-- Optional: Watch button --}}
                                                            <div class="mt-1">
                                                                <a href="{{ $lesson->path }}" target="_blank"
                                                                    class="btn btn-sm btn-outline-primary">
                                                                    {{ $lesson->file_type === 'video' ? 'Watch' : 'View' }}
                                                                </a>
                                                                @if ($lesson->downloadable)
                                                                    <a href="{{ $lesson->path }}" download
                                                                        class="btn btn-sm btn-outline-success">Download</a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <p class="text-muted">No lessons found in this chapter.</p>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p>No chapters found for this subject.</p>
                                @endforelse

                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>
        </div>
        </div>
    </section>

    <!--====== TEACHER PART END ======-->
@endsection
