@extends('pisqa')

@section('cuerpo')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('usuarios.create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> </a>
                </div>

                <div class="card-body">
                    
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                    @endif
                    <table id="tablaPisqa" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Usuario</th>
                                <th>Celular</th>
                                <th>Dirección</th>
                                <th>Activo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}<br>
                                    @if( $user->tipo == "administrador" )
                                        <span class="badge badge-primary">Administrador</span>
                                    @elseif($user->tipo == "mesero" )
                                        <span class="badge badge-secondary">Mesero</span>
                                    @elseif($user->tipo == "cajero" )
                                        <span class="badge badge-info">Cajero</span>
                                    @endif
                                </td>
                                <td>{{ $user->celular }}</td>
                                <td>{{ $user->direccion }}</td>
                                <th>
                                    <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST">
                                        <input type="hidden" value="{{$user->id}}" name="id">
                                        <input type="hidden" value="{{$user->baja}}" name="baja">
                                        @csrf
                                        @method('DELETE')
                                        @if( $user->baja == '1' )
                                        <button type="submit" class="btn btn-success"><i class="fa fa-eye"></i> </button>
                                        @else
                                        <button type="submit" class="btn btn-danger"> <i class="fa fa-eye-slash"></i></button>
                                        @endif
                                    </form>
                                </th>
                                <td>
                                    <a href="{{ route('usuarios.edit', $user->id) }}" class="btn btn-warning"> <i class="fa fa-edit"></i> </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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