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
                        <h3 class="title float-left" style="font-size:20px;"> {{ strtoupper($menu->submenu) }} </h3>
                        <div class="">
                            <a href="#" onclick="pedido('{{$menu->id}}')" class="" data-toggle="modal" >
                                <p class="float-right text-primary" > <b style="font-size:20px; color:yellow;">Bs. {{$menu->precio_venta}}</b>  </p>
                            </a>
                        </div>
                    </div>
                    <div class=" col-md-9">
                        <p>  {{$menu->descripcion}}  </p>
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

    /// Funcion que multiplica el boton menos o mas para sacar el total
    function pedidoTotal(cantidad, tipo){
        var precio = parseInt( $('#pedidoPrecioText').val() )
        var id  = $('#pedidoId').val();
        var total =  (precio * cantidad)
        $('#pedidoTotal').text("Total "+ total + " Bs.");
        for (var i = 0; i < compras.length; i++) {
            if (compras[i].id === id) { 
                compras[i].cantidad = cantidad;
                compras[i].total = total;
                break;
            }
        }
    }

    ////// Boton mas del pedido
    $('#idMas').on('click', function() {
        var numero = $('#pedidoCantidad').val();
        var cantidad = parseInt(numero) + parseInt(1)
        $('#pedidoCantidad').val( cantidad );
        pedidoTotal(cantidad, 'mas');
    });
    ////// Boton menos del pedido
    $('#idMenos').on('click', function() {
        var numero = $('#pedidoCantidad').val();
        if( parseInt(numero) > 0 ){
            var cantidad = parseInt(numero) - parseInt(1);
            $('#pedidoCantidad').val( cantidad );
            pedidoTotal(cantidad, 'menos');
        }
    });
    
    ////// Guardar la compra de cada producto por el controlador en el carrito se vera el resuemn y gestion de todo
    function guardar(){
        //alert(compras)
        var json = JSON.stringify(compras);
        var token = $('meta[name="csrf-token"]').attr('content'); // Obtener el token CSRF
            $.ajax({
                url: "{{asset('index.php/Phisqa/comprasSet')}}",
                type: 'POST',
                dataType: 'json',
                data: {
                json: json,
                _token: token
            },
            success: function(response) {
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
        $('#exampleModalLong').modal('hide');
        $('#pedidoId').val("");
        $('#pedidoCantidad').val("0");
    }

    ///// Cancelar pedido
    function cancelar(){
        $('#exampleModalLong').modal('hide');
        //var id  = $('#pedidoId').val();
        $('#pedidoId').val("");
        $('#pedidoCantidad').val("0");        
    }

    ///Hacer pedido abrir modal de producto
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
                $('#pedidoId').val(id);
                $('#pedidoTitulo').text(titulo.toUpperCase());
                $('#pedidoPrecio').text("Precio "+ precio + " Bs.");
                $('#pedidoPrecioText').val(precio);
                $('#pedidoTotal').text("Total ");
                console.log(compras);
                $('#exampleModalLong').modal('show');
            },
            error: function(xhr, status, error) {
                console.error(xhr, status, error);
            }
        });
    }

    ////// funcion buscar producto
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