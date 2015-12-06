<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 30/11/2015
 * Time: 2:20 PM
 */

namespace Trogue\Http\Controllers;


use trogue\Repository\AcopioRep;
use trogue\Repository\PrestamoRep;
use trogue\Repository\ProveedorRep;

class ReportesController extends Controller {

    protected $acopioRep;
    protected $proveedorRep;
    protected $prestamoRep;

    public function __construct(AcopioRep $acopioRep,ProveedorRep $proveedorRep,PrestamoRep $prestamoRep){
        $this->acopioRep = $acopioRep;
        $this->proveedorRep = $proveedorRep;
        $this->prestamoRep = $prestamoRep;

    }



    public function repPruebas(){


        $view =  \View::make('reportes/ReportePrueba')->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice');


       // return view('reportes/ReportePrueba');

    }

    public function repAcopioByFechas($idProveedor,$fecha_inicio,$fecha_fin)
    {

        $acopios = $this->acopioRep->getAcopioByProveedorAndFechas($idProveedor,$fecha_inicio,$fecha_fin);

        $proveedor = $this->proveedorRep->find($idProveedor);


        $view =  \View::make('reportes/pdfAcopiosByProveedor',compact('acopios','proveedor'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('pdfAcopios');



    }


    public function getPrestamoById($id)
    {
        $prestamo = $this->prestamoRep->getPrestamoById($id);


        $view =  \View::make('reportes/pdfPrestamoById',compact('prestamo'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('pdfPrestamo');


    }



}