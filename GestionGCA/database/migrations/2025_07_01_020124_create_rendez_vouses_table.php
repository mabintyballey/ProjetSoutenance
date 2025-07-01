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
        Schema::create('rendez_vouses', function (Blueprint $table) {
           $table->id();
           $table->foreignId('dossier_id')->constrained()->onDelete('cascade');
           $table->dateTime('date_heure');
           $table->string('lieu')->nullable();
           $table->text('motif')->nullable();
           $table->enum('statut', ['en_attente', 'accepte', 'rejete'])->default('en_attente');
           $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rendez_vouses');
    }
};
