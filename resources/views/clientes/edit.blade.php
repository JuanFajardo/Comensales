@extends('pisqa')

@section('cuerpo')
<div class="page-title">
    <div class="title_left">
        <h3>Edtiar Cliente</h3>
    </div>
    <div class="title_rigth">
        <h3>
            <a href="{{ route('clientes.index') }}" class="btn btn-warning"> <i class="fa fa-backward"></i> </a>
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
            
            <form method="POST" action="{{ route('clientes.update', $cliente->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col">
                        <label for="cliente">Nombre del cliente:</label>
                        <input type="text" id="cliente" name="cliente" value="{{ $cliente->cliente }}" required  class="form-control">
                    </div>

                    <div class="col">
                        <label for="nit">NIT:</label>
                        <input type="text" id="nit" name="nit" value="{{ $cliente->nit }}" required  class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="tipo">Tipo:</label>
                        <select id="tipo" name="tipo" required class="form-control">
                            <option value="normal" {{ $cliente->tipo == 'normal' ? 'selected' : '' }}>Normal</option>
                            <option value="especial" {{ $cliente->tipo == 'especial' ? 'selected' : '' }}>Especial</option>
                        </select>
                    </div>

                    <div class="col">
                        <label for="extra">Extra:</label>
                        <input type="text" id="extra" name="extra" value="{{ $cliente->extra }}" class="form-control">
                    </div>
                </div>




                
                <br/><br/>
                <button type="submit" class="btn btn-warning">Actualizar Cliente</button>
            </form>

            </div>
        </div>
    </div>
</div>
@stop