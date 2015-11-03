<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 26/10/2015
 * Time: 12:44 PM
 */

namespace trogue\Repository;

use trogue\Entities\Prestamo;

class PrestamoRep {

    public function all()
    {
        $prestamos = Prestamo::with('detallePrestamo')->all();
        return $prestamos;
    }

}