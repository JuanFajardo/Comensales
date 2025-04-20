@extends('pisqa')

@section('cuerpo')
<div class="page-title">
    <div class="title_left">
        <h3>Listado de Clientes</h3>
    </div>
    <div class="title_rigth">
        <h3>
            <a href="{{ route('clientes.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> </a>
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
        <div class="x_panel">
            <div class="x_content">
                <br />
                <table id="tablaPisqa" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>NIT</th>
                            <th>Extra</th>
                            <th>Baja</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->cliente }}<br>
                                @if( $cliente->tipo == "especial")
                                    <p class="badge badge-info">{{ $cliente->tipo }}</p>
                                @else
                                    <p class="badge badge-success">{{ $cliente->tipo }}</p>
                                @endif
                                
                            </td>
                            <td>{{ $cliente->nit }}</td>
                            
                            <td>{{ $cliente->extra }}</td>
                            <td>
                                @if( $cliente->baja == '1' )
                                <a href="{{ route('cliente.baja', $cliente->id) }}" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                @else
                                <a href="{{ route('cliente.baja', $cliente->id) }}" class="btn btn-danger"><i class="fa fa-eye"></i></a>
                                @endif
                            </td>    
                            <td>
                                <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este cliente?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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
    </script>
@stop