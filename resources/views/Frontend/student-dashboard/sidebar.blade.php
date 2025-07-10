<div class="col-lg-4 col-md-8">
    <div class="teachers-left mt-50">
        <div class="hero">
            <img src="{{ asset(auth()->user()->image) }}" alt="Profile Image" class="img-fluid w-100">
        </div>

        <div class="name">
            <h6>{{ auth()->user()->name }}</h6>
            {{-- <span>{{ ucfirst(auth()->user()->role) }}</span> --}}
            <p>Class {{ auth()->user()->student_classes_id ?? '' }}</p>
        </div>

        <div class="description">
            <p>{{ auth()->user()->headline ?? '' }}</p>
        </div>

        <div class="description">
            <p><i class="fa fa-envelope"></i> {{ auth()->user()->email }}</p>
        </div>

        {{-- Logout --}}
        <div class="description">
            <a href="javascript:;" onclick="event.preventDefault(); $('#logout').submit();" class="btn btn-sm btn-danger mt-2">
                Sign Out
            </a>
            <form method="POST" id="logout" action="{{ route('logout') }}">
                @csrf
            </form>
        </div>
    </div> <!-- teachers left -->
</div>