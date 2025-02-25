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
        Schema::create('bon_payements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_moderateur')->constrained('utilisateurs');
            $table->float('total');
            $table->float('credit');
            $table->dateTime('date');
            $table->boolean('valide')->default(0)->comment('Non paye / paye');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bon_payements');
    }
};
