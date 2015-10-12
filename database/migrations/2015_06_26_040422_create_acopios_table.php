<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcopiosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('acopios',function(Blueprint $table){

            $table->increments('id');
            $table->date('feha');
            $table->decimal('cantidad');
            $table->decimal('cantidad_total',9,2);
            //relaciones
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
        Schema::drop('acopios');
	}

}
