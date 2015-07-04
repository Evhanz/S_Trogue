@extends('layout')

@section('content')


    <div class="ui grid" data-styl="block-seccion">

        <div class="sixteen wide column" style="background-color: #79A4D1;color: #ffffff">
            <h2>Módulo de Control y calidad</h2>
        </div>
        <div class="sixteen wide column" >
            @if(Session::has('confirm'))

                <div class="ui success message">
                    <div class="header">Perfecto!!</div>
                    <i class="fa fa-info-circle"></i>  <strong>{{ Session::get('confirm') }}</strong>
                </div>

            @endif

            @if(Session::has('fail'))
                    <div class="ui error message ">
                        <div class="header">Error!!</div>
                        <i class="fa fa-info-circle"></i>  <strong>{{ Session::get('fail') }}</strong>
                    </div>
            @endif
        </div>

        <div class="sixteen wide column">
            <div class="ui form">
                <div class="inline fields">
                    <div class="seven wide field">
                        <label for="">Ruta</label>
                        <select class="ui fluid search dropdown" name="ruta" id="selRuta">
                            <option value=" ">Ninguno</option>
                            @foreach($rutas as $ruta)
                                <option value="{{$ruta->id}}">{{$ruta->descripcion}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="three wide field">
                        <label for="">Anexo</label>
                        <select class="ui fluid search dropdown" name="anexos" id="selAnexo">
                            <option value=" ">Ninguno</option>
                        </select>
                    </div>
                    <div class="two wide field">
                        <button class="ui teal button" id="btnBuscar">
                            <i class="search icon"></i>
                            Buscar
                        </button>
                    </div>


                </div>
            </div>
        </div>


        <div class="sixteen wide column" data-styl="table">

            <table class="ui table" id="tableReq">
                <thead >
                <tr>
                    <th>Id</th>
                    <th>Nombre y Apellidos</th>
                    <th>Anexo</th>
                    <th>Ruta</th>
                    <th>Opciones</th>
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
                                <button class="ui blue button" name="regAcopio"
                                        onclick="regAcopio('{{ $proveedor->id }}','{{ $proveedor->fullname }}')">
                                    Registrar<i class="edit icon"></i>
                                </button>


                            </div>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            <div  id="paginador">
                <!--con el setPath arreglas el roblema con paginacion-->
                {!! $proveedores->setPath('')->render() !!}
            </div>



        </div>



        <div class="ui modal">
            <div class="header">Registrar Acopio</div>
            <div class="content">
                <p>

                <form class="ui form" id="formulario" action="{{ URL::route('regAcopio') }}"  method="post">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                    <h4 class="ui dividing header">Registrar Acopio</h4>
                    <div class="field">
                        <label>Proveeedor</label>
                        <input type="hidden" name="hdId" id="hdId"/>
                        <input type="text"  name="inProveedor" id="inProveedor" readonly/>
                    </div>
                    <div class="field">
                        <label>Datos</label>
                        <div class="two fields">
                            <div class="field">
                                <input type="date" name="fecha" placeholder="fecha" required="required">
                            </div>
                            <div class="field">
                                <input type="number" name="Cantidad" placeholder="Cantidad" required="required">
                            </div>
                        </div>
                    </div>

                    <button  class="ui teal button" tabindex="0" id="btnGuardarAcopio">Guardar</button>
                </form>


                </p>

            </div>
        </div>


    </div>


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

        function regAcopio(id,name){
           $('#hdId ').val(id);

           $('#inProveedor').val(name);

            $('.ui.modal').modal('show');

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

