<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiquidacionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('liquidaciones', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('numero');
            $table->decimal('precio_ref');
            $table->integer('solidos');
            $table->decimal('descuentos');
            $table->decimal('litros');
            $table->decimal('pago_neto');
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
        Schema::drop('liquidaciones');
	}

}
