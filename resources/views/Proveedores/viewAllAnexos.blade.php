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
        <div style="display:none" id="alert-result"  data-rol="aviso" class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4>Error!!</h4>
            <p><i class="fa fa-info-circle"></i>  <strong>{{ Session::get('fail') }}</strong></p>
        </div>
    @endif


    <div style="padding: 5px ;">
        <div class="bs-callout bs-callout-info" id="callout-type-dl-truncate">
            <h4>Módulo del Proveedores - Anexos </h4>
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
                            <i class="fa fa-crosshairs"></i>

                            <h3 class="box-title">Lista de Todo los anexos</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body ">
                        <div class="row">
                            <div class="col-lg-12">
                                <button id="btnNuevo" style="float:right" class="btn btn-success btn-lg">Nuevo</button>
                            </div>

                        </div>
                        <div class="row" style="padding: 15px;">
                            <div class="table-responsive">
                                <table class="table  table-bordered table-hover"  data-tabl="modProveedor" id="tableReq">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Descripcion</th>
                                            <th>Observacion</th>
                                            <th>Ruta</th>
                                            <th colspan="2">Opciones</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($anexos as $anexo)
                                        <tr>
                                            <td>{{ $anexo->id }}</td>
                                            <td>{{ $anexo->descripcion }}</td>
                                            <td>{{ $anexo->observacion }}</td>
                                            <td>{{ $anexo->ruta->descripcion}}</td>
                                            <td>
                                                <button class="btn btn-warning"
                                                        onclick="updateAnexo('{{ $anexo->id }}','{{ $anexo->descripcion }}',
                                                                '{{ $anexo->observacion }}','{{ $anexo->ruta_id }}')">
                                                    Editar<i class="edit icon"></i>
                                                </button>
                                                
                                            </td>
                                            <td>
                                                <button class="btn btn-danger" onclick="modalDelete('{{ $anexo->id }}','{{ $anexo->descripcion }}')">
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


    <div class="modal fade" id="newAnexo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title">Registrar Anexo</h2>
                </div>
                <div class="modal-body">
                    <p>
                    <form id="formRegModal" action="{{ URL::route('regAnexo') }}"  method="post">

                        <fieldset>
                            <legend>Formulario</legend>
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                            <div class="row">

                                <div class="col-lg-6">
                                    <label for="">Ruta</label>
                                    <select class="form-control" name="ruta" id="ruta" required>
                                        <option value=" ">Ninguno</option>
                                        @foreach($rutas as $ruta)
                                            <option value="{{$ruta->id}}">{{$ruta->descripcion}}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="col-lg-6">
                                    <label for="">Descripcion</label>
                                    <input name="descripcion" class="form-control" type="text" required/>
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Observacion</label>
                                    <input name="observacion" class="form-control" type="text" required/>

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

    <!--Modal Update-->
    <div class="modal fade" id="updateAnexo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title">Actualizar Anexo</h2>
                </div>
                <div class="modal-body">
                    <p>
                    <form id="formRegModal" action="{{ URL::route('updateAnexo') }}"  method="post">

                        <fieldset>
                            <legend>Formulario</legend>
                            <input type="hidden" id="idUpAnexo" name="idAnexo"/>
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                            <div class="row">

                                <div class="col-lg-6">
                                    <label for="">Ruta</label>
                                    <select class="form-control" name="ruta" id="selUpruta" required>
                                        <option value=" ">Ninguno</option>
                                        @foreach($rutas as $ruta)
                                            <option value="{{$ruta->id}}">{{$ruta->descripcion}}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="col-lg-6">
                                    <label for="">Descripción</label>
                                    <input id="upDescripcion" name="descripcion" class="form-control" type="text" required/>
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Observación</label>
                                    <input id="upObservacion" name="observacion" class="form-control" type="text" required/>

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


    <!--Modal Delete -->

    <!--Modal para eliminar ruta-->
    <div class="modal fade" id="modalDelete">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title">Eliminar Anexo</h2>
                </div>
                <div class="modal-body">
                    <p class="bg-danger">
                        <strong>Está seguro de eliminar el anexo</strong>  ?
                        <input  id="idDelAnexo" type="hidden"/>
                        <input class="form-control" id="anexo" type="text" readonly/>
                    </p>
                    <p>
                        <button id="btnsi" onclick="deleteSi()" type="button" class="btn btn-primary btn-lg">Si</button>
                    </p>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <script>

        $("#btnNuevo").click(function(){

            $('#newAnexo').modal('show');
        });


        function updateAnexo(id ,descripcion,observacion,ruta_id){

            $('#idUpAnexo').val(id);
            $('#upDescripcion').val(descripcion);
            $('#upObservacion').val(observacion);
            $('#selUpruta').val(ruta_id);
            $('#updateAnexo').modal('show');


        }

        function modalDelete(id,anexo){

            $('#modalDelete').modal('show');

            $('#idDelAnexo').val(id);
            $('#anexo').val(anexo);

        }

        function deleteSi(){
            var id = $('#idDelAnexo').val();
            location.href='{{ URL::route('anexos') }}/deleteAnexo/'+id;
        }


    </script>
@stop
