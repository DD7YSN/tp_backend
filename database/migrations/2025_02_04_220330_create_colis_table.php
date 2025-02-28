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
        Schema::create('colis', function (Blueprint $table) {
            $table->id();
            $table->string('track_number', 255);
            $table->string('telephone', 15);
            $table->string('adresse', 255);
            $table->string('marchandise', 255)->default('');
            $table->foreignId('id_ville')->constrained('villes');
            $table->foreignId('id_business')->constrained('businesses');
            $table->string('destinataire', 30);
            $table->boolean('ouvrir')->default(1);
            $table->date('date_creation')->default(now());
            $table->foreignId('bon_ramassage')->nullable()->constrained('bon_ramassages');
            $table->foreignId('bon_distribution')->nullable()->constrained('bon_distributions');
            $table->foreignId('bon_envoi')->nullable()->constrained('bon_envois');
            $table->decimal('prix', 8, 2);
            $table->foreignId('id_client')->constrained('utilisateurs');
            $table->boolean('pret_preparation')->default(1)->comment('pret pour la preparation / nouveau coli');
            $table->boolean('etat')->default(0)->comment('No paye / paye');
            $table->string('coli_type', 10)->default('normal')->comment('normal / in stock');
            $table->text('commentaire')->nullable();
            $table->foreignId('id_status')->constrained('statuses')->comment('livré / non livré');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colis');
    }
};
