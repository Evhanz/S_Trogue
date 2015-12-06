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
                <div class="box box-primary" >
                    <div class="box-header">
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                        </div><!-- /. tools -->
                        <i class="fa fa-cloud"></i>

                        <h3 class="box-title">Lista de los Venta a Terceros</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body ">

                        <div class="panel panel-modControlCalidad">
                            <div class="panel-heading">
                                Filtro
                            </div>

                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form class="form-inline">
                                            <div class="col-lg-2">
                                                <label>DNI</label>
                                                <input id="txtDNI"  class="form-control" type="number" placeholder="DNI"  pattern="[0-9]{13,16}">
                                            </div>
                                            <div class="col-lg-2">
                                                <label>Estado</label><br/>
                                                <select class="form-control" name="estado" required="">
                                                    <option value="deuda">deuda</option>
                                                    <option value="pagada">pagada</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-2">
                                                <label>Fecha Inicio</label>
                                                <input name="fecha_inicio" class="form-control" type="date" required>
                                            </div>
                                            <div class="col-lg-2">
                                                <label>Fecha Fin</label>
                                                <input name="fecha_fin"  class="form-control" type="date" required>
                                            </div>

                                            <div class="col-lg-4">
                                                <br/>
                                                <button  class="btn btn-info" id="btnBuscar">
                                                    <i class="fa fa-search"></i>
                                                    Buscar
                                                </button>
                                                <a href="{{URL::route('getViewNewVentaTerceros')}}" class="btn btn-success" id="btnNuevo">
                                                    <i class="fa fa-plus-circle"></i>
                                                     V. Terceros
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
                                        <th>Descripcion</th>
                                        <th>Origen</th>
                                        <th>Proveedor</th>
                                        <th>Estado</th>
                                        <th colspan="2">Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($ventaTerceros as $venta)
                                        <tr>
                                            <td>{{$venta->id}}</td>
                                            <td>{{$venta->descripcion}}</td>
                                            <td>{{$venta->origen->descripcion}}</td>
                                            <td>{{$venta->proveedor->fullname}}</td>
                                            @if($venta->estado == 1)
                                               <td><span class="label label-success">pagado</span></td>
                                            @else
                                               <td><span class="label label-danger">deuda</span></td>
                                            @endif

                                            <td>

                                                <a class="btn btn-warning" href="{{ URL::route('getViewNewVentaTerceros') }}">
                                                    Editar
                                                </a>

                                                <button class="btn btn-danger" > Eliminar</button>

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


@stop
