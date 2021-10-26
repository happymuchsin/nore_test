<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <a href="{{ route('home') }}">
                <img src="assets/images/logo.svg" alt="" srcset="">
            </a>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class='sidebar-title'>Main Menu</li>
                <li class="sidebar-item {{ request()->is('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}" class="sidebar-link">
                        <i class="fa fa-home" width="20"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->is('user') ? 'active' : '' }}">
                    <a href="{{ route('user') }}" class="sidebar-link">
                        <i class="fa fa-users" width="20"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->is('list') ? 'active' : '' }}">
                    <a href="{{ route('list') }}" class="sidebar-link">
                        <i class="fa fa-list" width="20"></i>
                        <span>List Item</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>