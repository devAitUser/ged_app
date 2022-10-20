<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FileSearch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_searches', function (Blueprint $table) {
            $table->id();
            $table->string('filename')->nullable();
            $table->text('content')->nullable();
            $table->unsignedBigInteger('dossier_id');
            $table->foreign('dossier_id')->references('id')->on('dossiers')->onDelete('cascade');
            $table->unsignedBigInteger('attributs_dossiers_id');
            $table->foreign('attributs_dossiers_id')->references('id')->on('attributs_dossiers')->onDelete('cascade');
            $table->unsignedBigInteger('projet_id');
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
        //
    }
}
