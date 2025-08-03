<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo">
            <div class="logo-icon">
                <i class="fas fa-shield-alt"></i>
            </div>
            <div class="logo-text">SuperAdmin</div>
        </div>
        <div class="sidebar-toggle" id="sidebar-toggle">
            <i class="fas fa-chevron-left"></i>
        </div>
    </div>
    <div class="sidebar-menu">
        <div class="menu-section">
            <div class="menu-section-title">Main</div>
            <a href="/superadmin/dashboard" class="menu-item active">
                <div class="menu-icon"><i class="fas fa-tachometer-alt"></i></div>
                <div class="menu-text">Dashboard</div>
            </a>
            <a href="#" class="menu-item">
                <div class="menu-icon"><i class="fas fa-chart-line"></i></div>
                <div class="menu-text">Analytics</div>
            </a>
        </div>

        <div class="menu-section">
            <div class="menu-section-title">User Management</div>
            <a href="{{ route('superadmin.admins.index') }}" class="menu-item {{ request()->routeIs('superadmin.admins.*') ? 'active' : '' }}">
                <div class="menu-icon"><i class="fas fa-user-shield"></i></div>
                <div class="menu-text">Admin Management</div>
            </a>
            <a href="#" class="menu-item">
                <div class="menu-icon"><i class="fas fa-users"></i></div>
                <div class="menu-text">User Accounts</div>
            </a>
            <a href="#" class="menu-item">
                <div class="menu-icon"><i class="fas fa-user-tag"></i></div>
                <div class="menu-text">Roles & Permissions</div>
            </a>
        </div>

        <div class="menu-section">
            <div class="menu-section-title">System</div>
            <a href="#" class="menu-item">
                <div class="menu-icon"><i class="fas fa-list-alt"></i></div>
                <div class="menu-text">Activity Logs</div>
            </a>
            <a href="#" class="menu-item">
                <div class="menu-icon"><i class="fas fa-lock"></i></div>
                <div class="menu-text">Security Settings</div>
            </a>
            <a href="#" class="menu-item">
                <div class="menu-icon"><i class="fas fa-database"></i></div>
                <div class="menu-text">Backup & Restore</div>
            </a>
        </div>

        <div class="menu-section">
            <div class="menu-section-title">Support</div>
            <a href="#" class="menu-item">
                <div class="menu-icon"><i class="fas fa-ticket-alt"></i></div>
                <div class="menu-text">Support Tickets</div>
            </a>
            <a href="#" class="menu-item">
                <div class="menu-icon"><i class="fas fa-bullhorn"></i></div>
                <div class="menu-text">Announcements</div>
            </a>
        </div>

        <div class="menu-section">
            <div class="menu-section-title">Settings</div>
            
            <a href="/superadmin/settings" class="menu-item">
                <div class="menu-icon"><i class="fas fa-cog"></i></div>
                <div class="menu-text">System Settings</div>
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
