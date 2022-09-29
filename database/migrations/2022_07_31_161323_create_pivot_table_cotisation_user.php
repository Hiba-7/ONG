<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotisation_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('cotisation_id')->references('id')->on('cotisations');
            $table->decimal('montant_ajouté', 8, 2)->default(0);
            $table->boolean('est_payée')->default(false);
            $table->date('date_paiement')->nullable();
            $table->foreignId('validé_par')->nullable()->references('id')->on('users');
            // !defaults to auth()->user()->id
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cotisation_user');
    }
};
