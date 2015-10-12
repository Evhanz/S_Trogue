<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagoLetrasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('pago_letras', function(Blueprint $table)
        {
            $table->increments('id');

            $table->date('fecha_pago');

            $table->integer('pago_proveedor_id')->unsigned()->index();
            $table->foreign('pago_proveedor_id')->references('id')->on('pago_proveedor');
            $table->integer('letra_id')->unsigned()->index();
            $table->foreign('letra_id')->references('id')->on('letras');


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
        Schema::drop('pago_letras');
	}

}
