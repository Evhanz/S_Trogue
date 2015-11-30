<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 30/11/2015
 * Time: 4:05 AM
 */

namespace Trogue\Http\Controllers;

use trogue\Entities\Letra;

class LetrasController extends Controller{


    public function vencidasByProveedores()
    {


        $today =  date("Y-m-d");

        $letras = Letra::where('estado','=','0')
            ->where('fecha_vencimiento','<',$today)
            ->with('prestamo.proveedor')
            ->get();

        return \Response::json($letras);


    }

}