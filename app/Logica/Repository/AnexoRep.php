<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 03/07/2015
 * Time: 14:47
 */

namespace trogue\Repository;
use trogue\Entities\Anexo;


class AnexoRep {

    public function getAnexoByRuta($id){

        $rutas = Anexo::where('ruta_id','=',$id)->get();
        return $rutas;

    }

}