<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo">
            <div class="logo-icon">B</div>
            <div class="logo-text">Balozi Dashboard</div>
        </div>
        <div class="sidebar-toggle" id="sidebar-toggle">
            <i class="fas fa-chevron-left"></i>
        </div>
    </div>

    <div class="sidebar-menu">
        <div class="menu-section">
            <div class="menu-section-title">Main</div>
            <a href="#" class="menu-item">
                <div class="menu-icon"><i class="fas fa-tachometer-alt"></i></div>
                <div class="menu-text">Dashboard</div>
            </a>
        </div>

        <div class="menu-section">
            <div class="menu-section-title">User Panel</div>
            <a href="#" class="menu-item">
                <div class="menu-icon"><i class="fas fa-user"></i></div>
                <div class="menu-text">Request  fomu ya  Udhamini</div>
            </a>
            <a href="#" class="menu-item">
                <div class="menu-icon"><i class="fas fa-file-alt"></i></div>
                <div class="menu-text">Request Meeting</div>
            </a>
           
            <a href="#" class="menu-item">
                <div class="menu-icon"><i class="fas fa-file-alt"></i></div>
                <div class="menu-text">Tuma Malalamiko</div>
            </a>
           <a href="#" class="menu-item">
                <div class="menu-icon"><i class="fas fa-file-alt"></i></div>
                <div class="menu-text">Write  Mapendekezo  ya  leo</div>
            </a>
        </div>
        <div class="menu-section">
            <div class="menu-section-title">Mahitaji Maalumu / Special Needs</div>
            <a href="#" class="menu-item">
                <div class="menu-icon"><i class="fas fa-cog"></i></div>
                <div class="menu-text">Sajili Watu wenye  mahitaji  maalumu </div>
            </a>
            <a href="#" class="menu-item">
                <div class="menu-icon"><i class="fas fa-sign-out-alt"></i></div>
                <div class="menu-text">Angalia  Watu  wenye  mahitaji  maalumu </div>
            </a>
        </div>
        <div class="menu-section">
            <div class="menu-section-title">Kaya Maskini</div>
            <a href="{{ route('balozi.kaya-maskini.create') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-plus-circle"></i></div>
                <div class="menu-text">Sajili Kaya Maskini</div>
            </a>
            <a href="{{ route('balozi.kaya-maskini.index') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-list-alt"></i></div>
                <div class="menu-text">Angalia  Kaya Maskini</div>
            </a>
        </div>
        <div class="menu-section">
            <div class="menu-section-title">Daily Progress</div>
            <a href="{{ route('balozi.daily-progress.create') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-plus-circle"></i></div>
                <div class="menu-text">Create Daily Progress</div>
            </a>
            <a href="{{ route('balozi.daily-progress.index') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-list-alt"></i></div>
                <div class="menu-text">View Daily Progress</div>
            </a>
        </div>
        
        <div class="menu-section">
            <div class="menu-section-title">Services / Huduma</div>
            <a href="{{ route('balozi.services.create') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-plus-circle"></i></div>
                <div class="menu-text">Request Services</div>
            </a>
            <a href="{{ route('balozi.services.index') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-list-alt"></i></div>
                <div class="menu-text">View Requested Services</div>
            </a>
        </div>
        
        <div class="menu-section">
            <div class="menu-section-title">Watu</div>
            <a href="{{ route('balozi.watu.create') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-plus-circle"></i></div>
                <div class="menu-text">Sajili Watu</div>
            </a>
            <a href="{{ route('balozi.watu.index') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-sign-out-alt"></i></div>
                <div class="menu-text">View Watu Registered</div>
            </a>
        </div>

        <div class="menu-section">
            <div class="menu-section-title">Settings</div>
            <a href="#" class="menu-item">
                <div class="menu-icon"><i class="fas fa-cog"></i></div>
                <div class="menu-text">Preferences</div>
            </a>
            <a href="#" class="menu-item">
                <div class="menu-icon"><i class="fas fa-sign-out-alt"></i></div>
                <div class="menu-text">Logout</div>
            </a>
        </div>
    </div>
</aside>
