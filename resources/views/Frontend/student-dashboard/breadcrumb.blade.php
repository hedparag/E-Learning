{{-- <section id="page-banner" class="pt-50 pb-50 bg_cover" data-overlay="8"
        style="background-image: url({{ asset('frontend/assets/images/page-banner-3.jpg') }})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>Student Dashboard</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

<section
    style="background: url('{{ asset('frontend/assets/images/page-banner-3.jpg') }}') center/cover no-repeat; padding: 40px 0;">
    <div class="container">
        <div class="bg-white bg-opacity-50 rounded-4 shadow p-3 text-center" style="backdrop-filter: blur(10px); border-radius: 5px;">
            <h3 class="text-dark mb-2">STUDENT DASHBOARD</h3>
            <nav aria-label="breadcrumb" class="d-inline-block">
                <ol class="breadcrumb justify-content-center bg-transparent mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item active text-dark" aria-current="page"><a
                            href="{{ route('student.profile.index') }}" class="text-dark">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
