@extends('pisqa')

@section('cuerpo')
<div class="page-title">
    <div class="title_left">
        <h3>Listado de Almacen</h3>
    </div>
    <div class="title_rigth">
        <h3>
            <a href="{{ route('almacen.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> </a>
            @if (session('success'))
            <div>
            {{ session('success') }}
            </div>
            @endif

        </h3>
    </div>
</div>
          
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_content">
                <br />
              
                <table id="datatable" class="table table-striped table-bordered">
               
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre del Menú</th>
                                        <th>Nombre del Submenú</th>
                                        <th>Nombre del Producto</th>
                                        <th>Precio de Compra</th>
                                        <th>Precio de Venta</th>
                                        <th>Fecha de Petición</th>
                                        <th>Fecha de Entrega</th>
                                        <th>Cantidad Entrada</th>
                                        <th>Cantidad Salida</th>
                                        <th>Observación</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($almacenes as $almacen)
                                        <tr>
                                            <td>{{ $almacen->id }}</td>
                                            <td>{{ $almacen->id_menu }}</td>
                                            <td>{{ $almacen->id_submenu }}</td>
                                            <td>{{ $almacen->id_producto }}</td>
                                            <td>{{ $almacen->precio_compra }}</td>
                                            <td>{{ $almacen->precio_venta }}</td>
                                            <td>{{ $almacen->fecha_peticion }}</td>
                                            <td>{{ $almacen->fecha_entrega }}</td>
                                            <td>{{ $almacen->cantidad_entrada }}</td>
                                            <td>{{ $almacen->cantidad_salida }}</td>
                                            <td>{{ $almacen->observacion }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

            </div>
        </div>
    </div>
</div>
@stop


