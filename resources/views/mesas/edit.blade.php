@extends('pisqa')

@section('titulo')
Editar Mesa
@stop

@section('cuerpo')
<div class="page-title">
    <div class="title_left">
        <h3>Editar Mesa</h3>
    </div>
    <div class="title_rigth">
        <h3>
            <a href="{{ route('mesas.index') }}" class="btn btn-warning"> <i class="fa fa-backward"></i> </a>
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
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_content">
                <form method="POST" action="{{ route('mesas.update', $mesa->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Esto indica que se usará el método PUT para actualizar la mesa -->

                    <div class="row">
                        <div class="col">
                            <label for="mesa">Nombre de la mesa:</label>
                            <input type="text" id="mesa" name="mesa" value="{{ $mesa->mesa }}" required class="form-control">
                        </div>

                        <div class="col">
                            <label for="codigo">Codigo de la mesa:</label>
                            <input type="text" id="codigo" name="codigo" value="{{ $mesa->codigo }}" required class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="descripcion">Descripción:</label>
                            <textarea id="descripcion" name="descripcion" required class="form-control">{{ $mesa->descripcion }}</textarea>
                        </div>
                    </div>

                    <input type="hidden" id="baja" name="baja" max="1" value="{{ $mesa->baja }}" required>
                    <input type="hidden" id="baja" name="baja" max="1" value="{{ $mesa->baja }}" required>
                    <input type="hidden" id="baja" name="baja" max="1" value="{{ $mesa->baja }}" required>

                    <br/><br/>
                    <button type="submit" class="btn btn-warning">Actualizar Mesa</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop