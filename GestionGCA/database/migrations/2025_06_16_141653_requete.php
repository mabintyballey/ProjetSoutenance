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
        Schema::create('requetes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('avocat_id')->nullable()->constrained('avocats')->onDelete('set null');
            $table->foreignId('domaine_id')->constrained('domaines')->onDelete('cascade');
            
            $table->string('type_aide');
            $table->text('probleme');
            $table->text('info_adverse')->nullable();
            $table->enum('statut', ['en_attente', 'acceptee', 'rejete', 'en_cours', 'terminee'])->default('en_attente');
            $table->timestamp('date_statut')->nullable();

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
