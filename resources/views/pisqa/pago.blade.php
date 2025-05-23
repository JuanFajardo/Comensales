<!DOCTYPE html>
<html>
<head>
    <title>Comprobante de Pago</title>
    <style>
        body {
            font-family: Calibri, sans-serif;
            font-size: 13px;
            margin: 0;
            padding: 0;
        }
        .ticket {
            width: 100%;
            margin: 0 auto;
            padding: 5px;
            box-sizing: border-box;
        }
        .ticket table {
            width: 100%;
            border-collapse: collapse;
        }
        .ticket th, .ticket td {
            padding: 2px;
            text-align: left;
        }
        .ticket th {
            font-weight: bold;
        }
        .ticket .total {
            text-align: right;
            font-weight: bold;
        }
        .ticket .center {
            text-align: center;
        }
        .ticket .separator {
            border-top: 1px dashed #000;
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="center">
            PHISQA CAFE PUB RESTAURANTE<br>
            <b>Pago Nro. {{ $venta->id }}</b><br>
            <div class="separator"></div>
        </div>
        <div>
            <table>
                <tr>
                    <td>Fecha: {{ date('d/m/Y') }}</td>
                    <td>{{ $mesa->mesa }} - {{ $mesa->descripcion }}</td>
                </tr>
                <tr>
                    <td>Hora: {{ date('H:i') }}</td>
                    <td>Cliente: {{ $clientePago }}</td>
                </tr>
            </table>
            <div class="separator"></div>
        </div>
        <div>
            <table>
                <tr>
                    <th>Descripcion</th>
                    <th>Cant.</th>
                    <th>P.U.</th>
                    <th>Importe</th>
                </tr>
                <?php $total = 0; ?>
                @foreach($ventas as $venta)
                    <tr>
                        <?php $total += $venta->total; ?>
                        <td>{{ strtoupper($venta->titulo) }}</td>
                        <td>{{ $venta->cantidad }}</td>
                        <td>{{ $venta->precio }}</td>
                        <td>{{ $venta->total }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="total">TOTAL Bs.</td>
                    <td class="total">{{ $total }}</td>
                </tr>
            </table>
        </div>
        <div class="center">
            <br>
            <b>Servicio Pagado</b><br>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>
</html>