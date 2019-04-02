<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Inicio de sesión</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">

    <style type="text/css">
      body, html {
        height: 100%;
        margin: 0;
      }

      .bg {
        /* The image used */
        background-image: url("images/fondo_login-1.jpg");

        /* Full height */
        height: 100%; 

        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }
      .center {
        width: auto;
        height: auto;
        padding: 20px;

        position: absolute;
        top: 25%;
        left: 37%;

        margin: -70px 0 0 -170px;
      }
    </style>
  </head>

  <body class="bg">
      <div class="container">
        <div class="panel panel-default col-md-3 center">
          <div class="panel-body">
            <section class="login_content">
            <form>
              <h1>Inicio de Sesión</h1>
              <div>
                <input type="text" class="form-control" placeholder="Usuario" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Contraseña" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="solicitudes">Iniciar Sesión</a>
                <a class="reset_pass" href="#">Recuperar contraseña</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
              <!--  <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>
              -->
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class=""></i> Tienda Lobos</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
          </div>
        </div>
      </div>

    </div>
  </body>
</html>
