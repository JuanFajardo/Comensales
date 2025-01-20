@extends('pisqa')

@section('titulo')
Crear Cliente
@stop

@section('cuerpo')
<div class="page-title">
    <div class="title_left">
        <h3>Crear Cliente</h3>
    </div>
    <div class="title_rigth">
        <h3>
            <a href="{{ route('clientes.index') }}" class="btn btn-primary"> <i class="fa fa-backward"></i> </a>
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

<!-- 'cliente', 'nit', 'tipo', 'extra', 'baja' -->
          
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_content">
            <form method="POST" action="{{ route('clientes.store') }}" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col">
                        <label for="cliente">Nombre del cliente:</label>
                        <input type="text" id="cliente" name="cliente" value="{{ old('cliente') }}" required  class="form-control">
                    </div>

                    <div class="col">
                        <label for="nit">NIT:</label>
                        <input type="text" id="nit" name="nit" value="{{ old('nit') }}" required  class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="tipo">Tipo:</label>
                        <select id="tipo" name="tipo" required class="form-control">
                            <option value="normal">Normal</option>
                            <option value="especial">Especial</option>
                        </select>
                    </div>

                    <div class="col">
                        <label for="extra">Extra:</label>
                        <input type="text" id="extra" name="extra" value="{{ old('extra') }}" class="form-control">
                    </div>
                </div>

                <input type="hidden" id="baja" name="baja"  max="1" value="1" required>
                <br/><br/>
                <button type="submit" class="btn btn-primary">Crear Cliente</button>
            </form>
                
            </div>
        </div>
    </div>
</div>
@stop