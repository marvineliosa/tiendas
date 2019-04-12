@extends('plantillas.menu')
@section('title','Listado')
@section('tittle_page','Listado de Espacios')

@section('content')
	<div class="row">
	  <div class="col-md-12 col-sm-12 col-xs-12">
	    <div class="x_panel">
	      <div class="x_title">
	        <h2>Listado de espacios</h2>
	        <button type="button" class="btn btn-primary pull-right" onclick="ModalAgregarEspacio()">Registrar Espacio</button>
	        <div class="clearfix"></div>
	      </div>
	      <div class="x_content">
	      	<div id="div_tabla_datos">
	      		@include('tablas.tabla_listado_espacios')
	      	</div>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- modal agregar producto -->
    <div class="modal fade" id="ModalAgregarEspacio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nuevo Espacio</h5>
              
          </div>
          <div class="modal-body">
          	<div class="form-horizontal form-label-left">

	          	<!-- nombre del producto -->
	            <div class="form-group">
	              <label class="control-label col-md-2 col-sm-2 col-xs-12">Nombre*</label>
	              <div class="col-md-10 col-sm-10 col-xs-12">
	                <input type="text" class="form-control" placeholder="" id="nuevo-nombre_espacio">
	              </div>
	            </div>

	          	<!-- nombre del producto -->
	            <div class="form-group">
	              <label class="control-label col-md-2 col-sm-2 col-xs-12">Ubicación*</label>
	              <div class="col-md-10 col-sm-10 col-xs-12">
	                <input type="text" class="form-control" placeholder="" id="nuevo-ubicacion_espacio">
	              </div>
	            </div>

	            <!-- Género -->
	            <div class="form-group">
	              <label class="control-label col-md-2 col-sm-2 col-xs-12">Tipo*</label>
	              <div class="col-md-5 col-sm-5 col-xs-12" id="">
	                <select class="form-control" id="nuevo-select_tipo_espacio">
	                  <option value="SELECCIONAR">--Seleccionar--</option>
	                  <option value="TIENDA">TIENDA</option>
	                  <option value="BODEGA">BODEGA</option>
	                </select>
	              </div>
	            </div>

        	</div><!-- fin div form -->
          </div>
          <div class="modal-footer">
        	<button type="button" class="btn btn-primary" onclick="RegistrarEspacio()">Registrar Espacio</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('script')
	
<script type="text/javascript">
	
	function ModalAgregarEspacio(){
		$("#nuevo-nombre_espacio").val('');
		$("#nuevo-ubicacion_espacio").val('');
		$("#nuevo-select_tipo_espacio").val('SELECCIONAR');
		$("#ModalAgregarEspacio").modal();
	}

	function RegistrarEspacio(){
		var nombre = $("#nuevo-nombre_espacio").val();
		var ubicacion = $("#nuevo-ubicacion_espacio").val();
		var tipo = $("#nuevo-select_tipo_espacio").val();
		var success;
		var url = "/espacios/registrar";
		var dataForm = new FormData();
		dataForm.append('nombre',nombre);
		dataForm.append('ubicacion',ubicacion);
		dataForm.append('tipo',tipo);
		//lamando al metodo ajax
		metodoAjax(url,dataForm,function(success){
		//aquí se escribe todas las operaciones que se harían en el succes
		//la variable success es el json que recibe del servidor el método AJAX
			MensajeModal("¡ÉXITO!","Espacio registrado satisfactoriamente.");
		});
	}
</script>
@endsection