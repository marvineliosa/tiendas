@extends('plantillas.menu')
@section('title','Productos')
@section('tittle_page','Listado de Productos')

@section('content')
	<div class="row">
	  <div class="col-md-12 col-sm-12 col-xs-12">
	    <div class="x_panel">
	      <div class="x_title">
	        <h2>Listado de productos</h2>
	        <button type="button" class="btn btn-primary pull-right" onclick="ModalAgregarProducto()">Registrar Producto</button>
	        <div class="clearfix"></div>
	      </div>
	      <input type="" name="" style="display: none" id="id_producto" value="">
	      <div class="x_content">
	      	<div id="div_tabla_datos">
	      		@include('tablas.tabla_listado_productos')
	      	</div>
	      </div>
	    </div>
	  </div>
	</div>

  	

    <!-- modal agregar producto -->
    <div class="modal fade" id="ModalAgregarProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nuevo Producto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          	<div class="form-horizontal form-label-left">
	          	<!-- nombre del producto -->
	            <div class="form-group">
	              <label class="control-label col-md-2 col-sm-2 col-xs-12">Producto*</label>
	              <div class="col-md-10 col-sm-10 col-xs-12">
	                <input type="text" class="form-control" placeholder="" id="nombre_producto">
	              </div>
	            </div>

	            <!-- Color y Talla -->
	            <div class="form-group">
	              <label class="control-label col-md-2 col-sm-2 col-xs-12">Color</label>
	              <div class="col-md-4 col-sm-4 col-xs-12">
	                <input type="text" class="form-control" placeholder="" id="color_producto">
	              </div>

	              <label class="control-label col-md-2 col-sm-2 col-xs-12">Género*</label>
	              <div class="col-md-4 col-sm-4 col-xs-12">
	                <select class="form-control" id="select_genero" onchange="cambioTalla()">
	                  <option value="SELECCIONAR">--Seleccionar--</option>
	                  <option value="DAMA">DAMA</option>
	                  <option value="CABALLERO">CABALLERO</option>
	                  <option value="UNISEX">UNISEX</option>
	                </select>
	              </div>
	            </div>

	            <!-- Género -->
	            <div class="form-group">
	              <label class="control-label col-md-2 col-sm-2 col-xs-12">Talla*</label>
	              <div class="col-md-4 col-sm-4 col-xs-12" id="">
	                <select class="form-control" id="select_talla" onchange="cambioTalla(this)">
	                  <option value="SELECCIONAR">--Seleccionar--</option>
	                  <option value="XS">XS</option>
	                  <option value="S">S</option>
	                  <option value="M">M</option>
	                  <option value="L">L</option>
	                  <option value="XL">XL</option>
	                  <option value="XXL">XXL</option>
	                  <option value="OTRA">OTRA</option>
	                  <option value="SIN TALLA">NO APLICA</option>
	                </select>
	              </div>
	              <div style="display: none;" id="div_input_talla">
	              	<label class="control-label col-md-2 col-sm-2 col-xs-12">No. Talla*</label>
	              	<div class="col-md-4 col-sm-4 col-xs-12">
	                	<input type="number" class="form-control" placeholder="Especifique" id="otra_talla" min="0"  max='50' value='0'>
	                </div>
	              </div>
	            </div>
	            <!-- Existencias -->
	            <div class="form-group">
	              <div style="display: block;" id="div_input_talla">
	              	<label class="control-label col-md-2 col-sm-2 col-xs-12">Precio Inicial</label>
	              	<div class="col-md-4 col-sm-4 col-xs-12">
	                	<input type="number" class="form-control" placeholder="Precio" id="precio_inicial" min="0"  max='' value='' step=".01">
	                </div>
	              </div>
	            </div>
	            <!-- Observaciones -->
	            <div class="form-group">
	              <div style="display: block;" id="">
	              	<label class="control-label col-md-2 col-sm-2 col-xs-12">Observaciones</label>
	              	<div class="col-md-10 col-sm-10 col-xs-12">
                		<textarea class="form-control" id="observaciones_nuevo_producto" rows="3" placeholder="" style="resize:none;"></textarea>
	                </div>
	              </div>
	            </div>
        	</div><!-- fin div form -->
          </div>
          <div class="modal-footer">
        	<button type="button" class="btn btn-primary" onclick="RegistrarProducto()">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- modal agregar existencias -->
    <div class="modal fade" id="ModalAgregarExistencias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          	<div class="form-horizontal form-label-left">
	            <div class="form-group">
	              <label class="control-label col-md-2 col-sm-2 col-xs-12">Artículo</label>
	              <div class="col-md-4 col-sm-4 col-xs-12">
	                <input type="number" class="form-control" id="nota_venta_id_producto" min="0" value='' disabled>
	              </div>
	              <label class="control-label col-md-2 col-sm-2 col-xs-12">Cantidad*</label>
	              <div class="col-md-4 col-sm-4 col-xs-12">
	                <input type="number" class="form-control" placeholder="" id="nota_venta_cantidad" min="0" value=''>
	              </div>
	            </div>
	            <!-- Precio de compra y venta -->
	            <div class="form-group">
	              <label class="control-label col-md-2 col-sm-2 col-xs-12">Precio de compra*</label>
	              <div class="col-md-4 col-sm-4 col-xs-12">
	                <input type="number" class="form-control" placeholder="" id="nota_venta_precio_compra" min="0" value='' step=".10">
	              </div>

	              <label class="control-label col-md-2 col-sm-2 col-xs-12">Bodega destino*</label>
	              <div class="col-md-4 col-sm-4 col-xs-12" id="">
	                <select class="form-control" id="nota_venta_select_bodega">
	                  <option value="SELECCIONAR">--Seleccionar--</option>
	                  @foreach($bodegas as $bodega)
	                  	<option value=" {{$bodega->ESPACIO_ID}} "> {{$bodega->ESPACIO_NOMBRE}} ({{$bodega->ESPACIO_UBICACION}}) </option>
	                  @endforeach
	                </select>
	              </div>
	            </div>

	            <!-- Observaciones -->
	            <div class="form-group">
	              <label class="control-label col-md-2 col-sm-2 col-xs-12">Observaciones</label>
	              <div class="col-md-10 col-sm-10 col-xs-12">
	                <textarea class="form-control" id="nota_venta_observaciones" rows="3" placeholder="" style="resize:none;"></textarea>
	              </div>
	            </div>


        	</div><!-- fin div form -->
          </div>
          <div class="modal-footer">
        	<button type="button" class="btn btn-primary" onclick="agregarNotaVenta()">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
	<div class="modal fade" id="ModalCodigoBarras" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel"></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div align="center">
	        	<!--<img id="codigo" width="500" height="150"/>-->
	        	<img id="codigo"/>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-success" onclick="abrirCodigo()">Imprimir Código</button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>



    <!-- modal traspasar producto -->
    <div class="modal fade" id="ModalEditarProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
          </div>
          <div class="modal-body">
          	<div class="form-horizontal form-label-left">
	            <!-- Encabezado datos venta -->
	            <div class="form-group">
	              	<div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
	              		<h2>Datos del producto</h2>
	              	</div>
	            </div>
	          	<!-- nombre del producto -->
	            <div class="form-group">
	              <label class="control-label col-md-2 col-sm-2 col-xs-12">Producto*</label>
	              <div class="col-md-10 col-sm-10 col-xs-12">
	                <input type="text" class="form-control" placeholder="" id="edicion_nombre_producto">
	              </div>
	            </div>

	            <!-- Color y Talla -->
	            <div class="form-group">
	              <label class="control-label col-md-2 col-sm-2 col-xs-12">Color</label>
	              <div class="col-md-4 col-sm-4 col-xs-12">
	                <input type="text" class="form-control" placeholder="" id="edicion_color_producto">
	              </div>

	              <label class="control-label col-md-2 col-sm-2 col-xs-12">Género*</label>
	              <div class="col-md-4 col-sm-4 col-xs-12">
	                <select class="form-control" id="edicion_select_genero" onchange="cambioTalla()">
	                  <option value="SELECCIONAR">--Seleccionar--</option>
	                  <option value="DAMA">DAMA</option>
	                  <option value="CABALLERO">CABALLERO</option>
	                  <option value="UNISEX">UNISEX</option>
	                </select>
	              </div>
	            </div>

	            <!-- Género -->
	            <div class="form-group">
	              <label class="control-label col-md-2 col-sm-2 col-xs-12">Talla*</label>
	              <div class="col-md-4 col-sm-4 col-xs-12" id="">
	                <select class="form-control" id="edicion_select_talla" onchange="cambioTalla2(this)">
	                  <option value="SELECCIONAR">--Seleccionar--</option>
	                  <option value="XS">XS</option>
	                  <option value="S">S</option>
	                  <option value="M">M</option>
	                  <option value="L">L</option>
	                  <option value="XL">XL</option>
	                  <option value="XXL">XXL</option>
	                  <option value="OTRA">OTRA</option>
	                  <option value="SIN TALLA">NO APLICA</option>
	                </select>
	              </div>
	              <div style="display: none;" id="div_edicion_input_talla">
	              	<label class="control-label col-md-2 col-sm-2 col-xs-12">No. Talla*</label>
	              	<div class="col-md-4 col-sm-4 col-xs-12">
	                	<input type="number" class="form-control" placeholder="Especifique" id="edicion_otra_talla" min="0"  max='50' value='0'>
	                </div>
	              </div>
	            </div>
	            <!-- Observaciones -->
	            <div class="form-group">
	              <div style="display: block;" id="">
	              	<label class="control-label col-md-2 col-sm-2 col-xs-12">Observaciones</label>
	              	<div class="col-md-10 col-sm-10 col-xs-12">
                		<textarea class="form-control" id="edicion_observaciones" rows="3" placeholder="" style="resize:none;"></textarea>
	                </div>
	              </div>
	            </div>
	            <!-- Boton guardar -->
	            <div class="form-group">
	              	<div class="col-md-12 col-sm-12 col-xs-12">
	              		<button type="button" class="btn btn-primary pull-right" onclick="ActualizarProducto()">Guardar</button>
	              	</div>
	            </div>

	           	<hr>
	            <!-- Encabezado datos venta -->
	            <div class="form-group">
	              	<div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
	              		<h2>Datos de venta</h2>
	              	</div>
	            </div>
	            <!-- Existencias -->
	            <div class="form-group">
	              <div style="display: block;" id="div_input_talla">
	              	<label class="control-label col-md-2 col-sm-2 col-xs-12">Precio Actual</label>
	              	<div class="col-md-4 col-sm-4 col-xs-12">
            			<input type="number" class="form-control" placeholder="Precio" id="edicion_precio" min="0"  max='' value='' step=".01">
	                </div>
	              	<label class="control-label col-md-2 col-sm-2 col-xs-12">Descuento Actual</label>
	              	<div class="col-md-4 col-sm-4 col-xs-12">
	                	<input type="number" class="form-control" placeholder="Precio" id="edicion_descuento" min="0"  max='' value='' step=".01">
	                </div>
	              </div>
	            </div>
	            <!-- Boton guardar -->
	            <div class="form-group">
	              	<div class="col-md-12 col-sm-12 col-xs-12">
	              		<button type="button" class="btn btn-primary pull-right" onclick="ActualizarDatosVenta()">Guardar</button>
	              	</div>
	            </div>
        	</div><!-- fin div form -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>



    <!-- modal traspasar producto -->
    <div class="modal fade" id="ModalTraspasarProductos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Traspasar</h5>
          </div>
          <div class="modal-body">
          	<div class="form-horizontal form-label-left">
	          	<!-- nombre del producto -->
	            <div class="form-group">
	              <label class="control-label col-md-2 col-sm-2 col-xs-12">Producto*</label>
	              <div class="col-md-10 col-sm-10 col-xs-12">
	                <input type="text" class="form-control" placeholder="" id="nombre_producto">
	              </div>
	            </div>

	            <!-- Color y Talla -->
	            <div class="form-group">
	              <label class="control-label col-md-2 col-sm-2 col-xs-12">Color</label>
	              <div class="col-md-4 col-sm-4 col-xs-12">
	                <input type="text" class="form-control" placeholder="" id="color_producto">
	              </div>

	              <label class="control-label col-md-2 col-sm-2 col-xs-12">Género*</label>
	              <div class="col-md-4 col-sm-4 col-xs-12">
	                <select class="form-control" id="select_genero" onchange="cambioTalla()">
	                  <option value="SELECCIONAR">--Seleccionar--</option>
	                  <option value="DAMA">DAMA</option>
	                  <option value="CABALLERO">CABALLERO</option>
	                  <option value="UNISEX">UNISEX</option>
	                </select>
	              </div>
	            </div>

	            <!-- Género -->
	            <div class="form-group">
	              <label class="control-label col-md-2 col-sm-2 col-xs-12">Talla*</label>
	              <div class="col-md-4 col-sm-4 col-xs-12" id="">
	                <select class="form-control" id="select_talla" onchange="cambioTalla(this)">
	                  <option value="SELECCIONAR">--Seleccionar--</option>
	                  <option value="XS">XS</option>
	                  <option value="S">S</option>
	                  <option value="M">M</option>
	                  <option value="L">L</option>
	                  <option value="XL">XL</option>
	                  <option value="XXL">XXL</option>
	                  <option value="OTRA">OTRA</option>
	                  <option value="SIN TALLA">NO APLICA</option>
	                </select>
	              </div>
	              <div style="display: none;" id="div_input_talla">
	              	<label class="control-label col-md-2 col-sm-2 col-xs-12">No. Talla*</label>
	              	<div class="col-md-4 col-sm-4 col-xs-12">
	                	<input type="number" class="form-control" placeholder="Especifique" id="otra_talla" min="0"  max='50' value='0'>
	                </div>
	              </div>
	            </div>
	            <!-- Existencias -->
	            <div class="form-group">
	              <div style="display: block;" id="div_input_talla">
	              	<label class="control-label col-md-2 col-sm-2 col-xs-12">Precio Inicial</label>
	              	<div class="col-md-4 col-sm-4 col-xs-12">
	                	<input type="number" class="form-control" placeholder="Precio" id="precio_inicial" min="0"  max='' value='' step=".01">
	                </div>
	              </div>
	            </div>
	            <!-- Observaciones -->
	            <div class="form-group">
	              <div style="display: block;" id="">
	              	<label class="control-label col-md-2 col-sm-2 col-xs-12">Observaciones</label>
	              	<div class="col-md-10 col-sm-10 col-xs-12">
                		<textarea class="form-control" id="observaciones_nuevo_producto" rows="3" placeholder="" style="resize:none;"></textarea>
	                </div>
	              </div>
	            </div>
        	</div><!-- fin div form -->
          </div>
          <div class="modal-footer">
        	<button type="button" class="btn btn-primary" onclick="RegistrarProducto()">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

@endsection

@section('script')
	<script type="text/javascript">
		//$("#ModalAgregarProducto").modal();

		function ModalEditarProducto(id_producto){
			$("#id_producto").val(id_producto);
			$("#edicion_nombre_producto").val('');
			$("#edicion_color_producto").val('');
			$("#edicion_select_genero").val('SELECCIONAR');
			$("#edicion_select_talla").val('SELECCIONAR');
			$("#edicion_otra_talla").val(0);
			$("#edicion_observaciones").val('');
			$("#edicion_precio").val('');
			$("#edicion_descuento").val('');
	        $("#div_edicion_input_talla").css('display','none');

	        var success;
				var url = "/productos/obtener_datos";
				var dataForm = new FormData();
				dataForm.append('id_producto',producto);
				//dataForm.append('existencias',existencias);
				dataForm.append('precio',precio);
				//lamando al metodo ajax
				metodoAjax(url,dataForm,function(success){
				  //aquí se escribe todas las operaciones que se harían en el succes
				  //la variable success es el json que recibe del servidor el método AJAX
				  MensajeModal("TITULO DEL MODAL",'Los datos del producto "'+producto+'" fueron actualizados correctamente.');
				});//*/

			$("#ModalEditarProducto").modal();
		}

		function ModalAgregarProducto(){
			var producto = $("#nombre_producto").val('');
			var color = $("#color_producto").val('');
			var genero = $("#select_genero").val('SELECCIONAR');
			var talla = $("#select_talla").val('SELECCIONAR');
			var talla2 = $("#otra_talla").val(0);
			var observaciones = $("#observaciones_nuevo_producto").val('');
	        $("#div_input_talla").css('display','none');
			$("#ModalAgregarProducto").modal();
		}

		function RegistrarProducto(){
			var producto = $("#nombre_producto").val();
			var color = $("#color_producto").val();
			var genero = $("#select_genero").val();
			var talla = $("#select_talla").val();
			var talla2 = $("#otra_talla").val();
			var observaciones = $("#observaciones_nuevo_producto").val();
			//var inventario_minimo = $("#inventario_minimo").val();

			//var existencias = $("#existencias_iniciales").val();
			var precio = (($("#precio_inicial").val()=='')?0:$("#precio_inicial").val());
			if(producto == ''){
				MensajeModal('¡ATENCIÓN!','Debe escribir el nombre del producto');
			}else if(genero == 'SELECCIONAR'){
				MensajeModal('¡ATENCIÓN!','Debe escribir el genero del producto, si el producto no es para un género en específico, seleccione UNISEX');
			}else if(talla == 'SELECCIONAR'){
				MensajeModal('¡ATENCIÓN!','Debe seleccionar la talla del producto');
			}else if(talla == 'OTRA' && (talla2 == '' || talla2 < 0)){
				MensajeModal('¡ATENCIÓN!','Debe escribir numero de talla del producto');
			}else{
				//console.log('enviando');
				var success;
				var url = "/productos/registrar";
				var dataForm = new FormData();
				dataForm.append('producto',producto);
				dataForm.append('color',color);
				dataForm.append('genero',genero);
				dataForm.append('talla',(talla=='OTRA')?talla2:talla);
				dataForm.append('observaciones',observaciones);
				//dataForm.append('existencias',existencias);
				dataForm.append('precio',precio);
				//lamando al metodo ajax
				metodoAjax(url,dataForm,function(success){
				  //aquí se escribe todas las operaciones que se harían en el succes
				  //la variable success es el json que recibe del servidor el método AJAX
				  MensajeModal("TITULO DEL MODAL",'Producto "'+producto+'" agregado correctamente al inventario.');
				});//*/
			}
		}


	    function cambioTalla(elemento){
	      var select = $("#select_talla").val();
	      //var select = $(elemento).val();
	      //console.log(select);
	      if(select == "OTRA"){
	        $("#div_input_talla").css('display','block');
	      }else{
	        $("#div_input_talla").css('display','none');
	      }
	    }

	    //esto es en actualizacion de informacion
	    function cambioTalla2(elemento){
	      var select = $("#edicion_select_talla").val();
	      //var select = $(elemento).val();
	      //console.log(select);
	      if(select == "OTRA"){
	        $("#div_edicion_input_talla").css('display','block');
	      }else{
	        $("#div_edicion_input_talla").css('display','none');
	      }
	    }


	    $('#PickerLlegada').datetimepicker({
			format: 'DD/MM/YYYY',
			locale: 'es'
	      });
	    $('#PickerRegistro').datetimepicker({
			format: 'DD/MM/YYYY',
			locale: 'es'
	      });

	    function ModalAgregarNotaVenta(id_producto){
	    	$("#nota_venta_id_producto").val(id_producto);
	    	$("#nota_venta_cantidad").val('');
	    	$("#nota_venta_precio_compra").val('');
	    	//$("#nota_venta_precio_venta").val('');
	    	$("#nota_venta_select_bodega").val('SELECCIONAR');
	    	$("#nota_venta_observaciones").val('');
	    	$("#ModalAgregarExistencias").modal();
	    }

	    function agregarNotaVenta(){
	    	var id_producto = $("#nota_venta_id_producto").val();
	    	var cantidad = $("#nota_venta_cantidad").val();
	    	var precio_compra = $("#nota_venta_precio_compra").val();
	    	var select_bodega = $("#nota_venta_select_bodega").val();
	    	var observaciones = $("#nota_venta_observaciones").val();

	    	if(cantidad==""){
	    		MensajeModal('¡ATENCIÓN!','Debe agregar la cantidad de productos');
	    	}else if(precio_compra == ""){
	    		MensajeModal('¡ATENCIÓN!','Debe agregar el precio de compra');
	    	}else if(select_bodega == "SELECCIONAR"){
	    		MensajeModal('¡ATENCIÓN!','Debe seleccionar la bodega en la que se almacenarán los productos');
	    	}else{
	    		var success;
				var url = "/productos/agregar_nota";
				var dataForm = new FormData();
				dataForm.append('id_producto',id_producto);
				dataForm.append('cantidad',cantidad);
				dataForm.append('precio_compra',precio_compra);
				dataForm.append('select_bodega',select_bodega);
				dataForm.append('observaciones',observaciones);
				//lamando al metodo ajax
				metodoAjax(url,dataForm,function(success){
				  //aquí se escribe todas las operaciones que se harían en el succes
				  //la variable success es el json que recibe del servidor el método AJAX
	    		$("#ModalAgregarExistencias").modal('hide');
				  MensajeModal("¡ÉXITO!","Nota de venta registrada satisfactoriamente");
				});
	    	}
	    	

	    }

	    function verCodigoBarras(codigo){
			JsBarcode("#codigo", codigo);
	    	$("#ModalCodigoBarras").modal();
	    }

	    function abrirCodigo(){
	    	window.open('/codigo/imprimir','_blank');
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