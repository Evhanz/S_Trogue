<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 20/11/2015
 * Time: 8:25 PM
 */

namespace trogue\Entities;


use Illuminate\Database\Eloquent\Model;

class PagoProveedor extends Model{

    protected $table = 'pago_proveedor';
    protected $quincena;

    //relaciones
    public function proveedor(){
        //$this->belongsTo('entitie', 'local_key', 'parent_key');
        return $this->belongsTo('trogue\Entities\Proveedor','proveedor_id','id');
    }

    public function pago_letra(){
        return $this->hasMany('trogue\Entities\PagoLetra','pago_proveedor_id','id');
    }

    public function pago_venta_tercero(){
        return $this->hasMany('trogue\Entities\PagoVentaTerceros','pago_proveedor_id','id');
    }

    public function liquidacion(){
        return $this->belongsTo('trogue\Entities\Liquidacion','liquidacion_id','id');
    }

    //para formatear los nombre
    public function getQuincenaAttribute() {

        $dato = explode("-", $this->fecha_inicio);

        $mes ="";

        switch($dato[1]){

            case 1: $mes ="Enero";break;
            case 2: $mes ="Febrero";break;
            case 3: $mes ="Marzo";break;
            case 4: $mes ="Abril";break;
            case 5: $mes ="Mayo";break;
            case 6: $mes ="junio";break;
            case 7: $mes ="Julio";break;
            case 8: $mes ="Agosto";break;
            case 9: $mes ="Septiembre";break;
            case 10: $mes ="Obtubre";break;
            case 11: $mes ="Noviembre";break;
            case 12: $mes ="Diciembre";break;

        }

        if($dato[2]>=1 && $dato[2]<15){
            $q = "Primera Quincena";
        }else{
            $q ="Segunda Quincena";
        }

        return $q." ".$mes." Del ".$dato[0];

    }

}