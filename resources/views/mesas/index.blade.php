@extends('pisqa')

@section('cuerpo')
<div class="page-title">
    <div class="title_left">
        <h3>Listado de Mesas</h3>
    </div>
    <div class="title_rigth">
        <h3>
            <a href="{{ route('mesas.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> </a>
            @if (session('success'))
            <div>
            {{ session('success') }}
            </div>
            @endif
        </h3>
    </div>
</div>
          
<div class="row">
    @foreach ($mesas as $mesa)
        <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 mt-4">
            @if( $mesa->baja == '0' )
                        <div class="custom-block-wrap" style="padding:10px; background-color:#F5C7C7;  -webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;" >
                        @elseif($mesa->ocupado != '0')
                        <div class="custom-block-wrap" style="padding:10px; background-color:#63F163;  -webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;" >
                        <a href="{{asset('index.php/mesas/'.$mesa->id)}}" class="d-block">
                        @else
                        <div class="custom-block-wrap" style="padding:10px; background-color:#E7E7E7;  -webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;" >
                        <a href="{{asset('index.php/mesas/'.$mesa->id)}}" class="d-block">
                        @endif
                            <div class="custom-block">        
                                <div class="custom-block-body">
                                    <h5 class="mb-3"> {{$mesa->mesa}} - {{$mesa->codigo}} </h5>
                                    <p> {{$mesa->descripcion}} <br> 
                                        @if( $mesa->ocupado != "0" )
                                            <b>{{$mesa->ocupado}}</b>
                                        @endif
                                    </p>
                                    <hr style="width: 230px;">
                                    <p class="mb-0"> Mesero: <strong> {{$mesa->mesero}}</strong></p>
                                    <p class="mb-0"> Cliente: <strong>{{$mesa->cliente}}</strong></p>
                                    <p class="mb-0"> Comenzales: <strong>{{$mesa->cantidad_comensales}}</strong></p>
                                    <hr style="width: 230px;">
                                    <div class="d-flex align-items-center mb-0 ">
                                    
                                    <form action="{{ route('mesas.destroy', $mesa->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('mesas.edit', $mesa->id) }}" class="btn btn-warning"> <i class="fa fa-edit"></i> </a>
                                        @if( $mesa->baja == '1' )
                                        <button type="submit" class="btn btn-success"><i class="fa fa-eye"></i> </button>
                                        @else
                                        <button type="submit" class="btn btn-danger"> <i class="fa fa-eye-slash"></i></button>
                                        @endif             
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
</div>
@stop