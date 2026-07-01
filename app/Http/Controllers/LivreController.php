<?php
namespace App\Http\Controllers;
use App\Models\{Livre, Auteur, Categorie};
use Illuminate\Http\Request;

class LivreController extends Controller {
    public function index(Request $req) {
        $q = Livre::with(['auteur','categorie']);
        if ($req->q) $q->where(fn($qb) => $qb->where('titre','like',"%{$req->q}%")->orWhere('isbn','like',"%{$req->q}%"));
        if ($req->categorie_id) $q->where('categorie_id',$req->categorie_id);
        return view('livres.index', [
            'livres'     => $q->orderBy('titre')->paginate(15),
            'categories' => Categorie::orderBy('nom')->get(),
        ]);
    }
    public function create() {
        return view('livres.create', ['auteurs'=>Auteur::orderBy('nom')->get(), 'categories'=>Categorie::orderBy('nom')->get()]);
    }
    public function store(Request $req) {
        $data = $req->validate([
            'titre'=>'required|max:255','auteur_id'=>'required|exists:auteurs,id',
            'categorie_id'=>'required|exists:categories,id','isbn'=>'nullable|max:20',
            'annee_publication'=>'nullable|integer|min:1000|max:'.date('Y'),
            'quantite'=>'required|integer|min:1','description'=>'nullable',
        ]);
        Livre::create($data);
        return redirect()->route('livres.index')->with('success','Livre ajouté avec succès.');
    }
    public function show(Livre $livre) { return view('livres.show', compact('livre')); }
    public function edit(Livre $livre) {
        return view('livres.edit', ['livre'=>$livre, 'auteurs'=>Auteur::orderBy('nom')->get(), 'categories'=>Categorie::orderBy('nom')->get()]);
    }
    public function update(Request $req, Livre $livre) {
        $data = $req->validate([
            'titre'=>'required|max:255','auteur_id'=>'required|exists:auteurs,id',
            'categorie_id'=>'required|exists:categories,id','isbn'=>'nullable|max:20',
            'annee_publication'=>'nullable|integer|min:1000|max:'.date('Y'),
            'quantite'=>'required|integer|min:1','description'=>'nullable',
        ]);
        $livre->update($data);
        return redirect()->route('livres.index')->with('success','Livre mis à jour.');
    }
    public function destroy(Livre $livre) {
        if ($livre->emprunts()->where('statut','en_cours')->exists())
            return back()->with('error','Impossible : ce livre est actuellement emprunté.');
        $livre->delete();
        return redirect()->route('livres.index')->with('success','Livre supprimé.');
    }
}
