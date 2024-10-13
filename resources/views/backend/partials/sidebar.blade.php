<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->

        <li class="nav-heading">Management</li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#management-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Management</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="management-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('permissions.index')  }}">
                        <i class="bi bi-circle"></i><span>Permissions</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('roles.index') }}">
                        <i class="bi bi-circle"></i><span>Roles</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Users</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('teachers.index') }}">
                        <i class="bi bi-circle"></i><span>Teachers</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('students.index') }}">
                        <i class="bi bi-circle"></i><span>Students</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('batch.index') }}">
                        <i class="bi bi-circle"></i><span>Batches</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Components Nav -->


    </ul>

</aside>
<!-- End Sidebar-->
