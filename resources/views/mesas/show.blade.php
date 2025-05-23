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
                    <a href="" class="btn btn-default"  data-toggle="modal" data-target="#mesaModal" > <b><i class="fa fa-edit" ></i> Cliente / Comenzales </b> </a>                    
                    <a href="{{asset('index.php/Phisqa/comanda/'.$mesa->id.';comida')}}" target="_blank" class="btn btn-default" > <b><i class="fa fa-print" ></i> Comida</b> </a>
                    <a href="{{asset('index.php/Phisqa/comanda/'.$mesa->id.';bebida')}}" target="_blank" class="btn btn-default" > <b><i class="fa fa-print" ></i> Bebida</b> </a>
                    <a href="{{asset('index.php/Phisqa/comanda/'.$mesa->id.';postre')}}" target="_blank" class="btn btn-default" > <b><i class="fa fa-print" ></i> Postre</b> </a>
                    <a href="{{asset('index.php/Phisqa/comanda/'.$mesa->id.';comanda')}}" target="_blank" class="btn btn-default" > <b><i class="fa fa-print" ></i> Comanda</b> </a>
                    <script>
                        function confirmarAccion() {
                            return confirm('¿Estás seguro de que deseas continuar con el pago?');
                        }
                    </script>
                </div>
                 <!-- Cambiar Mesa-->       
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
                            <button type="submit" class="btn btn-default"><i class="fa fa-exchange"></i> mesa</button>
                        </div>
                    </form>
                    </div>
                </div>

            </div>
        </div>

        <hr style="width: 100%px;">
        <hr style="width: 100%px;">

        <form action="{{ route('mesas.pagar', ['id' => $mesa->id, 'tipo' => 'efectivo']) }}" method="POST">
            <button type="submit" class="btn btn-success"> <i class="fa fa-file-pdf-o"></i> Pagar en Efectivo</button>
            <button type="submit" formaction="{{ route('mesas.pagar', ['id' => $mesa->id, 'tipo' => 'tarjeta']) }}" class="btn btn-primary"> <i class="fa fa-file-pdf-o"></i> Pagar con Tarjeta</button>
            @csrf
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Mesero</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Total</th>
                        <th> Acciones </th>
                    </tr>
                </thead>
                <tbody><?php $total = $cant = 0; ?>
                    @foreach($ventas as $venta)
                        <?php $total = $total  + $venta->total; $cant = $cant + $venta->cantidad; ?>
                        @if( $venta->cantidad != 0 )
                        <tr>
                            <td> 
                                <b>  {{ $venta->mesero }} </b>  <br>
                                @if  ($venta->tipo_comanda == "comida")
                                    <small class="badge badge-success"><b>{{$venta->tipo_comanda}}</b></small>
                                @elseif($venta->tipo_comanda == "bebida")
                                    <small class="badge badge-primary"><b> {{$venta->tipo_comanda}}</b></small>
                                @elseif($venta->tipo_comanda == "postre")
                                    <small class="badge badge-info"><b>{{$venta->tipo_comanda}}</b></small>
                                @endif
                                @if  ($venta->tipo_pedido == "mesa")
                                    <small class="badge badge-warning"><b>{{$venta->tipo_pedido}}</b></small>
                                @else
                                    <small class="badge badge-secondary"><b>{{$venta->tipo_pedido}}</b></small>
                                @endif
                            </td>
                            <td>
                                {{ strtoupper($venta->titulo) }}<br>
                                <small class="badge badge-info">{{$venta->comentario_pedido}}</small>
                                @if( strlen($venta->eliminacion_comentario) > 0)
                                    <small class="badge badge-danger">{{$venta->eliminacion_comentario}}</small>
                                @endif
                            </td>
                            <td>
                                <div class="row"> 
                                    <div class="col">
                                        <input type="hidden" name="productos[{{ $venta->id }}][precio]" value="{{ $venta->precio }}">
                                        <input type="hidden" name="productos[{{ $venta->id }}][codigo]" value="{{ $venta->id }}">
                                        <input name="productos[{{ $venta->id }}][cantidad]"  
                                            @if( $venta->id_menu == 1  )
                                                type="text"
                                            @else
                                                type="number" step="1" min="1" max="100"
                                            @endif
                                            value="{{ $venta->cantidad }}" class="form-control cantidad-input" 
                                            data-checkbox="checkbox-{{ $venta->id }}">
                                    </div>
                                    <div class="col">
                                        <input 
                                            type="checkbox" 
                                            id="checkbox-{{ $venta->id }}" 
                                            name="productos[{{ $venta->id }}][producto]" 
                                            value="{{ $venta->cantidad }}">
                                    </div>
                                </div>
                            </td>
                            <td>{{ $venta->precio }} Bs. </td>
                            <td>{{ $venta->total }} Bs. </td>
                            <td> 
                                @if( strlen($venta->eliminacion_comentario) == 0)
                                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#pedidoModal" onclick="actualizarPedido('{{$venta->id_mesa}}', '{{$venta->id}}')" > <b><i class="fa fa-edit" ></i></b> </a>
                                <a href="#" class="btn btn-danger" onclick="openDeleteModal('{{$venta->id}}')"> <b><i class="fa fa-trash"></i></b> </a>
                                <script>
                                    function openDeleteModal(pedidoId) {
                                        document.getElementById('pedidoId').value = pedidoId;
                                        $('#deleteModal').modal('show');
                                    }
                                    function actualizarPedido(mesa, venta) {
                                        $('#id_mesa').val(mesa);
                                        $('#id_venta').val(venta);
                                        $('#ruta').val('mesa');
                                    }
                                </script>
                                @endif
                            </td>        
                        </tr>
                        @endif
                    @endforeach
                        <tr>
                            <th colspan="3">TOTAL</th>
                            <th colspan="2"> {{$cant}}  </th>
                            <th> {{$total}} Bs. </th>
                        </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-success" onclick="return confirmarAccion();"> <i class="fa fa-file-pdf-o"></i> Pagar en Efectivo</button>
            <button type="submit" onclick="return confirmarAccion();" formaction="{{ route('mesas.pagar', ['id' => $mesa->id, 'tipo' => 'tarjeta']) }}" class="btn btn-primary"> <i class="fa fa-file-pdf-o"></i> Pagar con Tarjeta</button>
        </form>
        <hr style="width: 100%px;">
    </div>                        
</div>

<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmar eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form id="deleteForm" action="{{ route('mesas.destroy', ['mesa' => 'Eliminar']) }}" method="POST">
            <div class="modal-body">
                <p>Por favor, indica la razón para eliminar el pedido:</p>
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="pedidoId" name="pedidoId">
                    <input type="hidden" id="mesaId" name="mesaId" value="{{$mesa->id}}">
                    <div class="form-group">
                        <label for="razon">Razón de eliminación</label>
                        <textarea class="form-control" id="razon" name="razon" rows="3" required></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger" form="deleteForm">Confirmar eliminación</button>
            </div>
            </form>
        </div>
    </div>
</div>

@stop

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', () => {
    const cantidadInputs = document.querySelectorAll('.cantidad-input');
    cantidadInputs.forEach(input => {
        input.addEventListener('input', (event) => {
            const cantidadValue = event.target.value;
            const checkboxId = event.target.dataset.checkbox;
            const checkbox = document.getElementById(checkboxId);

            if (checkbox) {
                checkbox.value = cantidadValue;
            }
        });
    });
});
</script>
@stop