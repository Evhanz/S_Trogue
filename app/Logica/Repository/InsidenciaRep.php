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

}