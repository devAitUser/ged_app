<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEntiteToDossierChampsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dossier_champs', function (Blueprint $table) {
            $table->unsignedBigInteger('entite_id')->after('organigramme_id');
            $table->foreign('entite_id')->references('id')->on('entites');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
    }
}
