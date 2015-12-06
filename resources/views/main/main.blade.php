@extends('layout')

@section('content-header')

    <!-- Content Header (Page header) -->
    <div style="padding: 15px;">
        <div class="bs-callout bs-callout-info" id="callout-navbar-breakpoint">
            <h3>Bienvenido  </h3>
        </div>

    </div>

@stop

@section('content')



    <div ng-app="app" ng-controller="MainController">
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}"
        <div class="content" >
            <div class="row" style="padding: 0px 15px 0px 15px;">
                <div class="col-lg-6">
                    <h3>Proveedores con letras atrazadas</h3>
                    <!-- Box (with bar chart) -->
                    <div class="box box-primary" >
                        <div class="box-header">
                            <!-- tools box -->
                            <div class="pull-right box-tools">
                                <button class="btn btn-primary btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                                 </div><!-- /. tools -->
                            <i class="fa fa-cloud"></i>

                            <h3 class="box-title">Moras</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body no-padding">

                            <div class="row" style="padding: 15px;">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tableReq" data-tabl="modProveedor">
                                        <thead >
                                        <tr>
                                            <th>Proveedor</th>
                                            <th>Fecha Vencimiento</th>
                                            <th>N° Letra</th>
                                            <th>*</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="mora in LetrasVencidas">
                                                <td>@{{mora.prov}}</td>
                                                <td>@{{mora.fecha_vencimiento}}</td>
                                                <td>@{{mora.n_letra}}</td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div><!-- /.row - inside box -->
                        </div><!-- /.box-body -->
                        <div class="box-footer">

                        </div><!-- /.box-footer -->
                    </div><!-- /.box -->
                </div>
                <div class="col-lg-6">
                    <h3>Ultimas Liquidaciones</h3>
                    <div class="box box-warning" >
                        <div class="box-header">
                            <!-- tools box -->
                            <div class="pull-right box-tools">
                                <button class="btn btn-primary btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                                 </div><!-- /. tools -->
                            <i class="fa fa-cloud"></i>

                            <h3 class="box-title">Liquidaciones</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body no-padding">
                            <div class="row" style="padding: 15px;">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tableReq" data-tabl="detailAcopio">
                                        <thead >
                                        <tr>
                                            <th>Fecha Inicio</th>
                                            <th>Fecha Fin</th>
                                            <th>P. Ref.</th>
                                            <th>Litros</th>
                                            <th>Solidos</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="liqui in Liquidaciones">
                                            <td>@{{liqui.fecha_inicio}}</td>
                                            <td>@{{liqui.fecha_fin}}</td>
                                            <td>@{{liqui.precio_ref}}</td>
                                            <td>@{{liqui.litros}}</td>
                                            <td>@{{liqui.solidos}}</td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>

                            </div><!-- /.row - inside box -->
                        </div><!-- /.box-body -->
                        <div class="box-footer">

                        </div><!-- /.box-footer -->
                    </div><!-- /.box -->
                </div>
            </div>

            <div class="row" style="padding: 15px;">
                <div class="col-lg-6">
                    <h3>Ultimas Insidencias</h3>
                    <!-- Box (with bar chart) -->
                    <div class="box box-danger" >
                        <div class="box-header">
                            <!-- tools box -->
                            <div class="pull-right box-tools">
                                <button class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                                <button class="btn btn-danger btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-danger btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                            </div><!-- /. tools -->
                            <i class="fa fa-cloud"></i>

                            <h3 class="box-title">Insidencias</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body no-padding">

                            <div class="row" style="padding: 15px;">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tableReq" data-tabl="modServicio">
                                        <thead >
                                        <tr>
                                            <th>Proveedor</th>
                                            <th>Observacion</th>
                                            <th>Fecha</th>
                                            <th>Tipo</th>
                                            <th>Cantidad</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="insidencia in Insidencias">
                                                <td>@{{insidencia.proveedor}}</td>
                                                <td>@{{insidencia.observacion}}</td>
                                                <td>@{{insidencia.fecha}}</td>
                                                <td>@{{insidencia.tipo}}</td>
                                                <td>@{{insidencia.cantidad}}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                            </div><!-- /.row - inside box -->
                        </div><!-- /.box-body -->
                        <div class="box-footer">

                        </div><!-- /.box-footer -->
                    </div><!-- /.box -->
                </div>
                <div class="col-lg-6">
                    <h3>Resultado de acopios de lso ultimos 15 dias</h3>
                    <div class="box box-danger" >
                        <div class="box-header">
                            <!-- tools box -->
                            <div class="pull-right box-tools">
                                <button class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                                <button class="btn btn-danger btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-danger btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                            </div><!-- /. tools -->
                            <i class="fa fa-cloud"></i>

                            <h3 class="box-title">Server Load</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body chart-responsive">
                            <div class="chart" id="line-chart" style="height: 300px;"></div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">

                        </div><!-- /.box-footer -->
                    </div><!-- /.box -->
                </div>
            </div>


        </div>


    </div>

    <script src="{{ asset('js/plugins/angular/angular.min.js')}}"></script>
    <script src=" {{asset('js/charts/raphael-min.js')}}"></script>
    <script src=" {{asset('js/charts/morris.min.js')}}"></script>



    <script>

        var app = angular.module("app", []);
        app.controller("MainController",function($scope,$http,$window) {


            var token = $('input[name="_token"]').attr('value');

            $scope.LetrasVencidas=[];
            $scope.Liquidaciones=[];
            $scope.Insidencias =[];

            getLetraVencidas();
            getLiquidaciones();

            getInsidencias();
            getUltimosACopios();



            function getLetraVencidas() {

                $http.get('{{ URL::route('vencidasByProveedores') }}')
                        .success(function (data) {

                            angular.forEach(data,function(item){

                                var proveedor = item.prestamo.proveedor;

                                var mora = {
                                    idLetra:item.id,
                                    prov:proveedor.name+", "+proveedor.apellidoP+" "+proveedor.apellidoM,
                                    fecha_vencimiento:item.fecha_vencimiento,
                                    n_letra:item.n_letra

                                };

                                $scope.LetrasVencidas.push(mora);

                            });

                        }).error(function (data) {
                            console.log(data);
                        });

            }


            function getLiquidaciones() {

                $http.get('{{ URL::route('getAllLiquidacionMain') }}')
                        .success(function (data) {

                            angular.forEach(data,function(item){

                                $scope.Liquidaciones.push(item);

                            });



                        }).error(function (data) {
                            console.log(data);
                        });

            }

            function getInsidencias() {

                $http.get('{{ URL::route('getInsidencias') }}')
                        .success(function (data) {


                            angular.forEach(data,function(item){

                                var proveedor = item.acopio.proveedor;
                                var acopio = item.acopio;

                                var insidencia ={

                                    id:item.id,
                                    proveedor: proveedor.name+", "+proveedor.apellidoP+" "+proveedor.apellidoM,
                                    observacion:item.observacion,
                                    fecha:acopio.feha,
                                    tipo:item.tipo,
                                    cantidad:item.cantidad

                                };

                                $scope.Insidencias.push(insidencia);

                            });



                        }).error(function (data) {
                            console.log(data);
                        });

            }

            function getUltimosACopios(){

                $http.get('{{ URL::route('getUltimosACopios') }}')
                        .success(function (data) {

                          //  console.log(data);


                            new Morris.Line({
                                // ID of the element in which to draw the chart.
                                element: 'line-chart',
                                // Chart data records -- each entry in this array corresponds to a point on
                                // the chart.
                                data:data,
                                // The name of the data record attribute that contains x-values.
                                xkey: 'fecha',
                                // A list of names of data record attributes that contain y-values.
                                ykeys: ['monto', 'gloria'],
                                // Labels for the ykeys -- will be displayed when you hover over the
                                // chart.
                                labels: ['ACopio del Dia','Peso Gloria']
                            });
                            /*
                            angular.forEach(data,function(item){

                                $scope.Liquidaciones.push(item);

                            });*/



                        }).error(function (data) {
                            console.log(data);
                        });

            }






        });











    </script>


    <style>

        .bs-callout-info {
            border-left-color: #1b809e;
        }
        .bs-callout+.bs-callout {
            margin-top: -5px;
        }
        .bs-callout {
            padding: 20px;
            border: 1px solid #eee;
            border-left-width: 5px;
            border-radius: 3px;
            border-left-color: #1b809e;
            background-color: #ffffff;
        }
        .bs-callout-info h4 {
            color: #1b809e;
        }
    </style>
@stop