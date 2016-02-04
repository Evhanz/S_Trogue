@extends('layout')

@section('content-header')

    <div style="padding: 5px ;">
        <div class="bs-callout bs-callout-info" id="callout-type-dl-truncate">
            <h4>Módulo del Servicio - Venta a terceros </h4>
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
                        <form class="ui form" id="formulario"  name="formLiquidacion"  action="{{ URL::route('updateVentaTerceros') }}" method="post">
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                            <input type="hidden" id="proveedor_id" name="proveedor_id" />
                            <input type="hidden" id="idVenta" name="idVenta" value="{{ $id }}"/>
                            <div class="row">
                                <div class="col-lg-5">
                                    <label>DNI Proveedor</label><br/>
                                    <input  style="height: 34px;" ng-model="dniProveedor" type="number" id="dniProveedor" name="dniProveedor" ng-change="nameProveedor = ''" required>
                                    <a id="searchDNI" class="btn btn-info" ng-click="searchDNI()">:::</a>
                                    <input value="a" style="height: 34px;width: 250px" ng-model="nameProveedor" type="text" id="dniProveedor" name="dniProveedor" disabled>
                                </div>
                                <div class="col-lg-2">
                                    <label for="recurso">Origen</label>
                                    <select class="form-control" id="selRecuso" name="recurso" ng-model="recurso" required>
                                        <option value="">Ninguno</option>
                                        @foreach($recursos as $recurso)
                                            <option value="{{$recurso->id}}">{{$recurso->descripcion}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-5">
                                    <label for="">Descripcion</label>
                                    <textarea class="form-control" ng-model="descripcion" name="descripcion"  id="descripcion" cols="30" rows="2" required="true"></textarea>
                                </div>
                            </div>
                            <br/>
                            <div class="row">

                                <div class="col-lg-4">
                                    <label for="">Cantidad</label>
                                    <input step="any" min="0" class="form-control" ng-model="cantidad" type="number" id="cantidad" name="cantidad" required>
                                </div>
                                <div class="col-lg-4">
                                    <label for="">N° Documento</label>
                                    <input  min="0" class="form-control" ng-model="documento" type="number" id="n_documento" name="n_documento" required>
                                </div>
                                <div class="col-lg-4">
                                    <label for="">Fecha</label>
                                    <input class="form-control" name="fecha" ng-model="fecha"  type="date"/>
                                </div>
                            </div>

                            <br/>
                            <hr>


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

            initData();




            $scope.searchDNI = function (){

                $http.post('{{ URL::route('getProveedorByDNIService') }}',
                        {_token : token,
                            dni:$scope.dniProveedor
                        })
                        .success(function(data){

                            if(data.id !=1 || data.id ==null){
                                alert('No existe Proveedor con ese DNI');
                            }else{
                                $scope.nameProveedor = data.name +", " + data.apellidoP+" "+data.apellidoM;

                                $('#proveedor_id').val(data.id);


                            }

                        }).error(function(data) {
                            console.log(data);
                        });
            };

            function initData(){

                $http.get('{{ URL::route('getVentaTercero',$id) }}')
                        .success(function(data){

                            $scope.dniProveedor = parseInt(data.proveedor.dni);

                            $scope.descripcion = data.descripcion;
                            $scope.cantidad = parseFloat( data.monto);
                            $scope.documento = parseFloat(data.n_docuemento);
                            $scope.fecha = convertStringToDate(data.fecha);


                            $('#selRecuso').val(data.origen_id);


                            $scope.searchDNI();

                        }).error(function(data) {
                            console.log(data);
                        });

            }


        });






    </script>



@stop

