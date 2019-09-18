@extends('plantillas.menu')
@section('title','Usuarios')
@section('tittle_page','Listado de usuarios')

@section('content')

	<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <!-- <h2>Seccion 1 de la página</h2> -->
          <button type="button" class="btn btn-primary pull-right" onclick="ModalRegistrarUsuario()">Registrar Usuario</button>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <table class="table table-hover" id="TablaDatos">
            <thead>
              <tr>
                <th>Responsable</th>
                <th>Usuario</th>
                <th>Categoría</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($usuarios as $usuario)
                <tr>
                  <td> {{$usuario->RESPONSABLE}} </td>
                  <td> {{$usuario->UAURIO}} </td>
                  <td> {{$usuario->CATEGORIA}} </td>
                  <td>
                    <button type="button" class="btn btn-default btn-xs" onclick="ModalEnviarContrasena({!!$usuario->UAURIO!!},{!!$usuario->CATEGORIA!!})" data-toggle="tooltip" data-placement="top" title="ENVIAR CONTRASEÑA">
                      <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
                    </button>
                    <button type="button" class="btn btn-default btn-xs" onclick="ModalEliminarUsuario({!!$usuario->UAURIO!!})" data-toggle="tooltip" data-placement="top" title="ELIMINAR USUARIO">
                      <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

    <!-- modal traspasar producto -->
    <div class="modal fade" id="ModalCrearUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Movilizar Inventario</h5>
          </div>
          <div class="modal-body">
            <div class="form-horizontal form-label-left">
              <!-- nombre del responsable -->
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Nombre</label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                  <input type="text" class="form-control" placeholder="Nombre del responsable" id="NombreUsuario">
                </div>
              </div>
              <!-- nombre del Usuario -->
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Usuario</label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                  <input type="text" class="form-control" placeholder="Nombre de usuario o correo electrónico" id="Usuario">
                </div>
              </div>
              <!-- Tipo de Usuario -->
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Categoría</label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                  <select class="form-control" id="SelectCategoria" onchange="CambioCategoria(this)">
                    <option value="NADA">--SELECCIONAR--</option>
                    <option value="CAJERO">CAJERO</option>
                    <option value="ENCARGADO">ENCARGADO</option>
                    <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                  </select>
                </div>
              </div>
              <!-- Tipo de Usuario -->
              <div class="form-group" hidden="true" id="div_espacios">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Espacio</label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                  <select class="form-control" id="SelectEspacio">
                    <option value="NADA">--SELECCIONAR--</option>
                  </select>
                </div>
              </div>

            </div><!-- fin div form -->
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="BtnRegistrarUsuario" onclick="RegistrarUsuario()">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('script')
  <script type="text/javascript">
    LlenaEspacios();
    function ModalRegistrarUsuario(){
      $("#ModalCrearUsuario").modal();
    }

    function CambioCategoria(elemento){
      if($(elemento).val()=='CAJERO'){
        $("#SelectEspacio").val('NADA');
        $("#div_espacios").show();
      }else{
        $("#div_espacios").hide();
      }
    }

    function RegistrarUsuario(){
      var nombre = $("#NombreUsuario").val();
      var usuario = $("#Usuario").val();
      var categoria = $("#SelectCategoria").val();
      var espacio = $("#SelectEspacio").val();
      if(nombre == ''){
        MensajeModal('¡ATENCIÓN!','Debe registrar el nombre del usuario');
      }else if(usuario == ''){
        MensajeModal('¡ATENCIÓN!','Debe registrar el usuario con el que se iniciará sesión');
      }else if(categoria == 'NADA'){
        MensajeModal('¡ATENCIÓN!','Debe seleccionar una categoría');
      }else if(categoria == 'CAJERO' && espacio == 'NADA'){
        MensajeModal('¡ATENCIÓN!','Debe seleccionar una tienda para el usuario');
      }else{
        var success;
        var url = "/usuarios/registrar";
        var dataForm = new FormData();
        dataForm.append('nombre',nombre);
        dataForm.append('usuario',usuario);
        dataForm.append('categoria',categoria);
        dataForm.append('espacio',espacio);
        //lamando al metodo ajax
        metodoAjax(url,dataForm,function(success){
          //aquí se escribe todas las operaciones que se harían en el succes
          //la variable success es el json que recibe del servidor el método AJAX
          MensajeModal("¡ATENCIÓN!",success['mensaje']);

        });
      }
    }

    function LlenaEspacios(){
      var espacios = <?php echo json_encode($espacios) ?>;
      console.log(espacios);
      for(var i=0; i<espacios.length; i++){
        if(espacios[i]['TIPO_ESPACIO'] == 'TIENDA'){
          $("#SelectEspacio").append(
            '<option value="'+ espacios[i]['ID_ESPACIO'] +'">'+espacios[i]['NOMBRE_ESPACIO']+'</option>'
          );
        }
      }
    }

    function ejemploAjax(){
      var success;
      var url = "/ruta1/ruta2";
      var dataForm = new FormData();
      dataForm.append('p1',"p1");
      dataForm.append('p2','p2');
      //lamando al metodo ajax
      metodoAjax(url,dataForm,function(success){
        //aquí se escribe todas las operaciones que se harían en el succes
        //la variable success es el json que recibe del servidor el método AJAX
        MensajeModal("TITULO DEL MODAL","MENSAJE DEL MODAL");
      });
    }
  </script>
@endsection