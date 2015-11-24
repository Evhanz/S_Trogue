<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 7/11/2015
 * Time: 12:20 PM
 */

namespace Trogue\Http\Controllers;

use trogue\Repository\RecursoRep;
use trogue\Repository\VentaTercerosRep;

class VentaTercerosController extends Controller {


    protected $ventaTerceroRep ;
    protected $recursoRep;

    public function __construct(VentaTercerosRep $ventaTercerosRep,RecursoRep $recursoRep)
    {
        $this->ventaTerceroRep = $ventaTercerosRep;
        $this->recursoRep = $recursoRep;
    }

    public function getAllVentaTerceros()
    {
        return view('Servicio/viewAllVentaTerceros');

    }
    

    public function getViewNewVentaTerceros()
    {
        $recursos = $this->recursoRep->all();
        return view('Servicio/viewNewVentaATerceros',compact('recursos'));
    }


    public function RegVentaTerceros(){

        $data = \Input::all();

        $bandera = $this->ventaTerceroRep->regVentaTerceros($data);

        if($bandera ===1){

            return \Redirect::route('getAllVentaTerceros')->with(array('confirm' => 'Venta Registrad'));

        }else{
            return  redirect()->back()->withInput()->withErrors($bandera);
        }


    }

}