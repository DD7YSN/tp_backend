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
        Schema::create('bon_distributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_livreur')->constrained('utilisateurs');
            $table->foreignId('id_status')->constrained('statuses');
            $table->foreignId('bon_payement')->nullable()->constrained('bon_payements');
            $table->foreignId('bon_ramassage')->nullable()->constrained('bon_ramassages');
            $table->date('date');
            $table->boolean('relancer')->default(0);
            $table->string('jutification_de_relancer', 255)->nullable();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bon_distributions');
    }
};
