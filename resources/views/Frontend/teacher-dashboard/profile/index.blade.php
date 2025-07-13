@extends('Frontend.layouts.master')

@section('content')
    <!--====== PAGE BANNER PART START ======-->

    @include('Frontend.teacher-dashboard.breadcrumb')

    <!--====== PAGE BANNER PART ENDS ======-->

    <!--====== TEACHER PART START ======-->

    <section class="pt-90 pb-90">
        <div class="container">
             @if (@$count > 0)
       <div class="row justify-content-center mb-3">
    <div class="col-md-6">
        <div class="alert alert-info alert-dismissible fade show text-center" role="alert">
            <strong>Hey! Some doubts have been posted by your students!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="ti ti-close"></i>
            </button>
        </div>
    </div>
</div>

    @endif

            <div class="row">
                @include('frontend.teacher-dashboard.sidebar')

                <div class="col-lg-8">

                    @include('frontend.teacher-dashboard.navbar')
                    <div class="dashboard-content">
                        <div class="mb-5">
                            <h4 class="mb-2">Hey, {{ auth()->user()->name }} </h3>
                                <p>Let's Teach!</p>
                        </div>

                        <table class="table fixed-table">
                            <tr>
                                <td>
                                    <h6>Headline</h6>
                                    <p>{{ auth()->user()->headline ?? 'Not available' }}</p>
                                </td>
                                <td>
                                    <h6>Gender</h6>
                                    <p>{{ ucfirst(auth()->user()->gender ?? 'Not available') }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h6>Email</h6>
                                    <p>{{ auth()->user()->email }}</p>
                                </td>
                                <td>
                                    <h6>Phone</h6>
                                    <p>{{ auth()->user()->phone ?? 'Not available' }}</p>
                                </td>
                            </tr>
                        </table>

                        <div class="mb-4">
                            <h6>Bio</h6>
                            <p>{{ auth()->user()->bio ?? 'Not available' }}</p>
                        </div>

                        <div class="mb-4">
                            <h6>Courses Teaching</h6>
                            {{-- <p>{{ auth()->user()->headline ?? 'No headline available' }}</p> --}}
                        </div>

                        <a href="{{ route('teacher.profile.edit') }}" class="main-btn mt-4">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== TEACHER PART START ======-->
@endsection
