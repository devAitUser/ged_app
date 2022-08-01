<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boites', function (Blueprint $table) {
            $table->id();
            $table->mediumText('objet');
            $table->integer('num_boite');
            $table->date('premier_date');
            $table->date('dernier_date');
            $table->integer('code_topographe');
            $table->mediumText('remarque')->nullable();
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
        Schema::dropIfExists('boites');
    }
}
