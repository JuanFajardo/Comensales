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
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Celular</th>
                                <th>Dirección</th>
                                <th>Tipo</th>
                                <th>Activo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
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
