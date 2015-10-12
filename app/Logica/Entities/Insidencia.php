<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 11/10/2015
 * Time: 3:01 PM
 */

namespace trogue\Entities;
use Illuminate\Database\Eloquent\Model;

class Insidencia extends Model{


    public function acopio(){
        //$this->belongsTo('entitie', 'local_key', 'parent_key');
        return $this->belongsTo('trogue\Entities\Acopio','acopio_id','id');
    }


}