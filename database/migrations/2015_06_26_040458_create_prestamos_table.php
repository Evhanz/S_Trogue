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
            $table->enum('estado',['deuda','pagada']);
            $table->decimal('tasa');
            $table->decimal('interes',9,2);
            $table->integer('n_letras')->nullable();


            $table->integer('proveedor_id')->unsigned()->index();
            $table->foreign('proveedor_id')->references('id')->on('proveedores');
            $table->integer('recurso_id')->unsigned()->index();
            $table->foreign('recurso_id')->references('id')->on('recursos');



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
