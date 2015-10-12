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
            <h4>Módulo del Proveedores </h4>
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

                            <h3 class="box-title">Lista de Todo los Proveedores</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="row">
                            <div class="col-lg-12">
                                <form class="form-inline">
                                    <div class="form-group">
                                        <label>Criterio</label>
                                            <input id="txtCriterio" value="{{{ $criterio or ''}}}" type="text" class="form-control" placeholder="First Name"  onKeyUp="this.value=this.value.toUpperCase();">
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
                                        <button id="btnNuevo" class="btn btn-success"><i class="fa fa-user-plus"></i>Nuevo</button>
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
                                    @foreach ($proveedores as $proveedor)
                                        <tr>
                                            <td>{{ $proveedor->id }}</td>
                                            <td>{{ $proveedor->fullname }}</td>
                                            <td>{{ $proveedor->anexo->descripcion }}</td>
                                            <td>{{ $proveedor->anexo->ruta->descripcion }}</td>
                                            <td>
                                                <a href="{{ URL::route('updateProveedor',$proveedor->id) }}" class="btn btn-warning">
                                                    Editar<i class="edit icon"></i>
                                                </a>
                                                
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
                        <div  id="paginador">
                            {!! $proveedores->setPath('')->render() !!}
                        </div>
                    </div><!-- /.box-footer -->
                </div><!-- /.box -->
            </div>
        </div>
    </div><!-- /.content-->

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




    </script>






    <style>

        .pagination {
            display: inline-block;
            padding-left: 0;
            margin: 20px 0;
            border-radius: 4px;
        }
        .pagination>li {
            display: inline;
        }

        .pagination>li:first-child>a, .pagination>li:first-child>span {
            margin-left: 0;
            border-bottom-left-radius: 4px;
            border-top-left-radius: 4px;
        }
        .pagination>.disabled>span, .pagination>.disabled>span:hover, .pagination>.disabled>span:focus, .pagination>.disabled>a, .pagination>.disabled>a:hover, .pagination>.disabled>a:focus {
            color: #999;
            cursor: not-allowed;
            background-color: #fff;
            border-color: #ddd;
        }
        .pagination>li>a, .pagination>li>span {
            position: relative;
            float: left;
            padding: 6px 12px;
            margin-left: -1px;
            line-height: 1.428571429;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #ddd;
        }

        .pagination>.active>a, .pagination>.active>span, .pagination>.active>a:hover, .pagination>.active>span:hover,
        .pagination>.active>a:focus, .pagination>.active>span:focus {
            z-index: 2;
            color: #fff;
            cursor: default;
            background-color: #428bca;
            border-color: #428bca;
        }
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0 0 0 0);
            border: 0;
        }
    </style>




@stop

