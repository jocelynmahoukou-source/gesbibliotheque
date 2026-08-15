<?php
namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ── Affichage login ──────────────────────────────────────
    public function showLogin()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    // ── Traitement login ─────────────────────────────────────
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'Email ou mot de passe incorrect.']);
    }

    // ── Affichage inscription ─────────────────────────────────
    public function showRegister()
    {
        // Un seul compte admin autorisé
        if (Admin::count() > 0) {
            return redirect()->route('login')
                ->with('error', 'Un compte administrateur existe déjà. Veuillez vous connecter.');
        }
        return view('auth.register');
    }

    // ── Traitement inscription ────────────────────────────────
    public function register(Request $request)
    {
        // Double vérification
        if (Admin::count() > 0) {
            return redirect()->route('login')
                ->with('error', 'Un compte administrateur existe déjà.');
        }

        $data = $request->validate([
            'nom'                  => 'required|string|max:120',
            'prenom'               => 'required|string|max:120',
            'email'                => 'required|email|unique:admins,email',
            'password'             => 'required|string|min:8|confirmed',
        ], [
            'nom.required'         => 'Le nom est obligatoire.',
            'prenom.required'      => 'Le prénom est obligatoire.',
            'email.required'       => 'L\'adresse e-mail est obligatoire.',
            'email.unique'         => 'Cette adresse e-mail est déjà utilisée.',
            'password.required'    => 'Le mot de passe est obligatoire.',
            'password.min'         => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed'   => 'Les mots de passe ne correspondent pas.',
        ]);

        $admin = Admin::create([
            'nom'      => $data['nom'],
            'prenom'   => $data['prenom'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::guard('admin')->login($admin);

        return redirect()->route('dashboard')
            ->with('success', 'Compte créé avec succès. Bienvenue, ' . $admin->prenom . ' !');
    }

    // ── Déconnexion ───────────────────────────────────────────
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Vous êtes déconnecté.');
    }
}
