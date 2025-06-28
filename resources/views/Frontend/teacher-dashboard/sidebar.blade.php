<div class="col-lg-4 col-md-8">
    <div class="dashboard_sidebar teachers-left mt-50">
        <div class="dashboard_sidebar_top hero">
            <img src="{{ asset(auth()->user()->image) }}" alt="profile" class="img-fluid w-100">
        </div>
        <h4>{{ auth()->user()->name }}</h4>
        

        <ul class="wsus__dashboard_sidebar_menu">
            <li>
                <p>{{ auth()->user()->role }}</p>
            </li>
            <li>
                <a href="javascript:;"
                    onclick="event.preventDefault();
                                        $('#logout').submit();">
                    <div class="img">
                        <img src="{{ asset('frontend/assets/images/dash_icon_16.png') }}" alt="icon"
                            class="img-fluid w-100">
                    </div>
                    Sign Out
                </a>
                <form method="POST" id="logout" action="{{ route('logout') }}">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>
