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
        Schema::create('generals', function (Blueprint $table) {
            $table->id();
             $table->string('nom', 25);
            $table->foreignId('id_monnie')->constrained('monnies');
            $table->string('telephone_a', 15);
            $table->string('telephone_b', 15)->nullable();
            $table->string('fix', 15)->nullable();
            $table->string('email', 40);
            $table->string('site_lien', 255)->nullable();
            $table->string('lien_admin', 255)->nullable();
            $table->string('lien_client', 255)->nullable();
            $table->foreignId('zone_principal')->constrained('zones');
            $table->string('adresse', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generals');
    }
};
