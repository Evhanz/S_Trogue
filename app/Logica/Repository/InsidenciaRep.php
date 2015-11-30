<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 11/10/2015
 * Time: 11:43 AM
 */

namespace trogue\Repository;

use trogue\Entities\Insidencia;
use trogue\Entities\Acopio;



class InsidenciaRep {


    public function getInsidenciaByAcopio($data){

        $id = $data['id'];

        $insidencia = Insidencia::where('id','like',$id)->with('acopio.proveedor')->first();

        return $insidencia;

    }

    public function regDescuentoInsidencia($data)
    {

        $res = 0;

        $insidencia = new Insidencia();
        $insidencia->cantidad = $data['CantidadInsidencia'];
        $insidencia->tipo = "descuento";
        $insidencia->observacion = $data['observacion'];
        $insidencia->acopio_id = $data['hdIdAcopio'];

        if($insidencia->save()){

            $acopio = Acopio::find($data['hdIdAcopio']);
            $acopio->cantidad_total -= $insidencia->cantidad;
            $acopio->save();

            $res = 1;
        }

        return $res;
    }

    public function regObservacionInsidencia($data)
    {
        $res = 0;

        $insidencia = new Insidencia();
        $insidencia->cantidad = $data['CantidadInsidencia'];
        $insidencia->tipo = "observacion";
        $insidencia->observacion = $data['observacion'];
        $insidencia->acopio_id = $data['hdIdAcopio'];

        if($insidencia->save()){

            $res = 1;
        }

        return $res;

    }


    public function upDescuentoInsidencia($data)
    {

        $res = 0;


        //primero traigo a la insidencia
        $idInsidencia = $data['hdIdInsidencia'];

        $insidencia = Insidencia::find($idInsidencia);

        if($insidencia->tipo=='descuento'){
            $cant_anterior_insidencia = $insidencia->cantidad;

            $insidencia->cantidad = $data['CantidadInsidencia'];
            $insidencia->tipo = "descuento";
            $insidencia->observacion = $data['observacion'];
            $insidencia->acopio_id = $data['hdUpIdAcopio'];

            if($insidencia->save()){

                $acopio = Acopio::find($data['hdUpIdAcopio']);

                $total = ($acopio->cantidad_total +$cant_anterior_insidencia)-$insidencia->cantidad;

                $acopio->cantidad_total = $total;
                $acopio->save();

                $res = 1;
            }
        }else{

            $insidencia->cantidad = $data['CantidadInsidencia'];
            $insidencia->tipo = "descuento";
            $insidencia->observacion = $data['observacion'];
            $insidencia->acopio_id = $data['hdUpIdAcopio'];

            if($insidencia->save()){

                $acopio = Acopio::find($data['hdUpIdAcopio']);
                $acopio->cantidad_total -= $insidencia->cantidad;
                $acopio->save();

                $res = 1;
            }

        }



        return $res;
    }


    public function upObservacionInsidencia($data)
    {
        $res = 0;

        $insidencia =Insidencia::find($data['hdIdInsidencia']);

        if($insidencia->tipo=='descuento'){

            $cant_anterior_insidencia = $insidencia->cantidad;

            $insidencia->cantidad = $data['CantidadInsidencia'];
            $insidencia->tipo = "observacion";
            $insidencia->observacion = $data['observacion'];
            $insidencia->acopio_id = $data['hdUpIdAcopio'];

            if($insidencia->save()){

                $acopio = Acopio::find($data['hdUpIdAcopio']);
                $acopio->cantidad_total += $cant_anterior_insidencia;
                $acopio->save();

                $res = 1;
            }

        }else{
            $insidencia->cantidad = $data['CantidadInsidencia'];
            $insidencia->tipo = "observacion";
            $insidencia->observacion = $data['observacion'];
            $insidencia->acopio_id = $data['hdUpIdAcopio'];

            if($insidencia->save()){

                $res = 1;
            }

        }


        return $res;

    }

    public function deleteInsidencia($id)
    {
        $insidencia = Insidencia::find($id);

        if($insidencia->tipo =='descuento'){


            $acopio = $insidencia->acopio;

            $acopio->cantidad_total += $insidencia->cantidad;


            $insidencia->delete();

            $acopio->save();


        }else{
            $insidencia->delete();

        }


    }


    public function getInsidencias()
    {

        return Insidencia::with('acopio.proveedor')->take(5)->get();

    }


}