<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte — BiblioApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; margin: 0; padding: 0; box-sizing: border-box; }

        .auth-bg {
            min-height: 100vh;
            display: flex;
            position: relative;
            background-image: url('/images/bibliotheque.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
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

        .auth-left {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem 4rem;
            position: relative;
            z-index: 1;
        }
        .brand { display: flex; align-items: center; gap: .75rem; margin-bottom: 3rem; }
        .brand-icon {
            width: 48px; height: 48px; background: #6366f1;
            border-radius: 12px; display: flex; align-items: center;
            justify-content: center; font-size: 1.4rem; color: #fff;
        }
        .brand-name { color: #fff; font-size: 1.3rem; font-weight: 800; }
        .brand-sub  { color: #94a3b8; font-size: .72rem; }

        .step-list { display: flex; flex-direction: column; gap: 1.5rem; }
        .step-item { display: flex; align-items: flex-start; gap: 1rem; }
        .step-num {
            width: 32px; height: 32px; background: #6366f1;
            border-radius: 50%; display: flex; align-items: center;
            justify-content: center; color: #fff; font-size: .8rem;
            font-weight: 700; flex-shrink: 0; margin-top: 1px;
        }
        .step-text h6 { color: #e2e8f0; font-size: .88rem; font-weight: 600; margin: 0 0 .2rem; }
        .step-text p  { color: #64748b; font-size: .78rem; margin: 0; line-height: 1.5; }

        .auth-right {
            width: 480px;
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

        .auth-title { font-size: 1.4rem; font-weight: 800; color: #0f172a; margin-bottom: .3rem; }
        .auth-sub   { font-size: .84rem; color: #64748b; margin-bottom: 1.5rem; }

        .info-box {
            background: #f0fdf4; border: 1px solid #bbf7d0;
            border-radius: 10px; padding: .85rem 1rem;
            font-size: .82rem; color: #065f46; margin-bottom: 1.5rem;
        }
        .form-label { font-size: .8rem; font-weight: 600; color: #374151; }
        .form-control {
            border-color: #d1d5db; border-radius: 10px;
            font-size: .88rem; padding: .68rem 1rem;
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

        .strength-wrap { margin-top: .4rem; }
        .strength-bar {
            height: 4px; border-radius: 2px;
            background: #e5e7eb; transition: all .3s;
        }
        .strength-label { font-size: .7rem; color: #64748b; margin-top: .2rem; }

        .btn-register {
            background: #6366f1; border: none;
            border-radius: 10px; padding: .8rem;
            font-size: .92rem; font-weight: 600;
            width: 100%; color: #fff; transition: all .2s;
        }
        .btn-register:hover {
            background: #4f46e5; transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(99,102,241,.35);
        }
        .link-login { color: #6366f1; text-decoration: none; font-weight: 600; }
        .link-login:hover { color: #4f46e5; }
        .alert-danger {
            background: #fee2e2; color: #991b1b;
            border: none; border-radius: 10px; font-size: .83rem;
        }
        .photo-credit {
            position: absolute; bottom: 1rem; left: 50%;
            transform: translateX(-50%);
            color: rgba(255,255,255,.3); font-size: .68rem; z-index: 1;
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

        <div class="mb-4" style="color:#94a3b8;font-size:.85rem;font-weight:600;text-transform:uppercase;letter-spacing:.06em;">
            Étapes de démarrage
        </div>

        <div class="step-list">
            <div class="step-item">
                <div class="step-num">1</div>
                <div class="step-text">
                    <h6>Créer votre compte administrateur</h6>
                    <p>Renseignez vos informations. Ce compte est unique et sécurisé.</p>
                </div>
            </div>
            <div class="step-item">
                <div class="step-num">2</div>
                <div class="step-text">
                    <h6>Configurer le catalogue</h6>
                    <p>Ajoutez vos catégories, auteurs et livres.</p>
                </div>
            </div>
            <div class="step-item">
                <div class="step-num">3</div>
                <div class="step-text">
                    <h6>Enregistrer les adhérents</h6>
                    <p>Créez les fiches des membres de la bibliothèque.</p>
                </div>
            </div>
            <div class="step-item">
                <div class="step-num">4</div>
                <div class="step-text">
                    <h6>Gérer les emprunts</h6>
                    <p>Suivez les prêts, retours et relances en retard.</p>
                </div>
            </div>
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

        <h2 class="auth-title">Créer un compte administrateur</h2>
        <p class="auth-sub">Accès complet au système de gestion de bibliothèque.</p>

        <div class="info-box">
            <i class="bi bi-info-circle-fill me-2"></i>
            <strong>Compte unique :</strong> une seule inscription est autorisée sur ce système.
        </div>

        @if($errors->any())
            <div class="alert alert-danger mb-3">
                <i class="bi bi-x-circle-fill me-2"></i>
                @foreach($errors->all() as $e) {{ $e }}<br> @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row g-3">
                <div class="col-6">
                    <label class="form-label">Prénom <span class="text-danger">*</span></label>
                    <input type="text" name="prenom" value="{{ old('prenom') }}"
                           class="form-control" placeholder="Jean" required>
                </div>
                <div class="col-6">
                    <label class="form-label">Nom <span class="text-danger">*</span></label>
                    <input type="text" name="nom" value="{{ old('nom') }}"
                           class="form-control" placeholder="Dupont" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Adresse e-mail <span class="text-danger">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="form-control" placeholder="admin@bibliotheque.com" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Mot de passe <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="password" name="password" id="pwd1"
                               class="form-control" placeholder="Min. 8 caractères"
                               oninput="checkStrength(this.value)" required>
                        <button type="button" class="btn btn-outline-secondary eye-toggle"
                                onclick="toggle('pwd1','eye1')">
                            <i class="bi bi-eye" id="eye1"></i>
                        </button>
                    </div>
                    <div class="strength-wrap">
                        <div class="strength-bar" id="strengthBar" style="width:0"></div>
                        <div class="strength-label" id="strengthText"></div>
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label">Confirmer le mot de passe <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="password" name="password_confirmation" id="pwd2"
                               class="form-control" placeholder="Répétez le mot de passe" required>
                        <button type="button" class="btn btn-outline-secondary eye-toggle"
                                onclick="toggle('pwd2','eye2')">
                            <i class="bi bi-eye" id="eye2"></i>
                        </button>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn-register mt-4">
                <i class="bi bi-person-check me-2"></i>Créer mon compte
            </button>
        </form>

        <p class="text-center mt-3 mb-0" style="font-size:.84rem;color:#64748b;">
            Déjà un compte ? <a href="{{ route('login') }}" class="link-login">Se connecter</a>
        </p>

        <div class="mt-4 pt-3 border-top text-center" style="font-size:.72rem;color:#94a3b8;">
            &copy; {{ date('Y') }} BiblioApp — Tous droits réservés
        </div>
    </div>

    <div class="photo-credit">
        Photo : <a href="https://unsplash.com/photos/library-books" target="_blank">Unsplash</a>
    </div>
</div>

<script>
function toggle(id, eid) {
    const i = document.getElementById(id), e = document.getElementById(eid);
    i.type = i.type === 'password' ? 'text' : 'password';
    e.className = i.type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
}
function checkStrength(v) {
    const bar = document.getElementById('strengthBar');
    const txt = document.getElementById('strengthText');
    let s = 0;
    if (v.length >= 8) s++;
    if (/[A-Z]/.test(v)) s++;
    if (/[0-9]/.test(v)) s++;
    if (/[^A-Za-z0-9]/.test(v)) s++;
    const levels = [
        { label:'', color:'#e5e7eb' },
        { label:'Faible', color:'#ef4444' },
        { label:'Moyen', color:'#f59e0b' },
        { label:'Fort', color:'#10b981' },
        { label:'Très fort', color:'#059669' },
    ];
    const l = levels[s] || levels[0];
    bar.style.background = l.color;
    bar.style.width = (s * 25) + '%';
    txt.textContent = v ? 'Force : ' + l.label : '';
    txt.style.color = l.color;
}
</script>
</body>
</html>
