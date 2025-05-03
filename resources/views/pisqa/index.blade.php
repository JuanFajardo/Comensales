@php
$config = \App\Models\Config::first();
@endphp

@extends('warmis')

@section('titulo')
{{$config->titulo}}
@stop

@section('fondo')
{{ asset('assets/imgs/style-5.png') }}
@stop

@section('logo')
<center><img src="{{asset('assets/imgs/logo.png')}}" alt="centered image" height="400" width="600"> </center>
@stop

@section('cuerpo')
<div class="row">
    @foreach($menus as $menu)
    <div class="col-md-4 my-3">
        <div class="team-wrapper text-center">
            <img src="{{ asset('assets/img/' . $menu->img) }}" class="circle-120 rounded-circle mb-3 shadow" alt="">
            <h6 class="socials mt-3">
                <a href="{{asset('index.php/PhisqaWarmis/'.$menu->id)}}" class="btn btn-primary rounded">{{$menu->menu}}</a>
            </h6>
        </div>
    </div>
    @endforeach
</div>
@stop