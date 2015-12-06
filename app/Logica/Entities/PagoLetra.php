<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 20/11/2015
 * Time: 9:58 PM
 */

namespace trogue\Entities;


use Illuminate\Database\Eloquent\Model;

class PagoLetra extends Model{

    public function letra(){
        //$this->belongsTo('entitie', 'local_key', 'parent_key');
        return $this->belongsTo('trogue\Entities\Letra','letra_id','id');
    }

    public function pago(){
        //$this->belongsTo('entitie', 'local_key', 'parent_key');
        return $this->belongsTo('trogue\Entities\Ruta','ruta_id','id');
    }

}