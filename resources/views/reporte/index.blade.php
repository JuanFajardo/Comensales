@extends('pisqa')

@section('cuerpo')
<div class="page-title">
    <div class="title_left">
        <h3>Reporte Personalizado y Diario</h3>
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

<form action="{{ route('ventas.store') }}"  method="POST">
    @csrf

    <div class="row">

        <div class="col-md-3">
            <label for="fecha_inicio" class="form-text text-muted">Fecha Inicio</label>
            <input type="date" name="fecha_inicio" class="form-control">
        </div>

        <div class="col-md-3">
            <label for="fecha_final" class="form-text text-muted">Fecha Final</label>
            <input type="date" name="fecha_final" class="form-control">
        </div>

        <div class="col-md-3">
            <label for="fecha_final" class="form-text text-muted">Fecha Final</label>
            <select name="usuario" class="form-control">
                <option value="0">Todos</option>
                @foreach($meseros as $mesero)
                    <option value="{{$mesero->id}}">{{$mesero->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <button type="submit" class="btn btn-secondary" > <i class="fa fa-list-alt" aria-hidden="true"></i> Reporte Diario  </button>
        </div>

    </div>

    <div class="row">

        <div class="col-md-3">
            <label for="usuario" class="form-text text-muted">Selecciona un mesero de la lista</label>
            <select name="usuario" class="form-control">
                <option value="0">Todos</option>
                @foreach($meseros as $mesero)
                    <option value="{{$mesero->id}}">{{$mesero->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
          <select name="usuario" class="form-control">
            <option value="0">Todos</option>
            @foreach($meseros as $mesero)
            <option value="{{$mesero->id}}">{{$mesero->name}}</option>
            @endforeach
          </select>
        </div>

        <div class="col-md-3">
            <button type="submit" class="btn btn-primary" > <i class="fa fa-search" aria-hidden="true"></i> Reporte Personalizado  </button>
        </div>
    </div>
</form>


@stop