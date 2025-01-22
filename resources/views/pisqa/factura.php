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
                <th> Cantidad </th>
                <th> Precio </th>
                <th> Total </th>
                <th> Acciones </th>
            </tr>
        </thead>
        <tbody><?php $total = 0; ?>
            @foreach($ventas as $venta)
                @if( $venta->cantidad > 0)
                    <tr>
                        <td> {{$venta->mesa}} </td>
                        <td> {{$venta->mesero}} </td>
                        <td> {{$venta->titulo}} </td>
                        <td> {{$venta->cantidad}} </td>
                        <td> {{$venta->precio}} </td>
                        <td> {{$venta->total}} </td>
                        <?php $total = $total  + $venta->total; ?>
                        <td> 
                            <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#pedidoModal" onclick="actualizarPedido('{{$venta->id_mesa}}', '{{$venta->id}}')" > <b><i class="fa fa-edit" ></i></b> </a>
                            <form action="{{ route('pisqa.destroy', ['id' => $venta->id, 'ruta' => 'factura']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="confirmDelete(event)"> <b><i class="fa fa-trash fa-6"></i></b> </button>
                            </form>
                            <script>
                                function confirmDelete(event) {
                                    if (confirm("¿Estás seguro de elimnar el pedido?")) {
                                        document.getElementById('deleteForm').submit();
                                    } else {
                                        event.preventDefault();
                                    }
                                }
                                function actualizarPedido(mesa, venta){
                                    $('#id_mesa').val(mesa);
                                    $('#id_venta').val(venta);
                                    $('#ruta').val('factura');
                                }
                            </script>
                        </td>
                    </tr>
                @endif
            @endforeach
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="4">TOTAL</td>
                    <td> {{$total}} </td>
                </tr>
        </tbody>
    </table>
</div>
@stop