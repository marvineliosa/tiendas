@extends('plantillas.menu')
@section('title','Usuarios')
@section('tittle_page','Listado de usuarios')

@section('content')

	<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <!-- <h2>Seccion 1 de la página</h2> -->
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
@endsection

@section('script')
  <script type="text/javascript">
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