<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>el Trogue</title>
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

    /*Pagination*/

    #pagination > ul{

        display: inline-block;
        padding-left: 0px;
        margin: 20px 0px;
        border-radius: 4px;

    }

    #pagination >ul >li{
        display: inline;

    }

    #pagination > ul > li:first-child > a, .pagination > li:first-child > span {
        margin-left: 0px;
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
    }
    #pagination > ul > li > a,
    #pagination > ul > li > span {
        cursor: pointer;
        position: relative;
        float: left;
        padding: 6px 12px;
        margin-left: -1px;
        line-height: 1.42857;
        color: #337AB7;
        text-decoration: none;
        background-color: #FFF;
        border: 1px solid #DDD;
    }

    #pagination > ul > .disabled > a,
    #pagination > ul > .disabled > a:focus,
    #pagination > ul > .disabled > a:hover,
    #pagination > ul > .disabled > span,
    #pagination > ul > .disabled > span:focus,
    #pagination > ul > .disabled > span:hover {
        color: #777;
        cursor: not-allowed;
        background-color: #FFF;
        border-color: #DDD;
    }

    #pagination > ul > .active > a,
    #pagination > ul> .active > a:focus,
    #pagination > ul > .active > a:hover,
    #pagination > ul > .active > span,
    #pagination > ul > .active > span:focus,
    #pagination > ul > .active > span:hover {
        z-index: 2;
        color: #FFF;
        cursor: default;
        background-color: #337AB7;
        border-color: #337AB7;
    }




    /*End - Pagination*/

    /*Modificacion del framework css*/

    /*----- Modal-----*/
    .modal-header {

        background-color: #39BD9E;
        color: white;
    }

    /*------ End ----*/



    .pagination {
        display: inline-block;
        padding-left: 0;
        margin: 20px 0;
        border-radius: 4px;
    }
    .pagination>li {
        display: inline;
    }

    .pagination>li:first-child>a, .pagination>li:first-child>span {
        margin-left: 0;
        border-bottom-left-radius: 4px;
        border-top-left-radius: 4px;
    }
    .pagination>.disabled>span, .pagination>.disabled>span:hover, .pagination>.disabled>span:focus, .pagination>.disabled>a, .pagination>.disabled>a:hover, .pagination>.disabled>a:focus {
        color: #999;
        cursor: not-allowed;
        background-color: #fff;
        border-color: #ddd;
    }
    .pagination>li>a, .pagination>li>span {
        position: relative;
        float: left;
        padding: 6px 12px;
        margin-left: -1px;
        line-height: 1.428571429;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #ddd;
    }

    .pagination>.active>a, .pagination>.active>span, .pagination>.active>a:hover, .pagination>.active>span:hover,
    .pagination>.active>a:focus, .pagination>.active>span:focus {
        z-index: 2;
        color: #fff;
        cursor: default;
        background-color: #428bca;
        border-color: #428bca;
    }


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
        font-size: 8px;
    }












</style>
<script>





    $("div[data-rol='aviso']").show(2000);
    //$("div[data-rol='aviso']").hide();


</script>