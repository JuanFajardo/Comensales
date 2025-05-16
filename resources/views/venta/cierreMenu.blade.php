@php
$config = \App\Models\Config::first(); // Asume que solo hay un registro
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Venta por Rubros</title>
    <link href="{{asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <style>
        * {
            font-size:9px;
        }
    </style>
</head>
<body>
    <div class="container">

        <div class="row" >
            <div class="col-md-3">
                <p style="font-size:14px;"><strong>N° de Cierre:</strong> {{ $info->id_cierre }}</p>
            </div>
            <div class="col-md-6">
                <b style="font-size:14px;">Venta por Rubros</b>
            </div>
            <div class="col-md-3">
                <b style="font-size:14px;"> <a href="{{asset('index.php/reporteCierre')}}">{{ strtoupper($config->titulo) }}</a></b>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <p><strong>Usuario:</strong> {{ $info->cierre }}</p>
            </div>
            <div class="col-md-4">
                <p><strong>Fecha Cierra:</strong> {{  $info->updated_at }}</p>
            </div>
            <div class="col-md-4">
                <p><strong>Fecha Impresion :</strong> {{ date('Y-m-d H:i:s') }}</p>
            </div>
        </div>

        @if( isset($_GET['detalle']))
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Rubro</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sumaTotal = $contTotal = 0; ?>
                        @foreach($datos as $dato)
                        <tr>
                            <td>    {{$dato->menu}} </td>
                            <?php $cant=$total=0;?>
                                @foreach($detalles as $detalle)
                                    @if($dato->id_menu == $detalle->id_menu && $detalle->cantidad > 0)
                                     <?php 
                                        $cant=$cant + $detalle->cantidad;
                                        $total = $total + $detalle->total;
                                        $sumaTotal = $sumaTotal + $detalle->total;
                                        $contTotal = $contTotal + $detalle->cantidad;
                                     ?>
                                    @endif
                                @endforeach
                            <td> {{$cant}} 
                            </td>
                            <td style="text-align:right;"> {{$total}} Bs. </td>
                        </tr>
                        @endforeach
                        <tr>  
                            <td></td>
                            <th> {{$contTotal}}</th>
                            <td>
                                <div style="text-align:right;"> <b> {{$sumaTotal}} Bs. Resumen </b>  </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-md-12">
                <table border="1">
                    <tbody><?php $sumaTotal=0;?>
                        @foreach($datos as $dato)
                        <tr>
                            <th>{{$dato->menu}} </th>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <table border="0" width="100%">
                                    <?php $cant=$total=0;?>
                                @foreach($detalles as $detalle)
                                    @if($dato->id_menu == $detalle->id_menu && $detalle->cantidad > 0)
                                     <tr>
                                        <td style="text-align:center;">{{$detalle->cantidad}}</td>
                                        <td>{{strtoupper($detalle->titulo)}}</td>
                                        <td style="text-align:right;">{{$detalle->total}}  Bs.</td>
                                    </tr><?php $cant=$cant + $detalle->cantidad; $total = $total + $detalle->total; $sumaTotal=$sumaTotal+$detalle->total;?>
                                    @endif
                                @endforeach
                                    <tr>
                                        <th> {{$cant}} </th>
                                        <th> </th>
                                        <th style="text-align:right;"> {{$total}} Bs. </th>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        @endforeach
                        <tr>  
                            <td>
                                <div style="text-align:center;"> <b> {{$sumaTotal}} Bs.  Detallado </b>  </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @endif
</div>