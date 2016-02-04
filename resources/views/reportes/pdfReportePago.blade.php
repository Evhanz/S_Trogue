@extends('lreportes')

@section('content')

    <section class="titulo-pago">
        <strong>TROGE </strong><br/>
    </section>

    <section class="detalle-pago">
        <div class="proveedor">
            <strong>Proveedor:</strong>{{$proveedor->fullname}}
        </div>
        <div class="fecha-pago">

            {{ $pago->quincena }}

        </div>
    </section>


    <div id="tablaAcopio">
        <table class="pure-table pure-table-bordered"  data-tabl="modServicio">
        <?php
            if(count($acopios)<8){
                $valor=0;
            }else{
                $valor =  count($acopios)/8;
            }
            $valor =  intval($valor);
            $last = count($acopios)%8;
            ?>
            <tbody>
            @for($i=0;$i<=$valor;$i++)
            <tr>
                @if($i==$valor)
                    @for($a=($i*8);$a<count($acopios);$a++)
                    <td >
                        <div class="results">
                            <span class="fecha">{{ $acopios[$a]->feha}}</span> <br/>
                            <span  class="cantidad">{{ $acopios[$a]->cantidad_total}}</span>
                        </div>

                    </td>
                     @endfor
                @else
                @for($a=($i*8);$a<($i+1)*8;$a++)
                    <td >
                        <div class="results">
                            <span class="fecha">{{ $acopios[$a]->feha}}</span> <br/>
                            <span  class="cantidad">{{ $acopios[$a]->cantidad_total}}</span>
                        </div>
                    </td>
                @endfor
                @endif
            </tr>
            @endfor
            </tbody>
        </table>
    </div>

    <div class="resultado">

        <strong>Total KG</strong>
        <input value="{{$suma}}" type="text"/>
        <strong>Precio-Litro</strong>
        <input value="S/. {{ $pago->precio_litro }}" type="text"/>
        <strong>Pago Total</strong>
        <input value="S/. {{ $suma*$pago->precio_litro }}" type="text">

    </div>

    <section class="computable">

        <div class="descuentos">

            <h3>Descuentos</h3>

            <table id="detail-descuento">
                <thead>
                <tr>
                    <th>Descripcion</th>
                    <th>Monto</th>
                </tr>
                </thead>
                <tbody>

                @foreach($pago->pago_letra as $item)
                    <tr>
                        <td>{{$item->letra->prestamo->descripcion}}, Letra :{{$item->letra->n_letra}}</td>
                        <td>S/. {{$item->monto_pagado}}</td>
                    </tr>
                @endforeach

                @foreach($pago->pago_venta_tercero as $item)
                    <tr>
                        <td>{{$item->venta_tercero->origen->descripcion}}, Fecha:{{$item->venta_tercero->fecha}} </td>
                        <td>S/.{{$item->monto_pagado}}</td>
                    </tr>
                @endforeach

                    <tr>
                        <td>Total Descontado</td>
                        <td>S/. {{$pago->total_descontado}}</td>
                    </tr>

                </tbody>
            </table>


        </div>
        <div class="neto">

            Neto a Pagar: <br/>
            <span id="neto-pagar">

                S/. {{$pago->pago_total}}
            </span>

        </div>


    </section>




@stop