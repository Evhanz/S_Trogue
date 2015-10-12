<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccesoriosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('accesorios', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('serie');
            $table->boolean('estado');
            $table->string('tipo');

            $table->integer('proveedor_id')->unsigned()->index();
            $table->foreign('proveedor_id')->references('id')->on('proveedores');

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
        Schema::drop('accesorios');

	}

}
