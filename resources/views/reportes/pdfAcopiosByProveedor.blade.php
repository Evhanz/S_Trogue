@extends('lreportes')

@section('content')
    <h1 id="titleRep">Reportes Acopio por Proveedor y Fechas</h1>
    <hr/>

    <div class="row">

        <div class="col-lg-12">
            <h2>Proveedor:</h2>
            <h5><strong>{{$proveedor->fullname}}</strong></h5>
        </div>
        <div class="col-lg-12">

            Acopios:

        </div>

        <div id="tablaAcopio">

            <table class="pure-table pure-table-bordered"  data-tabl="modServicio">

                    <?php

                            if(count($acopios)<8){
                                $valor=0;
                            }else{
                            $valor =  count($acopios)/8;}

                            $valor =  intval($valor);
                            $last = count($acopios)%8;
                    ?>

                    <tbody>

                    @for($i=0;$i<=$valor;$i++)

                    <tr>
                        @if($i==$valor)
                            @for($a=($i*8);$a<count($acopios);$a++)
                                <td>
                                    <strong>Fecha</strong><br/>
                                    <span >{{ $acopios[$a]->feha}}</span> <br/>
                                    <strong>Cantidad</strong>
                                    <span >{{ $acopios[$a]->cantidad_total}}</span>
                                </td>
                            @endfor
                         @else
                            @for($a=($i*8);$a<($i+1)*8;$a++)
                                <td>
                                    <strong>Fecha</strong><br/>
                                    <span >{{ $acopios[$a]->feha}}</span> <br/>
                                    <strong>Cantidad</strong>
                                    <span >{{ $acopios[$a]->cantidad_total}}</span>
                                </td>
                            @endfor


                        @endif

                    </tr>
                    @endfor

                    </tbody>
                </table>

       </div>

    </div>


@stop