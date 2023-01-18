<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Main</li>
                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="ti-home"></i><span class="badge badge-primary badge-pill float-right">2</span> <span>
                            Dashboard </span>
                    </a>
                </li>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-user"></i><span> Manage Users <span
                                class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">

                        @can('user-list')
                            <li><a href="{{ route('users.index') }}">Users</a></li>
                        @endcan
                        @can('student-list')
                            <li><a href="{{ route('students.index') }}">Students</a></li>
                        @endcan
                        @can('staff-list')
                            <li><a href="{{ route('staffs.index') }} ">Staffs</a></li>
                        @endcan
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-write"></i><span> Exam Details <span
                                class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        @can('exam-list')
                            <li><a href="{{ route('exams.index') }}">Exams</a></li>
                        @endcan
                        {{-- @can('exam-attendance-list') --}}
                        <li><a href="{{ route('exam-attendances.index') }}">Exam Attendances</a></li>
                        {{-- @endcan --}}
                        {{-- @can('result-list') --}}
                        <li><a href="{{ route('results.index') }} ">Results</a></li>
                        {{-- @endcan --}}
                    </ul>
                </li>
                @can('course-list')
                    <li>
                        <a href="{{ route('courses.index') }}" class="waves-effect"><i class="ti-book"></i><span> Manage
                                Courses </span></a>
                    </li>
                @endcan
                @can('subject-list')
                    <li>
                        <a href="{{ route('subjects.index') }}" class="waves-effect"><i class="ti-agenda"></i><span> Manage
                                Subjects </span></a>
                    </li>
                @endcan
                @can('role-list')
                    <li>
                        <a href="{{ route('roles.index') }}" class="waves-effect"><i class="ti-tag"></i><span> Manage Role
                            </span></a>
                    </li>
                @endcan
                @can('permission-list')
                    <li>
                        <a href="{{ route('permissions.index') }}" class="waves-effect"><i class="ti-lock"></i><span>
                                Permissions </span></a>
                    </li>
                @endcan
                {{-- @can('change-password-list') --}}
                <li>
                    <a href="{{ route('change-password') }}" class="waves-effect"><i class="ti-key"></i><span> Change
                            Password </span></a>
                </li>
                {{-- @endcan --}}
            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
