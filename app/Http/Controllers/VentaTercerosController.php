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

        $ventaTerceros = $this->ventaTerceroRep->all();
        return view('Servicio/viewAllVentaTerceros',compact('ventaTerceros'));

    }
    

    public function getViewNewVentaTerceros()
    {
        $recursos = $this->recursoRep->all();
        return view('Servicio/viewNewVentaATerceros',compact('recursos'));
    }

    public function getViewUpVentaTercero($id)
    {
        $recursos = $this->recursoRep->all();
        return view('Servicio/viewUpVentaATerceros',compact('recursos','id'));
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

    public function updateVentaTerceros(){
        $data = \Input::all();

        $bandera = $this->ventaTerceroRep->updateVentaTerceros($data);

        if($bandera ===1){

            return \Redirect::route('getAllVentaTerceros')->with(array('confirm' => 'Venta actualizada'));

        }else{
            return  redirect()->back()->withInput()->withErrors($bandera);
        }
    }

    public function getVentaTercero($id){

        $venta = $this->ventaTerceroRep->find($id);

        return \Response::json($venta);

    }

    public function deleteVentaTercero($id)
    {

        try{

            $this->ventaTerceroRep->deleteVentaTercero($id);
            return \Redirect::route('getAllVentaTerceros')->with(array('confirm' => 'Venta  Eliminada'));

        }catch (\Exception $e){

            return \Redirect::route('getAllVentaTerceros')->
            with(array('fail' => 'La Venta no puede eliminarse,puede tener datos asociados'));

        }

    }

}