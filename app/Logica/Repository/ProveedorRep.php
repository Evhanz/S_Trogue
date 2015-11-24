<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 01/07/2015
 * Time: 17:03
 */

namespace trogue\Repository;
use trogue\Entities\Prestamo;
use trogue\Entities\Proveedor;
use trogue\Entities\VentaTerceros;

class ProveedorRep {

    public function find($id){
        return Proveedor::find($id);
    }

    public function allFunction()
    {
        return Proveedor::all();
    }

    public function getProveedorByDNI($dni){

       $proveedor = Proveedor::where('dni','like',$dni)->first();

        return $proveedor;
        
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
            'dni' => 'required|max:8|unique:proveedores',
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

    public function updateDataProveedor($data){

        $anexos = $data['anexos'];
        $id = $data['id'];

        $rules=[

            'name' => 'required',
            'apellidoP' => 'required|min:4',
            'apellidoM' => 'required|min:4',
            'dni' => 'required|max:8|unique:proveedores,dni,'.$data['id'],
            'celular' => 'min:7',

        ];

        $data = array_only($data,array_keys($rules));
        $validation = \Validator::make($data,$rules);

        $isValid = $validation->passes();

        if($isValid){

            $proveedor = Proveedor::find($id);
            $proveedor->name = $data['name'];
            $proveedor->apellidoP = $data['apellidoP'];
            $proveedor->apellidoM = $data['apellidoM'];
            $proveedor->dni = $data['dni'];
            $proveedor->celular = $data['celular'];
            $proveedor->estado = true;
            $proveedor->anexo_id = $anexos;
            $proveedor->save();
            return 1;


        }else
        {
            return $validation->messages();
        }


    }


    public function getProveedorById($id)
    {
        $proveedor =Proveedor::find($id);
        return $proveedor;
    }

    public function getProveedorByPrestamos($id){

        $proveedor = Proveedor::find($id);

        //luego traemos a todos los prestamos y venta a terceros del proveedor

        $prestamos = Prestamo::where('proveedor_id','like',$id)
                        ->where('estado','like','deuda')
                        ->with(array('letras'=>function($query){
                            $query->where('estado','like',0);
                        },'recurso'))
                        ->get();

        $venta_terceros = VentaTerceros::where('proveedor_id','like',$id)
                            ->where('estado','like',0)
                            ->with('origen')
                            ->get();


        $proveedor->descuentos = $prestamos;
        $proveedor->venta_terceros = $venta_terceros;





        return $proveedor;

    }




}