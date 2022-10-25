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
        Schema::create('vote_cartes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('numero_inscription')->unique()->nullable();
            $table->integer('numero_bureau')->nullable();
            $table->string('lieu')->nullable();
            $table->string('scan_vote')->nullable()->nullable();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('vote_cartes');
    }
};