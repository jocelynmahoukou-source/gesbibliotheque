<?php
namespace App\Http\Controllers;
use App\Models\{Emprunt, Livre, Adherent};
use Illuminate\Http\Request;

class EmpruntController extends Controller {
    public function index(Request $req) {
        $q = Emprunt::with(['livre','adherent']);
        if ($req->q) $q->whereHas('livre',fn($qb)=>$qb->where('titre','like',"%{$req->q}%"))
                       ->orWhereHas('adherent',fn($qb)=>$qb->where('nom','like',"%{$req->q}%")->orWhere('prenom','like',"%{$req->q}%"));
        if ($req->statut === 'en_retard')
            $q->where('statut','en_cours')->where('date_retour_prevue','<',now());
        elseif ($req->statut)
            $q->where('statut',$req->statut);
        return view('emprunts.index', ['emprunts'=>$q->latest()->paginate(20)]);
    }
    public function create() {
        return view('emprunts.create', [
            'livres'    => Livre::where('quantite','>',0)->orderBy('titre')->get()->filter(fn($l)=>$l->quantite_disponible>0),
            'adherents' => Adherent::where('statut','actif')->orderBy('nom')->get(),
        ]);
    }
    public function store(Request $req) {
        $req->validate([
            'livre_id'=>'required|exists:livres,id','adherent_id'=>'required|exists:adherents,id',
            'date_emprunt'=>'required|date','date_retour_prevue'=>'required|date|after:date_emprunt','notes'=>'nullable',
        ]);
        $livre = Livre::findOrFail($req->livre_id);
        if ($livre->quantite_disponible < 1)
            return back()->with('error','Ce livre n\'est plus disponible.')->withInput();
        Emprunt::create($req->only(['livre_id','adherent_id','date_emprunt','date_retour_prevue','notes']) + ['statut'=>'en_cours']);
        return redirect()->route('emprunts.index')->with('success','Emprunt enregistré.');
    }
    public function edit(Emprunt $emprunt) { return view('emprunts.edit', compact('emprunt')); }
    public function update(Request $req, Emprunt $emprunt) {
        $req->validate(['date_emprunt'=>'required|date','date_retour_prevue'=>'required|date','statut'=>'required|in:en_cours,retourne','date_retour_effective'=>'nullable|date','notes'=>'nullable']);
        $data = $req->only(['date_emprunt','date_retour_prevue','statut','notes']);
        if ($req->date_retour_effective) $data['date_retour_effective'] = $req->date_retour_effective;
        $emprunt->update($data);
        return redirect()->route('emprunts.index')->with('success','Emprunt mis à jour.');
    }
    public function retour(Emprunt $emprunt) {
        $emprunt->update(['statut'=>'retourne','date_retour_effective'=>now()]);
        return back()->with('success','Retour enregistré.');
    }
    public function destroy(Emprunt $emprunt) {
        $emprunt->delete();
        return redirect()->route('emprunts.index')->with('success','Emprunt supprimé.');
    }
    public function enRetard() {
        $emprunts = Emprunt::with(['livre','adherent'])->where('statut','en_cours')->where('date_retour_prevue','<',now())->orderBy('date_retour_prevue')->get();
        return view('emprunts.en_retard', compact('emprunts'));
    }
}
