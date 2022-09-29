<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('wilayas') ||  Schema::hasTable('communes')) {
            return ;
        }

        Schema::create('wilayas', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('nom_arabe');
        });

        Schema::create('communes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('nom_arabe');
            $table->string('code_postal');
            $table->foreignId('wilaya_id')->references('id')->on('wilayas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('communes');
        Schema::dropIfExists('wilayas');
    }
}
