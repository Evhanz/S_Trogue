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
            return \Redirect::route('rutasAll')->with(array('confirm' => 'Ruta Registrada'));

        }else{
            return \Redirect::route('rutasAll')->with(array('fail' => $bandera));
        }

    }


    public function updateRuta()
    {
        $data = \Input::all();


        $bandera = $this->rutaRep->updateRuta($data);

        if($bandera === 1){
            return \Redirect::route('rutasAll')->with(array('confirm' => 'Ruta Editada'));

        }else{
            return \Redirect::route('rutasAll')->with(array('fail' => $bandera));
        }

    }

    public function getRutaById($id)
    {

        $ruta = $this->rutaRep->find($id);
        return \Response::json($ruta);

    }

    public  function deleteRuta($id){

        try{

            $this->rutaRep->deleteRuta($id);
            return \Redirect::route('rutasAll')->with(array('confirm' => 'Ruta Eliminada'));

        }catch (\Exception $e){



            return \Redirect::route('rutasAll')->
            with(array('fail' => 'La ruta no puede eliminarse,puede tener datos asociados'));

        }



    }




}