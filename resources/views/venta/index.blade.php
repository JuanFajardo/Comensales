@extends('pisqa')

@section('cuerpo')
<div class="page-title">
    <div class="title_left">
        <h3>Ventas</h3>
    </div>
    <div class="title_rigth">
        <a href="{{asset('index.php/Cierre')}}" id="cierre" class="btn btn-warning">
            <i class="fa fa-unlock-alt"></i> Cerrar Caja
        </a>
        <h3>
            @if (session('success'))
            <div>
            {{ session('success') }}
            </div>
            @endif
        </h3>
    </div>
</div>


<div class="row">
    <div class="col-md-12 col-sm-12 ">
                <table id="tablaPisqa" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Mesero</th>
                            <th>Cajero</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datos as $dato)
                        <tr>
                            <td>{{ $dato->fecha_pago }}</td>
                            <td>{{ $dato->mesero }}</td>
                            <td>{{ $dato->cajero }}</td>
                            <td>{{ $dato->cliente }}<br>
                                @if( $dato->pago == "normal" )
                                <b class="badge badge-info">{{$dato->pago}}</b>
                                @else
                                <b class="badge badge-primary">{{$dato->pago}}</b>
                                @endif
                            </td>
                            <td>{{ $dato->total }} Bs<br>
                                @if( $dato->pago == "normal" )
                                    <b class="badge badge-success">{{$dato->tipo_pago}}</b>
                                @else
                                    <b class="badge badge-warning">{{$dato->tipo_pago}}</b>
                                @endif
                            </td>
                            <td>
                                <a href="javascript:void(0);" class="mostrar-detalles btn btn-primary" data-id="{{ $dato->id }}"> <i class="fa fa-eye"></i> </a>
                            </td>
                        </tr>
                        <tr class="detalle-venta" id="detalle-venta-{{ $dato->id }}" style="display: none;">
                            <td colspan="6">
                                <div class="detalle-contenido"></div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            
    </div>
</div>
@stop

@section('script')
<script>
    $(document).ready(function(){
        $('#tablaPisqa').DataTable({
            "order": [[ 0, 'asc']],
            "language": {
                "bDeferRender": true,
                "sEmtpyTable": "No ay registros",
                "decimal": ",",
                "thousands": ".",
                "lengthMenu": "Mostrar _MENU_ ",
                "zeroRecords": "No se encontro nada,  lo siento",
                "info": "Mostrar paginas [_PAGE_] de [_PAGES_]",
                "infoEmpty": "No ay entradas permitidas",
                "search": "Buscar ",
                "infoFiltered": "(Busqueda de _MAX_ registros en total)",
                "oPaginate":{
                    "sLast":"Final",
                    "sFirst":"Principio",
                    "sNext":"Siguiente",
                    "sPrevious":"Anterior"
                }
            }
        });
    });

    $('.mostrar-detalles').on('click', function () {
        var ventaId = $(this).data('id');
        var detalleRow = $('#detalle-venta-' + ventaId);

        if (detalleRow.is(':visible')) {
            detalleRow.hide();
        } else {
            $.ajax({
                url: '{{ url("/ventas/") }}/' + ventaId,
                method: 'GET',
                success: function (response) {
                    if (response.success) {
                        detalleRow.find('.detalle-contenido').html(response.html);
                        detalleRow.show(); // Muestra la fila de detalles
                    }
                }
            });
        }
    });

    $('#cierre').on('click', function (event) {
        event.preventDefault();
        let confirmation = confirm('¿Está seguro de cerrar la caja?');
        if (confirmation) {
            window.location.href = $(this).attr('href');
        }
    });

</script>
@stop