<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comptes', function (Blueprint $table) {
           

           $table->uuid('id')->primary();
           $table->string('titulaire');
           $table->string('numero_compte')->unique();
           $table->enum('type_compte', ['epargne', 'cheque'])->default('epargne');
           $table->decimal('solde_initial', 15, 2)->min(10000);
           $table->enum('statut', ['actif', 'bloque', 'ferme'])->default('actif');
           $table->string('devise', 10)->default('FCFA');
           $table->dateTime('date_creation')->default(now());
           $table->dateTime('date_fermeture')->nullable();
           $table->foreignUuid('client_id')->constrained('clients', 'uuid')->onDelete('cascade');
             $table->string('motifBlocage')->nullable();
           $table->timestamp('dateBlocage')->nullable();
           $table->timestamp('dateDeblocagePrevue')->nullable();
           $table->string('motifDeblocage')->nullable();
             $table ->softDeletes();
            $table->json('metadonnees')->nullable();
           $table->timestamp('dateDeblocage')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comptes');
    }
};
