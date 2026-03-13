@extends('layouts.app')

@section('title', 'Expériences - Lucas Ternel')


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
                                            return asset("images/experiences/{$xp->folder_name}/{$img}");
                                        });
                                    @endphp

                                    @foreach($xp->images as $index => $image)
                                        <div class="xp-img-box" 
                                             onclick="openLightbox(this)"
                                             data-index="{{ $index }}"
                                             data-images="{{ json_encode($imageUrls) }}"
                                             style="background-image: url('{{ asset("images/experiences/{$xp->folder_name}/{$image}") }}')">
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
    
@endsection

