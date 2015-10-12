<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsidenciasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//

        Schema::create('insidencias',function(Blueprint $table){

            $table->increments('id');
            $table->string('cantidad');
            $table->enum('tipo',['descuento','observacion']);
            $table->string('observacion');


            $table->integer('acopio_id')->unsigned()->index();
            $table->foreign('acopio_id')->references('id')->on('acopios');

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
        Schema::drop('insidencias');
	}

}
