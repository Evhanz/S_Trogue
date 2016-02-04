<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>El Troge</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="{{asset('css/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="{{asset('css/ionicons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Morris charts -->
    <link href="{{asset('css/morris/morris.css')}}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{asset('css/AdminLTE.css')}}" rel="stylesheet" type="text/css" />

    <!-- jQuery 2.0.2 -->
    <script src="{{ asset('js/jquery-2.0.2.min.js')}}"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="skin-black">
<!-- header logo: style can be found in header.less -->
<header class="header">
    <a href="{{ URL::route('home')}}" class="logo">
        <!-- Add the class icon to your logo image or logo icon to add the margining -->
        El Troge
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-right">
            <ul class="nav navbar-nav">

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i>
                        <span>Evhanz <i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-light-blue">
                            <img src="{{ asset('img/avatar3.png') }}" class="img-circle" alt="User Image" />
                            <p>
                                @if (Auth::guest())
                                    oublic
                                @else
                                   Usuario:{{Auth::user()->dni}}
                                @endif

                                <small>  *Treedex</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">

                            <div class="pull-right">
                                <a href="{{ URL::route('outLogin') }}" class="btn btn-default btn-flat">Desconectar</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>


        </div>
    </nav>
</header>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ asset('img/avatar3.png')}}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>Hola, Usuario</p>

                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li>
                    <a  href="{{ URL::route('home')}}">
                        <i  class="fa fa-dashboard"></i> <span>Inicio</span>
                    </a>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i style="color:#21B981;" class="fa fa-users"></i>
                        <span>Proveedores</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a class="item sub" id="linkModProductos" href="{{ URL::route('proveedoresAll')}}">
                                    <i class="fa fa-angle-double-right"></i> Proveedores</a></li>
                        <li><a href="{{ URL::route('rutasAll')}}"><i class="fa fa-angle-double-right"></i>Rutas</a></li>
                        <li><a href="{{ URL::route('anexosAll')}}"><i class="fa fa-angle-double-right"></i> Anexos</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i style="color:#236B92;" class="fa fa-tasks"></i>
                        <span>Control y Calidad</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a class="item sub" href="{{ URL::route('getAcopioAll')}}"><i class="fa fa-angle-double-right" ></i> Registro de  <br>Acopio</a></li>

                    </ul>
                </li>

                @if(Auth::user()->tipo=='admin')

                    <li class="treeview">
                        <a href="#">
                            <i style="color:#F44336;" class="fa fa-money"></i>
                            <span>Servicio</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ URL::route('getAllLiquidacion')}}"><i class="fa fa-angle-double-right"></i> Liquidacion</a></li>
                            <li><a href="{{ URL::route('getAllPrestamos') }}"><i class="fa fa-angle-double-right"></i> Prestamos</a></li>
                            <li><a href="{{ URL::route('getvieModRecursos') }}"><i class="fa fa-angle-double-right"></i> Recursos</a></li>
                            <li><a href="{{ URL::route('getAllVentaTerceros') }}"><i class="fa fa-angle-double-right"></i> Venta a Terceros</a></li>
                            <li><a href="{{ URL::route('viewAllPagos') }}"><i class="fa fa-angle-double-right"></i> Pagos</a></li>
                        </ul>
                    </li>
                    <li style="padding: 15px;color: white" class="hidden-xs">
                        <label for="">N° Quincena</label>
                        <input class="form-control" type="text"/>
                        <label for="">Mes</label>
                        <input class="form-control" type="text"/>
                    </li>

                @endif


                <!--

                <li class="treeview">
                    <a href="#">
                        <i  class="fa fa-bar-chart-o"></i>
                        <span>Reportes</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ URL::route('getAllLiquidacion')}}"><i class="fa fa-angle-double-right"></i> Liquidacion</a></li>
                        <li><a href="{{ URL::route('getAllPrestamos') }}"><i class="fa fa-angle-double-right"></i> Prestamos</a></li>
                        <li><a href="{{ URL::route('getvieModRecursos') }}"><i class="fa fa-angle-double-right"></i> Recursos</a></li>
                        <li><a href="{{ URL::route('getAllVentaTerceros') }}"><i class="fa fa-angle-double-right"></i> Venta a Terceros</a></li>
                        <li><a href=""><i class="fa fa-angle-double-right"></i> Pagos</a></li>
                    </ul>
                </li>
                -->
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">
        @yield('content-header')
        @yield('content')

    </aside><!-- /.right-side -->
</div><!-- ./wrapper -->



<!-- funciones main -->
<script src="{{ asset('js/main.js')}}" type="text/javascript"></script>

<!-- Bootstrap -->
<script src="{{ asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/AdminLTE/ej.js')}}" type="text/javascript"></script>

<!-- Morris.js charts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset('js/plugins/morris/morris.min.js')}}" type="text/javascript"></script>

</body>
</html>

<style>
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







</style>
<script>


    $("div[data-rol='aviso']").show(2000);
    //$("div[data-rol='aviso']").hide();


</script>