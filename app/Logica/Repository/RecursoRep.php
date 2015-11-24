<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 2/11/2015
 * Time: 12:57 AM
 */

namespace trogue\Repository;

use trogue\Entities\Recurso;


class RecursoRep {


    public function all()
    {
        $recursos = Recurso::all();
        return $recursos;
    }


    public function regRecurso($data)
    {
        $recurso = new Recurso();
        $recurso->descripcion = $data['descripcion'];
        $recurso->save();

    }

}