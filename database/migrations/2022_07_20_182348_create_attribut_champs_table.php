<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributChampsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribut_champs', function (Blueprint $table) {
            $table->id();
            $table->string('nom_champs');
            $table->string('type_champs');
            $table->unsignedBigInteger('dossier_champs_id');
            $table->foreign('dossier_champs_id')->references('id')->on('dossier_champs')->onDelete('cascade');
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
        Schema::dropIfExists('attribut_champs');
    }
}
