<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <title>Phisqa Warmis - @yield('title')</title>

    <!-- CSS -->
    <link href="{{asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
    <link href="{{asset('assets/build/css/custom.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">

    <!-- <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script> -->

  </head>


  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title">
                <span> <b>Phisqa Warmis</b> </span>
              </a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_info" style="text-align:center;">
                <h2>{{ auth()->user()->name }}</h2>
                <h6> <b> {{ strtoupper(auth()->user()->tipo) }} </b></h6>
              </div>
            </div>
            <!-- /menu profile quick info -->
            <br />
            <!-- sidebar menu -->
            @include('menu')
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                  <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                      <img src="{{asset('/assets/images/user.png')}}" alt="">{{ auth()->user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item"  href="{{asset('index.php/logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out" aria-hidden="true"></i> Cerrar Sesion
                      </a>
                      <form id="logout-form" action="{{asset('index.php/logout')}}" method="POST" class="d-none">
                        @csrf 
                      </form>
                      <a class="dropdown-item"  href="{{asset('index.php/change')}}" >
                        <i class="fa fa-key" aria-hidden="true"></i>Cambiar Clave
                      </a>
                    </div>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        <!-- /top navigation -->
        <div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="">
                  <div class="x_content">

                    <div class="row">
                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-shopping-cart"></i>
                          </div>
                          <div class="count">
                            {{ \App\Models\Venta::where('id_cierre', '=', '0')->sum('total') }} Bs.
                          </div>
                          <h3>Total Ventas</h3>
                        </div>
                      </div>
                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-cutlery"></i>
                          </div>
                          <div class="count">
                            {{ \App\Models\Venta::where('id_cierre', '=', '0')->count() }}
                          </div>
                          <h3>Cantidad de Ventas</h3>
                        </div>
                      </div>
                      
                      <!--<div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-cutlery"></i>
                          </div>
                          <div class="count">14</div>
                          <h3>Bubble Tea</h3>
                        </div>
                      </div>
                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-cutlery"></i>
                          </div>
                          <div class="count">9</div>
                          <h3>Topping´s </h3>
                        </div>
                      </div>-->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  @yield('cuerpo')
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

        @yield('cambiomesa')
        
    <!-- JS -->
    <script src="{{asset('assets/vendors/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/vendors/fastclick/lib/fastclick.js')}}"></script>
    <script src="{{asset('assets/vendors/nprogress/nprogress.js')}}"></script>
    <script src="{{asset('assets/vendors/Chart.js/dist/Chart.min.js')}}"></script>
    <script src="{{asset('assets/vendors/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('assets/vendors/Flot/jquery.flot.js')}}"></script>
    <script src="{{asset('assets/vendors/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('assets/vendors/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{asset('assets/vendors/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{asset('assets/vendors/Flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{asset('assets/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{asset('assets/vendors/flot.curvedlines/curvedLines.js')}}"></script>
    <script src="{{asset('assets/vendors/DateJS/build/date.js')}}"></script>
    <script src="{{asset('assets/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('assets/build/js/custom.min.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    @yield('script')
  </body>
</html>
