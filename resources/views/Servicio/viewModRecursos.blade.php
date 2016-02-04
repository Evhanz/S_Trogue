@extends('layout')


@section('content-header')

    @if(Session::has('confirm'))
        <div style="display:none" id="alert-result" data-rol="aviso" class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4>Perfecto!!</h4>
            <p><i class="fa fa-info-circle"></i>  <strong>{{ Session::get('confirm') }}</strong></p>
        </div>
    @endif
    @if(Session::has('fail'))
        <div style="display:none" id="alert-result" data-rol="aviso" class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4>Error!!</h4>
            <p><i class="fa fa-info-circle"></i>  <strong>{{ Session::get('fail') }}</strong></p>
        </div>
    @endif


    <div style="padding: 5px ;">
        <div class="bs-callout bs-callout-info" id="callout-type-dl-truncate">
            <h4>Módulo del Servicio - Recursos </h4>
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

                        <h3 class="box-title">Lista de Todo los Recursos</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <button id="btnNuevo" style="float:right" class="btn btn-success btn-lg">Nuevo</button>
                            </div>
                        </div>

                        <div class="row" style="padding: 15px;">
                            <div class="table-responsive">
                                <table class="table  table-bordered table-hover" data-tabl="modServicio" id="tableReq">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Descripcion</th>
                                        <th>Observacion</th>
                                        <th colspan="2">Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($recursos as $recurso)
                                        <tr>
                                            <td>{{ $recurso->id }}</td>
                                            <td>{{ $recurso->descripcion }}</td>

                                            <td>
                                                <button class="btn btn-warning" onclick="modalEdit('{{$recurso->id}}','{{ $recurso->descripcion}}')">
                                                    Editar<i class="edit icon"></i>
                                                </button>

                                            </td>
                                            <td>
                                                <button class="btn btn-danger">
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

                    </div><!-- /.box-footer -->
                </div><!-- /.box -->
            </div>
        </div>
    </div><!-- /.content-->

    <div class="modal fade" id="newRecurso">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title">Registrar Recurso</h2>
                </div>
                <div class="modal-body">
                    <p>
                    <form id="formRegModal" action="{{ URL::route('regRecurso') }}"  method="post">

                        <fieldset>
                            <legend>Formulario</legend>
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="">Descripción</label>
                                    <input name="descripcion" class="form-control" type="text" required/>
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

    <div class="modal fade" id="editRecurso">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title">Registrar Recurso</h2>
                </div>
                <div class="modal-body">
                    <p>
                    <form id="formRegModal" action="{{ URL::route('upRecursos') }}"  method="post">

                        <fieldset>
                            <legend>Formulario</legend>
                            <input type="hidden" id="upIdRecurso" name="id" />
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="">Descripción</label>
                                    <input id="upDescripcion" name="descripcion" class="form-control" type="text" required/>
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

    <script>

        $("#btnNuevo").click(function(){

            $('#newRecurso').modal('show');

        });

        function modalEdit(id,descripcion){

            $('#upIdRecurso').val(id);
            $('#upDescripcion').val(descripcion);

            $('#editRecurso').modal('show')
        }

    </script>

@stop