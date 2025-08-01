
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
        <!-- Main Navigation -->
        <div class="menu-section">
            <div class="menu-section-title">Main</div>
            <a href="{{ route('mwenyekiti.dashboard') }}" class="menu-item {{ request()->routeIs('mwenyekiti.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home menu-icon"></i>
                <span class="menu-text">Dashboard</span>
            </a>
            <a href="{{ route('mwenyekiti.reports.index') }}" class="menu-item {{ request()->routeIs('mwenyekiti.reports.*') ? 'active' : '' }}">
                <i class="fas fa-chart-line menu-icon"></i>
                <span class="menu-text">Reports</span>
            </a>
        </div>

        <!-- Balozi Management -->
        <div class="menu-section">
            <div class="menu-section-title">Balozi Management</div>
            <a href="{{ route('mwenyekiti.balozi.create') }}" class="menu-item {{ request()->routeIs('mwenyekiti.balozi.create') ? 'active' : '' }}">
                <i class="fas fa-user-plus menu-icon"></i>
                <span class="menu-text">Add Balozi</span>
            </a>
            <a href="{{ route('mwenyekiti.balozi.index') }}" class="menu-item {{ request()->routeIs('mwenyekiti.balozi.index') ? 'active' : '' }}">
                <i class="fas fa-users menu-icon"></i>
                <span class="menu-text">Manage Balozi</span>
            </a>
        </div>

        <!-- Community Data & Records -->
        <div class="menu-section">
            <div class="menu-section-title">Community Data & Records</div>
            <a href="{{ route('mwenyekiti.watu.index') }}" class="menu-item {{ request()->routeIs('mwenyekiti.watu.*') ? 'active' : '' }}">
                <i class="fas fa-users menu-icon"></i>
                <span class="menu-text">Watu</span>
            </a>
            <a href="{{ route('mwenyekiti.kaya-maskini.index') }}" class="menu-item {{ request()->routeIs('mwenyekiti.kaya-maskini.*') ? 'active' : '' }}">
                <i class="fas fa-home menu-icon"></i>
                <span class="menu-text">Kaya Maskini</span>
            </a>
            <a href="{{ route('mwenyekiti.mahitaji.index') }}" class="menu-item {{ request()->routeIs('mwenyekiti.mahitaji.*') ? 'active' : '' }}">
                <i class="fas fa-wheelchair menu-icon"></i>
                <span class="menu-text">Watu wenye Mahitaji Maalumu</span>
            </a>
            <a href="{{ route('mwenyekiti.malalamiko.index') }}" class="menu-item {{ request()->routeIs('mwenyekiti.malalamiko.*') ? 'active' : '' }}">
                <i class="fas fa-exclamation-triangle menu-icon"></i>
                <span class="menu-text">Malalamiko</span>
            </a>
        </div>

        <!-- Services & Assistance -->
        <div class="menu-section">
            <div class="menu-section-title">Services & Assistance</div>
            <a href="{{ route('mwenyekiti.requests.index') }}" class="menu-item {{ request()->routeIs('mwenyekiti.requests.*') ? 'active' : '' }}">
                <i class="fas fa-hand-holding-heart menu-icon"></i>
                <span class="menu-text">Services Requested</span>
            </a>
            <a href="{{ route('mwenyekiti.support.index') }}" class="menu-item {{ request()->routeIs('mwenyekiti.support.*') ? 'active' : '' }}">
                <i class="fas fa-hands-helping menu-icon"></i>
                <span class="menu-text">Request Support</span>
            </a>
            <a href="{{ route('mwenyekiti.udhamini.index') }}" class="menu-item {{ request()->routeIs('mwenyekiti.udhamini.*') ? 'active' : '' }}">
                <i class="fas fa-file-signature menu-icon"></i>
                <span class="menu-text">Fomu ya Udhamini</span>
            </a>
        </div>

        <!-- Development & Progress -->
        <div class="menu-section">
            <div class="menu-section-title">Development & Progress</div>
            <a href="{{ route('mwenyekiti.maendeleo.index') }}" class="menu-item {{ request()->routeIs('mwenyekiti.maendeleo.*') ? 'active' : '' }}">
                <i class="fas fa-chart-bar menu-icon"></i>
                <span class="menu-text">Maendeleo ya Kila Siku</span>
            </a>
        </div>

        <!-- Communication -->
        <div class="menu-section">
            <div class="menu-section-title">Communication</div>
            <a href="{{ route('mwenyekiti.matangazo.index') }}" class="menu-item {{ request()->routeIs('mwenyekiti.matangazo.*') ? 'active' : '' }}">
                <i class="fas fa-bullhorn menu-icon"></i>
                <span class="menu-text">Matangazo</span>
            </a>
        </div>

        <!-- Meeting Management -->
        <div class="menu-section">
            <div class="menu-section-title">Meeting Management</div>
            <a href="{{ route('mwenyekiti.meetings.index') }}" class="menu-item {{ request()->routeIs('mwenyekiti.meetings.*') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt menu-icon"></i>
                <span class="menu-text">Mikutano</span>
            </a>
            <a href="{{ route('mwenyekiti.meeting-requests.index') }}" class="menu-item {{ request()->routeIs('mwenyekiti.meeting-requests.*') ? 'active' : '' }}">
                <i class="fas fa-calendar-check menu-icon"></i>
                <span class="menu-text">Maombi ya Mikutano</span>
            </a>
        </div>

        <!-- Account -->
        <div class="menu-section">
            <div class="menu-section-title">Account</div>
            <a href="{{ route('mwenyekiti.preferences.index') }}" class="menu-item {{ request()->routeIs('mwenyekiti.preferences.*') ? 'active' : '' }}">
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