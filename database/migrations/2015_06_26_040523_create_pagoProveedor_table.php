<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagoProveedorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('pago_proveedor', function(Blueprint $table)
        {
            $table->increments('id');

            /* datos */

            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->decimal('precio_litro',9,2);
            $table->decimal('total_descontado',9,2);
            $table->decimal('pago_total',9,2);

            /*relacion*/

            $table->integer('liquidacion_id')->unsigned()->index();
            $table->foreign('liquidacion_id')->references('id')->on('liquidaciones');
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
        Schema::drop('pago_proveedor');
	}

}
