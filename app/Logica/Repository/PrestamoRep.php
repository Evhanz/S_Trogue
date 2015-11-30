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
        $prestamos = Prestamo::all();
        return $prestamos;
    }

    public function getPrestamoById($id)
    {
        $prestamo = Prestamo::where('id','like',$id)->with('letras','proveedor')->first();
        return $prestamo;
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


    public function getPrestamosByParams($estado,$dni,$fecha_inicio,$fecha_fin)
    {
        $pretamos = Prestamo::where('prestamos.estado','like',$estado)
            ->join('proveedores', 'prestamos.proveedor_id', '=', 'proveedores.id')
            ->where('proveedores.dni','like',$dni)
            ->where('prestamos.created_at','>=',$fecha_inicio)
            ->where('prestamos.created_at','<=',$fecha_fin)
            ->get();

        return $pretamos;

    }

    public function getPrestamosByFechas($estado,$fecha_inicio,$fecha_fin)
    {
        $pretamos = Prestamo::where('estado','like',$estado)
            ->where('created_at','>=',$fecha_inicio)
            ->where('created_at','<=',$fecha_fin)
            ->get();

        return $pretamos;

    }

    public function updatePrestamo($data)
    {
        DB::transaction(function() use ($data)
        {
            $prestamo = Prestamo::find($data['idPrestamo']);
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

            $this->deleteLetra($prestamo->id);


            $i = 0;

            foreach($data['letras'] as $letra){
                $i++;
                $this->regLetra($prestamo->id,$letra,$i);
            }
        });

        return 1;

    }


    public function deleteLetra($id)
    {
        $rowsAcopio = Letra::where('prestamo_id','like',$id)->delete();

    }

    public function getValidateUpdate($idPrestamo){

        $letras = Letra::where('prestamo_id','like',$idPrestamo)->get();

        $res = 0;

        foreach($letras as $letra){

            if(count($letra->pago_letra)>0){
                $res =1;
            }

        }

        return $res;


    }

    public function deletePrestamo($id){

        DB::transaction(function() use ($id)
        {

            $prestamo = Prestamo::find($id);
            $this->deleteLetra($prestamo->id);
            $prestamo->delete();

        });

    }






}