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

                            <h3 class="box-title">Lista de Todo los Proveedores</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body ">
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="panel panel-modControlCalidad">
                                    <div class="panel-heading">

                                        Filtro

                                    </div>
                                    <div class="panel-body">
                                        <form class="form-inline">
                                            <div class="form-group">
                                                <label for="">Ruta</label><br>
                                                <select class="form-control" name="ruta" id="selRuta">
                                                    <option value=" ">Ninguno</option>
                                                    @foreach($rutas as $ruta)
                                                        <option value="{{$ruta->id}}">{{$ruta->descripcion}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Anexo</label><br>
                                                <select class="form-control" name="anexos" id="selAnexo">
                                                    <option value=" ">Ninguno</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Opciones</label><br>
                                                <button class="btn btn-success" id="btnBuscar">
                                                    <i class="search icon"></i>
                                                    Buscar
                                                </button>
                                            </div>

                                        </form>

                                    </div>
                                </div>


                            </div>
                        </div>


                        <div class="row" style="padding: 15px;">
                            <div class="table-responsive">
                                <table class="table table-hover" id="tableReq" data-tabl="modControlCalidad">
                                    <thead >
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
                                                    <div class="ui icon buttons">
                                                        <button class="btn btn-success" name="regAcopio{{ $proveedor->id }}"
                                                                onclick="regAcopio('{{ $proveedor->id }}','{{ $proveedor->fullname }}')">
                                                            Registrar<i class="edit icon"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{ URL::route('getAcopioByProveedor',$proveedor->id)}}" class="btn btn-info">Ver Acopio</a>
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
    </div>

    
    
    
    <div class="modal fade" id="newAcopio">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h2 class="modal-title">Registrar Acopio</h2>
          </div>
          <div class="modal-body">
            <p>
                <form id="formRegModal" action="{{ URL::route('regAcopio') }}"  method="post">
                    
                    <fieldset>
                        <legend>Formulario</legend>
                        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <div class="field">
                            <label>Proveeedor</label>
                            <input type="hidden" name="hdId" id="hdId"/>
                            <input class="form-control" type="text"  name="inProveedor" id="inProveedor" readonly/>
                        </div>
                        <div class="form-inline">
                            <div class="form-group">
                                <label>Datos</label>
                                <input class="form-control" type="date" name="fecha" placeholder="fecha" required="required">
                                
                            </div>
                            <div class="form-group">
                                <label for="">Cantidad</label>
                                <input min="0" step="any" class="form-control" type="number" name="Cantidad" placeholder="Cantidad" required="required">
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


        //evento de los botones

        $(document).ready(function(){
            //evento al cargar input



            $("#btnBuscar").click(function(e){

                e.preventDefault();
                var anexo =   $("#selAnexo").val();

                location.href='{{ URL::route('getAcopio') }}/'+anexo;

            });


        });

        $("#selRuta").change(function() {
            $("#selAnexo").empty();
            $.getJSON('{{ URL::route('getAnexos') }}/'+$("#selRuta").val(),function(data){
                console.log(JSON.stringify(data));
                $.each(data, function(pos,val){
                    $("#selAnexo").append("<option value=\""+val.id+"\">"+val.descripcion+"- "+pos+"</option>");
                });
            });
        });


        
        /*
        $('#btnGuardarAcopio').click(function(e){
            e.preventDefault();
            var url = "{{ URL::route('regAcopio') }}"; // El script a dónde se realizará la petición.
            $.ajax({
                type: "POST",
                url: url,
                data: $("#formulario").serialize(), // Adjuntar los campos del formulario enviado.
                success: function(data)
                {
                    alert(data); // Mostrar la respuestas del script PHP.
                }
            });

        });
        */

        $( "#formRegModal" ).submit(function( event ) {
          $('#btnGuardarAcopio').attr("disabled", true);
        });

        

        function regAcopio(id,name){
           $('#hdId ').val(id);

           $('#inProveedor').val(name);

            $('#newAcopio').modal('show');

        }

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

