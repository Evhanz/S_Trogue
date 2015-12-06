@extends('layout')


@section('content-header')

    @if(Session::has('confirm'))
        <div style="display:none" data-rol ="aviso" id="alert-result" class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4>Perfecto!!</h4>
            <p><i class="fa fa-info-circle"></i>  <strong>{{ Session::get('confirm') }}</strong></p>
        </div>
    @endif
    @if(Session::has('fail'))
        <div style="display:none" data-rol ="aviso" id="alert-result" class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4>Error!!</h4>
            <p><i class="fa fa-info-circle"></i>  <strong>{{ Session::get('fail') }}</strong></p>
        </div>
    @endif


    <div style="padding: 5px ;">
        <div class="bs-callout bs-callout-info" id="callout-type-dl-truncate">
            <h4>Módulo del Servicio - Pagos a Poveedores </h4>
        </div>
    </div>

@stop


@section('content')

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

                        <h3 class="box-title">Lista todos los pagos</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body ">

                        <div class="panel panel-modControlCalidad">

                            <div class="panel-heading">
                                Filtros
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form class="form-inline" method="post" action="{{URL::route('getPrestamosByParams')}}" >
                                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                            <div class="form-group">
                                                <label>DNI</label>
                                                <input name="dni" id="txtDNI" min="1"  class="form-control" type="number" placeholder="DNI"  pattern="[0-9]{13,16}">
                                            </div>
                                            <div class="form-group">
                                                <label>Estado</label><br/>
                                                <select class="form-control" name="estado">
                                                    <option value="deuda">deuda</option>
                                                    <option value="pagada">pagada</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Fecha Inicio</label>
                                                <input name="fecha_inicio"  class="form-control" type="date" >
                                            </div>
                                            <div class="form-group">
                                                <label>Fecha Fin</label>
                                                <input name="fecha_fin"   class="form-control" type="date" >
                                            </div>


                                            <div class="form-group">
                                                <button  class="btn btn-info" id="btnBuscar">
                                                    <i class="fa fa-search"></i>
                                                    Buscar
                                                </button>
                                                <a href="{{URL::route('viewNewPago') }}" class="btn btn-success" id="btnNuevo">
                                                    <i class="fa fa-plus-circle"></i>
                                                    Nuevo Pago
                                                </a>
                                            </div>

                                        </form>
                                    </div>
                                </div>

                            </div>

                        </div>


                        <div class="row" style="padding: 15px;">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="tableReq" data-tabl="modControlCalidad">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Proveedor</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin</th>
                                        <th>P. Litro</th>
                                        <th colspan="2">Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pagos as $pago)
                                        <tr>
                                            <td>{{$pago->id}}</td>
                                            <td>{{$pago->proveedor->fullname}}</td>
                                            <td>{{$pago->fecha_inicio}}</td>
                                            <td>{{$pago->fecha_fin}}</td>
                                            <td>
                                                {{$pago->precio_litro}}
                                            </td>

                                            <td>
                                                <a href="{{ URL::route('viewUpPago',$pago->id) }}" class="btn btn-warning">editar</a>
                                                <button class="btn btn-danger" onclick="modalDelete('{{$pago->id}}')">
                                                    Eliminar<i class="remove icon"></i>
                                                </button>
                                            </td>

                                        </tr>
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
    </div><!-- /.content-->


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

        function modalDelete(idPrestamo){

            $('#idObject').val(idPrestamo);
            $('#modalDelete').modal('show');

        }

        function deleteSi()
        {
            var id = $('#idObject').val();
            location.href='{{ URL::route('ModPagos') }}/deletePago/'+id;

        }


    </script>




@stop
