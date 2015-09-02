<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 03/07/2015
 * Time: 17:18
 */

namespace trogue\Repository;
use trogue\Entities\Acopio;


class AcopioRep {

    public function getAllByProveedor($id){

        $acopios = Acopio::where('proveedor_id','=',$id)->get();
        return $acopios;

    }

    public function  getAcopioByProveedorAndFecha($id,$fecha){

        $acopio = Acopio::where('proveedor_id','=',$id)->where('proveedor_id','=',$id);

    }

}