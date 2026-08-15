<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','BiblioApp')</title>

    {{-- Assets compilés localement via Vite (Bootstrap + CSS + JS) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- Classe "page-app" → overlay léger pour les pages intérieures --}}
<body class="page-app">

<nav id="sidebar">
    <div class="sl">
        <div class="li"><i class="bi bi-book-half"></i></div>
        <h5>BiblioApp</h5>
        <small>Gestion de bibliothèque</small>
    </div>
    <div class="snav">
        <div class="nst">Navigation</div>
        <a href="{{ route('dashboard') }}" class="slink {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Tableau de bord
        </a>
        <div class="nst" style="margin-top:.5rem">Catalogue</div>
        <a href="{{ route('livres.index') }}" class="slink {{ request()->routeIs('livres.*') ? 'active' : '' }}">
            <i class="bi bi-journals"></i> Livres
        </a>
        <a href="{{ route('auteurs.index') }}" class="slink {{ request()->routeIs('auteurs.*') ? 'active' : '' }}">
            <i class="bi bi-person-lines-fill"></i> Auteurs
        </a>
        <a href="{{ route('categories.index') }}" class="slink {{ request()->routeIs('categories.*') ? 'active' : '' }}">
            <i class="bi bi-tags"></i> Catégories
        </a>
        <div class="nst" style="margin-top:.5rem">Membres & Prêts</div>
        <a href="{{ route('adherents.index') }}" class="slink {{ request()->routeIs('adherents.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Adhérents
        </a>
        <a href="{{ route('emprunts.index') }}" class="slink {{ request()->routeIs('emprunts.*') ? 'active' : '' }}">
            <i class="bi bi-arrow-left-right"></i> Emprunts
        </a>
        <a href="{{ route('emprunts.enRetard') }}" class="slink {{ request()->routeIs('emprunts.enRetard') ? 'active' : '' }}">
            <i class="bi bi-exclamation-triangle"></i> Retards
        </a>
    </div>
    <div class="sidebar-footer">
        <div class="admin-info">
            <div class="admin-av">
                {{ strtoupper(substr(auth()->user()->prenom,0,1).substr(auth()->user()->nom,0,1)) }}
            </div>
            <div>
                <div class="admin-name">{{ auth()->user()->prenom }} {{ auth()->user()->nom }}</div>
                <div class="admin-role">Administrateur</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="bi bi-box-arrow-left"></i> Se déconnecter
            </button>
        </form>
    </div>
</nav>

<div id="main">
    <div class="topbar">
        <div>
            <div class="tb-bc">BiblioApp / @yield('breadcrumb','Accueil')</div>
            <h1 class="tb-title">@yield('page-title','Tableau de bord')</h1>
        </div>
        <div style="font-size:.82rem;color:#64748b;">
            <i class="bi bi-shield-check text-success"></i> Administrateur
        </div>
    </div>

    <div class="px-4 pt-3">
        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center gap-2 mb-0">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger d-flex align-items-center gap-2 mb-0">
                <i class="bi bi-x-circle-fill"></i> {{ session('error') }}
            </div>
        @endif
    </div>

    <div class="pcontent">@yield('content')</div>
</div>

</body>
</html>
