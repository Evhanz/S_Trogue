<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 11/10/2015
 * Time: 11:39 AM
 */

namespace Trogue\Http\Controllers;

use trogue\Repository\InsidenciaRep;
use trogue\Repository\AcopioRep;
use trogue\Repository\ProveedorRep;

class InsidenciaController extends Controller{


    protected $insidenciaRep;
    protected $acopioRep;
    protected $proveedorRep;

    public function __construct(InsidenciaRep $insidenciaRep,AcopioRep $acopioRep,ProveedorRep $proveedorRep)
    {
        $this->insidenciaRep = $insidenciaRep;
        $this->acopioRep = $acopioRep;
        $this->proveedorRep = $proveedorRep;

    }

    public function RegInsidencia()
    {
        $data = \Input::all();



        if($data['seltipo'] == "descuento" ){

            $res = $this->insidenciaRep->regDescuentoInsidencia($data);

        }else{
            $res = $this->insidenciaRep->regObservacionInsidencia($data);

        }

        if($res == 1){

            $good = true;
            $acopios = $this->acopioRep->getAcopioByProveedorAndFechas($data['hdIdProveedor'],$data['hdFechaAcopio'],$data['hdFechaAcopio']);

            $proveedor = $this->proveedorRep->getProveedorById($data['hdIdProveedor']);

            return view('Control/getAcopioByProveedor',compact('proveedor', 'acopios','good'))->with(array('confirm' => 'Insidencia  Registrada'));
        }else{
            $bad = true;
            $acopios = $this->acopioRep->getAllByProveedor($data['hdIdProveedor']);
            $proveedor = $this->proveedorRep->getProveedorById($data['hdIdProveedor']);
            return view('Control/getAcopioByProveedor',compact('proveedor', 'acopios','bad'))->with(array('fail' => 'Insidencia  Registrada'));
        }
    }

    


}