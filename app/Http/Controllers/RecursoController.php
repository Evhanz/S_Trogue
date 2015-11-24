<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 8/11/2015
 * Time: 8:07 PM
 */

namespace Trogue\Http\Controllers;

use trogue\Repository\RecursoRep;

class RecursoController extends Controller{

    protected $recursoRep;

    public function __construct(RecursoRep $recursoRep)
    {

        $this->recursoRep = $recursoRep;
    }

    public function getvieModRecursos(){
        $recursos = $this->recursoRep->all();

        return view('Servicio/viewModRecursos',compact('recursos'));
    }

    public function regRecurso()
    {
        $data = \Input::all();

        $this->recursoRep->regRecurso($data);

        return \Redirect::route('getvieModRecursos')->with(array('confirm' => 'Recurso Registrada'));

    }



}