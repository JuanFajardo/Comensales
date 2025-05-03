@extends('pisqa')

@section('titulo')
Cambiar Clave 
@stop

@section('cuerpo')

@if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                    @endif
                    
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_content">

                
                <form method="POST" action="{{ route('user.changePost') }}"  enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col">
                            <label for="email">Usuario</label>
                            <input type="text" id="email" name="email" value="{{ \Auth()->user()->name }}" required class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="password">Contraseña</label>
                            <input type="text" id="password" name="password" value=""  class="form-control" placeholder="Introduzca nueva contraseña">
                        </div>
                    </div>

                    <br/>
                    <button type="submit" class="btn btn-warning">Actualizar Contraseña</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop