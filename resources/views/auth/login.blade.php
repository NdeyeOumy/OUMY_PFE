<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AUTHENTIFICATION</title>

    <meta name="csrf-token" content="{{ csrf_token()}}">

    <!-- Bootstrap -->
    <link href="{{ asset('bo/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('bo/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('bo/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{ asset('bo/vendors/animate.css/animate.min.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('bo/build/css/custom.min.css') }}" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="{{ route('bo.login.auth')}}" method="POST">
              <h1>AUTHENTIFICATION</h1>

              @csrf

              <div>
                <input type="text" name="username" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <button class="btn btn-primary submit" >Se Connecter</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />
                <div>
                  <p>©{{date ('Y')}} Tous droits réservés. SGCU Portail est un modèle basé sur Bootstrap 4. Confidentialité et conditions d'utilisation.</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
