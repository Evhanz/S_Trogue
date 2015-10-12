<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLetrasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('letras', function(Blueprint $table)
        {
            $table->increments('id');

            $table->decimal('cantidad',9,2);
            $table->date('fecha_vencimiento');
            $table->string('observacion')->nullable();
            $table->boolean('estado');

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
        Schema::drop('letras');
	}

}
