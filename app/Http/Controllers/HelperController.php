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





}