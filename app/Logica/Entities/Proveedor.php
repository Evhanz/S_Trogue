<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 01/07/2015
 * Time: 17:02
 */

namespace trogue\Entities;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model{

    protected $table='proveedores';
    protected $fullname;

    protected $fillable = array('name','apellidoP','apellidoM','dni',
        'celular');


    //para formatear los nombre
    public function getFullnameAttribute() {
        return $this->name.' '.$this->apellidoP.' '.$this->apellidoM;
    }


    //relaciones
    public function anexo(){
        //$this->belongsTo('entitie', 'local_key', 'parent_key');
        return $this->belongsTo('trogue\Entities\Anexo','anexo_id','id');
    }

}