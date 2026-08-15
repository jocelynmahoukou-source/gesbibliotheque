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
        *{font-family:'Inter',sans-serif;}
        body{background:linear-gradient(135deg,#0f172a 0%,#1e293b 50%,#0f172a 100%);min-height:100vh;display:flex;align-items:center;justify-content:center;padding:1.5rem;}
        .auth-card{background:#fff;border-radius:20px;padding:2.5rem;width:100%;max-width:460px;box-shadow:0 25px 60px rgba(0,0,0,.35);}
        .logo-wrap{display:flex;align-items:center;gap:.75rem;margin-bottom:1.75rem;}
        .logo-icon{width:46px;height:46px;background:#6366f1;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.3rem;color:#fff;}
        .logo-text h5{font-weight:800;margin:0;font-size:1.15rem;color:#0f172a;}
        .logo-text small{color:#64748b;font-size:.72rem;}
        .auth-title{font-size:1.3rem;font-weight:700;color:#0f172a;margin-bottom:.25rem;}
        .auth-sub{font-size:.84rem;color:#64748b;margin-bottom:1.5rem;}
        .form-label{font-size:.8rem;font-weight:600;color:#374151;}
        .form-control{border-color:#d1d5db;border-radius:10px;font-size:.88rem;padding:.65rem 1rem;}
        .form-control:focus{border-color:#6366f1;box-shadow:0 0 0 3px rgba(99,102,241,.12);}
        .btn-register{background:#6366f1;border:none;border-radius:10px;padding:.75rem;font-size:.9rem;font-weight:600;width:100%;color:#fff;transition:all .2s;}
        .btn-register:hover{background:#4f46e5;transform:translateY(-1px);box-shadow:0 6px 20px rgba(99,102,241,.35);}
        .link-login{color:#6366f1;text-decoration:none;font-weight:600;}
        .link-login:hover{color:#4f46e5;}
        .alert-danger{background:#fee2e2;color:#991b1b;border:none;border-radius:10px;font-size:.83rem;}
        .info-box{background:#f0fdf4;border:1px solid #bbf7d0;border-radius:10px;padding:.85rem 1rem;margin-bottom:1.5rem;font-size:.82rem;color:#065f46;}
        .strength-bar{height:4px;border-radius:2px;transition:all .3s;background:#e5e7eb;margin-top:.4rem;}
        .eye-toggle{border-left:none;cursor:pointer;border-color:#d1d5db;background:#f8fafc;}
        .eye-toggle:focus{box-shadow:none;border-color:#d1d5db;}
    </style>
</head>
<body>
<div class="auth-card">
    <div class="logo-wrap">
        <div class="logo-icon"><i class="bi bi-book-half"></i></div>
        <div class="logo-text">
            <h5>BiblioApp</h5>
            <small>Système de gestion de bibliothèque</small>
        </div>
    </div>

    <h2 class="auth-title">Créer un compte administrateur</h2>
    <p class="auth-sub">Ce compte vous donnera un accès complet au système.</p>

    <div class="info-box">
        <i class="bi bi-info-circle-fill me-2"></i>
        <strong>Compte unique :</strong> une seule inscription est autorisée. Ce compte sera l'administrateur du système.
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
                <input type="text" name="prenom" value="{{ old('prenom') }}" class="form-control" placeholder="Jean" required>
            </div>
            <div class="col-6">
                <label class="form-label">Nom <span class="text-danger">*</span></label>
                <input type="text" name="nom" value="{{ old('nom') }}" class="form-control" placeholder="Dupont" required>
            </div>
            <div class="col-12">
                <label class="form-label">Adresse e-mail <span class="text-danger">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="admin@bibliotheque.com" required>
            </div>
            <div class="col-12">
                <label class="form-label">Mot de passe <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="password" name="password" id="pwd1" class="form-control" placeholder="Min. 8 caractères"
                           oninput="checkStrength(this.value)" required>
                    <button type="button" class="btn btn-outline-secondary eye-toggle" onclick="toggle('pwd1','eye1')">
                        <i class="bi bi-eye" id="eye1"></i>
                    </button>
                </div>
                <div class="strength-bar mt-1" id="strengthBar"></div>
                <div id="strengthText" style="font-size:.72rem;color:#64748b;margin-top:.2rem;"></div>
            </div>
            <div class="col-12">
                <label class="form-label">Confirmer le mot de passe <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="password" name="password_confirmation" id="pwd2" class="form-control" placeholder="Répétez le mot de passe" required>
                    <button type="button" class="btn btn-outline-secondary eye-toggle" onclick="toggle('pwd2','eye2')">
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
</div>
<script>
function toggle(id,eid){const i=document.getElementById(id),e=document.getElementById(eid);i.type=i.type==='password'?'text':'password';e.className=i.type==='password'?'bi bi-eye':'bi bi-eye-slash';}
function checkStrength(v){
    const bar=document.getElementById('strengthBar'),txt=document.getElementById('strengthText');
    let s=0,msg='',color='';
    if(v.length>=8)s++;if(/[A-Z]/.test(v))s++;if(/[0-9]/.test(v))s++;if(/[^A-Za-z0-9]/.test(v))s++;
    if(s<=1){msg='Faible';color='#ef4444';}else if(s===2){msg='Moyen';color='#f59e0b';}else if(s===3){msg='Fort';color='#10b981';}else{msg='Très fort';color='#059669';}
    bar.style.background=color;bar.style.width=(s*25)+'%';txt.textContent=v?'Force : '+msg:'';
}
</script>
</body>
</html>
