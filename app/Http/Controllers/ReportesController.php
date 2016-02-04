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
use trogue\Repository\PagoRep;


class ReportesController extends Controller {

    protected $acopioRep;
    protected $proveedorRep;
    protected $prestamoRep;
    protected $pagoRep;

    public function __construct(AcopioRep $acopioRep,ProveedorRep $proveedorRep,PrestamoRep $prestamoRep,
                                PagoRep $pagoRep){
        $this->acopioRep = $acopioRep;
        $this->proveedorRep = $proveedorRep;
        $this->prestamoRep = $prestamoRep;
        $this->pagoRep = $pagoRep;

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

    public function repPagoById($id){


        $pago = $this->pagoRep->getPagoForReport($id);

        $proveedor = $pago->proveedor;

        $acopios = $this->acopioRep->getAcopioByProveedorAndFechas($proveedor->id,$pago->fecha_inicio,$pago->fecha_fin);

        $suma = 0;

        foreach($acopios as $acopio){

            $suma +=$acopio->cantidad_total;

        }


        $view =  \View::make('reportes/pdfReportePago',compact('pago','acopios','proveedor','suma'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('pdfPrestamo');



    }



}