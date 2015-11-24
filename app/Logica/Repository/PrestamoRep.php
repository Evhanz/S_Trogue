<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 26/10/2015
 * Time: 12:44 PM
 */

namespace trogue\Repository;

use trogue\Entities\Prestamo;
use trogue\Entities\Letra;
use Illuminate\Support\Facades\DB;

class PrestamoRep {

    public function all()
    {
        $prestamos = Prestamo::with('detallePrestamo');
        return $prestamos;
    }


    public function regPrestamo($data)
    {
        try{

            DB::transaction(function() use ($data)
            {
                $prestamo = new Prestamo();
                $prestamo->descripcion = $data['descripcion'];
                $prestamo->cantidad = $data['cantidad'];
                $prestamo->prioridad = $data['prioridad'];
                $prestamo->estado = 'deuda';
                $prestamo->tasa = $data['tasa'];
                $prestamo->interes = $data['interes'];
                $prestamo->proveedor_id = $data['proveedor_id'];
                $prestamo->recurso_id=$data['recurso_id'];
                $prestamo->n_letras = $data['n_letras'];
                $prestamo->save();

                $i = 0;

                foreach($data['letras'] as $letra){
                    $i++;
                    $this->regLetra($prestamo->id,$letra,$i);
                }
            });

            return 1;
        }catch (\Exception $e){
            return $e;
        }


    }

    public function regLetra($idPrestamo,$Letra,$i){

        $letra = new Letra();
        $letra->monto_inicial = $Letra['monto'];
        $letra->fecha_vencimiento = $Letra['fecha'];
        $letra->estado = "0";
        $letra->interes = $Letra['interes'];
        $letra->prestamo_id = $idPrestamo;
        $letra->n_letra = $i;
        $letra->save();
    }




}