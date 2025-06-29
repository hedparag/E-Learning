<ul class="dashboard-tabs nav nav-tabs nav-justified mb-4" role="tablist">
    <li class="nav-item">
        <a href="{{ route('student.profile.index') }}"
           class="nav-link {{ request()->routeIs('student.profile.index') ? 'active' : '' }}">
           Profile
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('student.enrolled-courses.index') }}"
           class="nav-link {{ request()->routeIs('student.enrolled-courses.index') ? 'active' : '' }}">
           Courses
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('student.remarks.index') }}"
           class="nav-link {{ request()->routeIs('student.remarks.index') ? 'active' : '' }}">
           Remarks
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('student.announcements.index') }}"
           class="nav-link {{ request()->routeIs('student.announcements.index') ? 'active' : '' }}">
           Announcements
        </a>
    </li>
</ul>


