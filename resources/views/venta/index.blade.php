@extends('pisqa')

@section('cuerpo')
<div class="page-title">
    <div class="title_left">
        <h3>Ventas</h3>
    </div>
    <div class="title_rigth">
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
                            <th>Comensales</th>
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
                            <td>{{ $dato->comensales }}</td>
                            <td>{{ $dato->total }}</td>
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

                <!-- Mostrar enlaces de paginación -->
                <div class="d-flex justify-content-center">
                    {{ $datos->links() }}
                </div>
            
    </div>
</div>

<script>
    //$(document).ready(function(){     });
    jQuery('.mostrar-detalles').on('click', function () {
            var ventaId = $(this).data('id');
            var detalleRow = $('#detalle-venta-' + ventaId);

            if (detalleRow.is(':visible')) {
                detalleRow.hide();
            } else {
                $.ajax({
                    //url: '{{ url("/ventas/detalles") }}/' + ventaId,
                    url: '{{ url("/ventas/") }}/' + ventaId,
                    method: 'GET',
                    success: function (response) {
                        if (response.success) {
                            // Inserta el HTML de los detalles en el contenedor correspondiente
                            detalleRow.find('.detalle-contenido').html(response.html);
                            detalleRow.show(); // Muestra la fila de detalles
                        }
                    }
                });
            }
        });
</script>
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
    </script>
@stop