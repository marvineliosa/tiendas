@extends('plantillas.menu')
@section('title','Inventario')
@section('tittle_page','Inventario')

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
                  <th scope="row">Código</th>
                  <th>Producto</th>
                  <th>Precio</th>
                  <th>Cantidad</th>
                  <!-- <th>Acciones</th> -->
                </tr>
              </thead>
              <tbody>
                @foreach($productos as $producto)
                  <tr>
                    <td> {{$producto->DATOS_VENTA_FK_PROCUTO}} </td>
                    <td> {{$producto->NOMBRE_PRODUCTO}} </td>
                    <td> PRECIO </td>
                    <td> {{$producto->DATOS_VENTA_CANTIDAD}} </td>
                    <!-- <td>
                      Acciones
                    </td> -->
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