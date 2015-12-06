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

    public function getPrestamosByParams()
    {

        $data = \Input::all();


        if (strlen($data['dni']) > 0) {

            $prestamos = $this->prestamoRep->getPrestamosByParams($data['estado'],$data['dni'],$data['fecha_inicio'],$data['fecha_fin']);

        } else {
            $prestamos = $this->prestamoRep->getPrestamosByFechas($data['estado'],$data['fecha_inicio'],$data['fecha_fin']);

        }

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

    public function getViewUpPrestamo($id){


        $res = $this->prestamoRep->getValidateUpdate($id);

        if($res==0){
            $recursos = $this->recursoRep->all();

            return view('Servicio/viewUpPrestamo',compact('recursos','id'));

        }else{
            return redirect()->back()->with(array('fail' => 'El Prestamo ya a pagado una letra , no puede ser actualizada'));

        }


    }

    public function getPrestamoById($id)
    {


        $prestamos = $this->prestamoRep->getPrestamoById($id);

        return \Response::json($prestamos);
    }


    public function updatePrestamo(){
        $data  = \Input::all();



        $bandera =$this->prestamoRep->updatePrestamo($data);

        if($bandera === 1){

            $mensaje = 'Registrado';

        }else
            $mensaje = $bandera;

        return \Response::json($mensaje);

    }

    public function deletePrestamo($id)
    {
        $res = $this->prestamoRep->getValidateUpdate($id);

        if($res==0){

            try{
                $this->prestamoRep->deletePrestamo($id);
                return redirect()->back()->with(array('confirm' => 'El Prestamo a sido eliminado'));
            }catch (\Exception $e){
                return redirect()->back()->with(array('fail' => 'El Prestamo no puede ser eliminado, verefique sus dependencias'));

            }
        }else{
            return redirect()->back()->with(array('fail' => 'El Prestamo no puede ser eliminado, verefique sus dependencias'));

        }
    }


}