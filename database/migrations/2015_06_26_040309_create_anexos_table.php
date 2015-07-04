<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnexosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('anexos',function(Blueprint $table){

            $table->increments('id');
            $table->string('descripcion');
            $table->string('observacion');

            $table->integer('ruta_id')->unsigned()->index();
            $table->foreign('ruta_id')->references('id')->on('rutas');

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
