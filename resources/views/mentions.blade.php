@extends('layouts.app')

@section('title', 'Mentions Légales - Lucas Ternel')

@section('content')

    <div class="mentions_legales-screen-wrapper">
        
        <h1 class="page-title">Mentions Légales</h1>

        <div class="legal-content-container">
            
            <section class="legal-section">
                <h2>1. Éditeur du site</h2>
                <p>
                    <strong>Propriétaire :</strong> {!! str_replace(' ', ' ', e($info->fullname)) !!}<br>
                    <strong>Email :</strong> <a href="mailto:{{ $info->email ?? 'contact@example.com' }}">{{ $info->email ?? 'contact@example.com' }}</a><br>
                    <strong>Téléphone :</strong> {{ $info->phone ?? '06 00 00 00 00' }}
                </p>
            </section>

            <section class="legal-section">
                <h2>2. Hébergement</h2>
                <p>
                    Ce site est hébergé par :<br>
                    <strong>Nom de l'hébergeur :</strong>Hostinger<br>
                    <strong>Adresse :</strong> Kaunas, Lituanie<br>
                    <strong>Site web :</strong> <a href ="https://www.hostinger.com/fr"> Lien vers l'hébergeur </a>
                </p>
            </section>

            <section class="legal-section">
                <h2>3. Propriété Intellectuelle</h2>
                <p>
                    L’ensemble de ce site relève de la législation française et internationale sur le droit d’auteur et la propriété intellectuelle. 
                    Tous les droits de reproduction sont réservés, y compris pour les documents téléchargeables et les représentations iconographiques et photographiques.
                    Toute reproduction sans autorisation explicite est interdite.
                </p>
            </section>

            <section class="legal-section">
                <h2>4. Données Personnelles</h2>
                <p>
                    Les informations recueillies via le formulaire de contact sont destinées uniquement à Lucas Ternel afin de répondre aux demandes. 
                    Elles ne sont ni vendues ni transmises à des tiers. Conformément à la loi "Informatique et Libertés", vous disposez d'un droit d'accès, 
                    de rectification et de suppression des données vous concernant.
                </p>
            </section>

        </div>

        <div class="legal-footer-action">
            <a href="{{ route('home') }}" class="back-link">← Retour à l'accueil</a>
        </div>

    </div>

@endsection