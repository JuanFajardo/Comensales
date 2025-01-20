@extends('warmis')

@section('titulo')
<a href="{{asset('index.php/PhisqaWarmis')}}"> Phisqa Warmis </a>

@stop

@section('fondo')
{{ asset('assets/imgs/style-5.png') }}
@stop

@section('logo')
<center><img src="{{asset('assets/imgs/logo.png')}}" alt="centered image" height="400" width="600"> </center>
@stop

@section('cuerpo')
<div class="row">
    <table class="table" style="color:white;">
        <thead>
            <tr>
                <th> Mesa </th>
                <th> Mesero </th>
                <th> Producto </th>
                <th> Cantidad/ Precio </th>
                <th> Total </th>
            </tr>
        </thead>
        <tbody><?php $total = 0; ?>
            
            @foreach($ventas as $venta)
                @if( $venta->cantidad > 0)
                <tr>
                    <td> {{$venta->mesa}} </td>
                    <td> 
                        {{$venta->mesero}} <br>
                        @if  ($venta->tipo_pedido == "mesa")
                        <small class="badge badge-warning"><b>{{$venta->tipo_pedido}}</b></small>
                        @else
                        <small class="badge badge-secondary"><b>{{$venta->tipo_pedido}}</b></small>
                        @endif
                    </td>
                    <td> {{$venta->titulo}} <br> <small class="badge badge-info"><b>{{$venta->comentario_pedido}}</b></small></td>
                    <td> {{$venta->cantidad}} Cant.  {{$venta->precio}} Bs. </td>
                    <td> {{$venta->total}} Bs. </td>
                    <?php $total = $total  + $venta->total; ?>
                    
                </tr>
                @endif
            @endforeach
            
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="3">TOTAL</td>
                    <td> {{$total}} </td>
                </tr>
        </tbody>
    </table>
</div>
@stop