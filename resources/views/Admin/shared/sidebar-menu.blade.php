<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo">
            <div class="logo-icon">
                <i class="fas fa-cube"></i>
            </div>
            <div class="logo-text">Prototype</div>
        </div>
        <div class="sidebar-toggle" id="sidebar-toggle">
            <i class="fas fa-chevron-left"></i>
        </div>
    </div>
    <div class="sidebar-menu">
        <div class="menu-section">
            <div class="menu-section-title">Main</div>
            <a href="#" class="menu-item active">
                <div class="menu-icon"><i class="fas fa-th-large"></i></div>
                <div class="menu-text">Dashboard</div>
            </a>
            <a href="#" class="menu-item">
                <div class="menu-icon"><i class="fas fa-chart-line"></i></div>
                <div class="menu-text">Analytics</div>
            </a>
           
            <a href="#" class="menu-item">
                <div class="menu-icon"><i class="fas fa-users"></i></div>
                <div class="menu-text">Create admin Accounts </div>
            </a>
        </div>
        <div class="menu-section">
            <div class="menu-section-title">Management</div>
            <a href="#" class="menu-item">
                <div class="menu-icon"><i class="fas fa-box"></i></div>
                <div class="menu-text">Products</div>
            </a>
            <a href="#" class="menu-item">
                <div class="menu-icon"><i class="fas fa-tag"></i></div>
                <div class="menu-text">Categories</div>
            </a>
            <a href="#" class="menu-item">
                <div class="menu-icon"><i class="fas fa-truck"></i></div>
                <div class="menu-text">Shipping</div>
            </a>
            <a href="#" class="menu-item">
                <div class="menu-icon"><i class="fas fa-percent"></i></div>
                <div class="menu-text">Discounts</div>
            </a>
        </div>
        <div class="menu-section">
            <div class="menu-section-title">Settings</div>
            <a href="#" class="menu-item">
                <div class="menu-icon"><i class="fas fa-user-circle"></i></div>
                <div class="menu-text">Account</div>
            </a>
            <a href="#" class="menu-item">
                <div class="menu-icon"><i class="fas fa-cog"></i></div>
                <div class="menu-text">Settings</div>
            </a>
            <a href="#" class="menu-item">
                <div class="menu-icon"><i class="fas fa-question-circle"></i></div>
                <div class="menu-text">Help Center</div>
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
