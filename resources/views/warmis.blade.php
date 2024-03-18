<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with Pigga landing page.">
    <meta name="author" content="Devcrud">
    <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->
    <title>Phisqa Warmis</title>
    <!-- font icons -->
    <link rel="stylesheet" href="{{asset('assets/vendors/themify-icons/css/themify-icons.css')}}">
    <!-- Bootstrap + Pigga main styles -->
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
                  <button class="btn btn-primary circle"><i class="ti-user"></i> sss</button>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                  <button class="btn btn-primary circle"><i class="ti-layout-grid2-alt"></i>  ssss</button>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                  <button class="btn btn-primary circle"><i class="ti-shopping-cart"></i></button>
                </li>
            </ul>
        </div>
    </nav>

    <section class="has-img-bg">
        <div class="container">
            @yield('logo')
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
                                    <img src="{{asset('assets/imgs/t4.jpg')}}" class="circle-120 rounded-circle mb-3 shadow" alt="PisqWarmis" id="pedidoImg">
                                    <h5 class="my-3" id="pedidoTitulo">Titulo</h5>
                                    <h6 id="pedidoPercio">Titulo</h6>
                                    <div class="row mt-5">
                                    <div class="col-md-4">
                                        <br><br>
                                        <div>
                                            <p class="btn btn-primary circle"  id="idMenos"><i class="ti-minus"></i></p>
                                        </div>  
                                    </div>
                                    <div class="col-md-4">
                                        <h6 class="section-secondary-title">Cantidad:</h6>   
                                        <div class="form-group">
                                            <input type="hidden" id="pedidoId">
                                            <input type="text" class="form-control" id="pedidoCantidad" value="0" aria-describedby="emailHelp" placeholder="0">
                                        </div>
                                        </div>
                                        <div class="col-md-4">
                                            <br>
                                            <br>
                                        <p class="btn btn-primary circle" id="idMas"><i class="ti-plus"></i></p>
                                        </div>
                                    </div>       
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
		      </div>
		      <div class="modal-footer mt-0">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		        <button type="button" class="btn btn-primary">Guardar</button>
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
</body>
</html>
