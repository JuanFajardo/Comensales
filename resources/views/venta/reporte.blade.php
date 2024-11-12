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
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
                <th>Mesa</th>
                <th>Mesero </th>
                <th>Cliente </th>
            </tr>
        </thead>
        <tbody><?php $total=0;?>
            @foreach($ventas as $venta)
            <tr><?php $total=$total + $venta->total; ?>
                <td>{{ $venta->fecha_pago }}</td>
                <td>{{ $venta->cajero_nombre }}</td>
                <td>{{ $venta->id_venta }}</td>
                <td>{{ $venta->titulo }}</td>
                <td>{{ $venta->cantidad }}</td>
                <td>{{ $venta->precio }}</td>
                <td>{{ $venta->total }}  Bs.</td>
                <td>{{ $venta->mesa }}</td>
                <td>{{ $venta->mesero }}</td>
                <td>{{ $venta->cliente }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>    
                <th colspan="6">Total</th>
                
                <th colspan="4">{{$total}} Bs.</th>
                
            </tr>
        </tfoot>
    </table>
</body>
</html>
