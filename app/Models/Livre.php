<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Livre extends Model {
    use HasFactory;
    protected $fillable = ['titre','auteur_id','categorie_id','isbn','annee_publication','description','quantite'];

    public function auteur() { return $this->belongsTo(Auteur::class); }
    public function categorie() { return $this->belongsTo(Categorie::class); }
    public function emprunts() { return $this->hasMany(Emprunt::class); }

    public function getQuantiteDisponibleAttribute(): int {
        $emprunte = $this->emprunts()->where('statut','en_cours')->count();
        return max(0, $this->quantite - $emprunte);
    }
}
