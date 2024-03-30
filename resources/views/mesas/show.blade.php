@extends('pisqa')

@section('cuerpo')
<div class="page-title">
    <div class="title_left">
        <h3> {{$mesa->mesa}} </h3>
         {{$mesa->descripcion}} 
    </div>
    <div class="title_rigth">
        <h3>
            <a href="{{ route('mesas.index') }}" class="btn btn-warning"> <i class="fa fa-backward"></i> </a>
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
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_content" style="padding:10px; background-color:#E7E7E7;  -webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;">
        

                    <p > Mesero: <strong> {{$mesa->mesero}}</strong></p>
                    <p > Cliente: <strong>{{$mesa->cliente}}</strong></p>
                    <p > Comenzales: <strong>{{$mesa->cantidad_comensales}}</strong></p>

                    <hr style="width: 230px;">

                    <table class="table">
                        <thead>
                            <tr>
                                <th> Nro</th>
                                <th> Mesa</th>
                                <th> Pedido</th>
                                <th> Cantidad</th>
                                <th> P. Unitario</th>
                                <th> P. Total</th>
                                <th> Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table> 

                    <hr style="width: 230px;">
                                    
                    <form action="{{ route('mesas.update', $mesa->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="mesa" id="mesa" class="form-control">
                            @foreach($mesas as $m)
                                <option value="{{$m->id}}">{{$m->mesa}} - {{$m->codigo}}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-success"><i class="fa fa-exchange"></i> </button>
                    </form>
            </div>  
        </div>                        
    </div>  
</div>
@stop
