<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Adherent extends Model {
    use HasFactory;
    protected $fillable = ['nom','prenom','email','telephone','adresse','date_adhesion','statut'];
    protected $casts = ['date_adhesion' => 'date'];
    public function emprunts() { return $this->hasMany(Emprunt::class); }
}
