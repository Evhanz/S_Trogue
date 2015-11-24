<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 20/11/2015
 * Time: 8:22 PM
 */

namespace trogue\Repository;

use Illuminate\Support\Facades\DB;
use trogue\Entities\PagoProveedor;
use trogue\Entities\PagoLetra;
use trogue\Entities\PagoVentaTerceros;
use trogue\Entities\Prestamo;
use trogue\Entities\VentaTerceros;
use trogue\Entities\Letra;


//esto e la clase para el Pago Proveedor
class PagoRep {


    public function regPago($data)
    {
        DB::transaction(function() use ($data)
        {
            $pago = $data['pago_proveedor'];


            $pago_proveedor = new PagoProveedor();
            $pago_proveedor->fecha_inicio = $pago['fecha_inicio'];
            $pago_proveedor->fecha_fin = $pago['fecha_fin'];
            $pago_proveedor->precio_litro = $pago['precio_litro'];
            $pago_proveedor->total_descontado = $pago['total_descontado'];
            $pago_proveedor->pago_total = $pago['pago_total'];
            $pago_proveedor->liquidacion_id = $pago['liquidacion_id'];
            $pago_proveedor->proveedor_id = $pago['proveedor_id'];
            $pago_proveedor->save();

            if(count($data['pago_letras'])>0){
                foreach($data['pago_letras'] as $item){
                    $this->regPagoLetra($item,$pago_proveedor);
                }

            }


            if(count($data['pago_venta_terceros'])>0){
                foreach($data['pago_venta_terceros'] as $item){
                    $this->regPagpVentaterceros($item,$pago_proveedor);
                }
            }


        });


    }


    public function regPagoLetra($pago_letra,$pago_proveedor)
    {
        //primero creamos el pago letra
        $p_letra = new PagoLetra();
        $p_letra->fecha_pago = $pago_proveedor->created_at;
        $p_letra->monto_pagado = $pago_letra['monto_inicial']+$pago_letra['interes'];
        $p_letra->pago_proveedor_id = $pago_proveedor->id;
        $p_letra->letra_id = $pago_letra['id'];
        $p_letra->save();


        //luego actualizamos la letra

        $letra = Letra::find($pago_letra['id']);

        $letra->estado = 1;

        $letra->save();


        //luego traemos al prestamo

        $prestamo = Prestamo::find($pago_letra['prestamo_id']);

        //comparamos si s la ultima letra para poder actualizar el prestamo

        if($letra->n_letra == $prestamo->n_letras){
            $prestamo->estado = 'pagada';
            $prestamo->save();

        }

    }

    public function regPagpVentaterceros($pago_venta_terceros, $pago_proveedor)
    {
        $p_venta_terceros = new PagoVentaTerceros();
        $p_venta_terceros->monto_pagado = $pago_venta_terceros['monto'];
        $p_venta_terceros->pago_proveedor_id = $pago_proveedor->id;
        $p_venta_terceros->venta_terceros_id = $pago_venta_terceros['id'];
        $p_venta_terceros->save();

        //luego actualizamos la venta a terceros
        $venta_tercero = VentaTerceros::find($pago_venta_terceros['id']);
        $venta_tercero->estado = 1;
        $venta_tercero->save();

    }

}