@extends('layout')

@section('content-header')
    
    @if(Session::has('confirm') || isset($good))
        <div style="display: none"  id="alert-result" class="alert alert-success alert-dismissible" role="alert" data-rol="aviso">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4>Perfecto!!</h4>
            <p><i class="fa fa-info-circle"></i>  <strong>{{ Session::get('confirm') }}</strong></p>
        </div>
    @endif
    @if(Session::has('fail')||isset($bad))
        <div style="display: none"  id="alert-result" class="alert alert-danger alert-dismissible" role="alert" data-rol="aviso">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4>Error!!</h4>
            <p><i class="fa fa-info-circle"></i>  <strong>{{ Session::get('confirm') }}</strong></p>
        </div>
    @endif


    <div style="padding: 5px ;">
        <div class="bs-callout bs-callout-info" id="callout-type-dl-truncate">
            <h4>Módulo de Control y calidad </h4>
        </div>
    </div>
@stop


@section('content')


    <div ng-app="app" ng-controller="MainController">

        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-danger" >
                        <div class="box-header">
                            <!-- tools box -->
                            <div class="pull-right box-tools">
                                <button class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                            </div><!-- /. tools -->
                            <i class="fa fa-cloud"></i>

                            <h3 class="box-title">Proveedor: {{ $proveedor->fullname}}</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body no-padding">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h2>Detalle de Acopio</h2>
                                </div>
                            </div>
                            <div class="row hidden-print">
                                <form action="{{ URL::route('getAcopioByProveedorAndFechas') }}" method="post" >
                                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                    <input type="hidden" name="id" value="{{ $proveedor->id}}" />
                                    <div class="col-lg-2">
                                        <label for="">Fecha Inicio</label>
                                        <input value="{{{$data['fecha_inicio'] or ''}}}" name="fecha_inicio" class="form-control" type="date" required/>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="">Fecha Fin</label>
                                        <input value="{{{$data['fecha_fin'] or ''}}}" name="fecha_fin" class="form-control" type="date" required/>
                                    </div>
                                    <div>
                                        <label for=""></label><br/>
                                        <button class="btn btn-info" >Buscar</button>
                                    </div>

                                </form>


                            </div>

                            <hr>

                            <div class="row" style="padding: 15px;">
                                <div class="table-responsive">
                                    <table class="table table-condensed table-hover" style="border-collapse:collapse;">
                                        <thead >
                                        <tr>
                                            <th>Id</th>
                                            <th>Cantidad Registrada</th>
                                            <th>Cantidad Total</th>
                                            <th>Fecha</th>
                                            <th class="hidden-print" colspan="2">Opciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($acopios as $acopio)
                                            <tr>
                                                <td data-toggle="collapse" data-target="#detalleAcopio{{ $acopio->id}}" class="accordion-toggle">{{ $acopio->id }}</td>
                                                <td>{{ $acopio->cantidad }}</td>
                                                <td>{{ $acopio->cantidad_total }}</td>
                                                <td>{{ $acopio->feha }}</td>
                                                <td>
                                                    <button ng-click="addInsidencia({{$acopio->id}})" class="btn btn-info hidden-print">Agergar Insidencia</button>
                                                </td>
                                            </tr>

                                            @if(count($acopio->insidencias)>0 )
                                            <!--
                                            <tr >
                                                <td colspan="3" class="hiddenRow"><div class="accordian-body collapse" id="detalleAcopio{{ $acopio->id}}"> Demo1 </div> </td>
                                            </tr>-->
                                            <tr class="accordian-body collapse" id="detalleAcopio{{ $acopio->id}}">

                                                <td>
                                                    <table class="table table-condensed table-hover">

                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Cantidad </th>
                                                            <th>Tipo</th>
                                                            <th>Observacion</th>
                                                        </tr>

                                                        @foreach($acopio->insidencias as $insidencia)
                                                            <tr>
                                                                <td>{{$insidencia->id}}</td>
                                                                <td>{{$insidencia->cantidad}}</td>
                                                                <td>{{$insidencia->tipo}}</td>
                                                                <td>{{$insidencia->observacion}}</td>
                                                            </tr>

                                                        @endforeach
                                                    </table>
                                                </td>
                                            </tr>
                                            @else
                                            <tr class="accordian-body collapse" id="detalleAcopio{{ $acopio->id}}">
                                                <td>No hay datos</td>
                                            </tr>

                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div><!--/.table-responsive -->
                            </div><!-- /.row - inside box -->
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <div  id="paginador">

                            </div>
                        </div><!-- /.box-footer -->
                    </div><!-- /.box -->

                </div>

            </div>
        </div><!--/.content-->

        <div class="modal fade" id="newInsidencia">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h2 class="modal-title">Registrar Insidencia de Acopio</h2>
                    </div>
                    <div class="modal-body">
                        <p>
                        <form name="formAddInsidencia" method="post" id="formInsidencia" action="{{ URL::route('RegInsidencia') }}" >

                            <fieldset>
                                <legend>Formulario</legend>
                                <input type="hidden" id="token" name="_token" value="{{{ csrf_token() }}}" />
                                <div class="field">
                                    <label>Proveeedor</label>
                                    <input type="hidden" name="hdIdAcopio" id="hdIdAcopio"/>
                                    <input type="hidden" name="hdIdProveedor" id="hdIdProveedor"/>
                                    <input type="hidden" name="hdFechaAcopio" id="hdFechaAcopio"/>
                                    <input class="form-control"  ng-model="acopio.provName" type="text"  name="inProveedor" id="inProveedor" readonly/>
                                </div>
                                <div class="form-inline">
                                    <div class="form-group">
                                        <label for="">Acopio</label>
                                        <input class="form-control"  ng-model="acopio.cantidad_total" type="number" name="acopio" placeholder="Cantidad" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="">Cantidad</label>
                                        <input step="any" class="form-control" ng-model="insidencia.cantidad" type="number" name="CantidadInsidencia"
                                              min ="0" placeholder="Cantidad" required="required">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="">Tipo</label>
                                        <select class="form-control" ng-model="insidencia.tipo" name="seltipo" >
                                            <option value="descuento">Descuento</option>
                                            <option value="observacion">Observacion</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="">Observacion</label>
                                        <input ng-model="insidencia.observacion" class="form-control" type="text" name="observacion" placeholder="Cantidad" required="required">
                                    </div>
                                </div>

                            </fieldset>


                            <hr>
                            <a ng-disabled='!formAddInsidencia.$valid' ng-click="enviarInsidencia()" class="btn btn-success" tabindex="0" id="btnGuardarAcopio">Guardar</a>
                        </form>
                        </p>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal --><!-- /#newInsidencia-->


    </div>




    <style type="text/css">
        .hiddenRow {
    padding: 0 !important;
}
    </style>


    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.19/angular.js"></script>
    <script>
        var app = angular.module("app", []);
        app.controller("MainController", function($scope,$http,$window) {

            /*Declaracion de variables*/
            $scope.acopio = {};
            $scope.insidencia = {};
            var token = $("#token").val();

            /*Iniciacion de Funciones*/




            /*Declaracion de Metodo*/

            $scope.enviarInsidencia = function () {

               // alert('hola');
                var bandera = validar ();


                if(bandera == 0){

                    /*envia los datos*/

                    console.log('datos validados');

                    $('#formInsidencia').submit();
                }else{
                    /*no envia los datos*/

                    alert('los datos ingresados no son correctoss')
                }
            };

            $scope.addInsidencia = function (id) {

                $scope.insidencia = {};

                $http.post('{{ URL::route('getAcopioById') }}',
                        {_token : token,
                            id:id })
                        .success(function(data){


                            $('#hdIdAcopio').val(data.id);
                            $('#hdIdProveedor').val(data.proveedor_id);
                            $('#hdFechaAcopio').val(data.feha);

                            data.cantidad_total = parseFloat(data.cantidad_total);

                            $scope.acopio = data;

                           console.log(data);

                        });

                $('#newInsidencia').modal('show');
               // alert('Hola'+id);
            };

            function validar(){

                var bandera = 0;


                if( $scope.insidencia.tipo == "descuento" && $scope.insidencia.cantidad > $scope.acopio.cantidad_total ){

                    bandera =1;

                }

               return bandera;
            }






        });



    </script>


@stop

