<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Emprunt extends Model {
    use HasFactory;
    protected $fillable = ['livre_id','adherent_id','date_emprunt','date_retour_prevue','date_retour_effective','statut','notes'];
    protected $casts = [
        'date_emprunt' => 'date',
        'date_retour_prevue' => 'date',
        'date_retour_effective' => 'date',
    ];

    public function livre() { return $this->belongsTo(Livre::class); }
    public function adherent() { return $this->belongsTo(Adherent::class); }

    public function isEnRetard(): bool {
        return $this->statut === 'en_cours' && now()->gt($this->date_retour_prevue);
    }
}
