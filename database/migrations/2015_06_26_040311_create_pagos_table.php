<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('pagos',function(Blueprint $table){

            $table->increments('id');
            $table->date('fecha_ini');
            $table->date('fecha_fin');
            $table->decimal('total_litros');
            $table->decimal('precio')->nullable();
            $table->decimal('total_pago');
            //relaciones
            $table->integer('proveedor_id')->unsigned()->index();
            $table->foreign('proveedor_id')->references('id')->on('proveedores');
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
        Schema::drop('pagos');
	}

}
