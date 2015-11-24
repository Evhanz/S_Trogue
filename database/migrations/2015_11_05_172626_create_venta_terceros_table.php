<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentaTercerosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('venta_terceros', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('descripcion');
            $table->decimal('monto',9,2);
            $table->string('n_docuemento');
            $table->boolean('estado');
            $table->date('fecha');


            /*relacion*/
            $table->integer('proveedor_id')->unsigned()->index();
            $table->foreign('proveedor_id')->references('id')->on('proveedores');
            /*relacion*/
            $table->integer('origen_id')->unsigned()->index();
            $table->foreign('origen_id')->references('id')->on('recursos');


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
        Schema::drop('venta_terceros');
	}

}
