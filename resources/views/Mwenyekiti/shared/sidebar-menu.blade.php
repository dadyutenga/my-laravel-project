<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo">
            <div class="logo-icon">MW</div>
            <div class="logo-text">Mwenyekiti</div>
        </div>
        <div class="sidebar-toggle" id="sidebar-toggle">
            <i class="fas fa-chevron-left"></i>
        </div>
    </div>
    <div class="sidebar-menu">
        <div class="menu-section">
            <div class="menu-section-title">Main</div>
            <a href="#" class="menu-item">
                <i class="fas fa-home menu-icon"></i>
                <span class="menu-text">Dashboard</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-user menu-icon"></i>
                <span class="menu-text">Profile</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-chart-bar menu-icon"></i>
                <span class="menu-text">Reports</span>
                <span class="menu-badge">3</span>
            </a>
        </div>
        <div class="menu-section">
            <div class="menu-section-title">Account</div>
            <a href="#" class="menu-item">
                <i class="fas fa-cog menu-icon"></i>
                <span class="menu-text">Settings</span>
            </a>
            <a href="#" class="menu-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt menu-icon"></i>
                <span class="menu-text">Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout1') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</div>
<div class="sidebar-overlay" id="sidebar-overlay"></div>