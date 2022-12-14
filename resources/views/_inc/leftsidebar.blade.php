<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Main</li>
                <li>
                    <a href="index.html" class="waves-effect">
                        <i class="ti-home"></i><span class="badge badge-primary badge-pill float-right">2</span> <span> Dashboard </span>
                    </a>
                </li>
            </li>
            <li>
                <a href="{{ route('courses.index') }}" class="waves-effect"><i class="ti-face-smile"></i><span>Manage Students </span></a>
            </li>
            <li>
                <a href="javascript:void(0);" class="waves-effect"><i class="ti-user"></i>
                    <span>Manage Staff <span class="float-right menu-arrow"><i
                                class="mdi mdi-chevron-right"></i></span> </span> </a>
                <ul class="submenu">
                    <li><a href="index.php?pg=bank.php&option=view">Acadamic Staff</a></li>
                    <li><a href="index.php?pg=banktransaction.php&option=view">Non-Acadamic Staff</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ route('courses.index') }}" class="waves-effect"><i class="ti-book"></i><span> Manage Courses </span></a>
            </li>
            <li>
                <a href="{{ route('subjects.index') }}" class="waves-effect"><i class="ti-agenda"></i><span> Manage Subjects </span></a>
            </li>
            <li>
                <a href="{{ route('roles.index') }}" class="waves-effect"><i class="ti-tag"></i><span> Manage Role </span></a>
            </li>
            <li>
                <a href="{{ route('permissions.index') }}" class="waves-effect"><i class="ti-lock"></i><span> Permissions </span></a>
            </li>
            <li>
                <a href="{{ route('users.index') }}" class="waves-effect"><i class="ti-user"></i><span> Manage Users </span></a>
            </li>



            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
