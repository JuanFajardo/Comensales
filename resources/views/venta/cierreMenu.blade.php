<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Venta por Rubros</title>
    <link href="{{asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
</head>
<body>
    <div class="container">

        <div class="row">
            <div class="col-md-4">
                <b> <a href="{{asset('index.php/reporteCierre')}}">PISQA WARMIS</a></b>
            </div>
            <div class="col-md-4">
                <b style="text-align:center; font-size:26px;">Venta por Rubros</b>
            </div>
            <div class="col-md-4">
            </div>    
        </div>
        <div class="row">
            <div class="col-md-6">
                <p><strong>N° de Cierre:</strong> {{ $lista[0]->id_cierre }}</p>
                <p><strong>Usuario:</strong> {{ $lista[0]->cierre }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Fecha Cierra:</strong> {{  $lista[0]->updated_at }}</p>
                <p><strong>Fecha Impresion :</strong> {{ date('Y-m-d H:i:s') }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table border="1">
                    <tbody>
                        @foreach($datos as $dato)
                        <tr>
                            <th>{{$dato->menu}}</th>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <table border="0" width="100%">
                                    <?php $cant=$total=0;?>
                                @foreach($detalles as $detalle)
                                    @if($dato->id_menu == $detalle->id_menu)
                                     <tr>
                                        <td style="text-align:center;">{{$detalle->cantidad}}</td>
                                        <td>{{strtoupper($detalle->titulo)}}</td>
                                        <td style="text-align:right;">{{$detalle->total}}  Bs.</td>
                                    </tr><?php $cant=$cant + $detalle->cantidad; $total = $total + $detalle->total;?>
                                    @endif
                                @endforeach
                                    <tr>
                                        <th> {{$cant}} </th>
                                        <th></th>
                                        <th style="text-align:right;"> {{$total}} Bs. </th>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                </div>
</div>