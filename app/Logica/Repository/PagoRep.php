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


    public function all()
    {
        return PagoProveedor::all();
    }


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

    public function updatePago($data)
    {
        DB::transaction(function() use ($data)
        {




            $pago = $data['pago_proveedor'];

            //primero eliminamos
            $this->deletePagoLetra($pago['idPago']);
            $this->deletePagoVentaTercero($pago['idPago']);


            $pago_proveedor = PagoProveedor::find($pago['idPago']);
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


    public function deletePagoLetra($idPago){


        $pagoLetra = PagoLetra::where('pago_proveedor_id','=',$idPago)->get();

        /*recorremos todos los pagos letras */
        foreach($pagoLetra as $pago){

            //traermos a la letra
            $letra = $pago->letra;

            //prestamos
            $prestamo = $letra->prestamo;


            //sacar la cantidad de cuantas letras estan pagadas

            $cantidad = Letra::where('prestamo_id','=',$prestamo->id)->where('estado','=','0')->get();


            //comprobamos si es la ultima letra
            //para modificar el estado del prestamo

            if($prestamo->n_letras == $letra->n_letra || count($cantidad)==0){

                $prestamo->estado ="deuda";
                $prestamo->save();

            }

            //luego modificamos estado de la letra

            $letra->estado = 0;
            $letra->save();

            //eliminamos la letra pago

            $pago->delete();

        }



    }

    public function deletePagoVentaTercero($idPago){


        $pagoVentaTerceros = PagoVentaTerceros::where('pago_proveedor_id','=',$idPago)->get();

        /*recorremos todos los pagos ventas terceros */
        foreach($pagoVentaTerceros as $pago){


            $ventaTercero = $pago->venta_tercero;
            $ventaTercero->estado = 0;
            $ventaTercero->save();

            $pago->delete();

        }

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

        //traemos a todas las letras no pagadas para comparar
        //sacamos la cantidad de letras en deudas
        $cantidad = Letra::where('prestamo_id','=',$pago_letra['id'])->where('estado','=','0')->get();


        //comparamos si s la ultima letra para poder actualizar el prestamo

        if($letra->n_letra == $prestamo->n_letras || count($cantidad)==0){
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
        $venta_tercero->estado = 1;/* 1 significa pagado*/
        $venta_tercero->save();

    }


    public function getPagoById($id){

        $pago = PagoProveedor::where('id','=',$id)
            ->with('pago_letra.letra','pago_venta_tercero.venta_tercero.origen','proveedor','liquidacion')
            ->first();


        return $pago;

    }


    public function getPagoByFechas($f_ini,$f_fin){


        $pagos = PagoProveedor::where(function($query) use ($f_ini){
            return $query
                ->where('fecha_inicio','<=',$f_ini)
                ->where('fecha_fin', '>=', $f_ini);
        })->orWhere(function($query) use ($f_fin){
            return $query
                ->where('fecha_inicio','<=',$f_fin)
                ->where('fecha_fin', '>=', $f_fin);
        })->get();


        return $pagos;


    }


    public function deletePagoProveedor($id)
    {
        DB::transaction(function() use ($id)
        {

            $this->deletePagoLetra($id);
            $this->deletePagoVentaTercero($id);

            $pago = PagoProveedor::find($id);

            $pago->delete();

        });

    }



}