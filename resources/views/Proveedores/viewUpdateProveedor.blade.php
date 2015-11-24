@extends('layout')

@section('content-header')
    
    <div style="padding: 5px ;">
        <div class="bs-callout bs-callout-info" id="callout-type-dl-truncate">
            <h4>Módulo del Proveedores </h4>
        </div>
    </div>
@stop

@section('content')

    <div class="content">
        <div class="row"><!--Mesaje de errores-->
            @if(isset($errors))
                @if (count($errors) > 0)
                    <div id="alert-result" class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4>Error!!</h4>
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
            @endif
        </div><!--/ end error messages -->
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                        </div><!-- /. tools -->
                        <i class="fa fa-cloud"></i>

                        <h3 class="box-title">Formulario de Update</h3>

                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        <form class="ui form" id="formulario" action="{{ URL::route('updateDataProveedor') }}" method="post">
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                            <input type="hidden" name="id" value="{{ $proveedor->id}}" />
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Nombres:</label>
                                    <input class="form-control" type="text" value="{{ $proveedor->name}}" name="name" placeholder="Nombre">
                                </div>
                                <div class="col-lg-4">
                                    <label>Apellido Paterno:</label>
                                    <input class="form-control" type="text" value="{{ $proveedor->apellidoP}}" name="apellidoP" ng-model="proveedor.apellidoP" placeholder="Apellido Paterno">
                                    
                                </div>
                                <div class="col-lg-4">
                                    <label for="">Apellido Materno:</label>
                                    <input class="form-control" type="text" value="{{ $proveedor->apellidoM}}" name="apellidoM" ng-model="proveedor.apellidoM" placeholder="Apellido Materno">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="">DNI:</label>
                                    <input class="form-control" type="text" value="{{ $proveedor->dni}}" name="dni" placeholder="DNI">
                                </div>
                                <div class="col-lg-4">
                                    <label for="">Celular:</label>
                                    <input class="form-control" type="text"value="{{ $proveedor->celular}}" name="celular" placeholder="Celular">
                                </div>
                                <div class="col-lg-4">
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="">Ruta</label>
                                    <select class="form-control" name="ruta" id="selRuta">
                                        <option value=" ">Ninguno</option>
                                        @foreach($rutas as $ruta)
                                        <option value="{{$ruta->id}}">{{$ruta->descripcion}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label for="">Anexo</label>
                                    <select class="form-control" name="anexos" id="selAnexo">
                                        <option value=" ">Ninguno</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <br>
                                    <button class="btn btn-success" id="btnGuardar" >
                                        <i class="save icon"></i>
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!--/.box -->
            </div><!--col-lg-12-->
        </div><!--/row form-->

        <div class="row">
          
        </div>

    </div><!--/.cotent-->

<!-- Bootstrap -->
<script src="{{ asset('js/plugins/angular/angular.min.js')}}" type="text/javascript"></script>

<script>

    var idRuta = "{{$proveedor->anexo->ruta_id}}";
    var idAnexo = "{{$proveedor->anexo->id}}"

    $("#selRuta").val(idRuta);

    $.getJSON('{{ URL::route('getAnexos') }}/'+idRuta,function(data){
                console.log(JSON.stringify(data));
                $.each(data, function(pos,val){
                    $("#selAnexo").append("<option value=\""+val.id+"\">"+val.descripcion+"- "+pos+"</option>");
                });
                $("#selAnexo").val(idAnexo);

    });

    

    /*cuando cambie el select hace esto*/
     $("#selRuta").change(function() {
            $("#selAnexo").empty();
            $.getJSON('{{ URL::route('getAnexos') }}/'+$("#selRuta").val(),function(data){
                console.log(JSON.stringify(data));
                $.each(data, function(pos,val){
                    $("#selAnexo").append("<option value=\""+val.id+"\">"+val.descripcion+"- "+pos+"</option>");
                });
            });
        });


</script>

@stop

