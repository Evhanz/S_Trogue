<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 7/11/2015
 * Time: 12:21 PM
 */

namespace trogue\Repository;

use trogue\Entities\VentaTerceros;

class VentaTercerosRep {


    public function all(){
        return VentaTerceros::all();
    }

    public function find($id){
        return VentaTerceros::where('id','=',$id)->with('proveedor')->first();

    }

    public function regVentaTerceros($data)
    {
        $venta_terceros = new VentaTerceros();

        $venta_terceros->descripcion = $data['descripcion'];
        $venta_terceros->monto = $data['cantidad'];
        $venta_terceros->n_docuemento = $data['n_documento'];
        $venta_terceros->estado = false;
        $venta_terceros->proveedor_id = $data['proveedor_id'];
        $venta_terceros->origen_id = $data['recurso'];
        $venta_terceros->fecha = $data['fecha'];

        try{

            $venta_terceros->save();
            $bandera =1;

        }catch (\Exception $e){
            $bandera = $e;
        }

        return $bandera;

    }


    public function updateVentaTerceros($data)
    {
        $venta_terceros = VentaTerceros::find($data['idVenta']);

        $venta_terceros->descripcion = $data['descripcion'];
        $venta_terceros->monto = $data['cantidad'];
        $venta_terceros->n_docuemento = $data['n_documento'];
        $venta_terceros->estado = false;
        $venta_terceros->proveedor_id = $data['proveedor_id'];
        $venta_terceros->origen_id = $data['recurso'];
        $venta_terceros->fecha = $data['fecha'];

        try{

            $venta_terceros->save();
            $bandera =1;

        }catch (\Exception $e){
            $bandera = $e;
        }

        return $bandera;



    }

    public function deleteVentaTercero($id){

        $venta = VentaTerceros::find($id);

        $venta->delete();


    }


}