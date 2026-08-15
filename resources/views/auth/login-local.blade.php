<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — BiblioApp</title>

    {{-- Assets locaux compilés par Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Styles spécifiques aux pages auth (viennent en complément de app.css) */
        body.page-auth { display: flex; min-height: 100vh; }

        .left-panel {
            flex: 1; display: flex; flex-direction: column;
            justify-content: center; padding: 3rem 4rem;
        }
        .brand { display: flex; align-items: center; gap: .8rem; margin-bottom: 3rem; }
        .brand-icon {
            width: 46px; height: 46px; background: #6366f1;
            border-radius: 12px; display: flex; align-items: center;
            justify-content: center; font-size: 1.3rem; color: #fff;
        }
        .brand-name { color: #fff; font-size: 1.2rem; font-weight: 800; }
        .brand-sub  { color: #64748b; font-size: .72rem; }
        .quote { border-left: 3px solid #6366f1; padding-left: 1.25rem; margin-bottom: 2.5rem; }
        .quote blockquote { color: #cbd5e1; font-size: 1.2rem; font-style: italic; font-weight: 300; margin: 0 0 .5rem; line-height: 1.65; }
        .quote cite { color: #475569; font-size: .78rem; }
        .feat { display: flex; align-items: center; gap: .65rem; color: #94a3b8; font-size: .84rem; margin-bottom: .6rem; }
        .feat i { color: #6366f1; width: 18px; }

        .right-panel {
            width: 420px; min-height: 100vh; background: #fff;
            display: flex; flex-direction: column; justify-content: center;
            padding: 2.75rem 2.5rem; box-shadow: -16px 0 50px rgba(0,0,0,.28);
            position: relative;
        }
        .right-panel::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0;
            height: 4px; background: linear-gradient(90deg, #6366f1, #818cf8);
        }
        .form-logo { display: flex; align-items: center; gap: .65rem; margin-bottom: 2rem; }
        .form-logo-icon {
            width: 38px; height: 38px; background: #6366f1; border-radius: 9px;
            display: flex; align-items: center; justify-content: center; color: #fff; font-size: 1rem;
        }
        .form-logo-name { font-weight: 800; font-size: .95rem; color: #0f172a; }
        .form-title { font-size: 1.5rem; font-weight: 800; color: #0f172a; margin-bottom: 1.75rem; }
        .field-label { display: block; font-size: .78rem; font-weight: 600; color: #374151; margin-bottom: .3rem; }
        .field-input {
            width: 100%; border: 1.5px solid #e2e8f0; border-radius: 9px;
            padding: .7rem .9rem; font-size: .9rem; color: #0f172a;
            outline: none; transition: border-color .15s, box-shadow .15s;
            font-family: 'Inter', sans-serif; background: #fff;
        }
        .field-input:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,.12); }
        .mb-f { margin-bottom: 1rem; }
        .pwd-wrap { display: flex; }
        .pwd-wrap .field-input { border-radius: 9px 0 0 9px; border-right: none; }
        .eye-btn {
            border: 1.5px solid #e2e8f0; border-left: none; border-radius: 0 9px 9px 0;
            background: #f8fafc; padding: 0 .85rem; cursor: pointer; color: #9ca3af;
        }
        .eye-btn:hover { color: #6366f1; }
        .remember { display: flex; align-items: center; gap: .5rem; margin-bottom: 1.5rem; }
        .remember input { accent-color: #6366f1; width: 15px; height: 15px; }
        .remember label { font-size: .82rem; color: #64748b; cursor: pointer; }
        .btn-login {
            width: 100%; background: #6366f1; color: #fff; border: none;
            border-radius: 9px; padding: .8rem; font-size: .92rem; font-weight: 600;
            cursor: pointer; transition: background .15s, transform .1s;
            font-family: 'Inter', sans-serif;
        }
        .btn-login:hover { background: #4f46e5; box-shadow: 0 6px 20px rgba(99,102,241,.35); transform: translateY(-1px); }
        .divider { display: flex; align-items: center; gap: .9rem; margin: 1.4rem 0; color: #cbd5e1; font-size: .78rem; }
        .divider::before, .divider::after { content: ''; flex: 1; height: 1px; background: #f1f5f9; }
        .reg-link { text-align: center; font-size: .84rem; color: #64748b; }
        .reg-link a { color: #6366f1; font-weight: 600; text-decoration: none; }
        .alert-err {
            background: #fef2f2; border: 1px solid #fecaca; border-radius: 8px;
            padding: .7rem .9rem; font-size: .82rem; color: #dc2626;
            display: flex; align-items: center; gap: .5rem; margin-bottom: 1.25rem;
        }
        .alert-ok {
            background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px;
            padding: .7rem .9rem; font-size: .82rem; color: #16a34a;
            display: flex; align-items: center; gap: .5rem; margin-bottom: 1.25rem;
        }
        @media (max-width: 768px) { .left-panel { display: none; } .right-panel { width: 100%; } }
    </style>
</head>

{{-- Classe "page-auth" → overlay sombre sur l'image --}}
<body class="page-auth">

    <div class="left-panel">
        <div class="brand">
            <div class="brand-icon"><i class="bi bi-book-half"></i></div>
            <div>
                <div class="brand-name">BiblioApp</div>
                <div class="brand-sub">Système de gestion de bibliothèque</div>
            </div>
        </div>
        <div class="quote">
            <blockquote>"Une maison sans livres est comme une chambre sans fenêtres."</blockquote>
            <cite>— Heinrich Mann</cite>
        </div>
        <div class="feat"><i class="bi bi-check-circle-fill"></i> Catalogue complet : livres, auteurs, catégories</div>
        <div class="feat"><i class="bi bi-check-circle-fill"></i> Suivi des emprunts et retours</div>
        <div class="feat"><i class="bi bi-check-circle-fill"></i> Alertes automatiques pour les retards</div>
        <div class="feat"><i class="bi bi-check-circle-fill"></i> Tableau de bord avec statistiques</div>
    </div>

    <div class="right-panel">
        <div class="form-logo">
            <div class="form-logo-icon"><i class="bi bi-book-half"></i></div>
            <div class="form-logo-name">BiblioApp</div>
        </div>
        <div class="form-title">Connexion</div>

        @if($errors->any())
            <div class="alert-err"><i class="bi bi-exclamation-circle-fill"></i> {{ $errors->first() }}</div>
        @endif
        @if(session('error'))
            <div class="alert-err"><i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="alert-ok"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-f">
                <label class="field-label" for="email">E-mail</label>
                <input id="email" type="email" name="email" class="field-input"
                       value="{{ old('email') }}" placeholder="admin@exemple.com" autofocus required>
            </div>
            <div class="mb-f">
                <label class="field-label" for="password">Mot de passe</label>
                <div class="pwd-wrap">
                    <input id="password" type="password" name="password"
                           class="field-input" placeholder="••••••••" required>
                    <button type="button" class="eye-btn" onclick="togglePwd()">
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>
            <div class="remember">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Se souvenir de moi</label>
            </div>
            <button type="submit" class="btn-login">Se connecter</button>
        </form>

        <div class="divider">ou</div>
        <div class="reg-link">Pas de compte ? <a href="{{ route('register') }}">Créer un compte</a></div>
    </div>

<script>
function togglePwd() {
    const p = document.getElementById('password'), i = document.getElementById('eyeIcon');
    p.type = p.type === 'password' ? 'text' : 'password';
    i.className = p.type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
}
</script>
</body>
</html>
