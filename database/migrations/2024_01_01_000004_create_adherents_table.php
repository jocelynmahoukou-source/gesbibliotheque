<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('adherents', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 120);
            $table->string('prenom', 120);
            $table->string('email')->nullable()->unique();
            $table->string('telephone', 20)->nullable();
            $table->text('adresse')->nullable();
            $table->date('date_adhesion');
            $table->enum('statut', ['actif','suspendu'])->default('actif');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('adherents'); }
};
