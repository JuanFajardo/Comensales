@extends('pisqa')

@section('cambiomesa')
<!-- Cambiar datos mesa -->
<div class="modal fade" id="mesaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Cambiar datos mesa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                <form autocomplete="off" action="{{ route('mesas.cambiodato', $mesa->id) }}" method="POST" >
                                    @csrf
                                    @method('PUT')
                                    <div class="team-wrapper text-center">
                                        <div class="form-group">
                                            <label for="s">Cliente:</label>
                                            <select name="cliente" id="cliente" class="form-control">
                                                @foreach($clientes as $cliente)
                                                    <option value="{{$cliente->id}};{{$cliente->cliente}}"> {{$cliente->cliente}}, {{$cliente->nit}}  </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleSelect1">Cantidad de comenzales:</label>
                                            <input type="text" class="form-control" name="cantidad" id="cantidad" value="{{$mesa->cantidad_comensales}}">
                                            <input type="hidden" name="id_mesa" id="id_mesa" value="{{$mesa->id}}">
                                            <button type="submit" class="btn btn-warning"> Actualizar</button>
                                        </div>
                                    </div>
                                    
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@stop

@section('cuerpo')
<div class="page-title">
    <div>
        <h3> <b>{{$mesa->mesa}}:</b> {{$mesa->descripcion}} 
                <b>Cliente:</b> {{$mesa->cliente}}
                <b> # Comenzales: </b> {{$mesa->cantidad_comensales}}
        </h3>

    </div>    
</div>


<div class="row">
    <div class="col" style="padding:10px; background-color:#E7E7E7;  -webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;">

        <div class="container">
            <div class="row">

                <div class="col-md-6">
                    <label for="mesa">Opciones:</label><br>
                    <a href="{{asset('index.php/mesas')}}" class="btn btn-success"> <b><i class="fa fa-backward"></i></b> </a>
                    <a href="" class="btn btn-warning"  data-toggle="modal" data-target="#mesaModal" > <b><i class="fa fa-edit" ></i> Cliente / Comenzales </b> </a>

                    <!-- <a href="{{asset('index.php/Phisqa/comanda/'.$mesa->id.';'.$mesa->ocupado)}}" target="_blank" class="btn btn-success" > <b><i class="fa fa-file" ></i> Comanda</b> </a> -->
                    <a href="{{asset('index.php/Phisqa/comanda/'.$mesa->id)}}" target="_blank" class="btn btn-success" > <b><i class="fa fa-file" ></i> Comanda</b> </a>

                    
                    <script>
                        function confirmarAccion() {
                            return confirm('¿Estás seguro de que deseas continuar con el pago?');
                        }
                    </script>
                </div>

                <div class="col-md-6">
                    <div class="row">
                    <form action="{{ route('mesas.cambio', $mesa->id) }}" method="POST">
                        <div class="col-md-6">    
                            @csrf
                            @method('PUT')
                            <label for="mesa">Cambiar mesa:</label>
                            <select name="mesa" id="mesa" class="form-control">
                                @foreach($mesas as $m)
                                    <option value="{{$m->id}}">{{$m->mesa}} - {{$m->codigo}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="mesa">&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <button type="submit" class="btn btn-success"><i class="fa fa-exchange"></i> mesa</button>
                        </div>
                    </form>
                    </div>
                </div>

            </div>
        </div>

        <hr style="width: 100%px;">
        
        <!--<hr style="width: 100%px;">
        <table class="table table-striped" >
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
            <tbody><?php $total = 0; $cant=0; ?>
            @foreach($ventas as $venta)
                <tr>
                    <td> {{$venta->mesa}} </td>
                    <td> {{$venta->mesero}} </td>
                    <td> {{ strtoupper($venta->titulo) }} </td>
                    <td> {{$venta->cantidad}} </td>
                    <td> {{$venta->precio}} Bs. </td>
                    <td> {{$venta->total}} Bs. </td>
                    <?php $total = $total  + $venta->total; $cant = $cant + $venta->cantidad; ?>
                    <td> 
                        <form action="{{ route('pisqa.destroy', ['id' => $venta->id, 'ruta' => $venta->id_mesa]) }}" id="bett0" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="confirmDelete(event)"> <b><i class="fa fa-trash fa-6"></i></b> </button>
                        </form>
                        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#pedidoModal" onclick="actualizarPedido('{{$venta->id_mesa}}', '{{$venta->id}}')" > <b><i class="fa fa-edit" ></i></b> </a>
                        <script>
                            function confirmDelete(event) {
                                if (confirm("¿Estás seguro de elimnar el pedido?")) {
                                    document.getElementById('bett0').submit();
                                } else {
                                    event.preventDefault();
                                }
                            }                
                            function actualizarPedido(mesa, venta){
                                $('#id_mesa').val(mesa);
                                $('#id_venta').val(venta);
                                $('#ruta').val('mesa');
                            }
                        </script>
                    </td>
                </tr>
            @endforeach
                <tr>
                    <th colspan="3">TOTAL</th>
                    <th colspan="2"> {{$cant}}  </th>
                    <th> {{$total}} Bs. </th>
                </tr>
            </tbody>
        </table> -->


        <hr style="width: 100%px;">



        <form action="{{ route('mesas.pagar', ['id' => $mesa->id, 'tipo' => 'efectivo']) }}" method="POST">

        <button type="submit" class="btn btn-success">Pagar en Efectivo</button>
        <button type="submit" formaction="{{ route('mesas.pagar', ['id' => $mesa->id, 'tipo' => 'tarjeta']) }}" class="btn btn-primary">Pagar con Tarjeta</button>
            @csrf
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Mesa</th>
                        <th>Mesero</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Total</th>
                        <th> Acciones </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ventas as $venta)
                        <tr>
                            <td>{{ $venta->mesa }}</td>
                            <td>{{ $venta->mesero }}</td>
                            <td>{{ strtoupper($venta->titulo) }}</td>
                            <td>
                                <div class="row"> 
                                    <div class="col">
                                        <input type="checkbox" name="producto_{{ $venta->id }}" value="1">
                                    </div>
                                    <div class="col">
                                        <input type="number" name="cantidad_{{ $venta->id }}" 
                                        value="{{ $venta->cantidad }}" 
                                        min="1" max="{{ $venta->cantidad }}" 
                                        class="form-control">
                                    </div>
                                </div>
                            </td>
                            <td>{{ $venta->precio }} Bs.</td>
                            <td>{{ $venta->total }} Bs.</td>

                            <?php $total = $total  + $venta->total; $cant = $cant + $venta->cantidad; ?>
                            <td> 
                                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#pedidoModal" onclick="actualizarPedido('{{$venta->id_mesa}}', '{{$venta->id}}')" > <b><i class="fa fa-edit" ></i></b> </a>
                                <script>
                                    function confirmDelete(event) {
                                        if (confirm("¿Estás seguro de elimnar el pedido?")) {
                                            document.getElementById('bett0').submit();
                                        } else {
                                            event.preventDefault();
                                        }
                                    }                
                                    function actualizarPedido(mesa, venta){
                                        $('#id_mesa').val(mesa);
                                        $('#id_venta').val(venta);
                                        $('#ruta').val('mesa');
                                    }
                                </script>
                            </td>        
                        </tr>
                    @endforeach
                        <tr>
                            <th colspan="3">TOTAL</th>
                            <th colspan="3"> {{$cant}}  </th>
                            <th> {{$total}} Bs. </th>
                        </tr>
                </tbody>
            </table>

            <button type="submit" class="btn btn-success" onclick="return confirmarAccion();">Pagar en Efectivo</button>
            <button type="submit" onclick="return confirmarAccion();" formaction="{{ route('mesas.pagar', ['id' => $mesa->id, 'tipo' => 'tarjeta']) }}" class="btn btn-primary">Pagar con Tarjeta</button>
        </form>

        <hr style="width: 100%px;">
    </div>                        
</div>
@stop
