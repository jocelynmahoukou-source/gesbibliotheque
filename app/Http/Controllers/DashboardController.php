<?php
namespace App\Http\Controllers;
use App\Models\{Livre, Adherent, Emprunt, Categorie};

class DashboardController extends Controller {
    public function index() {
        return view('dashboard.index', [
            'totalLivres'       => Livre::count(),
            'livresDisponibles' => Livre::all()->sum('quantite_disponible'),
            'totalAdherents'    => Adherent::count(),
            'empruntsActifs'    => Emprunt::where('statut','en_cours')->count(),
            'empruntsEnRetard'  => Emprunt::where('statut','en_cours')->where('date_retour_prevue','<',now())->count(),
            'derniersEmprunts'  => Emprunt::with(['livre','adherent'])->latest()->take(8)->get(),
            'topCategories'     => Categorie::withCount('livres')->orderByDesc('livres_count')->take(5)->get(),
        ]);
    }
}
