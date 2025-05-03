<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo">
            <div class="logo-icon">
                <i class="fas fa-shield-alt"></i>
            </div>
            <div class="logo-text">Admin</div>
        </div>
        <div class="sidebar-toggle" id="sidebar-toggle">
            <i class="fas fa-chevron-left"></i>
        </div>
    </div>
    <div class="sidebar-menu">
        <div class="menu-section">
            <div class="menu-section-title">Main</div>
            <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <div class="menu-icon"><i class="fas fa-tachometer-alt"></i></div>
                <div class="menu-text">Dashboard</div>
            </a>
        </div>

        <div class="menu-section">
            <div class="menu-section-title">User Management</div>
            <a href="{{ route('admin.mwenyekiti.create') }}" class="menu-item {{ request()->routeIs('admin.mwenyekiti.create') ? 'active' : '' }}">
                <div class="menu-icon"><i class="fas fa-user-plus"></i></div>
                <div class="menu-text">Create Mwenyekiti</div>
            </a>
            <a href="/admin/mwenyekiti/create-account" class="menu-item {{ request()->is('admin/mwenyekiti/create-account') ? 'active' : '' }}">
                <div class="menu-icon"><i class="fas fa-user-plus"></i></div>
                <div class="menu-text">Create Mwenyekiti Auth Account</div>
            </a>
            <a href="{{ route('admin.mwenyekiti.manage') }}" class="menu-item {{ request()->routeIs('admin.mwenyekiti.manage') ? 'active' : '' }}">
                <div class="menu-icon"><i class="fas fa-users-cog"></i></div>
                <div class="menu-text">Manage Mwenyekiti</div>
            </a>
            <a href="{{ route('admin.mwenyekiti.manage') }}" class="menu-item {{ request()->routeIs('admin.mwenyekiti.manage') ? 'active' : '' }}">
                <i class="fas fa-user menu-icon"></i>
                <span class="menu-text">Manage Mwenyekiti Auth Accounts</span>
            </a>
            <a href="{{ route('admin.balozi.manage') }}" class="menu-item {{ request()->routeIs('admin.balozi.manage') ? 'active' : '' }}">
                <div class="menu-icon"><i class="fas fa-users-cog"></i></div>
                <div class="menu-text">Manage Balozi Accounts</div>
            </a>
        </div>

        <div class="menu-section">
            <div class="menu-section-title">Support</div>
            <a href="{{ route('admin.tickets') }}" class="menu-item {{ request()->routeIs('admin.tickets') ? 'active' : '' }}">
                <div class="menu-icon"><i class="fas fa-ticket-alt"></i></div>
                <div class="menu-text">Support Tickets</div>
            </a>
        </div>

        <div class="menu-section">
            <div class="menu-section-title">Settings</div>
            <a href="{{ route('admin.profile') }}" class="menu-item {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                <div class="menu-icon"><i class="fas fa-user-circle"></i></div>
                <div class="menu-text">My Profile</div>
            </a>
            <a href="{{ route('logout') }}" class="menu-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <div class="menu-icon"><i class="fas fa-sign-out-alt"></i></div>
                <div class="menu-text">Logout</div>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</aside>

<!-- Sidebar Overlay -->
<div class="sidebar-overlay" id="sidebar-overlay"></div>