<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Inicio de sesión</title>

    <!-- jQuery -->
    <script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container">
      <div class="panel panel-default col-md-3 center">
        <div class="panel-body">
          <section class="login_content">
          <form>
            <h1>Inicio de Sesión</h1>
            <div>
              <input type="text" class="form-control" placeholder="Usuario" required="" id="usuario" />
            </div>
            <div>
              <input type="password" class="form-control" placeholder="Contraseña" required="" id="contrasena" />
            </div>
            <div>
              <a class="btn btn-default submit" href="javascript:void(0)" onclick="ValidarUsuario()">Iniciar Sesión</a>
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
  <!-- Modal mensaje -->
  <div class="modal fade" id="ModalMensaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="TituloModalMensaje" align="center"></h2>
          <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>-->
        </div>
        <div class="modal-body">
          <h3  id="CuerpoModalMensaje" align="center"> </h3>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Carga-->
    <div class="modal fade" id="modalCarga" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div align="center">
          <img src="{{ asset('images/carga3.gif') }}" class="img-rounded" alt="Cinque Terre">
        </div>
      </div>
    </div>
</html>

<script type="text/javascript">
  function ValidarUsuario(){
    var usuario = $("#usuario").val();
    var contrasena = $("#contrasena").val();
    var dataForm = new FormData();
    dataForm.append('usuario',usuario);
    dataForm.append('contrasena',contrasena);
    var url = "/usuarios/validar";
    $.ajax({
      url :url,
      data : dataForm,
      contentType:false,
      processData:false,
      headers:{
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
      type: 'POST',
      dataType : 'json',
      beforeSend: function (){
        $("#modalCarga").modal();
      },
      success : function(json){
        if(json['exito']){
          switch(json['categoria']){
            case 'ADMINISTRADOR':
              location.href='/productos';
            break;
            case 'ENCARGADO':
              location.href='/productos';
            break;

            case 'CAJERO':
              location.href='/venta';
            break;
          }
        }else{
          $("#TituloModalMensaje").text('¡ERROR!');
          $("#CuerpoModalMensaje").text('Existió un problema con la operación');
          $("#ModalMensaje").modal();
        }
      },
      error : function(xhr, status) {
        $("#TituloModalMensaje").text('¡ERROR!');
        $("#CuerpoModalMensaje").text('Existió un problema con la operación');
        $("#ModalMensaje").modal();
      },
      complete : function(xhr, status){
         $("#modalCarga").modal('hide');
      }
    });//*/
  }
</script>
