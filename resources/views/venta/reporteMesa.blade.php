@extends('pisqa')

@section('cuerpo')
<div class="page-title">
    <div class="title_left">
        <h3>Mesas y pedidos</h3>
    </div>    
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 ">
                <table id="tablaPisqa" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Mesa</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datos as $dato)
                        <tr>
                            <td>{{ $dato->id }}</td>
                            <td>{{ $dato->mesa }}</td>
                            <td>{{ $dato->cantidad }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
    </div>
</div>
@stop

