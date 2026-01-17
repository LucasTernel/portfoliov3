@extends('layouts.app')

@section('content')

    <div class="xp-screen-wrapper">
        <h1 class="page-title">Expériences</h1>
        
        <div class="timeline-container">
            <div class="timeline-line"></div>
            <div class="xp-list-scroll">
                @foreach($experiences as $xp)
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            
                            <h2 class="xp-header-title">{{ $xp->title }} <span class="xp-date-span">( {{ $xp->date_range }} )</span></h2>
                            <h3 class="xp-role">{{ $xp->role }}</h3>
                            <p class="xp-description">{{ $xp->description }}</p>

                            @if($xp->liste)
                                <ul class="xp-list-bullets">
                                    @foreach($xp->liste as $point)
                                        <li>{{ $point }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            @if($xp->images)
                                <div class="xp-gallery">
                                    @php
                                        // On prépare la liste complète des URLs pour le JS
                                        $imageUrls = collect($xp->images)->map(function($img) use ($xp) {
                                            return Vite::asset("resources/images/experiences/{$xp->folder_name}/{$img}");
                                        });
                                    @endphp

                                    @foreach($xp->images as $index => $image)
                                        <div class="xp-img-box" 
                                             onclick="openLightbox(this)"
                                             data-index="{{ $index }}"
                                             data-images="{{ json_encode($imageUrls) }}"
                                             style="background-image: url('{{ Vite::asset('resources/images/experiences/' . $xp->folder_name . '/' . $image) }}')">
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div id="lightboxModal" class="lightbox-modal">
        <span class="close-btn" onclick="closeLightbox()">&times;</span>
        
        <img class="lightbox-content" id="lightboxImage">
        
        <a class="prev" onclick="changeSlide(-1)">&#10094;</a>
        <a class="next" onclick="changeSlide(1)">&#10095;</a>

        <div class="lightbox-dots-container" id="lightboxDots">
            </div>
    </div>
    
@endsection

<script>

    let currentImages = []; 
    let currentIndex = 0;   

    // Ouvre la modale
    function openLightbox(element) {
        currentImages = JSON.parse(element.getAttribute('data-images'));
        currentIndex = parseInt(element.getAttribute('data-index'));

        document.getElementById('lightboxModal').style.display = "flex";
        
        // --- AJOUT ICI ---
        // On bloque le scroll de la page principale
        document.body.style.overflow = 'hidden'; 
        
        updateLightbox();
    }

    // Ferme la modale
    function closeLightbox() {
        document.getElementById('lightboxModal').style.display = "none";
        
        // --- AJOUT ICI ---
        // On réactive le scroll de la page principale
        document.body.style.overflow = ''; 
    }

    // Change l'image
    function changeSlide(n) {
        currentIndex += n;
        if (currentIndex >= currentImages.length) currentIndex = 0;
        if (currentIndex < 0) currentIndex = currentImages.length - 1;
        updateLightbox();
    }

    // Aller à une image spécifique
    function jumpToSlide(index) {
        currentIndex = index;
        updateLightbox();
    }

    // Met à jour l'image et les points
    function updateLightbox() {
        document.getElementById('lightboxImage').src = currentImages[currentIndex];

        const dotsContainer = document.getElementById('lightboxDots');
        dotsContainer.innerHTML = "";

        currentImages.forEach((img, index) => {
            let dot = document.createElement("span");
            dot.className = "lightbox-dot";
            if (index === currentIndex) {
                dot.classList.add("active");
            }
            dot.onclick = function() { jumpToSlide(index); };
            dotsContainer.appendChild(dot);
        });
    }
</script>