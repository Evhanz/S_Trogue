<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 03/07/2015
 * Time: 17:19
 */

namespace trogue\Entities;
use Illuminate\Database\Eloquent\Model;

class Acopio extends Model {


    public function proveedor(){
        //$this->belongsTo('entitie', 'local_key', 'parent_key');
        return $this->belongsTo('trogue\Entities\Proveedor','proveedor_id','id');
    }

    public function insidencias(){
        // return $this->hasMany('Content', 'parent_id', 'id');
        return $this->hasMany('trogue\Entities\Insidencia','acopio_id','id');
    }



}