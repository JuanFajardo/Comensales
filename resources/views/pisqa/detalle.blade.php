@extends('warmis')

@section('logo1')
<img src="{{asset('assets/img/'.$dato->logo)}}" alt="">
@stop

@section('fondo')
{{ asset('assets/img/'.$dato->fondo) }}
@stop

@section('titulo')
<!-- {{$dato->menu}} -->
<input type="text" name="buscar" id="buscar" class="form-control"  >
<input type="hidden" name="idmenu" id="idmenu" value="{{$dato->id}}">
@stop

@section('cuerpo')

<div class="row" id="cuerpomenu">
    @foreach($menus as $menu)
        <div class="col-md-12 mb-4">
            <div class="custom-list">
                <div class="img-holder">
                    <img src="{{ asset('assets/img/' . $menu->img) }}" alt="">
                </div>
                <div class="info">
                    <div class="head clearfix">
                        <h5 class="title float-left"> {{ strtoupper($menu->submenu) }} </h5>
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
                var precio = response.precio_venta;
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
                $('#pedidoTitulo').text(titulo.toUpperCase());
                $('#pedidoPrecio').text(precio + " Bs.");
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


    $('#buscar').on('input', function() {
        var dato = $(this).val(); 
        var idmenu = $('#idmenu').val();
        var link = "{{asset('index.php/PhisqaBuscar/')}}/"+idmenu+"/"+dato;
        if (dato.length > 3) {
            $('#cuerpomenu').html("");
            $.get(link, function(response) {
                var principal = "";
                for(var i=0; i<response.length; i++){
                    principal = principal + "<div class=\"col-md-12 mb-4\">";
                    principal = principal + "    <div class=\"custom-list\">";
                    principal = principal + "        <div class=\"img-holder\">";
                    principal = principal + "            <img src=\"{{ asset('assets/img/') }}/"+response[i]['img']+"\" >";
                    principal = principal + "        </div>";
                    principal = principal + "        <div class=\"info\">";
                    principal = principal + "            <div class=\"head clearfix\">";
                    principal = principal + "                <h5 class=\"title float-left\"> "+response[i]['submenu']+" </h5>";
                    principal = principal + "                <div class=\"\">";
                    principal = principal + "                    <a href=\"#\" onclick=\"pedido('"+response[i]['id']+"')\" class=\"\" data-toggle=\"modal\" >";
                    principal = principal + "                        <p class=\"float-right  text-primary\" > Bs. "+response[i]['precio_venta']+"  </p>";
                    principal = principal + "                    </a>";
                    principal = principal + "                </div>";
                    principal = principal + "            </div>";
                    principal = principal + "            <div class=\" col-md-9\">";
                    principal = principal + "                <p> "+response[i]['descripcion']+" </p>";
                    principal = principal + "            </div>";
                    principal = principal + "        </div>";
                    principal = principal + "    </div>";
                    principal = principal + "</div>";
                }
                $('#cuerpomenu').html(principal);
                }, 'json').fail(function(xhr, status, error) {
                // Manejar errores
                console.error('Error:', error);
            });


        }
    });

</script>
@stop