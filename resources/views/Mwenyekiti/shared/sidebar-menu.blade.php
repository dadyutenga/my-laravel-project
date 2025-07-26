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
            <div class="menu-section">
                
                <div class="menu-items">
                    <a href="{{ route('mwenyekiti.balozi.create') }}" class="menu-item {{ Request::routeIs('mwenyekiti.balozi.create') ? 'active' : '' }}">
                        <i class="fas fa-user-plus menu-icon"></i>
                        <span class="menu-text">Add Balozi</span>
                    </a>
                    
                    <a href="{{ route('mwenyekiti.balozi.index') }}" class="menu-item {{ Request::routeIs('mwenyekiti.balozi.index') ? 'active' : '' }}">
                        <i class="fas fa-users menu-icon"></i>
                        <span class="menu-text">Manage Balozi</span>
                    </a>
                </div>
            </div>
            <a href="#" class="menu-item">
                <i class="fas fa-chart-bar menu-icon"></i>
                <span class="menu-text">Reports</span>
            </a>
            <a href="{{ route('mwenyekiti.udhamini.index') }}" class="menu-item">
                <i class="fas fa-file-signature"></i>
                <span class="menu-text">Fomu ya Udhamini</span>
            </a>
         
              <a href="{{ route('mwenyekiti.meeting-requests.index') }}" class="menu-item">
             <i class="fas fa-calendar-alt menu-icon"></i>
              <span class="menu-text">Maombi ya  mkutano</span>
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