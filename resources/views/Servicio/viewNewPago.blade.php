@extends('layout')

@section('content-header')

    <div style="padding: 5px ;">
        <div class="bs-callout bs-callout-info" id="callout-type-dl-truncate">
            <h4>Módulo del Servicio - Pagos </h4>
        </div>
    </div>
@stop

@section('content')


    <div class="content" ng-app="app" ng-controller="MainController">
        <div class="row"><!--Mesaje de errores-->
            @if(isset($errors))
                @if (count($errors) > 0)
                    <div style="display:none" id="alert-result" data-rol="aviso" class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4>Error!!</h4>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @endif
        </div><!--/ end error messages -->
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                        </div><!-- /. tools -->
                        <i class="fa fa-cloud"></i>

                        <h3 class="box-title">Formulario de Registro</h3>

                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        <form class="ui form" id="formulario"  name="formLiquidacion"  ng-submit="enviarData()"  method="post">
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Proveedor</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label for="dniProveedor">DNI:</label>
                                                    <input  style="height: 34px;"  type="number" id="dniProveedor" name="dniProveedor" ng-model="dniProveedor" ng-change="nameProveedor = ''" required>
                                                    <a id="searchDNI" class="btn btn-info" ng-click="searchDNI()">:::</a>
                                                    <input value="a" style="height: 34px;width: 250px" ng-model="Proveedor.name" type="text" id="nameProveedor" name="nameProveedor" disabled>
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <label for="">Fecha Inicio</label>
                                                    <input ng-change="getAcopioByFechas()" ng-model="fecha_inicio" name="fecha_inicio" type="date" required/>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="">Fecha Fin</label>
                                                    <input  ng-change="getAcopioByFechas()" ng-model="fecha_fin" name="fecha_fin" type="date" required/>
                                                </div>

                                                <div class="col-lg-4">
                                                    <label for="">Acopio Total</label>
                                                    <input ng-model="acopio_Total" name="acopio_Total" type="text" disabled required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Panel Liquidación</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label for="">N° Liquidación</label>
                                                    <input  style="height: 34px;"  type="text" id="nLiquidacion" name="nLiquidacion" ng-model="numero_liqui" ng-change="nLiquidacion = ''" required>
                                                    <a id="SearchLiqui" class="btn btn-info" ng-click="searchLiquidacion()">:::</a>
                                                    <input value="a" style="height: 34px;;width: 200px" ng-model="Liquidacion.numero" type="text" disabled>
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <label for="">Valor Pago x Litro</label><br/>
                                                    <input id="pago_litro" ng-change="calcPago()" ng-model="Liquidacion.precio_ref" name="pago_litro" type="number" required disabled/>
                                                </div>
                                                <div class="col-lg-1">
                                                    <br/>
                                                    <a id="btnCahngePrecioLitro" class="btn btn-success" href="" ng-click="changePrecioPorLitro()">
                                                        <i class="glyphicon glyphicon-off"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <!--Inicio de el detalle de letras-->

                            <div style="width: 100%; background-color: #4DB1C9;overflow: hidden;color: #ffffff">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <h3>Descuentos </h3>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <span style="font-size: 15px" class="label label-primary">Préstamos</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <ul class="list-group">
                                                <li class="list-group-item" ng-repeat="prestamo in prestamos">
                                                    <a ng-click="getLetras($index)" href="">@{{ prestamo.descripcion }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-3">
                                            <ul class="list-group" >
                                                <li class="list-group-item" ng-repeat="letra in letras">
                                                    <strong>Letra @{{ letra.n_letra }}</strong>,  F.V. : @{{letra.fecha_vencimiento}}
                                                    <a href="" ng-click="addPagoLetra(letra)"><span class="badge"> >> </span></a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="col-lg-7">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Letra</th>
                                                    <th>Mo.</th>
                                                    <th>Int.</th>
                                                    <th>To.</th>
                                                    <th>Opciones</th>
                                                </tr>
                                                </thead>
                                                <tr ng-repeat="pagos_letra in pagos_letras">
                                                    <td>@{{ $index }}</td>
                                                    <td>Letra @{{ pagos_letra.n_letra }}</td>
                                                    <td>@{{ pagos_letra.monto_inicial }}</td>
                                                    <td>@{{ pagos_letra.interes }}</td>
                                                    <td>@{{ pagos_letra.total }}</td>
                                                    <td><a class="btn btn-danger" ng-click="deletePagosLetras($index)"> << </a></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div><!--Pago de Prestamos-->
                            <hr>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <span style="font-size: 15px" class="label label-info">Pago a Tercero</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <ul class="list-group">
                                                <li class="list-group-item" ng-repeat="venta_tercero in venta_terceros">
                                                    <strong>@{{ venta_tercero.origen.descripcion }}</strong>
                                                    <a ng-click="addPagoVentaTerceros(venta_tercero)" href=""><span class="label-success badge"> >> </span></a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="col-lg-7">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Descripcion</th>
                                                    <th>Origen</th>
                                                    <th>Mo.</th>
                                                    <th>Opciones</th>
                                                </tr>
                                                </thead>
                                                <tr ng-repeat="item in pagos_venta_terceros">
                                                    <td>@{{ $index }}</td>
                                                    <td>@{{ item.descripcion }}</td>
                                                    <td>@{{ item.origen.descripcion }}</td>
                                                    <td>@{{ item.monto }}</td>
                                                    <td><a class="btn btn-danger" ng-click="deletePagosVentaTerceros($index)"> << </a></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>



                                </div>
                                <div class="col-lg-12">

                                </div>
                            </div><!--Pago de Venta a terceros-->


                            <!--Resultados -->
                            <div style="width: 100%; background-color: #4CAF98;overflow: hidden;color: #ffffff">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <h3>Resultados </h3>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <h2>Resultado</h2>
                                </div>

                                <div class="col-lg-4">
                                    Pago Neto <br/>

                                    <input class="form-control" type="text" name="pago_neto" ng-model="pago_neto" readonly/>
                                </div>
                                <div class="col-lg-4">
                                    Descuento Total <br/>
                                    <input class="form-control" type="text" ng-init ="0" name="descuento_total" ng-model="descuento_total" readonly/>
                                </div>
                                <div class="col-lg-4">
                                    Pago Total <br/>
                                    <input class="form-control" type="text" ng-init ="0" name="pago_total" ng-model="pago_total" readonly/>
                                </div>
                            </div>

                            <br/>
                            <div class="row">
                                <div class="col-lg-12">
                                    <br>
                                    <button ng-disabled='!formLiquidacion.$valid' class="btn btn-success" id="btnGuardar" >
                                        <span style="font-size: 30px">Guardar</span>
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div><!-- /.box-body -->
                </div><!--/.box -->
            </div><!--col-lg-12-->
        </div><!--/row form-->
    </div>


    <script src="{{ asset('js/plugins/angular/angular.min.js')}}"></script>

    <script>

        var app = angular.module("app", []);
        app.controller("MainController",function($scope,$http,$window){

            var token = $('input[name="_token"]').attr('value');
            $scope.Liquidacion={};
            $scope.letras = [];
            $scope.Proveedor = {name:"",id:0};

            $scope.prestamos=[];
            $scope.prestamos.letas=[];
            $scope.venta_terceros = [];

            //pagos de deuda se colocara tipo para identificar si es venta a terceros u otros
            $scope.pagos_letras=[];
            $scope.pagos_venta_terceros=[];


            $scope.searchDNI = function (){

                $http.post('{{ URL::route('ApigetWithPrestamosAndLetras') }}',
                        {_token : token,
                            dni:$scope.dniProveedor
                        })
                        .success(function(data){
                            if(data.id !=1 || data.id ==null){
                                alert('No existe Proveedor con ese DNI');

                            }else{
                                $scope.Proveedor.name = data.name +", " + data.apellidoP+" "+data.apellidoM;
                                //$scope.promedio_quincenal = data.promedioQuincenal;
                                $scope.Proveedor.id = data.id;
                                $scope.prestamos = data.descuentos;
                                $scope.venta_terceros = data.venta_terceros;
                            }
                            console.log(data);

                        }).error(function(data) {
                            console.log(data);
                        });

            };


            $scope.searchLiquidacion = function (){

                $http.post('{{ URL::route('ApiGetLiquidacionByNumber') }}',
                        {_token : token,
                            numero_liqui:$scope.numero_liqui
                        })
                        .success(function(data){

                            if(data.id <1 || data.id ==null){
                                alert('No se encuentra liquidacion con ese monto');

                            }else{
                                data.precio_ref = parseFloat(data.precio_ref);

                                $scope.Liquidacion = data;

                            }
                           // console.log(data);

                            $scope.calcPago();

                        }).error(function(data) {
                            console.log(data);
                        });

            };

            $scope.getLetras = function(index){

                $scope.letras =$scope.prestamos[index].letras;
            };


            $scope.addPagoLetra = function (letra){


                var fecha = new Date();
                var fecha_vencimiento = new Date(letra.fecha_vencimiento);

                if($scope.pagos_letras.indexOf(letra)>=0){
                    alert('ya se a agregado la letra ')
                }else{

                    if(fecha_vencimiento > fecha.getTime()){
                        letra.interes = 0;
                    }

                    letra.total =  parseFloat( letra.interes)+ parseFloat(letra.monto_inicial);


                    $scope.pagos_letras.push(letra);
                    console.log($scope.pagos_letras);
                }

                $scope.calcPago();
            };

            $scope.addPagoVentaTerceros  = function (venta_tercero){


                if($scope.pagos_venta_terceros.indexOf(venta_tercero)>=0){
                    alert('ya se a agregado la venta a terceros ')
                }else{

                    $scope.pagos_venta_terceros.push(venta_tercero);
                }

                $scope.calcPago();

            };


            $scope.deletePagosLetras = function (index){

                $scope.pagos_letras.splice(index,1);

                $scope.calcPago();

            };

            $scope.deletePagosVentaTerceros = function (index){
                $scope.pagos_venta_terceros.splice(index,1);

                $scope.calcPago();
            };


            $scope.calcPago = function (){

                var p =  parseFloat( $scope.acopio_Total) * parseFloat($scope.Liquidacion.precio_ref);
                $scope.pago_neto = p.toFixed(2);

                //console.log($scope.pago_neto);

                var suma_descuento = 0;

                angular.forEach($scope.pagos_letras, function(item) {
                   suma_descuento += parseFloat(item.total);

                });
                angular.forEach($scope.pagos_venta_terceros, function(item) {

                    suma_descuento += parseFloat(item.monto);

                });

                $scope.descuento_total = suma_descuento.toFixed(2);

                $scope.pago_total = p.toFixed(2)-suma_descuento;

                $scope.pago_total = parseFloat($scope.pago_total).toFixed(2);

            };


            $scope.getAcopioByFechas = function (){

                var fecha_i = new Date($scope.fecha_inicio);
                var fecha_f = new Date($scope.fecha_fin);

                if(fecha_i>fecha_f) {
                    alert('Las fecha de inicio no puede ser mayor');
                }else{
                    $http.post('{{ URL::route('getSumaAcopioByProveedorAndFechas') }}',
                            {_token : token,
                                id:$scope.Proveedor.id,
                                fecha_inicio:fecha_i,
                                fecha_fin:fecha_f
                            })
                            .success(function(data){

                                $scope.acopio_Total = data;
                                $scope.calcPago();

                            }).error(function(data) {
                                console.log(data);
                            });
                }

            };


            $scope.changePrecioPorLitro = function (){





                /*


                var p =  parseFloat( $scope.acopio_Total) * parseFloat($scope.Liquidacion.precio_ref);
                $scope.pago_neto = p;

                console.log($scope.pago_neto);*/

            };





            $scope.enviarData = function(){
                $('#btnGuardar').attr("disabled", true);
                var token = $('input[name="_token"]').attr('value');

                var pago_proveedor = {

                    fecha_inicio:$scope.fecha_inicio,
                    fecha_fin:$scope.fecha_fin,
                    precio_litro:$scope.Liquidacion.precio_ref,
                    total_descontado:$scope.descuento_total,
                    pago_total:$scope.pago_total,
                    liquidacion_id:$scope.Liquidacion.id,
                    proveedor_id:$scope.Proveedor.id

                };

                $http.post('{{ URL::route('RegPago') }}',
                        {_token : token,
                            pago_proveedor:pago_proveedor,
                            pago_letras: $scope.pagos_letras,
                            pago_venta_terceros:$scope.pagos_venta_terceros
                        })
                        .success(function(data){

                            if(data.message=='correcto'){
                                alert('Prestamo Registrado Correctamente');
                                $('#btnGuardar').attr("disabled", false);
                                $window.location.href = '{{ URL::route('home') }}';

                            }else{
                                alert('Se encuentra Errores en el envio , revisar la consola ');
                                $('#btnGuardar').attr("disabled", false);
                                console.log(data);

                            }
                            //console.log(data);

                        }).error(function(data) {
                            console.log(data);
                            alert('Error revise la consola');
                            $('#btnGuardar').attr("disabled", false);

                        });
            }



        });



        //esto es para la suma de descuentos total









    </script>



@stop

