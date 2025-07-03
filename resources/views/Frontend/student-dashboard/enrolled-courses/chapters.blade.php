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
                                <h6>{{ $course->name }} Lecture Series</h6>
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
                                                    <li><i class="fa fa-file-o"></i></li>
                                                    <li><span class="lecture">Lecture
                                                            {{ $chapter->order ?? $index + 1 }}</span>
                                                    </li>
                                                    <li><span class="head">{{ $chapter->title }}</span>
                                                    </li>
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
                                                <p>{{ $chapter->desc ?? 'No description available.' }}
                                                </p>
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
