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
