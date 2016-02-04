@extends('layout')

@section('content-header')

    @if(Session::has('confirm'))
        <div data-rol="aviso"  style="display:none" id="alert-result" class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4>Perfecto!!</h4>
            <p><i class="fa fa-info-circle"></i>  <strong>{{ Session::get('confirm') }}</strong></p>
        </div>
    @endif
    @if(Session::has('fail'))
        <div data-rol="aviso" style="display:none" id="alert-result" class="alert alert-danger alert-dismissible" role="alert">
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

                        <h3 class="box-title">Lista de Todo los Liquidacion</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">

                        <div class="panel panel-modControlCalidad">
                            <div class="panel-heading">

                                Filtro

                            </div>

                            <div class="panel-body">

                                <div class="row">
                                    <div class="col-lg-12">
                                        <form class="form-inline" method="post" action="{{ URL::route('getAllLiquidacionByParameters') }}">
                                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                            <div class="form-group">
                                                <label for="">Fecha de Inicio</label><br>
                                                <input type="date" name="fecha_inicio"/>

                                            </div>
                                            <div class="form-group">
                                                <label for="">Fecha Fin</label><br>
                                                <input type="date" name="fecha_fin"/>

                                            </div>
                                            <div class="form-group">
                                                <label for="">Numero</label><br>
                                                <input type="text" name="numero"/>

                                            </div>
                                            <div class="form-group">
                                                <label for="">Opciones</label><br>
                                                <button class="btn btn-success" id="btnBuscar">
                                                    <i class="search icon"></i>
                                                    Buscar
                                                </button>
                                            </div>

                                            <div class="form-group">
                                                <label for=""> </label><br>
                                                <a href="{{ URL::route('viewNewLiquidacion') }}" class="btn btn-info" id="btnNuevo">
                                                    <i class="search icon"></i>
                                                    nuevo
                                                </a>
                                            </div>

                                        </form>
                                    </div>
                                </div>

                            </div>

                        </div>


                        <hr>

                        <div class="row" style="padding: 15px;">
                            <div class="table-responsive">
                                <table class="table table-hover" id="tableReq" data-tabl="modServicio">
                                    <thead >
                                    <tr>
                                        <th>Id</th>
                                        <th>Numero</th>
                                        <th>Ruta</th>
                                        <th>Precio Referencial</th>
                                        <th>Cantidad De Litros</th>
                                        <th>Descuentos</th>
                                        <th colspan="2">Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @if($liquidaciones!=null)
                                        @foreach($liquidaciones as $liquidacion)

                                            <tr>
                                                <td>{{$liquidacion->id}}</td>
                                                <td>{{$liquidacion->numero}}</td>
                                                <td>{{$liquidacion->ruta->descripcion}}</td>
                                                <td>{{$liquidacion->precio_ref}}</td>
                                                <td>{{$liquidacion->litros}}</td>
                                                <td>{{$liquidacion->descuentos}}</td>
                                                <td>
                                                    <a class="btn btn-warning" href="{{URL::route('getViewEditLiquidacion',$liquidacion->id)}}">
                                                        editar
                                                    </a>
                                                </td>
                                                <td><button class="btn btn-danger" onclick="modalDelete('{{$liquidacion->id}}')" >
                                                        Eliminar
                                                    </button>
                                                </td>

                                            </tr>

                                        @endforeach
                                    @endif

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
    </div>


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
                        <input id="idObject" type="hidden"/>
                    </p>
                    <p>
                        <button id="btnsi" onclick="deleteSi()" type="button" class="btn btn-primary btn-lg">Si</button>
                    </p>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <script>

        function modalDelete(idLiqui){

            $('#idObject').val(idLiqui);
            $('#modalDelete').modal('show');

        }

        function deleteSi()
        {
            var id = $('#idObject').val();
            location.href='{{ URL::route('modLiquidacion') }}/deleteLiquidacion/'+id;

        }






    </script>










@stop

