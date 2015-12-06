@extends('lreportes')

@section('content')
    <h1 id="titleRep">Reportes de Prestamo</h1>
    <hr/>

    <div class="row">

        <div class="col-lg-12">
            <h2>Proveedor:</h2>
            <h4><strong>{{$prestamo->proveedor->fullname}}</strong></h4>
        </div>
        <div class="col-lg-12">

            Prestamo:

        </div>

        <table class="pure-table pure-table-bordered"  data-tabl="modServicio">

            <thead>
                <tr>
                    <th>Descripcion</th>
                    <th>Cantidad</th>
                    <th>Estado</th>
                    <th>Tasa</th>
                    <th>Interes Quincenal</th>
                    <th>N° Letras</th>
                </tr>

            </thead>

            <tbody>

                <tr>
                    <td>{{$prestamo->descripcion}}</td>
                    <td>{{$prestamo->cantidad}}</td>
                    <td>{{$prestamo->estado}}</td>
                    <td>{{$prestamo->tasa}}</td>
                    <td>{{$prestamo->interes}}</td>
                    <td>{{$prestamo->n_letras}}</td>
                </tr>

            </tbody>

        </table>

        <br/>

        <section style="background-color: #0f7694;color: white;width: 100%">
            Detalle de Letras
        </section>
        <br/>

        <table class="pure-table pure-table-bordered"  data-tabl="modServicio">

            <thead>
            <tr>
                <th>Monto Inicial</th>
                <th>Fecha Vencimiento</th>
                <th>Estado</th>
                <th>interes</th>
                <th>N° Letra</th>
                <th>Dia de Pago</th>
            </tr>

            </thead>

            <tbody>

                @foreach($prestamo->letras as $letra)

                <tr>
                    <td>{{$letra->monto_inicial}}</td>
                    <td>{{$letra->fecha_vencimiento}}</td>
                    <td>{{$letra->estado}}</td>
                    <td>{{$letra->interes}}</td>
                    <td>{{$letra->n_letra}}</td>
                    @if($letra->estado == 1)
                        @foreach($letra->pago_letra as $pago)
                            <td>{{$pago->fecha_pago}}</td>
                        @endforeach
                    @else
                        <td> - </td>
                    @endif

                </tr>

                @endforeach

            </tbody>

        </table>











    </div>



@stop