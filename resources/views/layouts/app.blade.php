<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','BiblioApp')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root{--sbg:#0f172a;--shov:#1e293b;--acc:#6366f1;--bdr:#e2e8f0;--bgp:#f8fafc;}
        *{font-family:'Inter',sans-serif;}
        body{background:var(--bgp);margin:0;background-image: url('/images/bibliotheque.jpg');}
        #sidebar{position:fixed;top:0;left:0;width:260px;height:100vh;background:var(--sbg);display:flex;flex-direction:column;z-index:1000;overflow-y:auto;}
        .sl{padding:1.4rem 1.25rem .9rem;border-bottom:1px solid rgba(255,255,255,.07);}
        .sl .li{width:40px;height:40px;background:var(--acc);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;color:#fff;margin-bottom:.55rem;}
        .sl h5{color:#fff;font-weight:700;margin:0;font-size:1rem;}
        .sl small{color:#64748b;font-size:.7rem;}
        .snav{padding:1rem .75rem;flex:1;}
        .nst{color:#475569;font-size:.63rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;padding:.6rem .5rem .2rem;}
        .slink{display:flex;align-items:center;gap:.7rem;padding:.58rem .75rem;border-radius:8px;color:#94a3b8;text-decoration:none;font-size:.84rem;font-weight:500;transition:all .15s;margin-bottom:2px;}
        .slink:hover{background:var(--shov);color:#e2e8f0;}
        .slink.active{background:var(--acc);color:#fff;}
        .slink i{font-size:.95rem;width:18px;text-align:center;}
        .sidebar-footer{padding:.75rem 1rem;border-top:1px solid rgba(255,255,255,.07);}
        .admin-info{display:flex;align-items:center;gap:.65rem;padding:.5rem .75rem;border-radius:8px;background:rgba(255,255,255,.04);}
        .admin-av{width:32px;height:32px;border-radius:8px;background:var(--acc);display:flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:700;color:#fff;flex-shrink:0;}
        .admin-name{color:#e2e8f0;font-size:.8rem;font-weight:600;line-height:1.2;}
        .admin-role{color:#475569;font-size:.68rem;}
        .btn-logout{display:flex;align-items:center;gap:.6rem;padding:.5rem .75rem;border-radius:8px;color:#64748b;text-decoration:none;font-size:.8rem;font-weight:500;transition:all .15s;margin-top:.35rem;border:none;background:none;width:100%;cursor:pointer;}
        .btn-logout:hover{background:rgba(239,68,68,.15);color:#f87171;}
        #main{margin-left:260px;min-height:100vh;}
        .topbar{background:#fff;border-bottom:1px solid var(--bdr);padding:.875rem 2rem;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:500;}
        .tb-title{font-weight:700;font-size:1.05rem;color:#0f172a;margin:0;}
        .tb-bc{font-size:.75rem;color:#64748b;}
        .pcontent{padding:1.75rem 2rem;}
        .card{border:1px solid var(--bdr);border-radius:12px;box-shadow:0 1px 3px rgba(0,0,0,.04);}
        .sc{border-radius:12px;padding:1.4rem;border:1px solid var(--bdr);background:#fff;display:flex;align-items:flex-start;gap:1rem;}
        .sic{width:48px;height:48px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.25rem;flex-shrink:0;}
        .sl2{font-size:.72rem;color:#64748b;font-weight:600;text-transform:uppercase;letter-spacing:.04em;}
        .sv{font-size:1.75rem;font-weight:700;color:#0f172a;line-height:1.1;}
        .ss{font-size:.77rem;color:#64748b;margin-top:.15rem;}
        .tc{background:#fff;border-radius:12px;border:1px solid var(--bdr);overflow:hidden;}
        .th{padding:1.2rem 1.5rem;border-bottom:1px solid var(--bdr);display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;}
        .table>:not(caption)>*>*{padding:.8rem 1.2rem;}
        .table thead th{background:#f8fafc;font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:#64748b;border-bottom:1px solid var(--bdr);white-space:nowrap;}
        .table tbody tr:hover{background:#fafbff;}
        .table tbody td{font-size:.865rem;color:#334155;vertical-align:middle;}
        .bp{border-radius:20px;padding:.28em .72em;font-size:.7rem;font-weight:600;}
        .bs{background:#d1fae5;color:#065f46;}
        .bw{background:#fef3c7;color:#92400e;}
        .bd{background:#fee2e2;color:#991b1b;}
        .bi2{background:#e0f2fe;color:#075985;}
        .bm{background:#f1f5f9;color:#475569;}
        .btn-primary{background:var(--acc);border-color:var(--acc);}
        .btn-primary:hover{background:#4f46e5;border-color:#4f46e5;}
        .ba{padding:.32rem .58rem;font-size:.78rem;border-radius:7px;}
        .fc{background:#fff;border-radius:12px;border:1px solid var(--bdr);}
        .fch{padding:1.4rem;border-bottom:1px solid var(--bdr);}
        .fcb{padding:1.4rem;}
        .form-label{font-size:.8rem;font-weight:600;color:#374151;}
        .form-control,.form-select{border-color:#d1d5db;border-radius:8px;font-size:.875rem;}
        .form-control:focus,.form-select:focus{border-color:var(--acc);box-shadow:0 0 0 3px rgba(99,102,241,.1);}
        .alert{border-radius:10px;border:none;font-size:.875rem;}
        .alert-success{background:#d1fae5;color:#065f46;}
        .alert-danger{background:#fee2e2;color:#991b1b;}
        .sw2{position:relative;}
        .sw2 .bi{position:absolute;left:.75rem;top:50%;transform:translateY(-50%);color:#9ca3af;font-size:.9rem;}
        .si{border-radius:8px;border-color:#d1d5db;font-size:.85rem;padding-left:2.25rem;}
        .es{padding:3.5rem 2rem;text-align:center;}
        .es i{font-size:2.8rem;color:#cbd5e1;}
        .es h6{color:#64748b;margin-top:.75rem;}
        .es p{color:#94a3b8;font-size:.85rem;}
        .av{width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.78rem;font-weight:700;flex-shrink:0;}
    </style>
    @stack('styles')
</head>
<body>
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
        <a href="{{ route('auteurs.index') }}" class="slink {{ request()->routeIs('auteurs.*') ? 'active' : '' }}">
            <i class="bi bi-person-lines-fill"></i> Auteurs
        </a>
        <a href="{{ route('categories.index') }}" class="slink {{ request()->routeIs('categories.*') ? 'active' : '' }}">
            <i class="bi bi-tags"></i> Catégories
        </a>
        <a href="{{ route('livres.index') }}" class="slink {{ request()->routeIs('livres.*') ? 'active' : '' }}">
            <i class="bi bi-journals"></i> Livres
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
            <div class="admin-av">{{ strtoupper(substr(auth()->user()->prenom,0,1).substr(auth()->user()->nom,0,1)) }}</div>
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
        <div class="d-flex align-items-center gap-2" style="font-size:.82rem;color:#64748b;">
            <i class="bi bi-shield-check text-success"></i>
            Connecté en tant qu'administrateur
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
