@extends('layout')

@section('content-header')

    <div style="padding: 5px ;">
        <div class="bs-callout bs-callout-info" id="callout-type-dl-truncate">
            <h4>Módulo del Servicio - Liquidacion </h4>
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
                        <i class="fa fa-arrows-alt"></i>

                        <h3 class="box-title">Formulario de Registro</h3>

                    </div><!-- /.box-header -->
                    <div class="box-body ">
                        <form class="ui form" id="formulario"  name="formLiquidacion"
                              ng-submit="enviarData()"  method="post">
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />


                            <!--Datos de master-->

                            <div class="panel panel-primary">
                                <div class="panel-heading">

                                    <h4 ><i class="fa fa-cloud"></i>  Datos de Liquidacion</h4>

                                </div>

                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Código de Liquidación:</label>
                                            <input class="form-control" ng-model="numeroLiquidacion" type="text" id="numeroLiquidacion" name="numeroLiquidacion" required>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Numero de Sólidos:</label>
                                            <input step="any" class="form-control" type="number"  ng-model="numeroSolidos" name="numeroSolidos" required>

                                        </div>
                                        <div class="col-lg-4">
                                            <label for="">Fecha de Inicio:</label>
                                            <input class="form-control" type="date" ng-model="fecha_inicio" name="fecha_inicio" ng-change="changFecha()" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="">Valor de Pago x Litro:</label>
                                            <input min="0" step="0.0001" class="form-control" type="number"  ng-model="valor_litro" name="valor_litro" required>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="">Ruta</label>
                                            <select class="form-control" id="selRuta" name="ruta" ng-model="ruta" required>
                                                <option value="">Ninguno</option>
                                                @foreach($rutas as $ruta)
                                                    <option value="{{$ruta->id}}">{{$ruta->descripcion}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="">Fecha Fin</label>
                                            <input class="form-control" type="date" ng-model="fecha_fin" name="fecha_fin" ng-change="changFecha()" required>

                                        </div>
                                    </div>
                                </div>

                            </div>


                            <hr>

                            <div class="panel panel-detalleAcopio">
                                <div class="panel-heading">

                                    <h4 ><i class="fa fa-cloud"></i>  Detalle de Acopio</h4>

                                </div>

                                <div class="panel-body">

                                    <!-- empieza detalle de liquidacion -->
                                    <div class="row">
                                        <div class="col-lg-2" ng-repeat="acopio in DetalleAcopio">

                                            <label for="@{{$index}}Acopio">Dia @{{acopio.fechaView}}</label>
                                            <input  step="any" min="0" ng-change="cambioAcopio()" type="number" ng-model="acopio.cantidad" id="@{{$index}}Acopio"
                                                    name="@{{$index}}Acopio" required/>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="panel panel-detalleDescuento">
                                <div class="panel-heading" style="overflow: hidden">

                                    <section class="pull-right">
                                        <strong>Agregar Descuento</strong> <a class="btn btn-info" ng-click="addDetailDescuento()" >+</a>
                                    </section>

                                </div>

                                <div class="panel-body">

                                    <!-- Empieza el deta de descuentso-->
                                    <div class="row">

                                        <div class="col-lg-12">
                                            <h2>Descuentos</h2>
                                        </div>
                                        <br/>



                                        <div class="col-lg-12" ng-repeat="descuento in DetalleDescuento">

                                            <div class="col-lg-3">
                                                <label for="">Descripcion</label>
                                                <input type="text" ng-model="descuento.descripcion" required="true"/>
                                            </div>
                                            <div class="col-lg-3">
                                                <label for="">Monto</label>
                                                <input step="any" min="0" ng-change="changeDescuento()" type="number" ng-model="descuento.monto" required="true"/>

                                            </div>
                                            <div class="col-lg-3">
                                                <label for="">Fecha</label>
                                                <input type="date" ng-model="descuento.fecha" required="true"/>

                                            </div>

                                            <div class="col-lg-3">
                                                <label for=""> :: </label>
                                                <a class="btn btn-danger" ng-click="quitDetailDescuento($index)">-</a>
                                            </div>


                                        </div>

                                    </div>

                                </div>

                            </div>


                            <hr/>
                            <!-- Resultados -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <h2>Resultado</h2>
                                </div>

                                <div class="col-lg-2">
                                    Cantidad de Acopio <br/>

                                    <input type="text" ng-model="total_acopio" name="total_acopio" readonly/>
                                </div>

                                <div class="col-lg-2">
                                    Pago Neto <br/>

                                    <input type="text" name="pago_neto" ng-model="pago_neto" readonly/>
                                </div>

                                <div class="col-lg-2">
                                    IGV <br/>
                                    <input type="text" name="igv" ng-model="igv" readonly/>
                                </div>

                                <div class="col-lg-2">
                                    Descuento Total <br/>
                                    <input type="text" name="descuento_total" ng-model="descuento_total" readonly/>
                                </div>


                                <div class="col-lg-2">
                                    Pago Total <br/>
                                    <input type="text" name="pago_total" ng-model="pago_total" readonly/>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-lg-12">
                                    <br>
                                    <button ng-disabled='!formLiquidacion.$valid' class="btn btn-success" id="btnGuardar" >

                                        <span style="font-size: 30px"><i class="fa fa-save"></i> Guardar</span>
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
        app.controller("MainController", function($scope,$http,$window) {

            var token = $('input[name="_token"]').attr('value');

            var idLiquidacion = '{{$id}}';

            var tempAcopio =[];

            var hito = 0;

            $scope.DetalleAcopio =[];
            $scope.DetalleDescuento = [];
            $scope.descuento_total = 0;


            /*Primero traemos a la liquidacion*/
            getLiquidacionInitData();



            /*declaraciones de inicio*/



            $scope.$watch('fecha_fin',function(){

                if(hito!=0){
                var bandera = validarfechas();
                if(bandera ==1){

                    //lamaremos a la funcion que llena todos los detalles
                    fillFieldsDetalleAcopio();
                }
                }

            });



            $scope.$watch('pago_neto',function(){
                calcMonto();

            });
            $scope.$watch('descuento_total',function(){

                calcMonto();

            });


            $scope.changFecha = function(){

                hito=1;

            };


            $scope.addDetailDescuento = function (){

                var descuento = {monto:0};
                $scope.DetalleDescuento.push(descuento);

            };

            $scope.quitDetailDescuento = function(index){

                $scope.DetalleDescuento.splice(index,1);
                $scope.changeDescuento();

            };

            $scope.cambioAcopio = function(){



                var suma  = 0;

                angular.forEach($scope.DetalleAcopio,function(item){

                    suma += item.cantidad;

                });

                $scope.total_acopio = suma;

                $scope.pago_neto = $scope.valor_litro*suma;


                $scope.igv = $scope.pago_neto *0.18;

                $scope.pago_neto = $scope.pago_neto.toFixed(2);

            };


            $scope.changeDescuento = function (){

                var suma = 0;
                angular.forEach($scope.DetalleDescuento,function(item){
                    suma += item.monto;
                });

                $scope.descuento_total = suma;

            };

            $scope.enviarData = function(){

                $('#btnGuardar').attr("disabled", true);



                var token = $('input[name="_token"]').attr('value');
                var liquidacion = {};

                liquidacion.id = idLiquidacion;
                liquidacion.codigo_liquidacion = $scope.numeroLiquidacion;
                liquidacion.numeroSolidos = $scope.numeroSolidos;
                liquidacion.fecha_inicio = $scope.fecha_inicio;
                liquidacion.fecha_fin = $scope.fecha_fin;
                liquidacion.valor_litro = $scope.valor_litro;
                liquidacion.ruta = $scope.ruta;
                liquidacion.descuentos = $scope.descuento_total;
                liquidacion.litros = $scope.total_acopio;
                liquidacion.pago_neto = $scope.pago_neto;

                $http.post('{{URL::route('upLiquidacion') }}',{

                    token : token,
                    liquidacion : liquidacion,
                    detalle_acopio:$scope.DetalleAcopio,
                    detalle_descuento:$scope.DetalleDescuento

                }).success(function(data){

                    alert('Liquidacion Actualizada Correctamente');
                    $('#btnGuardar').attr("disabled", false);
                    $window.location.href = '{{ URL::route('getAllLiquidacion') }}';
                    //console.log(data);

                }).error(function(data){
                    console.log(data);
                    alert('Error revise la consol');
                    $('#btnGuardar').attr("disabled", false);
                });



            };

            /*funciones*/

            function validarfechas(){

                var bandera = 0;

                if($scope.fecha_inicio && $scope.fecha_fin){

                    var Fecha_I = new Date($scope.fecha_inicio);
                    var Fecha_F = new Date($scope.fecha_fin);

                    if(Fecha_I>Fecha_F){

                        alert("la fecha de inicio es mayor a la de fin , reectifique");
                        $("input[type=date]").val("")

                    }
                    else{
                        bandera = 1;
                    }
                }

                return bandera;

            }

            function fillFieldsDetalleAcopio(){

                $scope.DetalleAcopio=[];

                var Fecha_I = new Date($scope.fecha_inicio);
                var Fecha_F = new Date($scope.fecha_fin);

                var cantDias = Fecha_F.getDate()-Fecha_I.getDate()+1;



                for(var i=0;i<cantDias;i++){


                    var fecha = new Date(Fecha_I.getTime() + (i * 24 * 3600 * 1000));

                    var mes  = fecha.getMonth()+1;

                    var fechaFormat = fecha.getFullYear()+"-"+ mes +"-"+fecha.getDate();
                    var fechaView = fecha.getDate()+"-"+mes+"-"+fecha.getFullYear();

                    var acopio = {fecha:fechaFormat,fechaView:fechaView,cantidad:0};

                    $scope.DetalleAcopio.push(acopio);

                }

            }

            function calcMonto(){
                var pago = ( parseFloat( $scope.pago_neto)+parseFloat($scope.igv))-parseFloat($scope.descuento_total);

                $scope.pago_total = pago.toFixed(2);
            }


            function getLiquidacionInitData(){

                $http.post('{{URL::route('getLiquidacionById') }}',{

                    token : token,
                    id:idLiquidacion


                }).success(function(data){

                    console.log(data);


                    data.fecha_inicio = new Date(data.fecha_inicio);

                    data.fecha_inicio.setDate( data.fecha_inicio.getDate()+1);

                    data.fecha_fin = new Date(data.fecha_fin);
                    data.fecha_fin.setDate( data.fecha_fin.getDate()+1);



                    data.precio_ref = parseFloat(data.precio_ref);

                    $scope.numeroLiquidacion = data.numero  ;
                    $scope.numeroSolidos = data.solidos;
                    $scope.fecha_inicio = data.fecha_inicio;
                    $scope.fecha_fin = data.fecha_fin;
                    $scope.valor_litro = data.precio_ref;
                    $scope.descuento_total = data.descuentos;
                    $scope.litros = data.litros;
                    $scope.pago_neto = data.pago_neto;
                    //$scope.ruta = parseFloat( data.ruta_id);


                    $('#selRuta').val(data.ruta_id);

                    angular.forEach(data.detalle_liquidacion, function(item) {

                        var fech = new Date(item.fecha);
                       fech.setDate(fech.getDate()+1);

                        var detalle_acopio ={
                            fechaView:item.dia,
                            cantidad: parseFloat( item.cantidad)
                        } ;

                        $scope.DetalleAcopio.push(detalle_acopio);

                    });

                    angular.forEach(data.detalle_descuento, function(item) {

                        item.fecha = new Date( item.fecha);

                        item.fecha.setDate(  item.fecha.getDate()+1);

                        var descuento = {
                            fecha : item.fecha,
                            monto: parseFloat(item.monto),
                            descripcion:item.descripcion


                        };

                        $scope.DetalleDescuento.push(descuento);

                       



                    });

                    $scope.cambioAcopio();
                }).error(function(data){
                    console.log(data);

                });



            }





        });


    </script>







@stop

