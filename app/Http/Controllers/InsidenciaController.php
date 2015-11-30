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

            return redirect()->back()->with(array('confirm' => 'Insidencia  Agregada','proveedor'=>$proveedor,'acopios'=>$acopios));

        }else{
            $bad = true;
            $acopios = $this->acopioRep->getAllByProveedor($data['hdIdProveedor']);
            $proveedor = $this->proveedorRep->getProveedorById($data['hdIdProveedor']);

            return redirect()->back()->with(array('fail' => 'Insidencia  no puede ser agregada','proveedor'=>$proveedor,'acopios'=>$acopios));
        }
    }


    public function UpdateInsidencia()
    {
        $data = \Input::all();

        if($data['seltipo'] == "descuento" ){

            $res = $this->insidenciaRep->upDescuentoInsidencia($data);

        }else{
            $res = $this->insidenciaRep->upObservacionInsidencia($data);

        }

        if($res == 1){

            $good = true;
            $acopios = $this->acopioRep->getAcopioByProveedorAndFechas($data['hdUpIdProveedor'],$data['hdUpFechaAcopio'],$data['hdUpFechaAcopio']);

            $proveedor = $this->proveedorRep->getProveedorById($data['hdUpIdProveedor']);

            return redirect()->back()->with(array('confirm' => 'Insidencia actualizda correctamente','proveedor'=>$proveedor,'acopios'=>$acopios));
        }else{
            $bad = true;
            $acopios = $this->acopioRep->getAllByProveedor($data['hdUpIdProveedor']);
            $proveedor = $this->proveedorRep->getProveedorById($data['hdUpIdProveedor']);
            return redirect()->back()->with(array('fail' => 'Insidencia  no puede ser actualizada','proveedor'=>$proveedor,'acopios'=>$acopios));
           // return view('Control/getAcopioByProveedor',compact('proveedor', 'acopios','bad'))->with(array('fail' => 'Insidencia  No Actualizada'));

        }
    }

    public function getInsidenciaByAcopio()
    {
        $data = \Input::all();


        $insidencia = $this->insidenciaRep->getInsidenciaByAcopio($data);


        return \Response::json($insidencia);



    }

    public function deleteInsidencia($id)
    {

        try{

            $this->insidenciaRep->deleteInsidencia($id);
            return redirect()->back()->with(array('confirm' => 'Insidencia  Eliminada'));

        }catch (\Exception $e){

            return redirect()->back()->with(array('fail' => 'El valor contiene dependencias'));

        }


    }

    public function getInsidencias()
    {

        $insidencias = $this->insidenciaRep->getInsidencias();

        return \Response::json($insidencias);


    }

    


}