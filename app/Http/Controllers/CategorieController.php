<?php
namespace App\Http\Controllers;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller {
    public function index() {
        return view('categories.index', ['categories'=>Categorie::withCount('livres')->orderBy('nom')->get()]);
    }
    public function store(Request $req) {
        $req->validate(['nom'=>'required|max:100|unique:categories,nom','description'=>'nullable']);
        Categorie::create($req->only(['nom','description']));
        return redirect()->route('categories.index')->with('success','Catégorie ajoutée.');
    }
    public function edit(Categorie $categorie) {
        return view('categories.edit', compact('categorie'));
    }
    public function update(Request $req, Categorie $categorie) {
        $req->validate(['nom'=>'required|max:100|unique:categories,nom,'.$categorie->id,'description'=>'nullable']);
        $categorie->update($req->only(['nom','description']));
        return redirect()->route('categories.index')->with('success','Catégorie mise à jour.');
    }
    public function destroy(Categorie $categorie) {
        if ($categorie->livres()->exists()) return back()->with('error','Impossible : cette catégorie contient des livres.');
        $categorie->delete();
        return redirect()->route('categories.index')->with('success','Catégorie supprimée.');
    }
}
