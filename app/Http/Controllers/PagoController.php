<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 9/11/2015
 * Time: 4:29 PM
 */

namespace Trogue\Http\Controllers;

use trogue\Repository\PagoRep;


class PagoController extends Controller{

    protected $pagoRep;

    public function __construct(PagoRep $pagoRep){

        $this->pagoRep =$pagoRep;

    }

    public function viewAllPagos(){

        return view('Servicio/viewAllPagos');

    }


    public function viewNewPago()
    {
        return view('Servicio/viewNewPago');
    }

    public function RegPago()
    {
        $data = \Input::all();


        try{

            $this->pagoRep->regPago($data);
            $mensaje = ['message' => 'correcto'];

            return \Response::json($mensaje);

        }catch (\Exception $e){

            return $e;


        }

    }


}