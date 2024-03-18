@extends('warmis')

@section('logo1')
<img src="{{asset('assets/img/'.$dato->logo)}}" alt="">
@stop

@section('fondo')
{{ asset('assets/img/'.$dato->fondo) }}
@stop


@section('titulo')
{{$dato->menu}}
@stop

@section('cuerpo')

<div class="row">
    @foreach($menus as $menu)
        <div class="col-md-12 mb-4">
            <div class="custom-list">
                <div class="img-holder">
                    <img src="{{ asset('assets/img/' . $menu->img) }}" alt="">
                </div>
                <div class="info">
                    <div class="head clearfix">
                        <h5 class="title float-left"> {{$menu->submenu}} </h5>
                        <div class="">
                            <a href="#" onclick="pedido('{{$menu->id}}')" class="" data-toggle="modal" >
                                <p class="float-right  text-primary" > Bs. {{$menu->precio_venta}} </p>
                            </a>
                        </div>
                    </div>
                    <div class=" col-md-9">
                        <p>{{$menu->descripcion}}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>          
@stop
@section('script')
<script>
    $( document ).ready(function() {
        
        $.ajax({
            url: "{{asset('index.php/Phisqa/comprasVer')}}",
            type: 'GET',
            success: function(response) {
                compras = response;
                console.log(compras);
            },
            error: function(xhr, status, error) {
                console.error(xhr, status, error);
            }
        });
    });

    $('#idMas').on('click', function() {
        var numero = $('#pedidoCantidad').val();
        $('#pedidoCantidad').val( parseInt(numero) + parseInt(1) );
    });

    $('#idMenos').on('click', function() {
        var numero = $('#pedidoCantidad').val();
        $('#pedidoCantidad').val(parseInt(numero) - parseInt(1) );
    });
    
    function pedido(id){
        $.ajax({
            url: "{{asset('index.php/PhisqaWarmis/detalle/')}}/"+id,
            type: 'GET',
            success: function(response) {
                var titulo = response.submenu;
                var precio = response.precio;
                var img = "{{ asset('assets/img/') }}/"+response.img;
                var encontrado = false;
                var idBuscado = id;
                for (var i = 0; i < compras.length; i++) {
                    if (compras[i].id === idBuscado) {
                        encontrado = true; 
                        break; 
                    }
                }

                if (!encontrado) {
                    compras.push({ id:id , titulo:titulo, img:img, cantidad:0, precio:precio, total:0 } );
                }

                $('#pedidoImg').attr('src', img);
                $('#pedidoId').text(id);
                $('#pedidoTitulo').text(titulo);
                $('#pedidoPrecio').text(precio);
                $('#pedidoCantidad').text(precio);
                $('#pedidoTotal').text(precio);
                console.log(compras);

                $('#exampleModalLong').modal('show');
            },
            error: function(xhr, status, error) {
                console.error(xhr, status, error);
            }
        });



    }


    function guardar(){
        var json = JSON.stringify(compras);
        $.ajax({
            url: "{{asset('index.php/Phisqa/comprasSet')}}",
            type: 'POST',
            dataType: 'json',
            data: {
                json: json 
            },
            success: function(response) {
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }


</script>
@stop