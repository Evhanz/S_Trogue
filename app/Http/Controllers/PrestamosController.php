<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 26/10/2015
 * Time: 11:57 AM
 */

namespace Trogue\Http\Controllers;

use trogue\Repository\ProveedorRep;
use trogue\Repository\PrestamoRep;
use trogue\Repository\RecursoRep;



class PrestamosController extends Controller{

    public $prestamoRep;
    public $proveedorRep;
    public $recursoRep;

    public function __construct(ProveedorRep $proveedorRep,PrestamoRep $prestamoRep,RecursoRep $recursoRep)
    {
        $this->proveedorRep = $proveedorRep;
        $this->prestamoRep = $prestamoRep;
        $this->recursoRep = $recursoRep;
    }

    public function getAllPrestamos()
    {
        $prestamos = $this->prestamoRep->all();
        return view('Servicio/viewAllPrestamos',compact('prestamos'));

    }

    public function getProveedoresForPrestamos(){

        $proveedores = $this->proveedorRep->all();

        return view('Servicio/viewAllPrestamos',compact('proveedores'));

    }

    public function getViewNewPrestamo()
    {

        $recursos = $this->recursoRep->all();

        return view('Servicio/viewNewPrestamo',compact('recursos'));
    }

    public function regPrestamo()
    {
        $data  = \Input::all();
        
        $bandera =$this->prestamoRep->regPrestamo($data);

        if($bandera === 1){

            $mensaje = 'Registrado';

        }else
            $mensaje = $bandera;

        return \Response::json($mensaje);


    }


}