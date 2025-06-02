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
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('prenom')->nullable();;
        $table->string('email')->unique();
        $table->string('specialite')->nullable(); // spécifique à avocat
        $table->string('telephone')->nullable();
        $table->string('adresse')->nullable();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->enum('role', ['client', 'avocat', 'admin'])->default('client');
        $table->boolean('is_active')->default(false); // pour avocat
        $table->enum('statut_validation', ['en_attente', 'valide', 'rejete'])->default('en_attente'); // pour client
        $table->rememberToken();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
 