<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo">
            <div class="logo-icon">B</div>
            <div class="logo-text">Dashibodi ya Balozi</div>
        </div>
        <div class="sidebar-toggle" id="sidebar-toggle">
            <i class="fas fa-chevron-left"></i>
        </div>
    </div>

    <div class="sidebar-menu">
        <div class="menu-section">
            <div class="menu-section-title">Kuu</div>
            <a href="#" class="menu-item">
                <div class="menu-icon"><i class="fas fa-home"></i></div>
                <div class="menu-text">Dashibodi</div>
            </a>
        </div>

        <div class="menu-section">
            <div class="menu-section-title">Maombi ya Mikutano</div>
            <a href="{{ route('balozi.mtaameetingrequest.create') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-calendar-plus"></i></div>
                <div class="menu-text">Omba Mkutano</div>
            </a>
            <a href="{{ route('balozi.mtaameetingrequest.index') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-calendar-check"></i></div>
                <div class="menu-text">Angalia Maombi ya Mikutano</div>
            </a>
        </div>

        <div class="menu-section">
            <div class="menu-section-title">Malalamiko</div>
            <a href="{{ route('balozi.malalamiko.create') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-exclamation-triangle"></i></div>
                <div class="menu-text">Sajili Malalamiko</div>
            </a>
            <a href="{{ route('balozi.malalamiko.index') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-clipboard-list"></i></div>
                <div class="menu-text">Angalia Malalamiko</div>
            </a>
        </div>

        <div class="menu-section">
            <div class="menu-section-title">Mahitaji Maalumu</div>
            <a href="{{ route('balozi.mahitaji-maalumu.create') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-hand-holding-heart"></i></div>
                <div class="menu-text">Sajili Watu wenye Mahitaji Maalumu</div>
            </a>
            <a href="{{ route('balozi.mahitaji-maalumu.index') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-users-cog"></i></div>
                <div class="menu-text">Angalia Watu wenye Mahitaji Maalumu</div>
            </a>
        </div>

        <div class="menu-section">
            <div class="menu-section-title">Kaya Maskini</div>
            <a href="{{ route('balozi.kaya-maskini.create') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-house-user"></i></div>
                <div class="menu-text">Sajili Kaya Maskini</div>
            </a>
            <a href="{{ route('balozi.kaya-maskini.index') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-house-flag"></i></div>
                <div class="menu-text">Angalia Kaya Maskini</div>
            </a>
        </div>

        <div class="menu-section">
            <div class="menu-section-title">Maendeleo ya Kila Siku</div>
            <a href="{{ route('balozi.daily-progress.create') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-chart-line"></i></div>
                <div class="menu-text">Ongeza Maendeleo</div>
            </a>
            <a href="{{ route('balozi.daily-progress.index') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-chart-bar"></i></div>
                <div class="menu-text">Angalia Maendeleo</div>
            </a>
        </div>

        <div class="menu-section">
            <div class="menu-section-title">Huduma</div>
            <a href="{{ route('balozi.services.create') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-hands-helping"></i></div>
                <div class="menu-text">Omba Huduma</div>
            </a>
            <a href="{{ route('balozi.services.index') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-list-check"></i></div>
                <div class="menu-text">Angalia Huduma Zilizoombwa</div>
            </a>
        </div>

        <div class="menu-section">
            <div class="menu-section-title">Watu</div>
            <a href="{{ route('balozi.watu.create') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-user-plus"></i></div>
                <div class="menu-text">Sajili Watu</div>
            </a>
            <a href="{{ route('balozi.watu.index') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-users"></i></div>
                <div class="menu-text">Angalia Watu Waliosajiliwa</div>
            </a>
        </div>

        <div class="menu-section">
            <div class="menu-section-title">Mipangilio</div>
            <a href="{{ route('balozi.preferences.index') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-gear"></i></div>
                <div class="menu-text">Mapendekezo</div>
            </a>
           <a href="{{ route('balozi.tickets.index') }}" class="menu-item">
                <div class="menu-icon"><i class="fas fa-headset"></i></div>
                <div class="menu-text">Omba Msaada</div>
            </a>
            <a href="#" class="menu-item">
                <div class="menu-icon"><i class="fas fa-right-from-bracket"></i></div>
                <div class="menu-text">Ondoka</div>
            </a>
        </div>
    </div>
</aside>
