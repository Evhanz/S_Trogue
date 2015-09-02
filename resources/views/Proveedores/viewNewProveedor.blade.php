@extends('layout.blade-bucks.php')

@section('content')


    <div class="ui " data-styl="block-seccion">

        <div class="sixteen wide column" style="background-color: #FC6C6C;color: #ffffff">
            <h2>Módulo de Proveedores</h2>
        </div>
        @if(isset($errors))
        @if (count($errors) > 0)
            <div class="ui error message">
                <div class="header">Error</div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @endif


        <form class="ui form" id="formulario" action="{{ URL::route('regProveedor') }}" method="post">
            <h4 class="ui dividing header"></h4>
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <div class="field">
                <label>Name</label>
                <div class="three fields">
                    <div class="field">
                        <input type="text" id="txtName" name="name" placeholder="Nombre">
                    </div>
                    <div class="field">
                        <input type="text" name="apellidoP" id="txtApelidop" placeholder="Apellido Paterno">
                    </div>
                    <div class="field">
                        <input type="text" name="apellidoM" id="txtApelidom" placeholder="Apellido Materno">
                    </div>
                </div>
            </div>


            <div class="field">
                <label>Datos de Ubicacion</label>
                <div class="two fields">
                    <div class=" field">
                        <input type="text" id="txtDni" name="dni" placeholder="DNI">
                    </div>
                    <div class=" field">
                        <input type="text" id="txtCelular" name="celular" placeholder="Celular">
                    </div>
                </div>
            </div>

            <div class="field">

                <div class="two fields">

                    <div class="field">
                        <label for="">Ruta</label>
                        <select class="ui fluid search dropdown" name="ruta" id="selRuta">
                            <option value=" ">Ninguno</option>
                        @foreach($rutas as $ruta)
                                <option value="{{$ruta->id}}">{{$ruta->descripcion}}</option>
                        @endforeach
                        </select>



                    </div>
                    <div class="field">
                        <label for="">Anexo</label>
                        <select class="ui fluid search dropdown" name="anexos" id="selAnexo">
                            <option value=" ">Ninguno</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="field">
                <button class="ui teal button" id="btnGuardar" >
                    <i class="save icon"></i>
                    Guardar
                </button>
            </div>
        </form>





    </div>





    <script>

        //llamamos a los metodos

        $("#selRuta").change(function() {
            $("#selAnexo").empty();
            $.getJSON('{{ URL::route('getAnexos') }}/'+$("#selRuta").val(),function(data){
                console.log(JSON.stringify(data));
                $.each(data, function(pos,val){
                    $("#selAnexo").append("<option value=\""+val.id+"\">"+val.descripcion+"- "+pos+"</option>");
                });
            });
        });

        $(document).ready(function(){

            $('btnBuscar').click(function(e){
                e.preventDefault();


            });

        });


    </script>



           





@stop

