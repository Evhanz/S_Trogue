<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 03/07/2015
 * Time: 17:15
 */

namespace Trogue\Http\Controllers;
use trogue\Repository\AcopioRep;
use trogue\Repository\AnexoRep;
use trogue\Repository\ProveedorRep;
use trogue\Repository\RutaRep;
use trogue\Entities\Acopio;



class AcopioController extends Controller{
    protected $acopioRep;
    protected $anexoRep;
    protected $proveedorRep;
    protected $rutaRep;

    public function __construct(AcopioRep $acopioRep,AnexoRep $anexoRep,  ProveedorRep $proveedorRep,RutaRep $rutaRep){

        $this->acopioRep = $acopioRep;
        $this->anexoRep = $anexoRep;
        $this->proveedorRep = $proveedorRep;
        $this->rutaRep = $rutaRep;

    }

    public function index(){
        $proveedores = $this->proveedorRep->all();
        $rutas = $this->rutaRep->all();
        return view('Control/viewAllProveedores',compact('proveedores', 'rutas'));
    }

    public function getProveedoresByAnexo($id){

        $proveedores = $this->proveedorRep->getProveedorByAnexo($id);
        $rutas = $this->rutaRep->all();
        return view('Control/viewAllProveedores',compact('proveedores', 'rutas'));
    }


    public function regAcopio(){
        $data = \Input::all();
        //dd($data);

        $acopio = new Acopio();

        $acopio->feha=$data['fecha'];
        $acopio->cantidad=$data['Cantidad'];
        $acopio->proveedor_id=$data['hdId'];


        if($acopio->save()){
            return \Redirect::route('getAcopioAll')->with(array('confirm' => 'Acopio registrado'));

        }else{
            return \Redirect::route('getAcopioAll')->with(array('fail' => 'Error en el registro'));
        }

    }



}