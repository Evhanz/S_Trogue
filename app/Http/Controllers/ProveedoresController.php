<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 02/07/2015
 * Time: 16:45
 */

namespace Trogue\Http\Controllers;
use trogue\Repository\ProveedorRep;
use trogue\Repository\RutaRep;


class ProveedoresController extends Controller{
    protected $proveedorRep;
    protected $rutaRep;

    public function __construct(ProveedorRep $proveedorRep,RutaRep $rutaRep){

        $this->proveedorRep = $proveedorRep;
        $this->rutaRep = $rutaRep;

    }

    public function index(){

        $proveedores = $this->proveedorRep->all();
        dd($proveedores);
    }


    public function selectAllProveedores(){

        $proveedores = $this->proveedorRep->all();
        return view('Proveedores/viewAllProveedores',compact('proveedores'));
    }

    public function getProveedoresByCriterio($criterio,$dni){


        $proveedores = $this->proveedorRep->getProveedoresByCriterio($criterio,$dni);
        return view('Proveedores/viewAllProveedores',compact('proveedores','criterio','dni'));
    }


    public function getViewNewProveedor(){

        $rutas = $this->rutaRep->all();
        return view('Proveedores/viewNewProveedor',compact('rutas'));

    }


    public function  regProveedor(){

        $data = \Input::all();
        //$data="a";
        $bandera = $this->proveedorRep->RegProveedor($data);
        //dd($data);

        if($bandera === 1){
            return \Redirect::route('proveedoresAll')->with(array('confirm' => 'Proveedor Registrado'));
        }
        else{
            return \Redirect::back()->withInput()->withErrors($bandera);
        }
    }

}