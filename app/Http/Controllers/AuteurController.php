<?php
namespace App\Http\Controllers;
use App\Models\Auteur;
use Illuminate\Http\Request;

class AuteurController extends Controller {
    public function index(Request $req) {
        $q = Auteur::withCount('livres');
        if ($req->q) $q->where(fn($qb) => $qb->where('nom','like',"%{$req->q}%")->orWhere('prenom','like',"%{$req->q}%"));
        return view('auteurs.index', ['auteurs' => $q->orderBy('nom')->paginate(15)]);
    }
    public function create() { return view('auteurs.create'); }
    public function store(Request $req) {
        $req->validate(['nom'=>'required|max:120','prenom'=>'required|max:120','nationalite'=>'nullable|max:80','bio'=>'nullable']);
        Auteur::create($req->only(['nom','prenom','nationalite','bio']));
        return redirect()->route('auteurs.index')->with('success','Auteur ajouté.');
    }
    public function edit(Auteur $auteur) { return view('auteurs.edit', compact('auteur')); }
    public function update(Request $req, Auteur $auteur) {
        $req->validate(['nom'=>'required|max:120','prenom'=>'required|max:120','nationalite'=>'nullable|max:80','bio'=>'nullable']);
        $auteur->update($req->only(['nom','prenom','nationalite','bio']));
        return redirect()->route('auteurs.index')->with('success','Auteur mis à jour.');
    }
    public function destroy(Auteur $auteur) {
        if ($auteur->livres()->exists()) return back()->with('error','Impossible : cet auteur a des livres associés.');
        $auteur->delete();
        return redirect()->route('auteurs.index')->with('success','Auteur supprimé.');
    }
}
