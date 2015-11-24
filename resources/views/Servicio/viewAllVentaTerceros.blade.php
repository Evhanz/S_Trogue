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
            <h4>Módulo del Servicio - Venta a Terceros </h4>
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

                        <h3 class="box-title">Lista de los Venta a Terceros</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="row">
                            <div class="col-lg-12">
                                <form class="form-inline">
                                    <div class="form-group">
                                        <label>DNI</label>
                                        <input id="txtDNI"  class="form-control" type="text" placeholder="DNI"  pattern="[0-9]{13,16}">
                                    </div>
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <input id="txtDNI"  class="form-control" type="text" >
                                    </div>
                                    <div class="form-group">
                                        <label>Fecha Inicio</label>
                                        <input id="txtDNI"  class="form-control" type="text" >
                                    </div>
                                    <div class="form-group">
                                        <label>Fecha Fin</label>
                                        <input id="txtDNI"  class="form-control" type="text" >
                                    </div>

                                    <div class="form-group">
                                        <button  class="btn btn-info" id="btnBuscar">
                                            <i class="fa fa-search"></i>
                                            Buscar
                                        </button>
                                        <a href="{{URL::route('getViewNewVentaTerceros')}}" class="btn btn-success" id="btnNuevo">
                                            <i class="fa fa-plus-circle"></i>
                                            Nueva Venta a Terceros
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row" style="padding: 15px;">
                            <div class="table-responsive">
                                <table class="table table-hover" id="tableReq">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre y Apellidos</th>
                                        <th>Anexo</th>
                                        <th>Ruta</th>
                                        <th colspan="2">Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>

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


@stop
