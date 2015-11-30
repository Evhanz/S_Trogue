<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 03/07/2015
 * Time: 17:18
 */

namespace trogue\Repository;
use trogue\Entities\Acopio;
use trogue\Entities\PesoBalanza;


class AcopioRep {

    public function find($id)
    {
        $acopio = Acopio::find($id);
        return $acopio;
    }

    public function getAllByProveedor($id){

        $acopios = Acopio::where('proveedor_id','=',$id)->get();
        return $acopios;

    }

    public function  getAcopioByProveedorAndFecha($id,$fecha){

    	try {

    		$acopio = Acopio::where('proveedor_id','=',$id)->where('feha','=',$fecha)->firstOrFail();
    		
            return 1;
    		
    	} catch (\Exception $e) {

            return 0;
    	}
    }


    public function getAcopioByProveedorAndFechas($id, $fecha_inicio, $fecha_fin)
    {
        $acopios = Acopio::where('proveedor_id','=',$id)->where('feha','>=',$fecha_inicio)->where('feha','<=',$fecha_fin)->get();
        return $acopios;

    }

    public function regAcopio($data){
    	 /*cambiar a una capa de registro*/
        $acopio = new Acopio();

        $acopio->feha=$data['fecha'];
        $acopio->cantidad=$data['Cantidad'];
        $acopio->proveedor_id=$data['hdId'];
        $acopio->cantidad_total=$data['Cantidad'];

        if($acopio->save()){
            return 1;

        }else{
            return 0;
        }

    }

    public function updateAcopio($data)
    {

        $acopio = Acopio::find($data['idUpdateAcopio']);
        $acopio->feha=$data['fecha'];
        $acopio->cantidad=$data['cantidad'];
        $acopio->cantidad_total=$data['cantidad'];

        if($acopio->save()){
            return 1;

        }else{
            return 0;
        }

    }


    public function deleteAcopio($id)
    {

        $acopio = Acopio::find($id);
        $acopio->delete();
    }


    /*
     * El acopio es para las ultimos 15 acopio para
     * sacar el valor promedial para el manejo de la
     * logica de negocio
     *
     * */

    public function getPromedioAcopioByIdProveedor($id)
    {
        $acopios = Acopio::where('proveedor_id','=',$id) ->orderBy('feha', 'desc')->take(15)->get();
        $contador = 0;
        $suma = 0;
        foreach($acopios as $acopio){
            $contador++;
            $suma += $acopio->cantidad;
        }
        $promedio = $suma/$contador;

        return $promedio;

    }


    public function getAcopioByDay($day)
    {


        $acopios = Acopio::where('feha','=',$day)->get();

        $suma = 0;

        foreach($acopios as $acopio){
            $suma+=$acopio->cantidad_total;

        }
        return $suma;


    }


    public function getBalanzaGloria($day)
    {

        try{

        $peso = PesoBalanza::where('fecha','=',$day)->firstOrFail();

        return $peso->cantidad;
        }catch (\Exception $e){
            return 0;
        }


    }

    public function getUltimosACopios()
    {

        $res = array();

        for($i=0;$i<15;$i++){

            $fecha = date('Y-m-j');
            $nuevafecha = strtotime ( '-'.$i.' day' , strtotime ( $fecha ) ) ;
            $nuevafecha = date ( 'Y-m-j' , $nuevafecha );

            $suma = $this->getAcopioByDay($nuevafecha);

            $peso = $this->getBalanzaGloria($nuevafecha);

            $acopio_sum = ['fecha'=>$nuevafecha,'monto'=>$suma,'gloria'=>$peso];

            array_push($res, $acopio_sum);

        }

        return $res;

    }


}