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
           Schema::create('avocats', function (Blueprint $table) {
             $table->id();
         
             $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
         
             $table->foreignId('domaine_id')->constrained('domaines')->onDelete('cascade');
             $table->foreignId('specialite_id')->nullable()->constrained('specialites')->onDelete('set null');
         
             $table->boolean('is_active')->default(false);
         
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
