@php
$config = \App\Models\Config::first(); // Asume que solo hay un registro
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$config->titulo}}- Reporte de Ventas</title>
    <link href="http://127.0.0.1/pisqa/es/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="row" >
        <div class="col-md-4">
            <p><strong>Fecha Impresion:</strong> {{ date('Y-m-d H:i:s') }} </p>
        </div>
        <div class="col-md-4">
            <b style="font-size:18px;">Reporte de Ventas </b>
        </div>
        <div class="col-md-4">
            <b> <a href="{{asset('index.php/reporte')}}"> {{ strtoupper($config->titulo) }} </a></b>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <p><strong>Usuario:</strong> {{ \Auth()->user()->name }}</p>
        </div>
        <div class="col-md-4">
            <p><strong>Fecha Inicio:</strong> {{ $fechaInicio }}</p>
        </div>
        <div class="col-md-4">
            <p><strong>Fecha Fin:</strong> {{ $fechaFinal }}</p>
        </div>
    </div>



    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Cajero</th>
                <th>Venta</th>
                <th>Tipo</th>

                <th>Caja</th>
                <th>Adelanto</th>
                <th>Comentario</th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0; ?>
            @if($tipo == 1)
                @foreach($ventas as $venta)
                    <tr>
                        <td>{{ $venta->fecha_pago }}
                            <br> Cierre {{ $venta->id_cierre }} 
                        </td>
                        <td>{{ $venta->cajero }} </td>
                        <td>{{ $venta->total }} Bs.</td>
                        <td> <b>{{ $venta->tipo_pago }}</b> </td>
                        <td> @if( $venta->registro ) 
                            Efectivo: {{ $venta->registro_efectivo }}
                            <br>
                            Tarjeta: {{ $venta->registro_tarjeta }}
                            @endif
                        </td>
                        <td> @if( $venta->registro ) 
                                {{ $venta->adelanto_efectivo }} Bs. <br><small>{{ $venta->adelanto }}</small>
                            @endif
                        </td>
                        <td>{{ $venta->comentario }}</td>
                    </tr>
                    <tr><td colspan="1"></td>
                        <td colspan="6">
                        <table border="1">
                        @foreach($datos as $dato)
                            @if( $venta->id == $dato->id_venta)
                            <tr>
                                <td> <b> {{$dato->id_venta}} </b> {{$dato->tipo_comanda}}  </td>
                                <td> {{$dato->titulo}} </td>
                                <td> {{$dato->cantidad}} Cant.</td>
                                <td> {{$dato->precio}} Bs. </td>
                                <td> {{$dato->total}} Bs. </td>
                                <td> {{$dato->mesa}} </td>
                                <td> {{$dato->mesero}} </td>
                            </tr>
                            @endif
                        @endforeach
                        </table>
                        </td>
                    </tr>
                    <?php $total += $venta->total ; ?>
                @endforeach
            @else
                @foreach($ventas as $venta)
                    <tr>
                        <td>{{ $venta->fecha_pago }} 
                            <br> Cierre {{ $venta->id_cierre }} 
                        </td>
                        <td>{{ $venta->cajero }} <br> Cierre: {{ $venta->id_cierre }}  </td>
                        <td>{{ $venta->total }} Bs.</td>
                        <td> <b>{{ $venta->tipo_pago }}</b> </td>
                        <td> @if( $venta->registro ) 
                            Efectivo: {{ $venta->registro_efectivo }}
                            <br>
                            Tarjeta: {{ $venta->registro_tarjeta }}
                            @endif
                        </td>
                        <td> @if( $venta->registro ) 
                                {{ $venta->adelanto_efectivo }} Bs. <br><small>{{ $venta->adelanto }}</small>
                            @endif
                        </td>
                        <td>{{ $venta->comentario }}
                        </td>
                        
                    </tr>
                    <?php $total += $venta->total ; ?>
                @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6">Total</th>
                <th colspan="4">{{ $total }} Bs. </th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
