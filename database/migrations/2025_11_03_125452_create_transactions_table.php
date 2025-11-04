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
        

       Schema::create('transactions', function (Blueprint $table) {

           $table->uuid('id')->primary();
           $table->string('reference', 50);
           $table->enum('statut', ['en_attente', 'validee', 'annulee']);
           $table->foreignUuid('compte_id')->constrained('comptes')->onDelete('cascade');
           $table->enum('type', ['depot', 'retrait', 'virement', 'frais'])->default('depot');
           $table->decimal('montant', 15, 2);
           $table->string('description', 255)->nullable();
           $table->timestamp('date_transaction')->default('now');
           $table ->softDeletes();
           $table->timestamps();
       });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
