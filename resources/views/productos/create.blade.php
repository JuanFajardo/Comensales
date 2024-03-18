@extends('pisqa')

@section('cuerpo')
<div class="page-title">
    <div class="title_left">
        <h3>Crear Producto</h3>
    </div>
    <div class="title_rigth">
        <h3>
            <a href="{{ route('productos.index') }}" class="btn btn-primary"> <i class="fa fa-backward"></i> </a>
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
            
            <form action="{{ route('productos.store') }}" method="POST">
                 @csrf

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="producto">Nombre del Producto:</label>
                            <input type="text" name="producto" id="producto" class="form-control" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="precio">Precio:</label>
                            <input type="text" name="precio" id="precio" class="form-control" required>
                        </div>
                    </div>
                </div>    
                            
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="peso_compra">Peso de Compra:</label>
                            <input type="text" name="peso_compra" id="peso_compra" class="form-control" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="peso_venta">Peso de Venta:</label>
                            <input type="text" name="peso_venta" id="peso_venta" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="id_menu">Menú:</label>
                            <select name="id_menu" id="id_menu" class="form-control" required>
                                @foreach($menus as $menu)
                                    <option value="{{ $menu->id }}"> {{ $menu->menu }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="id_submenu">Submenú:</label>
                            <select name="id_submenu" id="id_submenu" class="form-control" required>
                                @foreach($submenus as $submenu)
                                    <option value="{{ $submenu->id }}">{{ $submenu->submenu }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>      

                <input type="hidden" name="baja" id="baja" class="form-control" value='1' required>
                <button type="submit" class="btn btn-primary" >Crear Producto</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
@stop
