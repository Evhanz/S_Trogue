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
        

        //va  traer el resultado si ya existe un acopio del mismo dia
        $res = $this->acopioRep->getAcopioByProveedorAndFecha($data['hdId'],$data['fecha']);

        //si res es 0 no hay uno igual
        if ($res == 0) {
            # code...
            $bandera = $this->acopioRep->regAcopio($data);

            if($bandera == 1){
                return \Redirect::route('getAcopioAll')->with(array('confirm' => 'Acopio registrado'));

            }else{
                return \Redirect::route('getAcopioAll')->with(array('fail' => 'Error en el registro'));
            }
        }else{

             return \Redirect::route('getAcopioAll')->with(array('fail' => 'El Acopio ya a sido ingresado en ese dia'));
        }

    }


    public function updateAcopio()
    {
        $data = \Input::all();

        $bandera = $this->acopioRep->updateAcopio($data);

        if($bandera == 1){

            return redirect()->back()->with(array('confirm' => 'Acopio actualizda correctamente'));

        }else{

            return redirect()->back()->with(array('fail' => 'Acopio no puede actualizarse'));

        }


    }


    public function deleteAcopio($id)
    {

        try{

            $this->acopioRep->deleteAcopio($id);
            return redirect()->back()->with(array('confirm' => 'Acopio borrado'));

        }catch(\Exception $e){

            return redirect()->back()->with(array('fail' => 'Acopio no puede borrarse '));

        }


    }
    

    public function getAcopioByProveedor($idProveedor)
    {
       //dd($idProveedor);

        $acopios = $this->acopioRep->getAllByProveedor($idProveedor);

        $proveedor = $this->proveedorRep->getProveedorById($idProveedor);

        return view('Control/getAcopioByProveedor',compact('proveedor', 'acopios'));

    }

    public function getAcopioByProveedorAndFechas()
    {

        $data = \Input::all();
        $id = $data['id'];
        $fecha_inicio = $data['fecha_inicio'];
        $fecha_fin=$data['fecha_fin'];

        $acopios = $this->acopioRep->getAcopioByProveedorAndFechas($id,$fecha_inicio, $fecha_fin);

        $proveedor = $this->proveedorRep->getProveedorById($id);

        return view('Control/getAcopioByProveedor',compact('proveedor', 'acopios','data'));

    }

    public function getSumaAcopioByProveedorAndFechas(){

        $data = \Input::all();
        $id = $data['id'];
        $fecha_inicio = $data['fecha_inicio'];
        $fecha_fin=$data['fecha_fin'];


        $acopios = $this->acopioRep->getAcopioByProveedorAndFechas($id,$fecha_inicio, $fecha_fin);


        $suma = 0 ;

        if(count($acopios)>0){
            foreach($acopios as $item){

                $suma += $item->cantidad_total;
            }
        }


        return \Response::json($suma);

    }


    public function getAcopioById()
    {
        $data = \Input::all();

        $id = $data['id'];

        $acopio = $this->acopioRep->find($id);

        $acopio->provName = $acopio->proveedor->name.$acopio->proveedor->apellidoP.$acopio->proveedor->apellidoM;



        return \Response::json($acopio);

    }



    public function getPromedioByProveedorID($id)
    {


    }




    /*solo prueba*/



    /*---------------------------------------*/
    /*area de servicios*/

    public function getAcopioByDay()
    {   $hoy = date("Y-m-d");
        $acopios = $this->acopioRep->getAcopioByDay($hoy);

        return \Response::json($acopios);
    }


    public function getUltimosACopios()
    {
        $res = $this->acopioRep->getUltimosACopios();

        return \Response::json($res);

    }







}