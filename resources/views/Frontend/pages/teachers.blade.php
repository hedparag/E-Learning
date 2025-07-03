@extends('frontend.layouts.master')

@section('content')
    <!--====== PAGE BANNER PART START ======-->

    <section id="page-banner" class="pt-105 pb-110 bg_cover" data-overlay="8"
        style="background-image: url({{ asset('frontend/assets/images/page-banner-3.jpg') }})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>Our Teachers</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Our Teachers</li>
                            </ol>
                        </nav>
                    </div> <!-- page banner cont -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== PAGE BANNER PART ENDS ======-->

    <!--====== TEACHERS PART START ======-->

    <section id="teachers-page" class="pt-50 pb-50 gray-bg">
        <div class="container">
            <div class="row">

                @foreach ($teachers as $teacher)
                    <div class="col-lg-3 col-sm-6">
                        <div class="singel-teachers mt-30 text-center">
                            <div class="image">
                                {{-- update this with profile photo --}}
                                {{-- <img src="{{ $teacher->photo ? asset('uploads/teachers/' . $teacher->photo) : asset('frontend/assets/images/teachers/default.jpg') }}"
                                    alt="{{ $teacher->name }}"> --}}
                                <img src="{{ asset('default-files/avatar.png') }}" alt="Teacher Image">
                            </div>
                            <div class="cont">
                                <a href="#" data-toggle="modal" data-target="#teacherModal-{{ $teacher->id }}">
                                    <h6>{{ $teacher->name }}</h6>
                                    <span>{{ ucfirst($teacher->role) }}</span>
                                </a>
                            </div>
                        </div> <!-- singel teachers -->
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="teacherModal-{{ $teacher->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="teacherModalLabel-{{ $teacher->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Teacher Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span>&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <div class="container">
                                        {{-- <div class="info-box row align-items-center"> --}}
                                            <div class="row align-items-center">
                                            <!-- Left: Image -->
                                            <div class="col-md-4 mb-3 text-center">
                                                <img src="{{ asset('default-files/avatar.png') }}" class="img-fluid rounded"
                                                    alt="Teacher Image" id="teacher_modal">
                                            </div>

                                            <!-- Right: Name, role, social -->
                                            <div class="col-md-8">
                                                <div class="mb-2">
                                                    <h5>{{ strtoupper($teacher->name) }}</h5>
                                                    {{-- <p>{{ ucfirst($teacher->gender) }}</p> --}}
                                                </div>
                                                {{-- <p><strong>{{ ucfirst($teacher->role) }}</strong></p> --}}
                                                <p class="mb-1">{{ $teacher->headline ?? '' }}</p>

                                                <p><i class="fa fa-envelope"></i> {{ $teacher->email }}</p>

                                                <ul class="list-inline mb-0">
                                                    @if ($teacher->facebook)
                                                        <li class="list-inline-item"><a href="{{ $teacher->facebook }}"
                                                                target="_blank"><i
                                                                    class="fa fa-facebook-square fa-lg"></i></a></li>
                                                    @endif
                                                    @if ($teacher->linkedin)
                                                        <li class="list-inline-item"><a href="{{ $teacher->linkedin }}"
                                                                target="_blank"><i
                                                                    class="fa fa-linkedin-square fa-lg"></i></a></li>
                                                    @endif
                                                    @if ($teacher->github)
                                                        <li class="list-inline-item"><a href="{{ $teacher->github }}"
                                                                target="_blank"><i
                                                                    class="fa fa-github-square fa-lg"></i></a></li>
                                                    @endif
                                                    @if ($teacher->website)
                                                        <li class="list-inline-item"><a href="{{ $teacher->website }}"
                                                                target="_blank"><i class="fa fa-globe fa-lg"></i></a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Other info -->
                                        <hr>
                                        <div class="mb-4">
                                            <h6 class="mb-1">BIO</h6>
                                            <p>{{ $teacher->bio ?? 'No bio available' }}</p>
                                        </div>
                                        <div class="mb-4">
                                            <h6 class="mb-1">COURSES</h6>
                                            {{-- <p>{{ $teacher->bio ?? 'No bio available' }}</p> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div> <!-- row -->

            {{-- <div class="row">
                <div class="col-lg-12">
                    <nav class="courses-pagination mt-50">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a href="#" aria-label="Previous">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                            </li>
                            <li class="page-item"><a class="active" href="#">1</a></li>
                            <li class="page-item"><a href="#">2</a></li>
                            <li class="page-item"><a href="#">3</a></li>
                            <li class="page-item">
                                <a href="#" aria-label="Next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>  <!-- courses pagination -->
                </div>
            </div>  <!-- row --> --}}

        </div> <!-- container -->
    </section>

    <!--====== TEACHERS PART ENDS ======-->
@endsection
