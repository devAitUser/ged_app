<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndexTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indexes', function (Blueprint $table) {
            $table->id();
            $table->string('name_index');
            $table->unsignedBigInteger('attribut_id');
            $table->foreign('attribut_id')->references('id')->on('attribut_champs')->onDelete('cascade');
            $table->unsignedBigInteger('file_id');
            $table->foreign('file_id')->references('id')->on('attribut_champs')->onDelete('cascade');
            $table->unsignedBigInteger('dossier_id');
            $table->foreign('dossier_id')->references('id')->on('dossier_champs')->onDelete('cascade');
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
        Schema::dropIfExists('index');
    }
}
