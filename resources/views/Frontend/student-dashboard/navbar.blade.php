<ul class="dashboard-tabs nav nav-tabs nav-justified mb-4" role="tablist">
    <li class="nav-item">
        <a href="{{ route('student.profile.index') }}"
           class="nav-link {{ request()->routeIs('student.dashboard') || request()->is('student/profile*') ? 'active' : '' }}">
           Profile
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('student.enrolled-courses.index') }}"
           class="nav-link {{ request()->is('student/enrolled-courses*') ? 'active' : '' }}">
           Courses
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('student.remarks.index') }}"
           class="nav-link {{ request()->is('student/remarks*') ? 'active' : '' }}">
           Remarks
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('student.announcements') }}"
           class="nav-link {{ request()->is('student/announcements*') ? 'active' : '' }}">
           Announcements
        </a>
    </li>
</ul>


