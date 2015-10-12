<?php

namespace Trogue\Http\Controllers;

use trogue\Repository\RutaRep;

class RutasController extends Controller{

	protected $rutaRep;

	function __construct(RutaRep $rutaRep) {

		$this->rutaRep = $rutaRep;
		
	}

	public function selectAllRutas()
	{
		$rutas = $this->rutaRep->all();
		return view('Proveedores/viewAllRutas',compact('rutas'));

		//dd($rutas);
	}

    public function regRuta()
    {
        $data = \Input::all();
        $rutas = $this->rutaRep->all();

        $bandera = $this->rutaRep->regRuta($data);

        if($bandera === 1){
            return \Redirect::route('rutasAll')->with(array('confirm' => 'Profesion Registrada'));

        }else{
            return \Redirect::route('rutasAll')->with(array('fail' => $bandera));
        }

    }




}