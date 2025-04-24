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
        
        <hr>

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

        <hr>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <th>Menu</th>
                            <th>Cantidad</th>
                            <th>Monto (Bs)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datos as $dato)
                        <tr>
                            <td>{{$dato->menu}}</td>
                            <td>{{$dato->contador}}</td>
                            <td>{{$dato->total}}  Bs.</td>
                        </tr>
                        <tr><td></td>
                            <td colspan="2">
                                <table border="1">
                                @foreach($detalles as $detalle)
                                    @if($dato->id_menu == $detalle->id_menu)
                                     <tr>
                                        <td>{{strtoupper($detalle->titulo)}}</td>
                                        <td>{{$detalle->cantidad}} Cant.</td>
                                        <td>{{$detalle->total}}  Bs.</td>
                                    </tr>
                                    @endif
                                @endforeach
                                </table>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                </div>
</div>