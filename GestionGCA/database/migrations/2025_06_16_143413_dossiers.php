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
          Schema::create('dossiers', function (Blueprint $table) {
            $table->id();
        
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('avocat_id')->nullable()->constrained('avocats')->onDelete('set null');
        
            $table->foreignId('domaine_id')->constrained('domaines')->onDelete('cascade'); 
        
            $table->enum('statut', ['en_attente', 'en_cours', 'termine', 'rejete'])->default('en_attente');
            $table->text('description');
            $table->text('information_adverse');
        
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
