<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use trogue\Entities\Ruta;
use trogue\Entities\Anexo;
use trogue\Entities\Proveedor;
use trogue\Entities\Recurso;


class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		// $this->call('UserTableSeeder');

        Ruta::create([
            'descripcion'=>'Cochan',
            'observacion'=>'-'
        ]);
        Anexo::create([
            'descripcion'=>'Santa Aurelia',
            'observacion'=>'-',
            'ruta_id'=>1
        ]);

        Proveedor::create([
            'name'=>'Evhanz',
            'apellidoP'=>'Hernandez',
            'apellidoM'=>'Salazar',
            'dni'=>'47085011',
            'celular'=>'990212662',
            'estado'=>true,
            'anexo_id'=>1
        ]);

        Recurso::create([
            'descripcion'=>'casa toro',
            'tipo'=>'interno'
        ]);







	}

}
