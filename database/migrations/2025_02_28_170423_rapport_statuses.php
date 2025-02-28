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
        Schema::create('rapport_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_status')->constrained('statuses');
            $table->foreignId('id_livreur')->constrained('utilisateurs');
            $table->foreignId('id_colis')->constrained('colis');
            $table->string('commentaire', 255)->nullable();
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
