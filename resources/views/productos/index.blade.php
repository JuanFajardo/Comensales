@extends('pisqa')

@section('cuerpo')
<div class="page-title">
    <div class="title_left">
        <h3>Listado de Productos</h3>
    </div>
    <div class="title_rigth">
        <h3>
            <a href="{{ route('productos.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> </a>
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
                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre del Producto</th>
                                    <th>Precio</th>
                                    <th>Peso de Compra</th>
                                    <th>Peso de Venta</th>
                                    <th>Menú</th>
                                    <th>Submenú</th>
                                    <th>Baja</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productos as $producto)
                                    <tr>
                                        <td>{{ $producto->id }}</td>
                                        <td>{{ $producto->producto }}</td>
                                        <td>{{ $producto->precio }}</td>
                                        <td>{{ $producto->peso_compra }}</td>
                                        <td>{{ $producto->peso_venta }}</td>
                                        <td>{{ $producto->id_menu }}</td>
                                        <td>{{ $producto->id_submenu }}</td>
                                        <td>
                                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                @if( $producto->baja == '1' )
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-eye"></i> </button>
                                                @else
                                                    <button type="submit" class="btn btn-danger"> <i class="fa fa-eye-slash"></i></button>
                                                @endif
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning"> <i class="fa fa-edit"></i> </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop


