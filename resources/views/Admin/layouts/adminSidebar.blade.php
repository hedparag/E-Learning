<aside class="app-navbar">
                    <!-- begin sidebar-nav -->
                    <div class="sidebar-nav scrollbar scroll_light">
                        <ul class="metismenu " id="sidebarNav">
                            <li class="nav-static-title">Personal</li>
                            <li class="active">
                                <a href="{{ route('admin.dashboard') }}">

                                    <span class="nav-title">Dashboards</span>

                                </a>

                            </li>

                            <li><a href="{{ route('admin.instructor-request') }}" aria-expanded="false"><i
                                        class="nav-icon ti ti-comment"></i><span class="nav-title">Instructor Request</span></a>
                            </li>
                             <li><a href="{{ route('admin.class.index') }}" aria-expanded="false"><i
                                        class="nav-icon ti ti-comment"></i><span class="nav-title">Add Class</span></a>
                            </li>
                            <li><a href="{{ route('admin.subject.index') }}" aria-expanded="false"><i
                                        class="nav-icon ti ti-comment"></i><span class="nav-title">Add Subjects</span></a>
                            </li>
                            <li><a href="{{ route('admin.subjectAssign.index') }}" aria-expanded="false"><i
                                        class="nav-icon ti ti-comment"></i><span class="nav-title">Subject Assignment</span></a>
                            </li>



                            <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i
                                        class="nav-icon ti ti-calendar"></i><span
                                        class="nav-title">Calendar</span></a>
                                <ul aria-expanded="false">
                                    <li> <a href='calendar-full.html'>Full Calendar</a> </li>
                                    <li> <a href='calendar-list.html'>Calendar List</a> </li>
                                </ul>
                            </li>
                            <li><a href="mail-inbox.html" aria-expanded="false"><i
                                        class="nav-icon ti ti-email"></i><span class="nav-title">Mail</span></a> </li>


                            <li class="nav-static-title">Widgets, Tables & Layouts</li>



                            <li class="nav-static-title">Extra Components</li>


                        </ul>
                    </div>
                    <!-- end sidebar-nav -->
                </aside>
