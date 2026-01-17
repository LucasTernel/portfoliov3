@extends('layouts.app')

@section('content')

    <div class="skills-page-wrapper">
        <div class="skills-grid">
            
            <div class="skill-section">
                <h1 class="section-title">Compétences</h1>
                <ul class="orange-list">
                    <li>Developpement site Web / Site Vitrine</li>
                    <li>Design Intéractif / UX / UI</li>
                    <li>Référencement optimal</li>
                    <li>Designs adapté pour écrans</li>
                </ul>
            </div>

            <div class="skill-section">
                <h2 class="section-title">Langages</h2>
                <div class="language-list">
                    <div class="lang-item">
                        <span class="orange-dot"></span>
                        <span class="lang-name">Français</span>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 100%;"></div>
                        </div>
                    </div>
                    <div class="lang-item">
                        <span class="orange-dot"></span>
                        <span class="lang-name">Anglais</span>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 70%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="skill-section">
                <h2 class="section-title">Outils</h2>
                
                <div class="tools-grid">
                    <i class="fa-brands fa-laravel"></i>
                    
                    <i class="fa-brands fa-php"></i>
                    
                    <i class="fa-brands fa-js"></i>
                    
                    <i class="fa-brands fa-html5"></i>
                    
                    <i class="fa-brands fa-css3-alt"></i>
                    
                    <i class="fa-brands fa-wordpress"></i>
                    
                    <i class="fa-solid fa-desktop"></i>
                    
                    <i class="fa-brands fa-goodreads"></i>

                    <div class="fake-icon lr">Lr</div>

                    <div class="fake-icon ps">Ps</div>
                </div>
            </div>
            <div class="skill-section">
                <h2 class="section-title">Formation</h2>
                <ul class="orange-list formation-list">
                    <li>
                        <strong>Insitut Universitaire et Technologique ( IUT DE LENS )</strong>
                        <p>BUT Métiers du Multimédia et de l'Internet ( BUT MMI )</p>
                        <ul class="sub-list">
                            <li>Spécialisation dans le Parcours Développement WEB & Dispositifs Interactifs</li>
                        </ul>
                    </li>
                    <li>
                        <strong>Lycée Guy Mollet ( LGM )</strong>
                        <p>Baccalauréat Général</p>
                        <ul class="sub-list">
                            <li>Spécialités : NSI ( Informatique ) / SES ( Économie ) + Maths Complémentaires.</li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>

    </div>

@endsection