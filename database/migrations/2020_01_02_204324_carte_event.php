<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CarteAction extends Migration
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
           $table->integer('value');
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
