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
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>NIT</th>
                            <th>Tipo</th>
                            <th>Extra</th>
                            <th>Baja</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->cliente }}</td>
                            <td>{{ $cliente->nit }}</td>
                            <td>{{ $cliente->tipo }}</td>
                            <td>{{ $cliente->extra }}</td>
                            <td>
                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    @if( $cliente->baja == '1' )
                                    <button type="submit" class="btn btn-success"><i class="fa fa-eye"></i></button>
                                    @else
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-eye-slash"></i></button>
                                    @endif
                                </form>
                            </td>    
                            <td>
                                <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
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