<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 21/10/2015
 * Time: 6:17 PM
 */

namespace trogue\Repository;

use trogue\Entities\Liquidacion;
use trogue\Entities\DetalleLiquidacion;
use trogue\Entities\DetalleDescuentoLiquidacion;
use Illuminate\Support\Facades\DB;


class LiquidacionRep {


    public function getAllLiquidacion()
    {
        $liquidaciones = Liquidacion::with('ruta')->orderBy('id', 'desc')->paginate(10);
        return $liquidaciones;
    }


    public function getLiquidacionByNumero($numero)
    {
        $liquidacion = Liquidacion::where('numero','like',$numero)->paginate(10);
        return $liquidacion;
    }


    public function regLiquidacion($data)
    {


        DB::transaction(function() use ($data)
        {
            $liquidacion = $data['liquidacion'];
            $detalle_liquidacion = $data['detalle_acopio'];
            $detalle_descuento = $data['detalle_descuento'];

            $liqui = new Liquidacion();
            $liqui->numero = $liquidacion['codigo_liquidacion'];
            $liqui->precio_ref = $liquidacion['valor_litro'];
            $liqui->solidos = $liquidacion['numeroSolidos'];
            $liqui->fecha_inicio = $liquidacion['fecha_inicio'];
            $liqui->fecha_fin = $liquidacion['fecha_fin'];
            $liqui->descuentos = $liquidacion['descuentos'];
            $liqui->litros = $liquidacion['litros'];
            $liqui->pago_neto = $liquidacion['pago_neto'];
            $liqui->ruta_id = $liquidacion['ruta'];

            $liqui->save();


            if(count($detalle_liquidacion)>0){

                foreach($detalle_liquidacion as $detalle){

                    $detalleLiquidacion = new DetalleLiquidacion();
                    $detalleLiquidacion->cantidad = $detalle['cantidad'];
                    $detalleLiquidacion->dia = $detalle['fecha'];
                    $detalleLiquidacion->liquidacion_id = $liqui->id;
                    $detalleLiquidacion->save();
                }

            }


            if(count($detalle_descuento)>0){

                foreach($detalle_descuento as $detalle){

                    $detalle_descuento = new DetalleDescuentoLiquidacion();
                    $detalle_descuento->descripcion = $detalle['descripcion'];
                    $detalle_descuento->fecha = $detalle['fecha'];
                    $detalle_descuento->monto = $detalle['monto'];
                    $detalle_descuento->liquidacion_id = $liqui->id;
                    $detalle_descuento->save();
                }

            }



        });

        return 0;


    }

    public function getLiquidacionByFechas($fecha_inicio,$fecha_fin)
    {
        $liquidaciones = Liquidacion::where('fecha_inicio','>=',$fecha_inicio)
            ->where('fecha_fin','<=',$fecha_fin)->paginate(10);

        return $liquidaciones;

    }


}