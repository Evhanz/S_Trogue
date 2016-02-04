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

        $pagos =$this->pagoRep->all();

        return view('Servicio/viewAllPagos',compact('pagos'));
    }

    public function getPagoById($id){

        $pago = $this->pagoRep->getPagoById($id);

        return \Response::json($pago);


    }


    public function viewNewPago()
    {
        return view('Servicio/viewNewPago');
    }

    public function viewUpPago($id){


        return view('Servicio/viewUpPago',compact('id'));

    }

    public function RegPago()
    {
        $data = \Input::all();

        $pago = $data['pago_proveedor'];

        $fecha_inicio = $pago['fecha_inicio'];
        $fecha_fin =  $pago['fecha_fin'];


        //primero traemos si existe un pago con las fechas dadas


        $pagos = $this->pagoRep->getPagoByFechasAndProveedor($pago['proveedor_id'],$fecha_inicio,$fecha_fin);

        if(count($pagos)>=1){

            $mensaje = ['message' => 'incorrecto','body'=>'ya existe un pago dentro de las fechas dadas','pagos'=>$pagos];
            return \Response::json($mensaje);

        }else{

            try{

                $this->pagoRep->regPago($data);
                $mensaje = ['message' => 'correcto'];

                return \Response::json($mensaje);

            }catch (\Exception $e){

                return $e;
            }
        }


    }

    public function UpdatePago()
    {
        $data = \Input::all();


        $pago = $data['pago_proveedor'];

        $fecha_inicio = $pago['fecha_inicio'];
        $fecha_fin =  $pago['fecha_fin'];


        //primero traemos si existe un pago con las fechas dadas


        $pagos = $this->pagoRep->getPagoByFechasAndProveedor($pago['proveedor_id'],$fecha_inicio,$fecha_fin);

        if(count($pagos)>1){


            $mensaje = ['message' => 'incorrecto','body'=>'ya existe un pago dentro de las fechas dadas'];
            return \Response::json($mensaje);

        }else{

            try{

                $this->pagoRep->updatePago($data);
                $mensaje = ['message' => 'correcto'];

                return \Response::json($mensaje);

            }catch (\Exception $e){

                return $e;


            }

        }



    }


    public  function deletePago($id){


        try{
            $this->pagoRep->deletePagoProveedor($id);
            return redirect()->back()->with(array('confirm' => 'Pago  Eliminado'));
        }catch (\Exception $e){

            return redirect()->back()->with(array('fail' => 'No se puede eliminar pago'));

        }





    }



}