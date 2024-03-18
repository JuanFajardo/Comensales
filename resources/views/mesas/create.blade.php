@extends('pisqa')

@section('titulo')
Crear Mesa
@stop

@section('cuerpo')
<div class="page-title">
    <div class="title_left">
        <h3>Crear Mesa</h3>
    </div>
    <div class="title_rigth">
        <h3>
            <a href="{{ route('mesas.index') }}" class="btn btn-primary"> <i class="fa fa-backward"></i> </a>
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

<!-- 'img', 'menu', 'logo', 'fondo', 'descripcion', 'baja' -->
          
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_content">
            <form method="POST" action="{{ route('mesas.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <label for="mesa">Nombre de la mesa:</label>
                        <input type="text" id="mesa" name="mesa" value="{{ old('mesa') }}" required  class="form-control">
                    </div>

                    <div class="col">
                        <label for="codigo">Codigo de la mesa:</label>
                        <input type="text" id="codigo" name="codigo" value="{{ old('codigo') }}" required  class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="img">Descripcion:</label>
                        <textarea id="descripcion" name="descripcion" required class="form-control"></textarea>
                    </div>
                </div>

                

                <input type="hidden" id="baja" name="baja"  max="1" value="1" required>
                <br/><br/>
                <button type="submit" class="btn btn-primary">Crear Mesa</button>
            </form>
                
            </div>
        </div>
    </div>
</div>
@stop