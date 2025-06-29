<ul class="dashboard-tabs nav nav-tabs nav-justified mb-4" role="tablist">
    <li class="nav-item">
        <a href="{{ route('teacher.profile.index') }}"
           class="nav-link {{ request()->routeIs('teacher.dashboard') || request()->is('teacher/profile*') ? 'active' : '' }}">
           Profile
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('teacher.courses.index') }}"
           class="nav-link {{ request()->is('teacher/courses*') ? 'active' : '' }}">
           Manage Courses
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('teacher.remarks.index') }}"
           class="nav-link {{ request()->is('teacher/remarks*') ? 'active' : '' }}">
           Remarks
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('teacher.announcements.index') }}"
           class="nav-link {{ request()->is('teacher/announcements*') ? 'active' : '' }}">
           Announcements
        </a>
    </li>
</ul>


