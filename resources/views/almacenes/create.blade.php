@extends('pisqa')

@section('cuerpo')
<div class="page-title">
    <div class="title_left">
        <h3>Crear Almacen</h3>
    </div>
    <div class="title_rigth">
        <h3>
            <a href="{{ route('almacen.index') }}" class="btn btn-primary"> <i class="fa fa-backward"></i> </a>
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
            
                <form action="{{ route('almacen.store') }}" method="POST">
                @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="id_menu">Menú:</label>
                                <select name="id_menu" id="id_menu" class="form-control" required>
                                    @foreach($menus as $menu)
                                        <option value="{{ $menu->id }}">{{ $menu->menu }}</option>
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
                        <div class="col">
                            <div class="form-group">
                                <label for="id_producto">Producto:</label>
                                <select name="id_producto" id="id_producto" class="form-control" required>
                                    @foreach($productos as $producto)
                                        <option value="{{ $producto->id }}">{{ $producto->producto }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="precio_compra">Precio de Compra:</label>
                                <input type="text" name="precio_compra" id="precio_compra" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="precio_venta">Precio de Venta:</label>
                                <input type="text" name="precio_venta" id="precio_venta" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="fecha_peticion">Fecha de Petición:</label>
                                <input type="date" name="fecha_peticion" id="fecha_peticion" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="fecha_entrega">Fecha de Entrega:</label>
                                <input type="date" name="fecha_entrega" id="fecha_entrega" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="cantidad_entrada">Cantidad de Entrada:</label>
                                <input type="text" name="cantidad_entrada" id="cantidad_entrada" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="cantidad_salida">Cantidad de Salida:</label>
                                <input type="text" name="cantidad_salida" id="cantidad_salida" class="form-control" required readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="observacion">Observación:</label>
                                <textarea name="observacion" id="observacion" class="form-control" required></textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Crear Almacén</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
@stop
