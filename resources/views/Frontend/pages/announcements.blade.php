  @extends('frontend.layouts.master')

@section('content')

  <!--====== PAGE BANNER PART START ======-->

    <section id="page-banner" class="pt-105 pb-110 bg_cover" data-overlay="8" style="background-image: url({{ asset('frontend/assets/images/page-banner-3.jpg') }})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>Events</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Announcements</li>
                            </ol>
                        </nav>
                    </div>  <!-- page banner cont -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== PAGE BANNER PART ENDS ======-->

    <!--====== EVENTS PART START ======-->

    <section id="event-page" class="pt-90 pb-120 gray-bg">
        <div class="container">
           <div class="row">
               @foreach($data as $d)
               <div class="col-lg-6">
                   <div class="singel-event-list mt-30">
                       <div class="event-thum">
                           <img src="{{ asset($d?->attachment) }}" alt="Event">
                       </div>
                       <div class="event-cont">
                           <span><i class="fa fa-calendar"></i>{{ \Carbon\Carbon::parse($d?->start_date)->format('Y-m-d') }}</span>
                            <a href="events-singel.html"><h4>{{ $d?->title }}</h4></a>
                            <p>{{ $d?->body }}</p>
                       </div>
                   </div>
               </div>
               @endforeach

           </div> <!-- row -->
           {{ $data->links() }}

        </div> <!-- container -->
    </section>

    <!--====== EVENTS PART ENDS ======-->

    @endsection
