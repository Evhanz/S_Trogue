<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('proveedores',function(Blueprint $table){

            $table->increments('id');
            $table->string('name');
            $table->string('apellidoP');
            $table->string('apellidoM');
            $table->string('dni');
            $table->string('celular');
            $table->string('foto')->nullable();
            $table->boolean('estado');
            $table->timestamps();

            //relaciones

            $table->integer('anexo_id')->unsigned()->index();
            $table->foreign('anexo_id')->references('id')->on('anexos');



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
        Schema::drop('provedores');
	}

}
