<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagoVentaTercerosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('pago_venta_terceros', function(Blueprint $table)
        {
            $table->increments('id');
            $table->decimal('monto_pagado',9,2);

            $table->integer('pago_proveedor_id')->unsigned()->index();
            $table->foreign('pago_proveedor_id')->references('id')->on('pago_proveedor');
            $table->integer('venta_terceros_id')->unsigned()->index();
            $table->foreign('venta_terceros_id')->references('id')->on('venta_terceros');


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
        Schema::drop('pago_venta_terceros');
	}

}
