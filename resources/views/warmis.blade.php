@php
$config = \App\Models\Config::first(); // Asume que solo hay un registro
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with Pigga landing page.">
    <meta name="author" content="Juan Fajardo, Elena Taboada">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">-->
    <title> {{$config->titulo}} </title>
    <link rel="stylesheet" href="{{asset('assets/vendors/themify-icons/css/themify-icons.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/pigga.css')}}">
    <style>
        section.pattern-style-4 {
            background-image: url(@yield('fondo'));
        }
        section.has-img-bg {
            position: relative;
            background: url(@yield('fondo')) no-repeat center top fixed;
            background-size: 80%;
            color: #fff;
        }   
    </style>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">

    <nav class="navbar nav-first navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{asset('index.php/PhisqaWarmis')}}">
                @yield('logo1')
            </a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <button class="btn btn-primary circle" data-toggle="modal" data-target="#mesasModal" >
                        <i class="ti-layout-grid2-alt"></i>  
                    </button>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item" style="color:white;">
                  @if (Session::has('mesa') ) 
                    {{ trim(explode(",", Session::get('mesa') )[0]) }} <b>| </b>
                    {{ trim(explode(" ", Session::get('cliente') )[0]) }} <b>| </b>
                    {{ trim(explode(" ", Session::get('comenzales') )[0]) }}
                  @else
                    Sin Mesa
                  @endif
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                  <a href="{{asset('index.php/factura')}}" class="btn btn-primary circle"><i class="ti-shopping-cart"></i></a>
                </li>
            </ul>
        </div>
    </nav>

    <section class="has-img-bg">
        <div class="container">
            <h3 class="section-title mb-6 text-center">@yield('titulo')</h3>
            @yield('cuerpo')
        </div>
    </section>

    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLongTitle">Pedido</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="team-wrapper text-center">
                                <form>
                                    <img src="{{asset('assets/imgs/t4.jpg')}}" class="circle-120 rounded-circle mb-3 shadow"  id="pedidoImg">
                                    <h5 class="my-3" id="pedidoTitulo">Titulo</h5>
                                    <h6 id="pedidoPrecio">Precio</h6>
                                    <p id="pedidoTotal">Total </p>
                                    <div class="row mt-5">
                                    <div class="col-md-4">
                                        <br><br>
                                        <div>
                                        <p class="btn btn-primary circle" id="idMas"><i class="ti-plus"></i></p>
                                        </div>  
                                    </div>
                                    <div class="col-md-4">
                                        <h6 class="section-secondary-title">Cantidad:</h6>   
                                        <div class="form-group">
                                            <input type="hidden" id="pedidoPrecioText">
                                            <input type="hidden" id="pedidoId">
                                            <input type="text" class="form-control" id="pedidoCantidad" value="0" aria-describedby="emailHelp" placeholder="0">
                                        </div>
                                        </div>
                                        <div class="col-md-4">
                                            <br>
                                            <br>
                                        <p class="btn btn-primary circle"  id="idMenos"><i class="ti-minus"></i></p>
                                        </div>
                                    </div>       
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
		      </div>
		      <div class="modal-footer mt-0">
                <button type="button" class="btn btn-secondary" onclick="cancelar()" >Cancelar</button>
                <input type="text" value="" class="form-control" name="comentario_pedido" id="comentario_pedido" placeholder="Sin pedido especial">
		        <button type="button" class="btn btn-secondary" onclick="guardar('llevar')" >Llevar</button>
		        <button type="button" class="btn btn-primary" onclick="guardar('mesa')">Mesa</button>
		      </div>
		    </div>
		  </div>
		</div>
        

        <!-- Modal Mesas-->
        <div class="modal fade" id="mesasModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Elegir Mesa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <form autocomplete="off" id="seleccionMesa">
                                        <div class="team-wrapper text-center">
                                            <div class="form-group">
                                                <label for="exampleSelect1">Mesa:</label>
                                                <input type="text" class="form-control" name="mesa" id="mesa" list="lista_mesa" required>
                                                <datalist id="lista_mesa">
                                                    @foreach($mesas as $mesa)
                                                        @if($mesa->ocupado == "0")
                                                            <option value="{{$mesa->mesa}}, {{$mesa->id}}"></option>
                                                        @else
                                                            <option value="{{$mesa->mesa}}, {{$mesa->id}}, {{$mesa->ocupado}}"></option>
                                                        @endif
                                                    @endforeach
                                                </datalist>
                                                <div id="mesa-error" class="text-danger" style="display: none;">Por favor seleccione una mesa</div>
                                            </div>
                                        </div>
                                        <div class="team-wrapper text-center">
                                            <div class="form-group">
                                                <label for="exampleSelect1">Cliente:</label>
                                                <input type="text" class="form-control" name="cliente" id="cliente" list="lista_cliente" required>
                                                <datalist id="lista_cliente">
                                                    @foreach($clientes as $cliente)
                                                        <option value="{{$cliente->cliente}}, {{$cliente->nit}}"></option>
                                                    @endforeach
                                                </datalist>
                                                <div id="cliente-error" class="text-danger" style="display: none;">Por favor seleccione un cliente</div>
                                            </div>
                                        </div>
                                        <div class="team-wrapper text-center">
                                            <div class="form-group">
                                                <label for="exampleSelect1">Comensales:</label>
                                                <input type="number" class="form-control" name="comensales" id="comensales" value="1" required>
                                                <div id="comensales-error" class="text-danger" style="display: none;">Por favor ingrese el número de comensales</div>
                                                <br>
                                                <a href="#" class="btn btn-primary" onclick="seleccionarMesa()"> Seleccionar</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Cambiar pedido -->
    <div class="modal fade" id="pedidoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Cambiar Pedido</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                <form autocomplete="off" action="{{ route('pisqa.actualizarPedido') }}" method="POST" >
                                    @csrf
                                    <div class="team-wrapper text-center">
                                        <div class="form-group">
                                            <label for="exampleSelect1">Cantidad :</label>
                                            <input type="text" class="form-control" name="cantidad" id="cantidad">
                                            <input type="hidden" name="id_mesa" id="id_mesa" value="">
                                            <input type="hidden" name="id_venta" id="id_venta" value="">
                                            <input type="hidden" name="ruta" id="ruta" value="">
                                            <button type="submit" class="btn btn-warning"> Actualizar</button>
                                        </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <script src="{{asset('assets/vendors/jquery/jquery-3.4.1.js')}}"></script>
    <script src="{{asset('assets/vendors/bootstrap/bootstrap.bundle.js')}}"></script>
    <script src="{{asset('assets/vendors/bootstrap/bootstrap.affix.js')}}"></script>
    <script src="{{asset('assets/js/pigga.js')}}"></script>
    <script>
      var compras = [];
    </script>
    @yield('script')
    <script>
    $('#mesa').on('change', function() {
        var mesa = $('#mesa').val();
        var id = mesa.split(',')[1]?.trim();
        var url = "{{ route('pisqa.cargarcookies', ':id') }}".replace(':id', id);
        $.get(url, function(response) {
            $('#cliente').val(response.cliente);
            $('#comensales').val(response.comensales);
        });
    });

    function seleccionarMesa() {
        var mesa = $('#mesa').val().trim();
        var cliente = $('#cliente').val().trim();
        var comensales = $('#comensales').val().trim();
        $('#mesa-error').hide();
        $('#cliente-error').hide();
        $('#comensales-error').hide();
        var isValid = true;
        if (mesa === "") {
            $('#mesa-error').show();
            isValid = false;
        }
        if (cliente === "") {
            $('#cliente-error').show();
            isValid = false;
        }
        if (comensales === "" || comensales === "0") {
            $('#comensales-error').show();
            isValid = false;
        }
        if (!isValid) {
            return false;
        }
        if (cliente.length < 1) {
            cliente = "0";
            comensales = "0";
        }
        $.ajax({
            url: "{{asset('index.php/PhisqaSession/setMesa/')}}/"+mesa+";"+cliente+";"+comensales,
            type: 'GET',
            success: function(response) {
                setTimeout(function() {
                    location.reload();
                }, 1000);
            },
            error: function(xhr, status, error) {
                console.error(xhr, status, error);
                alert('Ocurrió un error al asignar la mesa');
            }
        });
    }
    </script>
    <script>
        let inactivityTimer;
        const inactivityTimeout = 60000;
        function resetInactivityTimer() {
            clearTimeout(inactivityTimer);
            inactivityTimer = setTimeout(() => {
                alert('Actualice los datos de mesa, cliente, comenzales')
                var url = "{{ route('pisqa.limpiarcookies') }}";
                $.get(url, function(response) {
                    location.reload();
                });
                
            }, inactivityTimeout);
        }
        ['mousemove', 'keydown', 'click', 'scroll', 'touchstart'].forEach(event => {
            window.addEventListener(event, resetInactivityTimer);
        });
        document.addEventListener('DOMContentLoaded', resetInactivityTimer);
        document.addEventListener('visibilitychange', () => {
            if (!document.hidden) {
                resetInactivityTimer();
            }
        });
    </script>
</body>
</html>
