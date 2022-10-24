<?php

use App\Enums\UserCiviliteEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\UserEtatProfileEnum;
use App\Enums\UserNiveauEtudeEnum;
use App\Enums\UserEtatSocialEnum;
use App\Models\Commune;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('civilité', UserCiviliteEnum::getValues());
            $table->string('nom');
            $table->string('prénom');
            $table->string('email')->unique();
            $table->string('téléphone');
            $table->boolean('fondateur')->default(0);
            $table->enum("etat_profile_courant", UserEtatProfileEnum::getValues())->default(UserEtatProfileEnum::DEMANDE_ADMISSION->value);
            $table->date('date_naissance');
            $table->string('adresse');
            $table->string('adresse_secondaire')->nullable();
            $table->foreignId('pays_id')->references('id')->on('pays');
            $table->foreignId('commune_id')->nullable()->default(Commune::count() ? Commune::find(Commune::count())->id : null)->references('id')->on('communes');
            $table->string('photo_profile')->nullable();
            $table->string('spécialité');
            $table->string('fonction');
            $table->enum('niveau_etude', UserNiveauEtudeEnum::getValues());
            $table->enum('etat_social', UserEtatSocialEnum::getValues());
            $table->string('nom_departement')->nullable();
            $table->string('password');
            $table->date('date_admission')->default(now());
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};