@extends('pisqa')

@section('cuerpo')
<div class="page-title">
    <div class="title_left">
        <h3>Cierre de Cajas</h3>
    </div>
    <div class="title_rigth">
        <h3>
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
                <table id="tablaPisqa" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Cajero</th>
                            <th>Numero Cierre</th>
                            <th>Fecha</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datos as $dato)
                        <tr>
                            <td>{{ $dato->cierre }}</td>
                            <td>{{ $dato->id_cierre }}</td>
                            <td>{{ $dato->fecha_cierre }}</td>
                            <td>
                                <a href="{{asset('index.php/reporteCierre/'.$dato->id_cierre)}}" class="mostrar-detalles btn btn-primary" > <i class="fa fa-eye"></i> </a>
                                <a href="{{asset('index.php/reporteCierreMenu/'.$dato->id_cierre)}}" class="mostrar-detalles btn btn-success" > <i class="fa fa-bars"></i> </a>
                                <a href="{{asset('index.php/reporteCierreMenu/'.$dato->id_cierre.'?detalle=1')}}" class="mostrar-detalles btn btn-info" > <i class="fa fa-file-o"></i> </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            
    </div>
</div>
@stop
