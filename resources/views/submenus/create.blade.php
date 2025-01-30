@extends('pisqa')

@section('titulo')
Crear Submenú
@stop

@section('cuerpo')
<div class="page-title">
    <div class="title_left">
        <h3>Crear Submenú</h3>
    </div>
    <div class="title_rigth">
        <h3>
            <a href="{{ route('submenus.index') }}" class="btn btn-primary"> <i class="fa fa-backward"></i> </a>
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
            <form method="POST" action="{{ route('submenus.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col">
                        <label for="submenu">Nombre del submenú:</label>
                        <input type="text" id="submenu" name="submenu" value="{{ old('submenu') }}" required  class="form-control">
                    </div>

                    <div class="col">
                        <label for="id_menu">Menú:</label>
                        <select name="id_menu" id="id_menu" required class="form-control">
                            @foreach ($menus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->menu }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col">
                        <label for="img">Imagen:</label>
                        <input type="file" id="img" name="img" required class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="tipo_comanda">Tipo Comanda:</label>
                        <select name="tipo_comanda" id="tipo_comanda" class="form-control">
                            <option value="comida">Comida</option>
                            <option value="bebida">Bebida</option>
                            <option value="postre">Postre</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="fondo">Precio Compra:</label>
                        <input type="text" id="precio_compra" name="precio_compra" value="0" required class="form-control">
                    </div>
                    <div class="col">
                        <label for="fondo">Precio Venta:</label>
                        <input type="text" id="precio_venta" name="precio_venta" required class="form-control">
                    </div>
                    
                </div>

               

                <div class="row">
                    <div class="col">
                        <label for="img">Descripcion:</label>
                        <textarea id="descripcion" name="descripcion" class="form-control"></textarea>
                    </div>
                </div>

                <input type="hidden" name="baja" id="baja" value="1" required>
                <input type="hidden" name="promocion" id="promocion" value="0" required>
                
                <button class="btn btn-primary" type="submit">Crear Submenú</button>
            </form>
                
            </div>
        </div>
    </div>
</div>
@stop