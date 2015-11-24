<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 7/11/2015
 * Time: 12:21 PM
 */

namespace trogue\Entities;


use Illuminate\Database\Eloquent\Model;

class VentaTerceros extends Model{
    protected $table="venta_terceros";

    public function origen(){
        //$this->belongsTo('entitie', 'local_key', 'parent_key');
        return $this->belongsTo('trogue\Entities\Recurso','origen_id','id');
    }

}