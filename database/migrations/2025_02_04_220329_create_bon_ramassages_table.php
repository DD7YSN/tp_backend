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
        Schema::create('bon_ramassages', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(0)->comment('attende ramassage / recu');
            $table->date('date')->comment('date de recu');
            $table->string('ref_ramassage', 255)->unique();
            $table->foreignId('id_ramasseur')->nullable()->constrained('utilisateurs');
            $table->foreignId('ville_ramassage')->constrained('villes');
            $table->string('adresse_ramassage', 255)->default('');
            $table->foreignId('id_client')->constrained('utilisateurs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bon_ramassages');
    }
};
