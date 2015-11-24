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
use trogue\Repository\AcopioRep;


class ProveedoresController extends Controller{
    protected $proveedorRep;
    protected $rutaRep;
    protected $acopioRep;

    public function __construct(ProveedorRep $proveedorRep,RutaRep $rutaRep,AcopioRep $acopioRep){

        $this->proveedorRep = $proveedorRep;
        $this->rutaRep = $rutaRep;
        $this->acopioRep = $acopioRep;


    }

    public function index(){

        $proveedores = $this->proveedorRep->all();


    }



    /*return un JSON*/
    public function getProveedorByID($id)
    {
        $proveedor = $this->proveedorRep->find($id);
        return \Response::json($proveedor);
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

    public function getViewUpdateProveedor($id)
    {
        $proveedor = $this->proveedorRep->find($id);
        $rutas = $this->rutaRep->all();
        return view('Proveedores/viewUpdateProveedor',compact('rutas','proveedor'));
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
            return  redirect()->back()->withInput()->withErrors($bandera);
            //return \Redirect::back()->withInput()->withErrors($bandera);
        }
    }


    public function updateDataProveedor()
    {
       $data = \Input::all();

       $bandera = $this->proveedorRep->updateDataProveedor($data);

       if ($bandera === 1) {

         return \Redirect::route('proveedoresAll')->with(array('confirm' => 'Proveedor Registrado'));
          
       } else {
            return  redirect()->back()->withInput()->withErrors($bandera);
       }
       
    }






    /*------Metodo: getProveedorByDNIService
     * se traera con este metodo
    *a un proveedor con su promedio
     * quincenal para lograr aplicar logica
     * de negocio en el frontend, teniendo en
     * cuenta que si se necesita otro metodo mas
     * limpio agregar otro metodo
    */

    public function getProveedorByDNIService()
    {
        $data = \Input::all();

        $proveedor = $this->proveedorRep->getProveedorByDNI($data['dni']);

        if(isset($proveedor->id)){
            $proveedor->promedioQuincenal = $this->acopioRep->getPromedioAcopioByIdProveedor($proveedor->id);
        }


        return \Response::json($proveedor);
    }

    /*------Metodo: ServiceGetWithPrestamosAndLetras
    * se traera con este metodo
     * a un proveedor con sus prestamos y letras habiles
   */

    public function ServiceGetWithPrestamosAndLetras()
    {
        $data = \Input::all();

        $proveedor = $this->proveedorRep->getProveedorByDNI($data['dni']);

        $proveedor = $this->proveedorRep->getProveedorByPrestamos($proveedor->id);


        return \Response::json($proveedor);
    }





}