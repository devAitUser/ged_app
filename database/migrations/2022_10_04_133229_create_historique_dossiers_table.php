<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriqueDossiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historique_dossiers', function (Blueprint $table) {
            $table->id();
            $table->string('user');
            $table->string('action');
            $table->unsignedBigInteger('dossier_id');
            $table->foreign('dossier_id')->references('id')->on('dossiers')->onDelete('cascade');
            
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
        Schema::dropIfExists('historique_dossiers');
    }
}
