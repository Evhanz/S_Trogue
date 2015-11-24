<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 26/10/2015
 * Time: 12:51 PM
 */

namespace trogue\Entities;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model{


    //relaciones
    public function proveedor(){
        //$this->belongsTo('entitie', 'local_key', 'parent_key');
        return $this->belongsTo('trogue\Entities\Proveedor','proveedor_id','id');
    }

    public function recurso(){
        //$this->belongsTo('entitie', 'local_key', 'parent_key');
        return $this->belongsTo('trogue\Entities\Recurso','recurso_id','id');
    }

    public function letras(){
        // return $this->hasMany('Content', 'parent_id', 'id');
        return $this->hasMany('trogue\Entities\Letra','prestamo_id','id');
    }


}