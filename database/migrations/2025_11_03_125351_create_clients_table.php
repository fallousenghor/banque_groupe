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
        Schema::create('clients', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string('nom');
            $table->string('prenom');
            $table->string('date_naissance')->nullable();
            $table->string('adresse')->nullable();
            $table->string('telephone')->unique();
            $table->string('cni')->unique();  
            $table->timestamps();
            $table ->index(['nom', 'prenom']);
             $table ->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
