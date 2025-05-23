@php
$config = \App\Models\Config::first();
@endphp

<!DOCTYPE html>
<html>
<head>
    <title>PISQA</title>
    <style>
        body {
            font-family: Calibri, sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }
        .ticket {
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
            {{$config->titulo}} PUB RESTAURANTE<br>
            <b>{{ strtoupper($comanda) }}</b>
        </div>
        <div>
            <table>
                <tr>
                    <td>Fecha: {{ date('d/m/Y') }}</td>
                    <td> {{ $mesa->mesa }} - {{ $mesa->descripcion }} </td>
                </tr>
                <tr>
                    <td>Hora: {{ date('H:i') }}</td>
                    <td>Cliente: {{ $mesa->cliente }}</td>
                </tr>
            </table>
            <div class="separator"></div>
        </div>
        <div>
            <table border="0">
                <tr>
                    <th>Descripcion</th>
                    <th>Cant.</th>
                    <th>P.U.</th>
                    <th>Importe</th>
                </tr>
                <?php $total = 0; ?>
                @foreach($ventas as $venta)
                    @if($venta->cantidad > 0 && $venta->eliminacion_comentario == "")
                        <tr>
                            <?php $total += $venta->total; ?>
                            <td>{{ strtoupper($venta->titulo) }}<br>
                                    {{ explode(' ', $venta->created_at)[1] }}
                            </td>
                            <td>{{ $venta->cantidad }}</td>
                            <td>{{ $venta->precio }}</td>
                            <td>{{ $venta->total }}</td>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <td colspan="3" class="total">TOTAL Bs.</td>
                    <td class="total">{{ $total }}</td>
                </tr>
            </table>
            
        </div>
        <div class="center">
            <br/><br/>
            Gracias por su visita!
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>
</html>