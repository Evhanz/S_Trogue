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
            <p><i class="fa fa-info-circle"></i>  <strong>{{ Session::get('fail') }}</strong></p>
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
                    <div class="box box-primary" >
                        <div class="box-header">
                            <!-- tools box -->
                            <div class="pull-right box-tools">
                                <button class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                            </div><!-- /. tools -->
                            <i class="fa fa-cloud"></i>

                            <h3 class="box-title">Proveedor: {{ $proveedor->fullname}}</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body ">


                            <div class="panel panel-modControlCalidad">
                                <div class="panel-heading">

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h2>Detalle de Acopio</h2>
                                        </div>
                                    </div>

                                </div>

                                <div class="panel-body">

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
                                                <button class="btn btn-success" >Buscar</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>

                            </div>






                            <div class="row" style="padding: 15px;">
                                <div class="table-responsive">
                                    <table class="table table-condensed table-hover" data-tabl="modControlCalidad" style="border-collapse:collapse;">
                                        <thead >
                                        <tr>
                                            <th>Id</th>
                                            <th>Cant. Regitrada</th>
                                            <th>Cant. Total</th>
                                            <th>Fecha</th>
                                            <th class="hidden-print" >Insidencias</th>
                                            <th class="hidden-print" >Acopio</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($acopios as $acopio)
                                            <tr>
                                                <td >{{ $acopio->id }}</td>
                                                <td>{{ $acopio->cantidad }}</td>
                                                <td>{{ $acopio->cantidad_total }}</td>
                                                <td>{{ $acopio->feha }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button data-toggle="collapse" data-target="#detalleAcopio{{ $acopio->id}}" aria-expanded="false"
                                                                 aria-controls="detalleAcopio" class="btn btn-default hidden-print">
                                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>

                                                            @if(count($acopio->insidencias)>0 )
                                                                <span class="badge bg-red">{{ count($acopio->insidencias) }}</span>
                                                            @else
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            @endif

                                                        </button>
                                                        <button ng-click="addInsidencia({{$acopio->id}})" class="btn btn-info hidden-print">
                                                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                                        </button>
                                                    </div>

                                                </td>

                                                <td>
                                                    <div class="btn-group">
                                                        <button ng-click="editAcopio({{$acopio->id}})" class="btn btn-warning hidden-print">
                                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                        </button>
                                                        <button ng-click="deleteAcopio({{$acopio->id}})" class="btn btn-danger hidden-print">
                                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                        </button>
                                                    </div>

                                                </td>

                                            </tr>

                                            @if(count($acopio->insidencias)>0 )
                                            <!--
                                            <tr >
                                                <td colspan="3" class="hiddenRow"><div class="accordian-body collapse" id="detalleAcopio{{ $acopio->id}}"> Demo1 </div> </td>
                                            </tr>-->
                                            <tr  class="collapse" id="detalleAcopio{{ $acopio->id}}" >

                                                <td colspan="5">

                                                    <h3>Detalle de Insidencia</h3>

                                                    <table class="table  table-bordered table-hover" data-tabl="detailAcopio">

                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Cantidad </th>
                                                                <th>Tipo</th>
                                                                <th>Observacion</th>
                                                                <th>Opciones</th>
                                                            </tr>
                                                        </thead>

                                                        @foreach($acopio->insidencias as $insidencia)
                                                            <tr>
                                                                <td>{{$insidencia->id}}</td>
                                                                <td>{{$insidencia->cantidad}}</td>
                                                                <td>{{$insidencia->tipo}}</td>
                                                                <td>{{$insidencia->observacion}}</td>
                                                                <td>
                                                                    <div class="btn-group">

                                                                        <button ng-click="editInsidencia({{$insidencia->id}})" class="btn btn-warning hidden-print">
                                                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                                        </button>
                                                                        <button ng-click="deleteInsidencia({{$insidencia->id}})" class="btn btn-danger hidden-print">
                                                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                                        </button>
                                                                    </div>

                                                                </td>

                                                            </tr>

                                                        @endforeach
                                                    </table>

                                                    <br/>
                                                </td>
                                            </tr>
                                            @else
                                            <tr class="accordian-body collapse" id="detalleAcopio{{ $acopio->id}}">
                                                <td colspan="5">No hay datos</td>
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


        <!--Modal nueva Insidencia-->
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


        <!--Modal editar Insidencia-->
        <div class="modal fade" id="ediInsidencia">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h2 class="modal-title">Editar Insidencia de Acopio</h2>
                    </div>
                    <div class="modal-body">

                        <form name="formUpInsidencia" method="post" id="formUpInsidencia" action="{{ URL::route('UpdateInsidencia') }}" >

                            <fieldset>
                                <legend>Formulario</legend>
                                <input type="hidden" id="token" name="_token" value="{{{ csrf_token() }}}" />
                                <div class="field">
                                    <label>Proveeedor</label>
                                    <input type="hidden" name="hdUpIdAcopio" id="hdUpIdAcopio"/>
                                    <input type="hidden" name="hdUpIdProveedor" id="hdUpIdProveedor"/>
                                    <input type="hidden" name="hdUpFechaAcopio" id="hdUpFechaAcopio"/>
                                    <input type="hidden" name="hdIdInsidencia" id="hdIdInsidencia"/>
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
                                               min ="1" placeholder="Cantidad" required="required">
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
                            <a ng-disabled='!formUpInsidencia.$valid' ng-click="enviarUpInsidencia()" class="btn btn-success" tabindex="0" id="btnUpInsidencia">Guardar</a>
                        </form>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal --><!-- /#newInsidencia-->


        <!--Modal Editar Acopio-->

        <div class="modal fade" id="editAcopio">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h2 class="modal-title">Editar Acopio</h2>
                    </div>
                    <div class="modal-body">
                        <p>
                        <form id="formEditAcopio" action="{{ URL::route('updateAcopio') }}"  method="post">

                            <fieldset>
                                <legend>Formulario</legend>
                                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                <div class="field">
                                    <label>Proveeedor</label>
                                    <input type="hidden" name="idUpdateAcopio" id="idUpdateAcopio"/>
                                    <input class="form-control" type="text"   id="namProveedor" readonly/>
                                </div>
                                <div class="form-inline">
                                    <div class="form-group">
                                        <label>Datos</label>
                                        <input class="form-control" type="date" id="fechaAcopio" name="fecha" placeholder="fecha" required="required">

                                    </div>
                                    <div class="form-group">
                                        <label for="">Cantidad</label>
                                        <input min="0" step="any" class="form-control" type="number" id="cantidadAcopio" name="cantidad"
                                               placeholder="Cantidad" required="required">
                                    </div>
                                </div>

                            </fieldset>


                            <hr>
                            <button  class="btn btn-success" tabindex="0" id="btnGuardarAcopio">Guardar</button>
                        </form>
                        </p>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->



        <!--Modal para eliminar -->
        <div class="modal fade" id="modalDelete">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h2 class="modal-title">Eliminar </h2>
                    </div>
                    <div class="modal-body">
                        <p class="bg-danger">
                            <strong>Está seguro de continuar</strong>  ?
                            <input id="typeObject" type="hidden"/>
                            <input id="idObject" type="hidden"/>
                        </p>
                        <p>
                            <button id="btnsi" ng-click="deleteSi()" type="button" class="btn btn-primary btn-lg">Si</button>
                        </p>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


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
            var temp;

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


            /*para mostrar el modal editar la insidencia*/

            $scope.editInsidencia = function (id) {

                $scope.insidencia = {};

                $http.post('{{ URL::route('getInsidenciaByAcopio') }}',
                        {_token : token,
                            id:id })
                        .success(function(data){

                            $('#hdUpIdAcopio').val(data.acopio_id);
                            $('#hdUpIdProveedor').val(data.acopio.proveedor_id);
                            $('#hdUpFechaAcopio').val(data.acopio.feha);
                            $('#hdIdInsidencia').val(data.id);


                            var acopio = {
                                provName:data.acopio.proveedor.name+','+data.acopio.proveedor.apellidoP+' '+data.acopio.proveedor.apellidoM,
                                cantidad_total: parseFloat(data.acopio.cantidad_total)

                            };


                            var insidencia = {

                                cantidad: parseFloat(data.cantidad),
                                tipo:data.tipo,
                                observacion:data.observacion

                            };

                            temp =parseFloat(data.cantidad);

                            $scope.acopio = acopio;
                            $scope.insidencia = insidencia;


                            console.log(data);

                        }).error(function(error){
                            console.log(error);
                        });

                $('#ediInsidencia').modal('show');
                // alert('Hola'+id);
            };


            $scope.enviarUpInsidencia = function () {


                var bandera = validarUpdate ();


                if(bandera == 0){

                    /*envia los datos*/

                    //console.log('datos validados');
                    $('#formUpInsidencia').submit();


                }else{
                    /*no envia los datos*/

                    alert('la cantidad supera al total')
                }
            };


            $scope.deleteInsidencia = function(id){


                $('#idObject').val(id);
                $('#typeObject').val("insidencia");

                $('#modalDelete').modal('show');


            };

            $scope.deleteSi =function(){

                var id = $('#idObject').val();

                var tipo =  $('#typeObject').val();

                if(tipo == 'insidencia'){

                    location.href='{{ URL::route('modControlCalidad') }}/deleteInsidencia/'+id;

                }

            };


            $scope.editAcopio = function (id) {


                $http.post('{{ URL::route('getAcopioById') }}',
                        {_token : token,
                            id:id })
                        .success(function(data){

                            $('#idUpdateAcopio').val(id);
                            $('#namProveedor').val(data.provName);
                            $('#fechaAcopio').val(data.feha);
                            $('#cantidadAcopio').val(data.cantidad);



                            console.log(data);

                        }).error(function(error){
                            console.log(error);
                        });

                $('#editAcopio').modal('show');
                // alert('Hola'+id);
            };




            function validarUpdate(){


                var bandera = 0;

                console.log(temp);


                if( $scope.insidencia.tipo == "descuento" && $scope.insidencia.cantidad > $scope.acopio.cantidad_total+temp ){

                    bandera =1;

                }

                return bandera;
            }



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

