<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>el Troge</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="{{asset('css/pure-min.css')}}" rel="stylesheet" type="text/css" />


</head>
<body >
<!-- header logo: style can be found in header.less -->


@yield('content')



</body>
</html>

<style>

    body{

    }

    #alert-result{
        position: absolute;
        right: 25px;
        top: 50px;
        width: 300px;
        z-index: 5;
    }

    .bs-callout {
        background-color: white;
        border-width: 1px 1px 1px 5px;
        border-style: solid;
        border-color: #EEE;
        -moz-border-top-colors: none;
        -moz-border-right-colors: none;
        -moz-border-bottom-colors: none;
        -moz-border-left-colors: none;
        border-image: none;
        border-radius: 3px;
        padding: 20px;

    }
    .bs-callout-info {
        border-left-color: #1B809E;
    }

    .bs-callout-info h4 {
        color: #1B809E;
    }
    .bs-callout h4 {
        margin-top: 0px;
        margin-bottom: 5px;
    }



    /*Modificacion del framework css*/

    /*----- Modal-----*/
    .modal-header {

        background-color: #39BD9E;
        color: white;
    }

    /*------ End ----*/





    .panel-modControlCalidad {
        border-color: rgb(228, 228, 228);
    }

    .panel-modControlCalidad>.panel-heading {
        color: #fff;
        background-color: #95A0A6;
        border-color: #95A0A6;
    }


    .panel-detalleAcopio {
        border-color:#21B981;
    }

    .panel-detalleAcopio>.panel-heading {
        color: #fff;
        background-color:#21B981;
        border-color: #21B981;
    }

    .panel-detalleDescuento {
        border-color:#2E7572;
    }

    .panel-detalleDescuento>.panel-heading {
        color: #fff;
        background-color:#2E7572;
        border-color: #2E7572;
    }




    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0 0 0 0);
        border: 0;
    }

    .head-table{

        background-color: #1289B7;

    }

    .head-table > tr >th{
        color:white;


    }

    table[data-tabl='ruta'] {

    }
    table[data-tabl='modProveedor'] > thead{

        background-color: #608F94;
        color: white;

    }


    table[data-tabl='modControlCalidad'] > thead{

        background-color: #236B92;
        color: white;

    }

    table[data-tabl='detailAcopio'] > thead{

        background-color: #E46969;
        color: white;

    }

    table[data-tabl='modServicio'] > thead{

        background-color: #2BA66D;
        color: white;

    }

    #tablaAcopio>table>tbody>tr>td{

        width: 70px;
        padding: 10px;


    }

    #tablaAcopio>table>tbody>tr>td>.results{

        position: relative;
    }

    #tablaAcopio>table>tbody>tr>td>.results>.fecha{

        margin: 0;
        padding: 0;
        position: absolute;
        top: -5px;
        left: 0px;
        font-size: 10px;

    }

    #tablaAcopio>table>tbody>tr>td>.results>.cantidad{

        margin: 0;
        padding: 0;
        font-size: 15px;
        position: absolute;
        top: 5px;
        right:20px;
        text-align: right;
    }

    #tablaAcopio{
        width: 100%;
    }



    .resultado{

        display:inline-block;

    }

    .resultado>input{
        width: 70px;
        text-align: center;
        margin-right: 1em;

    }

    .titulo-pago{

    }

    .detalle-pago{
        font-size: 12px;


    }
    .detalle-pago > .proveedor{
       font-style: italic;
       display: inline-block;
    }
    .detalle-pago > .fecha-pago{
        font-style: italic;
        display: inline-block;
        margin-left: -220px;
    }

    .detail-descuento {
        border-collapse: collapse;
    }

    .detail-descuento > thead>tr>td {
        background-color: teal;
    }

    .computable > .descuentos{

        display: inline-block;
        width: 450px;
    }

    .computable > .neto{

        display:inline-block;
        width: 200px;

        padding-top: 50px;

    }

    #neto-pagar{
        margin-top: 80px;
        border: 1px solid #335d7e;
        padding: 20px;
        font-size: 18px;
        font-weight: bold;
    }



    #detail-descuento>thead>tr>th:nth-child(1){

        background-color: teal;
        color: #ffffff;
        border: 4px solid #808080;
        padding: 3px;
        width: 300px;
        font-size: 14px;
    }
    #detail-descuento>thead>tr>th:nth-child(2){

        background-color: teal;
        color: #ffffff;
        border: 4px solid #808080;
        padding: 3px;
        width: 80px;
        font-size: 14px;
    }

    #detail-descuento>tbody>tr>td{

        border: 1px solid #808080;
        text-align: center;
        padding: 3px;
        font-size: 13px;

    }

    #detail-descuento>tbody>tr:last-child>td{

        border: 1px solid #808080;
        text-align: center;
        padding: 3px;
        font-size: 15px;
        border-top: 2px dashed;
        font-weight: bold;
    }













</style>
<script>





    $("div[data-rol='aviso']").show(2000);
    //$("div[data-rol='aviso']").hide();


</script>