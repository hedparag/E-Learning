@extends('Frontend.layouts.master')

@section('content')

    <!--====== PAGE BANNER PART START ======-->

    @include('Frontend.student-dashboard.breadcrumb')

    <!--====== PAGE BANNER PART ENDS ======-->



    <!--====== STUDENT PART START ======-->

    <section class="pt-90 pb-90">
        <div class="container">
            @if (@$count != 0)
                <div class="row d-flex justify-content-center">
                    <div class="col-6 mb-2">
                    <div class="alert alert-primary" role="alert">
                        <h3 class="text-white">Hey! {{ Auth::guard('web')->user()->name }}</h3>
                        <p class="text-white">You have message from teacher.</p>
                            <a href="{{ route('student.viewReply') }}" class="btn btn-success">View</a>
                    </div>
                </div>
                </div>
            @endif
            <div class="row">
                @include('frontend.student-dashboard.sidebar')

                <div class="col-lg-8">
                    @include('frontend.student-dashboard.navbar')

                    <div class="dashboard-content">
                        <div class="mb-5">
                            <h4 class="mb-2">Hey, {{ auth()->user()->name }} </h3>
                                <p>Let's Study!</p>
                        </div>

                        <div class="profile-index pt-20 pb-20 white-bg" style="border-radius: 5px;">
                            <table class="table fixed-table">
                            <tr>
                                <td class="pl-5">
                                    <h5>HEADLINE</h5>
                                    <p>{{ auth()->user()->headline ?? 'Not available' }}</p>
                                </td>
                                <td>
                                    <h5>GENDER</h5>
                                    <p>{{ ucfirst(auth()->user()->gender ?? 'Not available') }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="pl-5">
                                    <h5>EMAIL</h5>
                                    <p>{{ auth()->user()->email }}</p>
                                </td>
                                <td>
                                    <h5>PHONE</h5>
                                    <p>{{ auth()->user()->phone ?? 'Not available' }}</p>
                                </td>
                            </tr>
                        </table>

                        <div class="mb-4 pl-5">
                            <h5>BIO</h5>
                            <p>{{ auth()->user()->bio ?? 'Not available' }}</p>
                        </div>

                        <div class="mb-4 pl-5">
                            <h5>COURSE PROGRESS</h5>
                            {{-- <p>{{ auth()->user()->headline ?? 'Not available' }}</p> --}}
                        </div>
                        </div>

                        <a href="{{ route('student.profile.edit') }}" class="main-btn mt-4">Edit Profile</a>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!--====== STUDENT PART START ======-->
    
@endsection