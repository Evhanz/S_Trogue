<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 20/11/2015
 * Time: 9:59 PM
 */

namespace trogue\Entities;


use Illuminate\Database\Eloquent\Model;

class PagoVentaTerceros extends Model{

    public function venta_tercero(){
        //$this->belongsTo('entitie', 'local_key', 'parent_key');
        return $this->belongsTo('trogue\Entities\VentaTerceros','venta_terceros_id','id');
    }

}