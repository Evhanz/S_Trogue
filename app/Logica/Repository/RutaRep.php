<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 03/07/2015
 * Time: 14:39
 */

namespace trogue\Repository;
use trogue\Entities\Ruta;


class RutaRep {

    public function all(){
        return Ruta::all();
    }

    public function find($id){

        return Ruta::find($id);

    }

    public function regRuta($data)
    {

        $rules=[
            'descripcion' => 'required|unique:rutas',
            'observacion' => 'required'
        ];

        $data = array_only($data,array_keys($rules));
        $validation = \Validator::make($data,$rules);

        $isValid = $validation->passes();

        if($isValid){
            $ruta = new Ruta();
            $ruta->descripcion = $data['descripcion'];
            $ruta->observacion = $data['observacion'];
            $ruta->save();
            return 1;

        }else
        {
            return $validation->messages();
        }

    }


    public function updateRuta($data)
    {
        try{
            $ruta = Ruta::find($data['id']);
            $ruta->descripcion = $data['descripcion'];
            $ruta->observacion = $data['observacion'];
            $ruta->save();
            return 1;
        }
        catch(\Exception $e){

            return $e;

        }
    }
}