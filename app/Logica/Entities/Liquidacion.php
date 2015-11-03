<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 21/10/2015
 * Time: 5:49 PM
 */

namespace trogue\Entities;
use Illuminate\Database\Eloquent\Model;

class Liquidacion extends Model{
    protected $table='liquidaciones';


    public function ruta(){
        //$this->belongsTo('entitie', 'local_key', 'parent_key');
        return $this->belongsTo('trogue\Entities\Ruta','ruta_id','id');
    }



}