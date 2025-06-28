<ul class="dashboard-tabs nav nav-tabs nav-justified mb-4" role="tablist">
    <li class="nav-item">
        <a href="{{ route('teacher.profile.index') }}"
           class="nav-link {{ request()->routeIs('teacher.profile.index') ? 'active' : '' }}">
           Profile
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('teacher.enrolled-courses.index') }}"
           class="nav-link {{ request()->routeIs('teacher.enrolled-courses.index') ? 'active' : '' }}">
           Create Courses
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('teacher.remarks.index') }}"
           class="nav-link {{ request()->routeIs('teacher.remarks.index') ? 'active' : '' }}">
           Remarks
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('teacher.announcements.index') }}"
           class="nav-link {{ request()->routeIs('teacher.announcements.index') ? 'active' : '' }}">
           Announcements
        </a>
    </li>
</ul>


