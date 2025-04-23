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
                    <tbody>
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
                        <tr>
                            <td colspan="2"><b>Comentario:</b> {{$dato->comentario}}</td>
                            
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-md-7">
                <h3 >Clientes con Pagos Especiales</h3>
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th>Monto (Bs)</th>
                            <th>Adelante </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datos as $dato)
                            @if( $dato->adelanto_efectivo !="" && $dato->adelanto !="" )
                            <tr>
                                <td> {{ $dato->adelanto_efectivo }} </td>
                                <td> {{ $dato->adelanto }} </td>
                            </tr>
                            @endif
                        @endforeach
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