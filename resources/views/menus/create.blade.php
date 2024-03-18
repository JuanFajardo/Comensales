@extends('pisqa')

@section('titulo')
Crear Menú
@stop

@section('cuerpo')
<div class="page-title">
    <div class="title_left">
        <h3>Crear Menú</h3>
    </div>
    <div class="title_rigth">
        <h3>
            <a href="{{ route('menus.index') }}" class="btn btn-primary"> <i class="fa fa-backward"></i> </a>
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
            <form method="POST" action="{{ route('menus.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <label for="menu">Nombre del menú:</label>
                        <input type="text" id="menu" name="menu" value="{{ old('menu') }}" required  class="form-control">
                    </div>

                    <div class="col">
                        <label for="img">Imagen:</label>
                        <input type="file" id="img" name="img" required class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="img">Logo:</label>
                        <input type="file" id="logo" name="logo" required class="form-control">
                    </div>

                    <div class="col">
                        <label for="img">Fondo:</label>
                        <input type="file" id="fondo" name="fondo" required class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="img">Descripcion:</label>
                        <textarea id="descripcion" name="descripcion" required class="form-control"></textarea>
                    </div>
                </div>

                

                <input type="hidden" id="baja" name="baja"  max="1" value="1s" required>
                <br/><br/>
                <button type="submit" class="btn btn-primary">Crear Menú</button>
            </form>
                
            </div>
        </div>
    </div>
</div>
@stop