<?php

use App\Enums\TypeCotisationEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotisations', function (Blueprint $table) {
            $table->id();
            $table->enum('type', TypeCotisationEnum::getValues());
            $table->decimal('montant', 8, 2);
            $table->foreignId('instance_id')->nullable()->references('id')->on('instances');
            $table->date('année');
            $table->date('délai_paiement');
            $table->date('dernier_délai_paiement');
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
        Schema::dropIfExists('cotisations');
    }
};
