<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('auteurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 120);
            $table->string('prenom', 120);
            $table->text('bio')->nullable();
            $table->string('nationalite', 80)->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('auteurs'); }
};
