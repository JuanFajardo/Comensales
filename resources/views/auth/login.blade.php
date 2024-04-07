<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">-->
    <title>Bubble Tea</title>
    <link href="{{asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendors/animate.css/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/build/css/custom.min.css')}}" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <br />
          <section class="login_content">
            <div>
              <span class="image">
                <img src="{{asset('assets/images/img11.png')}}" alt="img" />
              </span>
            </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-10 col-form-label text-md-end">Usuario</label>

                            <div class="col-md-10">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <label for="password" class="col-md-10 col-form-label text-md-end">Contraseña</label>

                            <div class="col-md-10">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-11">
                                <button type="submit" class="btn btn-primary"> Iniciar Session </button>
                            </div>
                        </div>
                    </form>
              
          </section>
        </div>
        
      </div>
    </div>
  </body>
</html>

