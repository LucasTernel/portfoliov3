@extends('layouts.app')

@section('content')

    <div class="projects-screen-wrapper">
        
        <div class="projects-title-section">
            <h1 class="page-title-projects">Projets</h1>
        </div>

        <div class="projects-controls-row">
            <div class="filter-dropdown">
                <button class="btn-filter" onclick="toggleFilterMenu(event)">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                    </svg>
                    <span>Filtres</span>
                </button>
                <div class="filter-menu" id="filterMenu">
                    <button onclick="filterProjects('all')">Tout voir</button>
                    <div class="filter-divider"></div>
                    <button onclick="filterProjects('web')">Web</button>
                    <button onclick="filterProjects('audiovisuel')">Audiovisuel</button>
                    <button onclick="filterProjects('communication')">Communication</button>
                </div>
            </div>

            <div class="search-container">
                <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#999" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input type="text" id="searchInput" placeholder="Rechercher une Oeuvre" onkeyup="searchProjects()">
            </div>
        </div>

        <div class="projects-grid" id="projectsGrid">
            
            @if($projects->count() > 0)
                
                @foreach($projects as $project)
                    <div class="project-card-outer" 
                         data-category="{{ strtolower($project->category) }}" 
                         data-name="{{ strtolower($project->title) }}">
                        
                        <div class="card-image-header"
                             style="background-image: url('{{ Vite::asset('resources/images/projects/' . $project->folder_name . '/' . $project->thumbnail) }}')">
                        </div>

                        <div class="card-content-bottom">
                            
                            <div class="cat-badge">{{ strtoupper($project->category) }}</div>

                            <h2 class="card-proj-title">{{ $project->title }}</h2>
                            <p class="card-proj-desc">{{ $project->short_description }}</p>

                            <a href="{{ route('project.details', $project->folder_name) }}" class="btn-arrow-circle">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                            </a>
                        </div>

                    </div>
                @endforeach

            @else
                <div class="no-projects-message">Aucun Projet pour le moment.</div>
            @endif

            <div id="noResultsJS" class="no-projects-message" style="display: none;">
                Aucun projet ne correspond à votre recherche.
            </div>

        </div>
    </div>

    <script>
    // 1. GESTION MENU DÉROULANT (UX AMÉLIORÉE)
    function toggleFilterMenu(event) {
        // Empêche le clic de se propager au document (sinon ça ferme tout de suite)
        event.stopPropagation();
        
        const menu = document.getElementById('filterMenu');
        menu.classList.toggle('show');
    }

    // Détecte n'importe quel clic sur la page entière
    document.addEventListener('click', function(event) {
        const menu = document.getElementById('filterMenu');
        const filterButton = document.querySelector('.btn-filter');

        // Si le menu est ouvert...
        if (menu.classList.contains('show')) {
            // ... et que le clic N'EST PAS sur le menu NI sur le bouton
            if (!menu.contains(event.target) && !filterButton.contains(event.target)) {
                menu.classList.remove('show');
            }
        }
    });

    // 2. FILTRES (Logique inchangée)
    function filterProjects(category) {
        let cards = document.querySelectorAll('.project-card-outer');
        let count = 0;
        
        // Ferme le menu après avoir choisi
        document.getElementById('filterMenu').classList.remove('show');
        
        // Reset recherche
        document.getElementById('searchInput').value = '';

        cards.forEach(card => {
            let cardCat = card.getAttribute('data-category');
            if (category === 'all' || cardCat === category) {
                card.style.display = 'flex';
                count++;
            } else {
                card.style.display = 'none';
            }
        });
        toggleNoResults(count);
    }

    // 3. RECHERCHE (Logique inchangée)
    function searchProjects() {
        let input = document.getElementById('searchInput').value.toLowerCase();
        let cards = document.querySelectorAll('.project-card-outer');
        let count = 0;

        // Ferme le menu si on tape une recherche
        document.getElementById('filterMenu').classList.remove('show');

        cards.forEach(card => {
            let name = card.getAttribute('data-name');
            if (name.includes(input)) {
                card.style.display = 'flex';
                count++;
            } else {
                card.style.display = 'none';
            }
        });
        toggleNoResults(count);
    }

    // Gestion message vide
    function toggleNoResults(count) {
        let msg = document.getElementById('noResultsJS');
        if(msg) msg.style.display = (count === 0) ? 'block' : 'none';
    }
</script>
@endsection