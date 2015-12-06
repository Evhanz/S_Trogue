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
            <h4><i class="fa fa-users" style="color: #17CAAE "></i> Módulo del Proveedores </h4>
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
                            <h3 class="box-title">Lista de Todo los Proveedores</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body ">
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="panel panel-primary">
                                    <div class="panel-heading">

                                        Filtro

                                    </div>
                                    <div class="panel-body">

                                        <form class="form-inline">
                                            <div class="form-group">
                                                <label>Criterio</label>
                                                <input id="txtCriterio" value="{{{ $criterio or ''}}}" type="text" class="form-control" placeholder="Ingrese Nombre o Apellido"  onKeyUp="this.value=this.value.toUpperCase();">
                                            </div>
                                            <div class="form-group">
                                                <label>DNI</label>
                                                <input id="txtDNI"  class="form-control" type="text" placeholder="DNI" value="{{{ $dni or ''}}}" pattern="[0-9]{13,16}">
                                            </div>
                                            <div class="form-group" style="float:right;">
                                                <button  class="btn btn-info" id="btnBuscar">
                                                    <i class="fa fa-search"></i>
                                                    Buscar
                                                </button>
                                                <button id="btnNuevo" class="btn btn-success"><i class="fa fa-plus-circle"></i>  Nuevo</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row" style="padding: 15px;">
                            <div class="table-responsive">
                                <table class="table  table-bordered table-hover" id="tableReq" data-tabl="modProveedor">
                                    <thead class="head-table">
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre y Apellidos</th>
                                            <th>DNI</th>
                                            <th>Anexo</th>
                                            <th>Ruta</th>
                                            <th colspan="2">Opciones</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($proveedores as $proveedor)
                                        <tr>
                                            <td>{{ $proveedor->id }}</td>
                                            <td>{{ $proveedor->fullname }}</td>
                                            <td>{{ $proveedor->dni }}</td>
                                            <td>{{ $proveedor->anexo->descripcion }}</td>
                                            <td>{{ $proveedor->anexo->ruta->descripcion }}</td>
                                            <td>
                                                <a href="{{ URL::route('updateProveedor',$proveedor->id) }}" class="btn btn-warning">
                                                    Editar  <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                                
                                            </td>
                                            <td>
                                                <button class="btn btn-danger" onclick="viewModal('{{ $proveedor->id }}','{{ $proveedor->fullname }}')">
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
                            {!! $proveedores->setPath('')->render() !!}
                        </div>
                    </div><!-- /.box-footer -->
                </div><!-- /.box -->
            </div>
        </div>
    </div><!-- /.content-->


    <div class="modal fade" id="modalDelete">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title">Eliminar Proveedor</h2>
                </div>
                <div class="modal-body">
                    <p class="bg-danger">
                       <strong>Está seguro de eliminar a:</strong>  ?
                        <input id="idProveedor" type="hidden"/>
                        <input class="form-control" id="proveedor" type="text" readonly/>
                    </p>
                    <p>
                        <button id="btnsi" onclick="deleteSi()" type="button" class="btn btn-primary btn-lg">Si</button>
                    </p>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->






    <script>


        //evento de los botones

        $(document).ready(function(){
            //evento al cargar input
          $('#txtDNI').focus(function(){
              if(this.value=='0'){
                  this.value='';
              }
          });

            $('#btnNuevo').click(function(e){
                e.preventDefault();
                location.href='{{ URL::route('viewNewProveedor') }}';
            });


            $("#btnBuscar").click(function(e){

                e.preventDefault();
                var criterio = $('#txtCriterio').val().trim();
                var dni = $('#txtDNI').val().trim();


                if(dni.length<=0){
                    dni ='0';
                }

                if(criterio.length<=0){
                    criterio=' ';
                }


                if(dni=='0' && criterio.trim().length<=0){


                    location.href='{{ URL::route('proveedoresAll') }}';
                }else{

                location.href='{{ URL::route('proveedores') }}/getBy/'+criterio+'-'+dni;
                }

            });


        });


        function viewModal(id,proveedor){

            $('#modalDelete').modal('show');

            $('#idProveedor').val(id);
            $('#proveedor').val(proveedor);

        }


        function deleteSi(){
            var id = $('#idProveedor').val();
            location.href='{{ URL::route('proveedores') }}/deteleProveedor/'+id;
        }




    </script>






 




@stop

