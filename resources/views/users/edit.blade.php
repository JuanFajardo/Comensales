@extends('pisqa')

@section('titulo')
Editar Usuario
@stop

@section('cuerpo')
<div class="page-title">
    <div class="title_left">
        <h3>Editar Usuario</h3>
    </div>
    <div class="title_rigth">
        <h3>
            <a href="{{ route('usuarios.index') }}" class="btn btn-primary"> <i class="fa fa-backward"></i> </a>
            @if ($errors->any())
                <div>
                    <strong>Error de validación:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_content">

                <form method="POST" action="{{ route('usuarios.store') }}" enctype="multipart/form-data">
                <form method="POST" action="{{ route('usuarios.update', $user->id) }}"  enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col">
                            <label for="email">Usuario</label>
                            <input type="text" id="email" name="email" value="{{ $user->email }}" required class="form-control">
                        </div>

                        <div class="col">
                            <label for="password">Contraseña</label>
                            <input type="text" id="password" name="password" value="" required class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="name">Nombre Completo</label>
                            <input type="text" id="name" name="name" value="{{ $user->name }}" required class="form-control">
                        </div>

                        <div class="col">
                            <label for="celular">Celular</label>
                            <input type="text" id="celular" name="celular" value="{{ $user->celular }}" required class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="direccion">Direccion</label>
                            <input type="text" id="direccion" name="direccion" value="{{ $user->direccion }}" required class="form-control">
                        </div>

                        <div class="col">
                            <label for="tipo">Tipo</label>
                            <select name="tipo" id="tipo" required class="form-control">
                                <option value="administrador" {{ $user->tipo == 'administrador' ? 'selected' : '' }}>Administrador</option>
                                <option value="mesero" {{ $user->tipo == 'mesero' ? 'selected' : '' }}>Mesero</option>
                                <option value="cajero" {{ $user->tipo == 'cajero' ? 'selected' : '' }}>Cajero</option>
                            </select>
                        </div>
                    </div>

                    <input type="hidden" id="id_mesa" name="id_mesa" value="{{ $user->id_mesa }}" required>
                    <input type="hidden" id="id_cliente" name="id_cliente" value="{{ $user->id_cliente }}" required>
                    <input type="hidden" id="baja" name="baja" value="{{ $user->baja }}" required>
                    <br/><br/>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop