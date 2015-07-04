<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 01/07/2015
 * Time: 17:03
 */

namespace trogue\Repository;
use trogue\Entities\Proveedor;

class ProveedorRep {

    public function find($id){
        return Proveedor::find($id);
    }

    public function all(){
        return Proveedor::paginate(3);
    }

    public function getProveedoresByCriterio($criterio,$dni){

        if($dni!='0'){

            $criterio ='%'.$criterio.'%';
            $proveedores = Proveedor::where('dni', 'like',$dni)->where(function ($query) use ($criterio){
                $query->where('name', 'like',$criterio);
                $query->orWhere('apellidoP', 'like',$criterio);
                $query->orWhere('apellidoM', 'like',$criterio);
            })->paginate(5);

        }else{

            $criterio ='%'.$criterio.'%';
            $proveedores = Proveedor::where(function ($query) use ($criterio){
                $query->where('name', 'like',$criterio);
                $query->orWhere('apellidoP', 'like',$criterio);
                $query->orWhere('apellidoM', 'like',$criterio);
            })->paginate(5);

        }

        return $proveedores;

    }


    public function getProveedorByAnexo($id){

        $proveedores = Proveedor::where('anexo_id','=',$id)->paginate(5);
        return $proveedores;

    }


    public function RegProveedor($data){

        $anexos = $data['anexos'];

        $rules=[

            'name' => 'required',
            'apellidoP' => 'required|min:4',
            'apellidoM' => 'required|min:4',
            'dni' => 'required|max:8',
            'celular' => 'min:7',

        ];

        $data = array_only($data,array_keys($rules));
        $validation = \Validator::make($data,$rules);

        $isValid = $validation->passes();

        if($isValid){

            $proveedor = new Proveedor($data);
            $proveedor->estado = true;
            $proveedor->anexo_id = $anexos;
            $proveedor->save();
            return 1;


        }else
        {
            return $validation->messages();
        }


    }

}