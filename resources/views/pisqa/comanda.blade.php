<div width="200px">
    <div style="text-align: center; font-family: Calibri; font-size:10px;">
    PHISQA CAFE PUB RESTAURANTE<br>
    CONSUMO  Nro. <br>
    --------------------------
    </div>
    <div style="text-align: left;">
    <table style="font-family: Calibri; font-size:10px;">
        <tr>
            <td>Fecha: {{ date('d/m/Y') }}</td>
            <td>Mesa: {{$mesa->codigo}}</td>
        </tr>
        <tr>
            <td>Hora: {{date('H:i')}}</td>
            <td>Cliente: {{$mesa->cliente}}</td>
        </tr>
    </table>
    --------------------------
    <table style="font-family: Calibri; font-size:10px;">
        <tr>
            <th>Descripcion</th>
            <th>Cant.</th>
            <th>P.U.</th>
            <th>Importe</th>
        </tr><?php $total=0; ?>
        @foreach($ventas as $venta)
        <tr><?php $total= $total + $venta->precio; ?>
            <td>{{ strtoupper( $venta->titulo) }}</td>
            <td>{{$venta->cantidad}}</td>
            <td>{{$venta->precio}}</td>
            <td>{{$venta->total}}</td>
        </tr>
        @endforeach
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="2">
                TOTAL Bs. {{$total}}
            </td>
        </tr>    
        
    </table>
    </div>
    --------------------------
    <div style="text-align: center; font-family: Calibri; font-size:10px;">
    NO VALIDO PARA CREDITO FISCAL<br>
    PHISQA CAFE PUB RESTAURANTE<br>
    AGRADECE SU PREFERENCIA!
    </div>
</div>