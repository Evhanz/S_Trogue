<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 19/10/2015
 * Time: 5:23 PM
 */

namespace Trogue\Http\Controllers;

use trogue\Repository\LiquidacionRep;
use trogue\Repository\RutaRep;


class LiquidacionController extends Controller
{


    protected $rutaRep;
    protected $liquidacionRep;

    public function __construct(RutaRep $rutaRep, LiquidacionRep $liquidacionRep)
    {
        $this->rutaRep = $rutaRep;
        $this->liquidacionRep = $liquidacionRep;
    }


    public function index()
    {
        dd('hola');
    }

    public function viewNewLiquidacion()
    {

        $rutas = $this->rutaRep->all();

        return view('Servicio/viewNewLiquidacion', compact('rutas'));

    }

    public function getViewEditLiquidacion($id)
    {

        $rutas = $this->rutaRep->all();

        return view('Servicio/viewUpLiquidacion', compact('rutas','id'));

    }





    public function regLiquidacion()
    {
        $data = \Input::all();

        try {

            $this->liquidacionRep->regLiquidacion($data);

            $mensaje = ['message' => 'correcto'];

            return \Response::json($mensaje);

        } catch (\Exception $e) {

            return response()->json(['error' => 500, 'message' => 'Error' . $e], 500);

        }

    }


    public function getAllLiquidacion()
    {

        $liquidaciones = $this->liquidacionRep->getAllLiquidacion();
        return view('Servicio/viewLiquidacion', compact('liquidaciones'));

    }


    public function getAllLiquidacionByParameters()
    {
        $data = \Input::all();


        if (strlen($data['numero']) > 0) {

            $liquidaciones = $this->liquidacionRep->getLiquidacionByNumero($data['numero']);

        } else if (strlen($data['numero']) == 0 && strlen($data['fecha_inicio']) == 0 && strlen($data['fecha_fin']) == 0) {
            $liquidaciones = $this->liquidacionRep->getAllLiquidacion();

        } else {
            $liquidaciones = $this->liquidacionRep->getLiquidacionByFechas($data['fecha_inicio'], $data['fecha_fin']);

        }



        return view('Servicio/viewLiquidacion', compact('liquidaciones'));

    }


    public function getLiquidacionById()
    {
        $data = \Input::all();

        $liquidacion = $this->liquidacionRep->getLiquidacionById($data['id']);

        return \Response::json($liquidacion);

    }

    public function upLiquidacion(){
        $data = \Input::all();


        try {

            $this->liquidacionRep->upLiquidacion($data);

            $mensaje = ['message' => 'correcto'];

            return \Response::json($mensaje);

        } catch (\Exception $e) {

            return response()->json(['error' => 500, 'message' => 'Error' . $e], 500);

        }
    }



    /*Esto es para service*/
    public function getLiquidacionByNumber()
    {
        $data = \Input::all();

        $liquidacion = $this->liquidacionRep->getLiquidacionByNumero($data['numero_liqui']);

        return \Response::json($liquidacion);

    }


    public function deleteLiquidacion($id)
    {

        try{

            $this->liquidacionRep->deleteLiquidacion($id);
            return redirect()->back()->with(array('confirm' => 'Liquidacion eliminadad correctamente'));

        }catch (\Exception $e){

            return redirect()->back()->with(array('fail' => 'No es posible eliminar , revise las dependencias'));

        }


    }

    public function getAllLiquidacionMain(){

        $liquidacion = $this->liquidacionRep->getAllLiquidacionMain();

        return \Response::json($liquidacion);
    }

}