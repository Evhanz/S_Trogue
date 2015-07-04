<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 02/07/2015
 * Time: 23:48
 */

namespace trogue\Entities;
use Illuminate\Database\Eloquent\Model;

class Anexo extends Model{


    //relaciones
    public function ruta(){
        //$this->belongsTo('entitie', 'local_key', 'parent_key');
        return $this->belongsTo('trogue\Entities\Ruta','ruta_id','id');
    }

}