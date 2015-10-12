<?php

namespace Trogue\Http\Controllers;

use trogue\Repository\AnexoRep;
use trogue\Repository\RutaRep;

class AnexosController extends Controller{

	protected $anexoRep;
    protected $rutaRep;

	function __construct(AnexoRep $anexoRep,RutaRep $rutaRep) {

		$this->anexoRep = $anexoRep;
        $this->rutaRep = $rutaRep;
		
	}

	public function selectAllRutas()
	{
		$anexos = $this->anexoRep->all();
        $rutas = $this->rutaRep->all();
		return view('Proveedores/viewAllAnexos',compact('anexos','rutas'));

		//dd($rutas);
	}

    public function regAnexo()
    {
        $data = \Input::all();

        $bandera = $this->anexoRep->regAnexo($data);

        if($bandera === 1){
            return \Redirect::route('anexosAll')->with(array('confirm' => 'Profesion Registrada'));

        }else{
            return \Redirect::route('anexosAll')->with(array('fail' => $bandera));
        }
    }




}