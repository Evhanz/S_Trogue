<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 03/07/2015
 * Time: 14:47
 */

namespace trogue\Repository;
use trogue\Entities\Anexo;


class AnexoRep {

    public function getAnexoByRuta($id){

        $rutas = Anexo::where('ruta_id','=',$id)->get();
        return $rutas;

    }

    public function all()
    {
    	$anexos = Anexo::all();
    	return $anexos;
    }

    public function regAnexo($data)
    {


        $rules=[
            'descripcion' => 'required|unique:anexos',
            'observacion' => 'required',
            'ruta' => 'required'
        ];

        $data = array_only($data,array_keys($rules));
        $validation = \Validator::make($data,$rules);

        $isValid = $validation->passes();

        if($isValid){
            $anexo = new Anexo();
            $anexo->descripcion = $data['descripcion'];
            $anexo->observacion = $data['observacion'];
            $anexo->ruta_id = $data['ruta'];
            $anexo->save();
            return 1;

        }else
        {
            return $validation->messages();
        }
    }

}