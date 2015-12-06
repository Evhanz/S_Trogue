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
            <h4>Módulo del Servicio - Prestamos </h4>
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
                            <a href="{{URL::route('getAllPrestamos')}}" class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i style="color: #ffffff" class="fa fa-refresh"></i></a>
                        </div><!-- /. tools -->
                        <i class="fa fa-cloud"></i>

                        <h3 class="box-title">Lista de los Prestamos</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        
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
                                                <select class="form-control" name="estado" required="">
                                                   <option value="deuda">deuda</option>
                                                   <option value="pagada">pagada</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Fecha Inicio</label>
                                                <input name="fecha_inicio"  class="form-control" type="date" required="">
                                            </div>
                                            <div class="form-group">
                                                <label>Fecha Fin</label>
                                                <input name="fecha_fin"   class="form-control" type="date" required="">
                                            </div>


                                            <div class="form-group">
                                                <button  class="btn btn-info" id="btnBuscar">
                                                    <i class="fa fa-search"></i>
                                                    Buscar
                                                </button>
                                                <a href="{{URL::route('getViewNewPrestamo') }}" class="btn btn-success" id="btnNuevo">
                                                    <i class="fa fa-plus-circle"></i>
                                                    Nuevo Prestamo
                                                </a>
                                            </div>

                                        </form>
                                    </div>
                                </div>

                            </div>

                        </div>




                        <div class="row" style="padding: 15px;">
                            <div class="table-responsive">
                                <table class="table table-hover" id="tableReq" data-tabl="modServicio">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Proveedor</th>
                                        <th>Cantidad</th>
                                        <th>Fecha</th>
                                        <th>estado</th>
                                        <th></th>
                                        <th colspan="3">Opciones</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($prestamos as $prestamo)

                                        <tr>
                                            <td>{{$prestamo->id}}</td>
                                            <td>{{$prestamo->proveedor->fullname}}</td>
                                            <td>{{$prestamo->cantidad}}</td>
                                            <td>{{$prestamo->created_at}}</td>
                                            <td>

                                                @if($prestamo->estado == 'deuda')
                                                    <span class="label label-danger">deuda</span>
                                                @else
                                                    <span class="label label-success">pagada</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if($prestamo->estado != 'deuda')
                                                    <button class="btn btn-warning" disabled>
                                                        editar
                                                    </button>
                                                @else
                                                    <a class="btn btn-warning" href="{{URL::route('getViewUpPrestamo',$prestamo->id)}}">
                                                        editar
                                                    </a>
                                                @endif

                                            </td>
                                            <td>
                                                <button class="btn btn-danger" onclick="modalDelete('{{$prestamo->id}}')">
                                                    Eliminar
                                                </button>
                                            </td>

                                            <td>
                                                <button class="btn btn-default" onclick="imprimirCalendario('{{$prestamo->id}}');">
                                                    <i class="fa fa-print"></i>
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
            location.href='{{ URL::route('modPrestamos') }}/deletePrestamo/'+id;

        }

        function imprimirCalendario(id){

            var url ='{{ URL::route('modReporte') }}/getPrestamoById/'+id;

            var n =window.open(url);
            n.print();


        }




    </script>


@stop
