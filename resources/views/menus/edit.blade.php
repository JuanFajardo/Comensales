@extends('pisqa')

@section('cuerpo')

<div class="page-title">
    <div class="title_left">
        <h3>Edtiar Menú</h3>
    </div>
    <div class="title_rigth">
        <h3>
            <a href="{{ route('menus.index') }}" class="btn btn-warning"> <i class="fa fa-backward"></i> </a>
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
            
            <form method="POST" action="{{ route('menus.update', $menu->id) }}"  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col">
                        <label for="menu">Nombre del menú:</label>
                        <input type="text" id="menu" name="menu" value="{{ $menu->menu }}" required  class="form-control">
                    </div>
                    <div class="col">
                        <label for="img">Imagen:</label>
                        <input type="file" id="img" name="img" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="img">Logo:</label>
                        <input type="file" id="logo" name="logo"  class="form-control">
                    </div>

                    <div class="col">
                        <label for="img">Fondo:</label>
                        <input type="file" id="fondo" name="fondo"  class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="img">Descripcion:</label>
                        <textarea id="descripcion" name="descripcion"  class="form-control">{{ $menu->descripcion }}</textarea>
                    </div>
                </div>

                <input type="hidden" id="baja" name="baja"  value="{{ $menu->baja }}" required>
                <br/><br/>
                <button type="submit" class="btn btn-warning">Actualizar Menú</button>
            </form>

            </div>
        </div>
    </div>
</div>

@stop