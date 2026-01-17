<div class="navbar-container">
    <nav class="glass-nav">
        <div class="burger-menu" id="burgerMenu">
            <span></span>
            <span></span>
            <span></span>
        </div>
        
        <a href="{{ route('home') }}" 
           class="nav-btn-home {{ request()->routeIs('home') ? 'active' : '' }}">
            Home
        </a>

        

        <div class="nav-items" id="navItems">
            
            <div class="nav-links">
                <a href="{{ route('home') }}" class="nav-link-item mobile-only {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="nav-link-item {{ request()->routeIs('about') ? 'active' : '' }}">A Propos</a>
                <a href="{{ route('skills') }}" class="nav-link-item {{ request()->routeIs('skills') ? 'active' : '' }}">Skills</a>
                <a href="{{ route('experience') }}" class="nav-link-item {{ request()->routeIs('experience') ? 'active' : '' }}">Expérience</a>
                <a href="{{ route('projects') }}" class="nav-link-item {{ request()->routeIs('projects') ? 'active' : '' }}">Projets</a>
                <a href="{{ route('links') }}" class="nav-link-item {{ request()->routeIs('links') ? 'active' : '' }}">Liens</a>
            </div>

            <a href="{{ route('contact') }}" class="cta-contact">
                <span>Me Contacter</span>
                <div class="arrow-circle">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>

        </div>

    </nav>
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