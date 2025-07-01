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
           Schema::create('documents', function (Blueprint $table) {
            $table->id();
        
            $table->foreignId('dossier_id')->constrained('dossiers')->onDelete('cascade');
        
            $table->enum('type', ['requete', 'assignation', 'preuve', 'autre']);
            $table->string('path_fichier'); 
        
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
