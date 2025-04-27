<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cierre Caja</title>
    <link href="{{asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
</head>
<body>
    <div class="container">

        <div class="row">
            <div class="col-md-4">
                <b> <a href="{{asset('index.php/reporteCierre')}}">PISQA WARMIS</a></b>
            </div>
            <div class="col-md-4">
                <b style="text-align:center; font-size:26px;">Arqueo de Caja</b>
            </div>
            <div class="col-md-4">
            </div>    
        </div>
        
        <hr>

        <div class="row">
            <div class="col-md-6">
                <p><strong>N° de Cierre:</strong> {{ $dato->id_cierre }}</p>
                <p><strong>Usuario:</strong> {{ $dato->cierre }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Fecha Cierra:</strong> {{  $datos[0]->updated_at }}</p>
                <p><strong>Fecha Impresion :</strong> {{ date('Y-m-d H:i:s') }}</p>
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Tipo de pago</th>
                            <th>Cantidad</th>
                            <th>Monto (Bs)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>EFECTIVO</td>
                            <td>{{$efectivo->cantidad}}</td>
                            <td>{{$efectivo->suma}}  Bs.</td>
                        </tr>
                        <tr>
                            <td>TARJETAS</td>
                            <td>{{$tarjeta->cantidad}}</td>
                            <td>{{$tarjeta->suma}} Bs.</td>
                        </tr>
                        <tr>
                            <td><strong>Total </strong></td>
                            <td><strong> {{ $efectivo->cantidad + $tarjeta->cantidad }} </strong></td>
                            <td><strong> {{ $tarjeta->suma + $efectivo->suma }}  Bs.</strong></td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered text-center">
                    <tbody><?php $total =0; ?>
                        @foreach($datos as $dato)
                        @if( $dato->registro_efectivo !=0 || $dato->registro_tarjeta !=0  )
                        <tr>
                            <td>EFECTIVO MANUAL</td>
                            <td>{{$dato->registro_efectivo}}  Bs.</td>
                        </tr>
                        <tr>
                            <td>TARJETAS MANUAL</td>
                            <td>{{$dato->registro_tarjeta}}  Bs.</td>
                        </tr>
                        <tr><?php $total =$dato->registro_efectivo + $dato->registro_tarjeta; ?>
                            <th> Total </th>
                            <th> {{$total}}</th>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align:left;">
                                @php
                                    // Dividir el comentario usando el separador ";"
                                    $comentarios = explode('|', $dato->comentario);
                                @endphp
                                {{-- Mostrar el primer comentario --}}
                                <b>Comentario:</b> {{ htmlspecialchars($comentarios[0] ?? 'No disponible') }}
                                <br/>
                                {{-- Mostrar el segundo comentario si existe, o "No disponible" si no existe --}}
                                <b>Rotatorio:</b> {{ htmlspecialchars($comentarios[1] ?? 'No disponible') }}
                            </td>
                        </tr>
                        @endif
                        @endforeach
                        
                    </tbody>
                </table>

            </div>
        </div>

        <div class="row">
            <div class="col-md-7">
                <h3 >Pagos Especiales/Adelantos</h3>
                <table border="1" style="width:100%">
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Monto (Bs)</th>
                            <th>Comentario </th>
                        </tr>
                    </thead>
                    <tbody><?php $total=0;?>
                        @foreach ($datos as $dato)
                            @if( $dato->adelanto_efectivo !="" && $dato->adelanto !="" )
                            <tr>
                                <td> Adelanto </td>
                                <td> {{ $dato->adelanto_efectivo }} Bs. </td>
                                <td> {{ $dato->adelanto }} </td>
                            </tr><?php $total = $total + $dato->adelanto_efectivo; ?>
                            @endif
                        @endforeach
                        <tr>
                            <th>Total</th>
                            <th>{{$total}}</th>
                            <th></th>
                        </tr><?php $total=0;?>
                        @foreach ($datos as $dato)
                            @if( $dato->tipo_pago == "Sin pago")
                            <tr>
                                <td> Especial </td>
                                <td> {{ $dato->total }} Bs. </td>
                                <td> {{ $dato->cliente }} </td>
                            </tr><?php $total = $total + $dato->total; ?>
                            @endif
                        @endforeach
                        <tr>
                            <th>Total</th>
                            <th>{{$total}}</th>
                            <th></th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                &nbsp;
            </div>
        </div>
    </div>
</body>
</html>