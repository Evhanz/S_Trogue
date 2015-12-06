@extends('layout')

@section('content-header')

    <div style="padding: 5px ;">
        <div class="bs-callout bs-callout-info" id="callout-type-dl-truncate">
            <h4>Módulo del Servicio - Prestamo </h4>
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
                    <div class="box-body ">


                        <form class="ui form" id="formulario"  name="formLiquidacion"
                              ng-submit="enviarData()"  method="post">

                            <div class="panel panel-modControlCalidad">
                                <div class="panel-heading">
                                    <h4>Datos del Prestamo</h4>
                                </div>

                                <div class="panel-body">

                                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="dniProveedor">DNI Proveedor</label><br/>
                                            <input  style="height: 34px;"  type="number" id="dniProveedor" name="dniProveedor" ng-model="dniProveedor" ng-change="nameProveedor = ''" required>
                                            <a id="searchDNI" class="btn btn-info" ng-click="searchDNI()">:::</a>
                                            <input value="a" style="height: 34px;width: 300px" ng-model="nameProveedor" type="text" id="nameProveedor" name="nameProveedor" disabled>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Promedio Quincenal:</label>
                                            <input step="any" class="form-control" type="text"  ng-model="promedio_quincenal" name="promedio_quincenal" required disabled>
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="">Recurso</label>
                                            <select class="form-control" id="selRecuso" name="recurso" ng-model="recurso" required>
                                                <option value="">Ninguno</option>
                                                @foreach($recursos as $recurso)
                                                    <option value="{{$recurso->id}}">{{$recurso->descripcion}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="col-lg-1">
                                            <label for="">Prioridad</label>
                                            <select class="form-control" id="selPrioridad" name="prioridad" ng-model="prioridad" required>
                                                <option value="">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>

                                            </select>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="">Descripcion</label>
                                            <textarea class="form-control" ng-model="descripcion" name="descripcion"  id="descripcion" cols="30" rows="2" required="true"></textarea>


                                        </div>
                                        <div class="col-lg-2">
                                            <label for="">Cantidad S/.</label>
                                            <input  step="any" min="0" class="form-control" ng-model="cantidad" type="number" id="cantidad" name="cantidad" required>
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="tasa">Tasa %</label>
                                            <input type="number" name="tasa" id="tasa" min="0" ng-change="sacarInteres()" ng-model="tasa" required/>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="">Interes </label>
                                            <input class="form-control"  ng-model="interes" name="interes" required disabled>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!--Inicio de el detalle de letras-->

                            <div style="width: 100%; background-color: #4DB1C9;overflow: hidden;color: #ffffff">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <h3>Calendario de Letras</h3>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-lg-2">
                                    <h4 >Número de Letras</h4>
                                </div>
                                <div class="col-lg-1">
                                    <input class="form-control" ng-model="num_letras" id="num_letras" name="num_letras" type="number" min="1" max="12" required/>
                                </div>
                                <div class="col-lg-3">
                                    <a class="btn btn-warning" href="" ng-click="addLetras()"> >> </a>
                                </div>
                            </div>

                            <br/>
                            <div class="row">
                                <div class="col-lg-12" ng-repeat="letra in letras">

                                    <div class="col-lg-1">
                                        <label for="">Letra: @{{ $index }}</label>
                                    </div>

                                    <div class="col-lg-3">
                                        <label for="">Monto Inicial</label><br/>
                                        <input  ng-model="letra.monto" required="true" disabled/>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="">Interes</label><br/>
                                        <input  ng-model="letra.interes" required="true" disabled/>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="">Total</label><br/>
                                        <input  ng-model="letra.total" required="true" disabled/>
                                    </div>

                                    <div class="col-lg-3">
                                        <label for="">Fecha</label><br/>
                                        <input type="date" ng-model="letra.fecha" required="true"/>
                                    </div>

                                </div>

                            </div><!--./detalle de letra-->
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
            $scope.letras = [];
            $scope.idProveedor = 0;

            var idPrestamo = '{{$id}}';

            fillInitData(idPrestamo);

            $scope.searchDNI = function (){

                $http.post('{{ URL::route('getProveedorByDNIService') }}',
                        {_token : token,
                            dni:$scope.dniProveedor
                        })
                        .success(function(data){

                            if(data.id <1 || data.id ==null){
                                alert('No existe Proveedor con ese DNI');

                            }else{
                                $scope.nameProveedor = data.name +", " + data.apellidoP+" "+data.apellidoM;
                                $scope.promedio_quincenal = data.promedioQuincenal;
                                $scope.idProveedor = data.id;

                            }
                            console.log(data);

                        }).error(function(data) {
                            console.log(data);
                        });

            };


            $scope.sacarInteres = function(){

                $scope.interes = parseFloat($scope.cantidad) *($scope.tasa/100);


            };

            $scope.addLetras = function(){
                $scope.letras = [];

                var monto_letra = ($scope.cantidad)/ $scope.num_letras;

                for(var i= 0;i<$scope.num_letras;i++){

                    var letra = {monto:monto_letra,
                        interes:$scope.interes,
                        n_letra:i+1,
                        total:$scope.interes+monto_letra};
                    $scope.letras.push(letra);
                }
            };

            $scope.enviarData = function(){
                $('#btnGuardar').attr("disabled", true);
                var token = $('input[name="_token"]').attr('value');
                var idPrestamo = '{{$id}}';

                $http.post('{{ URL::route('updatePrestamo') }}',
                        {_token : token,
                            descripcion:$scope.descripcion,
                            cantidad:$scope.cantidad,
                            prioridad:$scope.prioridad,
                            tasa:$scope.tasa,
                            interes:$scope.interes,
                            proveedor_id:$scope.idProveedor,
                            recurso_id:$scope.recurso,
                            n_letras: $scope.num_letras,
                            letras:$scope.letras,
                            idPrestamo:idPrestamo
                        })
                        .success(function(data){

                            if(data=='Registrado'){
                                alert('Prestamo Registrado Correctamente');
                                $('#btnGuardar').attr("disabled", false);
                                $window.location.href = '{{ URL::route('getAllPrestamos') }}';

                            }else{
                                alert('Se encuentra Errores en el envio , revisar la consola ');
                                $('#btnGuardar').attr("disabled", false);
                                console.log(data);

                            }
                            console.log(data);

                        }).error(function(data) {
                            console.log(data);
                            alert('Error revise la consola');
                            $('#btnGuardar').attr("disabled", false);

                        });
            };


            function fillInitData(id){

                $http.get('{{ URL::route('modPrestamos') }}/getPrestamoById/'+id)
                        .success(function(data){

                            console.log(data);

                            $scope.descripcion = data.descripcion;
                            $scope.cantidad= parseFloat(data.cantidad) ;
                            $scope.tasa = parseInt(data.tasa);
                            $scope.interes = parseFloat(data.interes);
                            $scope.idProveedor = parseFloat(data.proveedor_id) ;
                            $scope.num_letras = parseFloat(data.n_letras);
                            $scope.dniProveedor = parseInt(data.proveedor.dni);

                            angular.forEach(data.letras,function(item){

                                var fec = new Date(item.fecha_vencimiento);
                                fec.setDate(fec.getDate()+1);

                                var letra = {
                                    monto: parseFloat(item.monto_inicial),
                                    interes:parseFloat(item.interes),
                                    total:parseFloat(item.monto_inicial)+parseFloat(item.interes),
                                    fecha:fec
                                };

                                $scope.letras.push(letra);



                            });

                            $scope.searchDNI();




                        }).error(function(data) {
                            console.log(data);


                        });

            }



        });






    </script>



@stop

