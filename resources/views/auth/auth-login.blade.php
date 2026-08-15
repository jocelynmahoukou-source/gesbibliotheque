<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — BiblioApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; margin: 0; padding: 0; box-sizing: border-box; }

        /* ── Arrière-plan bibliothèque ── */
        .auth-bg {
            min-height: 100vh;
            display: flex;
            position: relative;
            background-image: url('/images/bibliotheque.jpg');            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        /* Overlay sombre pour lisibilité */
        .auth-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(
                135deg,
                rgba(15, 23, 42, 0.88) 0%,
                rgba(30, 41, 59, 0.75) 50%,
                rgba(15, 23, 42, 0.82) 100%
            );
            backdrop-filter: blur(1px);
        }

        /* Panneau gauche — citation */
        .auth-left {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem 4rem;
            position: relative;
            z-index: 1;
        }
        .auth-left .brand {
            display: flex;
            align-items: center;
            gap: .75rem;
            margin-bottom: 3rem;
        }
        .brand-icon {
            width: 48px; height: 48px;
            background: #6366f1;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem; color: #fff;
        }
        .brand-name { color: #fff; font-size: 1.3rem; font-weight: 800; }
        .brand-sub  { color: #94a3b8; font-size: .72rem; }

        .auth-quote {
            border-left: 3px solid #6366f1;
            padding-left: 1.5rem;
            margin-bottom: 2.5rem;
        }
        .auth-quote blockquote {
            color: #e2e8f0;
            font-size: 1.35rem;
            font-weight: 300;
            line-height: 1.6;
            font-style: italic;
            margin: 0 0 .75rem;
        }
        .auth-quote cite { color: #64748b; font-size: .8rem; }

        .auth-features { display: flex; flex-direction: column; gap: .75rem; }
        .feat-item {
            display: flex; align-items: center; gap: .75rem;
            color: #94a3b8; font-size: .85rem;
        }
        .feat-item i { color: #6366f1; font-size: 1rem; width: 20px; }

        /* Panneau droit — formulaire */
        .auth-right {
            width: 460px;
            min-height: 100vh;
            background: rgba(255,255,255,0.97);
            backdrop-filter: blur(20px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 2.5rem;
            position: relative;
            z-index: 1;
            box-shadow: -20px 0 60px rgba(0,0,0,.3);
        }

        .auth-title { font-size: 1.5rem; font-weight: 800; color: #0f172a; margin-bottom: .3rem; }
        .auth-sub   { font-size: .85rem; color: #64748b; margin-bottom: 2rem; }

        .form-label   { font-size: .8rem; font-weight: 600; color: #374151; }
        .form-control {
            border-color: #d1d5db; border-radius: 10px;
            font-size: .9rem; padding: .7rem 1rem;
            transition: all .2s;
        }
        .form-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99,102,241,.12);
        }
        .eye-toggle {
            border-left: none; cursor: pointer;
            border-color: #d1d5db; background: #f8fafc;
            border-radius: 0 10px 10px 0 !important;
        }
        .eye-toggle:focus { box-shadow: none; border-color: #d1d5db; }

        .btn-login {
            background: #6366f1; border: none;
            border-radius: 10px; padding: .8rem;
            font-size: .92rem; font-weight: 600;
            width: 100%; color: #fff;
            transition: all .2s;
        }
        .btn-login:hover {
            background: #4f46e5;
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(99,102,241,.35);
        }

        .divider {
            display: flex; align-items: center; gap: 1rem;
            margin: 1.5rem 0; color: #9ca3af; font-size: .78rem;
        }
        .divider::before, .divider::after {
            content: ''; flex: 1; height: 1px; background: #e5e7eb;
        }

        .link-reg { color: #6366f1; text-decoration: none; font-weight: 600; }
        .link-reg:hover { color: #4f46e5; }

        .alert-danger {
            background: #fee2e2; color: #991b1b;
            border: none; border-radius: 10px; font-size: .85rem;
        }
        .badge-admin {
            background: #eef2ff; color: #6366f1;
            border-radius: 8px; padding: .25em .7em;
            font-size: .7rem; font-weight: 700;
        }

        /* Décoration image en bas */
        .photo-credit {
            position: absolute; bottom: 1rem; left: 50%;
            transform: translateX(-50%);
            color: rgba(255,255,255,.3); font-size: .68rem;
            z-index: 1; white-space: nowrap;
        }
        .photo-credit a { color: rgba(255,255,255,.4); text-decoration: none; }

        @media (max-width: 768px) {
            .auth-left  { display: none; }
            .auth-right { width: 100%; }
        }
    </style>
</head>
<body>

<div class="auth-bg">

    <!-- ── Panneau gauche ── -->
    <div class="auth-left">
        <div class="brand">
            <div class="brand-icon"><i class="bi bi-book-half"></i></div>
            <div>
                <div class="brand-name">BiblioApp</div>
                <div class="brand-sub">Système de gestion de bibliothèque</div>
            </div>
        </div>

        <div class="auth-quote">
            <blockquote>
                "Une maison sans livres est comme une chambre sans fenêtres."
            </blockquote>
            <cite>— Heinrich Mann</cite>
        </div>

        <div class="auth-features">
            <div class="feat-item"><i class="bi bi-check-circle-fill"></i> Gestion complète des livres et auteurs</div>
            <div class="feat-item"><i class="bi bi-check-circle-fill"></i> Suivi des emprunts en temps réel</div>
            <div class="feat-item"><i class="bi bi-check-circle-fill"></i> Alertes automatiques pour les retards</div>
            <div class="feat-item"><i class="bi bi-check-circle-fill"></i> Tableau de bord avec statistiques</div>
            <div class="feat-item"><i class="bi bi-shield-check-fill"></i> Accès sécurisé administrateur</div>
        </div>
    </div>

    <!-- ── Panneau droit — Formulaire ── -->
    <div class="auth-right">
        <div class="mb-4 d-flex align-items-center gap-2">
            <div style="width:36px;height:36px;background:#6366f1;border-radius:9px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1rem;">
                <i class="bi bi-book-half"></i>
            </div>
            <div style="font-weight:700;font-size:.95rem;color:#0f172a;">BiblioApp</div>
        </div>

        <h2 class="auth-title">
            Connexion <span class="badge-admin"><i class="bi bi-shield-fill me-1"></i>Admin</span>
        </h2>
        <p class="auth-sub">Accès réservé à l'administrateur du système.</p>

        @if($errors->any())
            <div class="alert alert-danger d-flex align-items-center gap-2 mb-3">
                <i class="bi bi-x-circle-fill"></i> {{ $errors->first() }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger d-flex align-items-center gap-2 mb-3">
                <i class="bi bi-x-circle-fill"></i> {{ session('error') }}
            </div>
        @endif
        @if(session('success'))
            <div class="alert d-flex align-items-center gap-2 mb-3" style="background:#d1fae5;color:#065f46;border:none;border-radius:10px;font-size:.85rem;">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Adresse e-mail</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="form-control" placeholder="admin@exemple.com" autofocus required>
            </div>
            <div class="mb-3">
                <label class="form-label">Mot de passe</label>
                <div class="input-group">
                    <input type="password" name="password" id="pwdInput"
                           class="form-control" placeholder="••••••••" required>
                    <button type="button" class="btn btn-outline-secondary eye-toggle" onclick="togglePwd()">
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember" style="font-size:.82rem;color:#64748b;">
                    Se souvenir de moi
                </label>
            </div>
            <button type="submit" class="btn-login">
                <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
            </button>
        </form>

        <div class="divider">ou</div>
        <p class="text-center mb-0" style="font-size:.85rem;color:#64748b;">
            Pas encore de compte ?
            <a href="{{ route('register') }}" class="link-reg">Créer un compte administrateur</a>
        </p>

        <div class="mt-4 pt-3 border-top text-center" style="font-size:.72rem;color:#94a3b8;">
            &copy; {{ date('Y') }} BiblioApp — Tous droits réservés
        </div>
    </div>

    <div class="photo-credit">
        Photo : <a href="https://unsplash.com/photos/library-books" target="_blank">Unsplash</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"></script>
<script>
function togglePwd() {
    const i = document.getElementById('pwdInput');
    const e = document.getElementById('eyeIcon');
    i.type = i.type === 'password' ? 'text' : 'password';
    e.className = i.type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
}
</script>
</body>
</html>
