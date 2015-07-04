<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 03/07/2015
 * Time: 14:39
 */

namespace trogue\Repository;
use trogue\Entities\Ruta;


class RutaRep {

    public function all(){
        return Ruta::all();
    }
}