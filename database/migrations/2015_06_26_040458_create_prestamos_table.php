<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestamosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('prestamos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('descripcion');
            $table->decimal('cantidad',9,2);
            $table->integer('prioridad');
            $table->string('estado');


            $table->integer('proveedor_id')->unsigned()->index();
            $table->foreign('proveedor_id')->references('id')->on('proveedores');
            $table->integer('recurso_id')->unsigned()->index();
            $table->foreign('recurso_id')->references('id')->on('recursos');
            $table->integer('documento_adjunto_id')->unsigned()->nullable()->default(NULL);;
            $table->foreign('documento_adjunto_id')->references('id')->on('comprobante_adjunto');


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
        Schema::drop('prestamos');
	}

}
