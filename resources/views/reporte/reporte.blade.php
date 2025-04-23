<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Reporte de Ventas</h1>
    <p><strong>Fecha de inicio:</strong> {{ $fechaInicio }}</p>
    <p><strong>Fecha final:</strong> {{ $fechaFinal }}</p>

    <table>
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
                        <td>{{ $venta->fecha_pago }}</td>
                        <td>{{ $venta->cajero }}</td>
                        <td>{{ $venta->total }}</td>
                        <td>{{ $venta->tipo_pago }}</td>
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
                        <table>
                        @foreach($datos as $dato)
                            @if( $venta->id == $dato->id_venta)
                            <tr>
                                <td> {{$dato->tipo_comanda}} </td>
                                <td> {{$dato->titulo}} </td>
                                <td> {{$dato->cantidad}} </td>
                                <td> {{$dato->precio}} </td>
                                <td> {{$dato->total}} </td>
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
                        <td>{{ $venta->fecha_pago }}</td>
                        <td>{{ $venta->cajero }}</td>
                        <td>{{ $venta->total }}</td>
                        <td>{{ $venta->tipo_pago }}</td>
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
                    <?php $total += $venta->total ; ?>
                @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6">Total</th>
                <th colspan="4">{{ $total }} Bs.</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
