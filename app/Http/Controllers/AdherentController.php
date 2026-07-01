<?php
namespace App\Http\Controllers;
use App\Models\Adherent;
use Illuminate\Http\Request;

class AdherentController extends Controller {
    public function index(Request $req) {
        $q = Adherent::withCount('emprunts');
        if ($req->q) $q->where(fn($qb) => $qb->where('nom','like',"%{$req->q}%")->orWhere('prenom','like',"%{$req->q}%")->orWhere('email','like',"%{$req->q}%"));
        if ($req->statut) $q->where('statut',$req->statut);
        return view('adherents.index', ['adherents'=>$q->orderBy('nom')->paginate(15)]);
    }
    public function create() { return view('adherents.create'); }
    public function store(Request $req) {
        $req->validate(['nom'=>'required|max:120','prenom'=>'required|max:120','email'=>'nullable|email','telephone'=>'nullable|max:20','adresse'=>'nullable','date_adhesion'=>'required|date','statut'=>'required|in:actif,suspendu']);
        Adherent::create($req->only(['nom','prenom','email','telephone','adresse','date_adhesion','statut']));
        return redirect()->route('adherents.index')->with('success','Adhérent ajouté.');
    }
    public function show(Adherent $adherent) {
        $adherent->load('emprunts.livre');
        return view('adherents.show', compact('adherent'));
    }
    public function edit(Adherent $adherent) { return view('adherents.edit', compact('adherent')); }
    public function update(Request $req, Adherent $adherent) {
        $req->validate(['nom'=>'required|max:120','prenom'=>'required|max:120','email'=>'nullable|email','telephone'=>'nullable|max:20','adresse'=>'nullable','date_adhesion'=>'required|date','statut'=>'required|in:actif,suspendu']);
        $adherent->update($req->only(['nom','prenom','email','telephone','adresse','date_adhesion','statut']));
        return redirect()->route('adherents.index')->with('success','Adhérent mis à jour.');
    }
    public function destroy(Adherent $adherent) {
        if ($adherent->emprunts()->where('statut','en_cours')->exists()) return back()->with('error','Impossible : cet adhérent a des emprunts en cours.');
        $adherent->delete();
        return redirect()->route('adherents.index')->with('success','Adhérent supprimé.');
    }
}
