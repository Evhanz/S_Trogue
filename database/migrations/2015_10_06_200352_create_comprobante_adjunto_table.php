<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprobanteAdjuntoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('comprobante_adjunto', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('num_comprobante');
            $table->string('tipo');
            $table->string('descripcion');
            $table->decimal('monto',9,2);


            /*relacion*/
            $table->integer('prestamo_id')->unsigned()->index();
            $table->foreign('prestamo_id')->references('id')->on('prestamos');


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
        Schema::drop('comprobante_adjunto');
	}

}
