<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('livres', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->foreignId('auteur_id')->constrained('auteurs')->restrictOnDelete();
            $table->foreignId('categorie_id')->constrained('categories')->restrictOnDelete();
            $table->string('isbn', 20)->nullable();
            $table->unsignedSmallInteger('annee_publication')->nullable();
            $table->text('description')->nullable();
            $table->unsignedSmallInteger('quantite')->default(1);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('livres'); }
};
