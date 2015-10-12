<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleDescuentoLiquidacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('detalle_descuento_liquidacion', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('descripcion');
            $table->date('fecha');
            $table->decimal('monto',9,2);

            /*relacion*/
            $table->integer('liquidacion_id')->unsigned()->index();
            $table->foreign('liquidacion_id')->references('id')->on('liquidaciones');


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
        Schema::drop('detalle_descuento_liquidacion');
	}

}
