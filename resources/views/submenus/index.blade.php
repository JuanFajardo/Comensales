@extends('pisqa')

@section('cuerpo')
<div class="page-title">
    <div class="title_left">
        <h3>Listado de SubMenú</h3>
    </div>
    <div class="title_rigth">
        <h3>
            <a href="{{ route('submenus.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> </a>
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
                            <th>Imagen</th>
                            <th>Menú</th>
                            <th>Submenú</th>
                            <th>Precio</th>
                            <th>Baja</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($submenus as $submenu)
                        <tr>
                            <td>
                                @if ($submenu->img)
                                    <img src="{{ asset('assets/img/' . $submenu->img) }}" alt="Imagen del submenú" style="width: 100px;">
                                @else
                                    Sin imagen
                                @endif
                            </td>
                            <td>{{ $submenu->menu->menu }}</td>
                            <td>{{ $submenu->submenu }}<br>
                                <small> {{ $submenu->detalles }}</small>
                            </td>                
                            <td>
                                <span class="badge badge-primary">Compra {{ $submenu->precio_compra }} Bs. </span><br>
                                <span class="badge badge-success">Venta {{ $submenu->precio_venta }} Bs. </span>
                            </td>
                            <td>
                                <form action="{{ route('submenus.destroy', $submenu->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    @if( $submenu->baja == '1' )
                                    <button type="submit" class="btn btn-success"><i class="fa fa-eye"></i></button>
                                    @else
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-eye-slash"></i></button>
                                    @endif
                                </form>
                            </td>    
                            <td>
                                <a href="{{ route('submenus.edit', $submenu->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                
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
