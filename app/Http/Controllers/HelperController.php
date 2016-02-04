<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 03/07/2015
 * Time: 14:46
 */

namespace Trogue\Http\Controllers;
use trogue\Repository\ProveedorRep;
use trogue\Repository\RutaRep;
use trogue\Repository\AnexoRep;

use trogue\Entities\prueba;
use trogue\Entities\PesoBalanza;
use trogue\Entities\Acopio;


class HelperController extends Controller{

    protected $proveedorRep;
    protected $rutaRep;
    protected $anexoRep;

    public function __construct(ProveedorRep $proveedorRep, RutaRep $rutaRep,AnexoRep $anexoRep){
        $this->proveedorRep= $proveedorRep;
        $this->rutaRep=$rutaRep;
        $this->anexoRep = $anexoRep;

    }


    public function getAnexoByRuta($id){

        $anexos = $this->anexoRep->getAnexoByRuta($id);
       return $anexos->toJson();

    }

    public function token()
    {
        return csrf_token();
    }


    /*funcion para enviar todos los datos al server*/
    public function getDataCore()
    {
        $data = [];

        $anexos = $this->anexoRep->all();
        $rutas = $this->rutaRep->all();
        $proveedores = $this->proveedorRep->allFunction();

        $data['anexos'] = $anexos;
        $data['rutas'] = $rutas;
        $data['proveedores'] = $proveedores;

        return \Response::json($data);

    }


    public function reqDataSyncPesoBalanza()
    {

        $data = \Input::all();

        $fecha =$data['fecha'];
        $cantidad =$data['cantidad'];


        $peso = PesoBalanza::where('fecha','=',$fecha)->first();


        if(count($peso)==0){
            $p = new PesoBalanza();

            $p->fecha = $fecha;
            $p->cantidad = $cantidad;
            $p->save();

            return "correcto";

        }else{
            return "error ya ingresado";
        }


    }


    public function reqDataSyncAcopios()
    {

        $data = \Input::all();

        $fecha =$data['fecha'];
        $cantidad =$data['cantidad'];
        $id_proveedor = $data['idProveedor'];
        $id = $data['id'];


        $acopio = Acopio::where('feha','=',$fecha)->where('proveedor_id','=',$id_proveedor)->first();


        if(count($acopio)==0){
            $a = new Acopio();

            $a->feha = $fecha;
            $a->cantidad = $cantidad;
            $a->proveedor_id = $id_proveedor;
            $a->cantidad_total = $cantidad;
            $a->save();

            $mensaje = ['id' => $id];

            return \Response::json($mensaje);

        }else{
            $mensaje = ['id' => $id];

            return \Response::json($mensaje);
        }


    }






}