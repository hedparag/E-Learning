<div class="col-lg-4 col-md-8">
    <div class="teachers-left mt-50">
        <div class="hero">
            <img src="{{ asset(auth()->user()->image) }}" alt="Profile Image" class="img-fluid w-100">
        </div>

        <div class="name">
            <h6>{{ auth()->user()->name }}</h6>
            {{-- <span>{{ ucfirst(auth()->user()->role) }}</span> --}}
        </div>

        <div class="description">
            <p>{{ auth()->user()->headline ?? '' }}</p>
        </div>

        {{-- <div class="description">
            <p><i class="fa fa-envelope"></i> {{ auth()->user()->email }}</p>
        </div> --}}

        <div class="social">
            <div class="description">
                <p><i class="fa fa-envelope"></i> {{ auth()->user()->email }}</p>
            </div>
            <ul>
                @if (auth()->user()->facebook)
                    <li><a href="{{ auth()->user()->facebook }}" target="_blank"><i
                                class="fa fa-facebook-square"></i></a>
                    </li>
                @endif
                @if (auth()->user()->linkedin)
                    <li><a href="{{ auth()->user()->linkedin }}" target="_blank"><i
                                class="fa fa-linkedin-square"></i></a></li>
                @endif
                @if (auth()->user()->github)
                    <li><a href="{{ auth()->user()->github }}" target="_blank"><i class="fa fa-github-square"></i></a>
                    </li>
                @endif
                @if (auth()->user()->website)
                    <li><a href="{{ auth()->user()->website }}" target="_blank"><i class="fa fa-globe"></i></a></li>
                @endif
            </ul>
        </div>

        {{-- Logout --}}
        <div class="description mt-3">
            <a href="javascript:;" onclick="event.preventDefault(); $('#logout').submit();"
                class="btn btn-sm btn-danger mt-2">
                Sign Out
            </a>
            <form method="POST" id="logout" action="{{ route('logout') }}">
                @csrf
            </form>
        </div>
    </div> <!-- teachers left -->
</div>
