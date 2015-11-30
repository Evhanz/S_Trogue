<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 5/11/2015
 * Time: 5:27 PM
 */

namespace trogue\Entities;
use Illuminate\Database\Eloquent\Model;

class Letra extends Model{

    public function pago_letra()
    {
        return $this->hasMany('trogue\Entities\PagoLetra','letra_id','id');
    }

    //relaciones
    public function prestamo(){
        //$this->belongsTo('entitie', 'local_key', 'parent_key');
        return $this->belongsTo('trogue\Entities\Prestamo','prestamo_id','id');
    }

}