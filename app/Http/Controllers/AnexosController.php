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
            return \Redirect::route('anexosAll')->with(array('confirm' => 'Anexo Registrado'));

        }else{
            return \Redirect::route('anexosAll')->with(array('fail' => $bandera));
        }
    }

    public function updateAnexo()
    {
        $data = \Input::all();

        $bandera = $this->anexoRep->updateAnexo($data);

        if($bandera === 1){
            return \Redirect::route('anexosAll')->with(array('confirm' => 'Anexo Actualizado'));

        }else{
            return \Redirect::route('anexosAll')->with(array('fail' => $bandera));
        }

    }

    public function deleteAnexo($id)
    {
        try{

            $this->anexoRep->deletAnexo($id);
            return \Redirect::route('anexosAll')->with(array('confirm' => 'Anexo Eliminado'));

        }catch (\Exception $e){


            return \Redirect::route('anexosAll')->
            with(array('fail' => 'El Anexo no puede eliminarse,puede tener datos asociados'));

        }

    }




}