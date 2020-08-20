<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CarteEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('carteEvent', function (Blueprint $table) {
          $table->increments('id');
          $table->string('url');
          $table->string('texte');
          $table->string('type');
          $table->integer('value');
          $table->boolean('espionnage');
          $table->string('collection');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carteEvent');
    }
}
