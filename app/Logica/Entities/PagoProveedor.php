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

}