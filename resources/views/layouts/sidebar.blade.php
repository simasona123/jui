<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('home') }}" class="brand-link">
        <img src="https://assets.infyom.com/logo/blue_logo_150x150.png"
             alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
        @role('administrator|manajer')
        <nav>
            <ul class="nav nav-pills nav-sidebar flex-column">
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Manage Users</p>
                    </a>
                </li>
            </ul>
        </nav>
        @endrole
    </div>

</aside>
