@extends('layouts.app')

@section('content')

    <header class="site-header">
        <div class="logo">
            <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Logo Lucas Ternel">
        </div>

        <div class="status-badge">
            @if(isset($globalSettings) && $globalSettings->is_available)
                <div class="dot-container">
                    <span class="dot-ping green"></span>
                    <span class="dot-solid green"></span>
                </div>
                <span class="status-text">DISPONIBLE</span>
            @else
                <div class="dot-container">
                    <span class="dot-solid red"></span>
                </div>
                <span class="status-text" style="color: #aaa;">INDISPONIBLE</span>
            @endif
        </div>
    </header>

    <section class="hero-wrapper">
        
        <div class="hero-content">
            
            <h2 class="job-title">{{ $info->job_title }}</h2>
            
            <h1 class="main-name">
                {!! str_replace(' ', '<br>', e($info->fullname)) !!}
            </h1>

            <div class="info-grid">
                
                <div class="info-item">
                    <div class="icon-box-white">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <span>{{ $info->email }}</span>
                </div>

                <div class="info-item">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    <span>{{ $info->phone }}</span>
                </div>

                <div class="info-item">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>{{ $info->location }}</span>
                </div>

                <div class="info-item">
                    <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                    </svg>
                    <a href="https://{{ $info->linkedin }}" target="_blank" class="link-hover">
                        Mon Linkedin
                    </a>
                </div>

            </div>
        </div>

        <div class="hero-spacer"></div>
        
    </section>

@endsection