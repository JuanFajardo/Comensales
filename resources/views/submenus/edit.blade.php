@extends('pisqa')

@section('titulo')
Editar Submenú
@stop

@section('cuerpo')
<div class="page-title">
    <div class="title_left">
        <h3>Editar Submenú</h3>
    </div>
    <div class="title_rigth">
        <h3>
            <a href="{{ route('submenus.index') }}" class="btn btn-warning"> <i class="fa fa-backward"></i> </a>
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
                <form method="POST" action="{{ route('submenus.update', $submenu->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col">
                            <label for="submenu">Nombre del submenú:</label>
                            <input type="text" id="submenu" name="submenu" value="{{ $submenu->submenu }}" required class="form-control">
                        </div>

                        <div class="col">
                            <label for="id_menu">Menú:</label>
                            <select name="id_menu" id="id_menu" required class="form-control">
                                @foreach ($menus as $menu)
                                    <option value="{{ $menu->id }}" {{ $submenu->id_menu == $menu->id ? 'selected' : '' }}>{{ $menu->menu }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col">
                            <label for="img">Imagen:</label>
                            <input type="file" id="img" name="img" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="tipo_comanda">Tipo Comanda:</label>
                            <select name="tipo_comanda" id="tipo_comanda" class="form-control">
                                <option value="comida" {{ $submenu->tipo_comanda == 'comida' ? 'selected' : '' }}>Comida</option>
                                <option value="bebida" {{ $submenu->tipo_comanda == 'bebida' ? 'selected' : '' }}>Bebida</option>
                                <option value="postre" {{ $submenu->tipo_comanda == 'postre' ? 'selected' : '' }}>Postre</option>
                            </select>

                        </div>
                        <div class="col">
                            <label for="fondo">Precio Compra:</label>
                            <input type="text" id="precio_compra" name="precio_compra" value="{{ $submenu->precio_compra }}" required class="form-control">
                        </div>
                        <div class="col">
                            <label for="fondo">Precio Venta:</label>
                            <input type="text" id="precio_venta" name="precio_venta" value="{{ $submenu->precio_venta }}" required class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="img">Descripción:</label>
                            <textarea id="descripcion" name="descripcion" required class="form-control">{{ $submenu->descripcion }}</textarea>
                        </div>
                    </div>

                    <input type="hidden" name="baja" id="baja" value="{{ $submenu->baja }}" required>
                    <input type="hidden" name="promocion" id="promocion" value="{{ $submenu->promocion }}" required>
                    
                    <button class="btn btn-warning" type="submit">Actualizar Submenú</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop