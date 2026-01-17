<head>
    <meta name="robots" content="noindex, nofollow">
</head>

<div class="navbar-container">
    <nav class="glass-nav">
        <div class="burger-menu" id="burgerMenu">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <a href="{{ route('admin.dashboard') }}" 
           class="nav-btn-home {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            Accueil
        </a>
        <div class="nav-items" id="navItems">

            <div class="nav-links">     
                <a href="{{ route('admin.dashboard') }}" class="nav-link-item mobile-only {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Home</a>       

                <a href="{{ route('admin.settings.index') }}" class="nav-link-item {{ request()->routeIs('admin.settings.index') ? 'active' : '' }}">Parametres</a>
                
                <a href="{{ route('admin.experiences.index') }}" class="nav-link-item {{ request()->routeIs('experience') ? 'active' : '' }}">Expériences</a>
                
                <a href="{{ route('admin.projects.index') }}" class="nav-link-item {{ request()->routeIs('admin.projects.index') ? 'active' : '' }}">Projets</a>
                
                <a href="{{ route('admin.logs.index') }}" class="nav-link-item {{ request()->routeIs('admin.logs.index') ? 'active' : '' }}">Logs</a>

                <a href="{{ route('admin.contacts.index') }}" class="nav-link-item {{ request()->routeIs('admin.contacts.index') ? 'active' : '' }}">Messagerie</a>
            </div>

            <form action="{{ route('admin.logout') }}" method="POST" style="margin: 0;">
                @csrf
                
                <button type="submit" class="cta-contact" style="border: none; cursor: pointer; font-family: inherit; font-size: inherit;">
                    
                    <span>DECONNEXION</span>

                    <div class="arrow-circle">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </div>

                </button>
            </form>       
            </nav>
        </div>
</div>

<script>
    const burger = document.getElementById('burgerMenu');
    const nav = document.getElementById('navItems');
    const body = document.body;
    
    // Pour fermer le menu quand on clique sur un lien
    const navLinks = document.querySelectorAll('.nav-btn-home, .nav-link-item, .cta-contact');

    if(burger) {
        burger.addEventListener('click', function() {
            this.classList.toggle('open');
            nav.classList.toggle('active');
            body.classList.toggle('no-scroll');
        });
    }

    navbar-container.forEach(link => {
        link.addEventListener('click', () => {
            if(burger) burger.classList.remove('open');
            if(nav) nav.classList.remove('active');
            body.classList.remove('no-scroll');
        });
    });
</script>