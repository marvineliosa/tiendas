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
	              		<button type="button" class="btn btn-primary pull-right" onclick="ActualizarProducto()">Actualizar</button>
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
	              	<label class="control-label col-md-2 col-sm-2 col-xs-12">Descuento Actual (Porcentaje)</label>
	              	<div class="col-md-4 col-sm-4 col-xs-12">
	                	<input type="number" class="form-control" placeholder="Precio" id="edicion_descuento" min="0"  max='' value='' step=".01">
	                </div>
	              </div>
	            </div>
	            <!-- Boton guardar -->
	            <div class="form-group">
	              	<div class="col-md-12 col-sm-12 col-xs-12">
	              		<button type="button" class="btn btn-primary pull-right" onclick="ActualizarDatosVenta()">Actualizar</button>
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
    <div class="modal fade" id="ModalListadoMovilizacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: scroll; max-height:100%;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Listado de movilización</h5>
          </div>
          <div class="modal-body">
          	
          	<table class="table">
			  <thead>
			    <tr>
			      <th scope="col">Fecha</th>
			      <th scope="col">Origen</th>
			      <th scope="col">Destino</th>
			      <th scope="col">Cantidad</th>
			      <th scope="col">Estado</th>
			      <th scope="col">Acciones</th>
			    </tr>
			  </thead>
			  <tbody id="body_movilizaciones">
			    
			  </tbody>
			</table>

          </div>
          <div class="modal-footer">
        	<button type="button" class="btn btn-primary" onclick="ModalTraspaso()">Nueva Movilización</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- modal traspasar producto -->
    <div class="modal fade" id="ModalAceptarMovilizacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: scroll; max-height:100%;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Listado de movilizaciónes por aceptar</h5>
          </div>
          <div class="modal-body">
          	
          	<table class="table">
			  <thead>
			    <tr>
			      <th scope="col">Fecha</th>
			      <th scope="col">Origen</th>
			      <th scope="col">Destino</th>
			      <th scope="col">Cantidad</th>
			      <th scope="col">Acciones</th>
			    </tr>
			  </thead>
			  <tbody id="body_movilizaciones_pendientes">
			    
			  </tbody>
			</table>

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
            <h5 class="modal-title" id="exampleModalLabel">Movilizar Inventario</h5>
          </div>
          <div class="modal-body">
          	<div class="form-horizontal form-label-left">
	          	<!-- nombre del producto -->
	            <div class="form-group">
	              <label class="control-label col-md-2 col-sm-2 col-xs-12">Código</label>
	              <div class="col-md-4 col-sm-4 col-xs-12">
	                <input type="text" class="form-control" placeholder="" id="traspaso_codigo" disabled>
	              </div>
	            </div>

	            <!-- Bodega origen -->
	            <div class="form-group">
	              <label class="control-label col-md-2 col-sm-2 col-xs-12">Lugar Origen*</label>
	              <div class="col-md-10 col-sm-10 col-xs-12">
	                <select class="form-control" id="select_tienda_origen" onchange="SeleccionOrigen(this)">
	                </select>
	              </div>
	            </div>

	            <!-- Bodega Destino -->
	            <div class="form-group" id="div_destino" style="display: none">
	              <label class="control-label col-md-2 col-sm-2 col-xs-12">Lugar Destino*</label>
	              <div class="col-md-10 col-sm-10 col-xs-12">
	                <select class="form-control" id="select_tienda_destino" onchange="SeleccionDestino(this)">
	                </select>
	              </div>
	            </div>

	            <!-- Cantidad de traspaso -->
	            <div class="form-group" id="div_cantidad" style="display: none">

	              <label class="control-label col-md-2 col-sm-2 col-xs-12">Cantidad*</label>

	              <div class="col-md-2 col-sm-2 col-xs-12">
	                	<input type="number" class="form-control" placeholder="Especifique" id="cantidad_traspaso" min="0" value='0' onchange="AumentarCantidad()">
	              </div>

	              <div class="col-md-2 col-sm-2 col-xs-12">
	                	<button type="button" class="btn btn-default btn-md" onclick="AumentarCantidad()">
							<span class="fa fa-plus" aria-hidden="true"></span>
						</button>
	              </div>
	              <div class="col-md-6 col-sm-6 col-xs-12">
	                	<h3 style="position:relative; bottom: 5px; text-align: center;" id="h_cantidad_traspaso"></h3>
	              </div>
	            </div>

        	</div><!-- fin div form -->
          </div>
          <div class="modal-footer">
        	<button type="button" class="btn btn-primary" id="btn_MovilizacionInventario" onclick="RegistrarMovilizacionInventario()">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('script')
	<script type="text/javascript">
		//$("#ModalAgregarProducto").modal();

		function CancelarMovilizacion(id_movilizacion){
			console.log(id_movilizacion);
			var success;
			var url = "/productos/cancelar_movilizaciones";
			var dataForm = new FormData();
			dataForm.append('id_movilizacion',id_movilizacion);
			//lamando al metodo ajax
			metodoAjax(url,dataForm,function(success){
				//aquí se escribe todas las operaciones que se harían en el succes
				//la variable success es el json que recibe del servidor el método AJAX
				//MensajeModal('¡ÉXITO!','Se ha marcado como recibida la movilización de 
				MensajeModal('¡ÉXITO!',success['mensaje']);
				$("#ModalListadoMovilizacion").modal('hide');
			});//*/
		}

		function AprobarMovilizacion(id_movilizacion){
			/*console.log("*********************");
			console.log(tmp);
			id_movilizacion = tmp[0];//*/
			console.log(id_movilizacion);
			var success;
			var url = "/productos/aprobar_movilizaciones";
			var dataForm = new FormData();
			dataForm.append('id_movilizacion',id_movilizacion);
			//lamando al metodo ajax
			metodoAjax(url,dataForm,function(success){
				//aquí se escribe todas las operaciones que se harían en el succes
				//la variable success es el json que recibe del servidor el método AJAX
				//MensajeModal('¡ÉXITO!','Se ha marcado como recibida la movilización de inventario. Se ha registrado exitosamente '+tmp[1]+'" unidades al inventario de '+'"'+tmp[2]+'"');
				MensajeModal('¡ÉXITO!',success['mensaje']);
				$("#ModalAceptarMovilizacion").modal('hide');
			});//*/
			
		}

		function RegistrarMovilizacionInventario(){
			var id_producto = $("#traspaso_codigo").val();
			var tienda_origen = $("#select_tienda_origen").val();
			var tienda_destino = $("#select_tienda_destino").val();
			var cantidad_traspaso = $("#cantidad_traspaso").val();
			/*console.log(tienda_origen);
			console.log(tienda_destino);
			console.log("-----------");//*/
				
			if(tienda_origen == 'SELECCIONAR'){
				MensajeModal('¡ATENCIÓN!','Aún no se ha seleccionado la tienda origen.');
			}else if(tienda_destino == 'SELECCIONAR'){
				MensajeModal('¡ATENCIÓN!','Aún no se ha seleccionado la tienda destino.');
			}else if(cantidad_traspaso <= 0){
				MensajeModal('¡ATENCIÓN!','La cantidad de artículos debe ser mayor a 0.');
			}else if(cantidad_traspaso == ''){
				MensajeModal('¡ATENCIÓN!','La campo de cantidad de artículos no debe estar vacío.');
			}else{
				//document.getElementById("btn_MovilizacionInventario").value = "Enviando...";
			    //document.getElementById("btn_MovilizacionInventario").disabled = true;
			    $("#btn_MovilizacionInventario").attr("disabled", true);
			    $("#btn_MovilizacionInventario").text('Enviando...');

			    //*/
				var success;
				var url = "/productos/registrar_movilizacion_inventario";
				var dataForm = new FormData();
				var id_tienda_origen = array_origen[tienda_origen]['ID_ESPACIO'];
				var cantidad_origen = array_destino[tienda_origen]['CANTIDAD_EXISTENCIAS'];
				var id_tienda_destino = array_destino[tienda_destino]['ID_ESPACIO'];
				dataForm.append('id_producto',id_producto);
				dataForm.append('id_tienda_origen',id_tienda_origen);
				dataForm.append('id_tienda_destino',id_tienda_destino);
				dataForm.append('cantidad_traspaso',cantidad_traspaso);
				dataForm.append('cantidad_origen',cantidad_origen);
				/*console.log(tienda_origen);
				console.log(cantidad_origen);
				console.log(tienda_destino);//*/
				//lamando al metodo ajax
				metodoAjax(url,dataForm,function(success){
				  //aquí se escribe todas las operaciones que se harían en el succes
				  //la variable success es el json que recibe del servidor el método AJAX
				  MensajeModal("¡ÉXITO!",'Se ha registrado el movimiento de inventario, se ha reducido la cantidad de este producto del espacio origen pero no se verá reflejado en el inventario del lugar destino hasta que se marque como recibido en el espacio destino.');
				  $("#ModalListadoMovilizacion").modal('hide');
				});//*/
			}
		}

		var array_origen = new Array();
		var array_destino = new Array();
		function LlenarTiendas(select,id_producto,origen){
			//var id_producto = $("#traspaso_codigo").val();
			//console.log(id_producto);
			var success;
			var url = "/productos/obtener_inventario_tiendas";
			var dataForm = new FormData();
			var j = 0;
			dataForm.append('id_producto',id_producto);
			//lamando al metodo ajax
			$("#"+select).html("");
			metodoAjax(url,dataForm,function(success){
			  //aquí se escribe todas las operaciones que se harían en el succes
			  //la variable success es el json que recibe del servidor el método AJAX
			  $("#"+select).append('<option value="SELECCIONAR">--Seleccionar--</option>');
			  for(var i = 0; i < success['inventario'].length; i++){
			  	if(origen=='origen'){
			  		if(success['inventario'][i]['CANTIDAD_EXISTENCIAS']>0){
				  		$("#"+select).append(
					  		'<option value="'+i+'">'+success['inventario'][i]['ESPACIO_EXISTENCIAS']+' ('+success['inventario'][i]['CANTIDAD_EXISTENCIAS']+')'+'</option>'
					  	);
					  	//array_origen[j] = success['inventario'][i];
					  	//j++;
				  	}
				}else if(origen=='destino'){
					$("#"+select).append(
				  		'<option value="'+i+'">'+success['inventario'][i]['ESPACIO_EXISTENCIAS']+' ('+success['inventario'][i]['CANTIDAD_EXISTENCIAS']+')'+'</option>'
				  	);//*/
				  	//array_destino[j] = success['inventario'][i];
				  	//j++;
				}else{

				}
			  }
			  if(origen == 'origen'){
			  	array_origen = success['inventario'];
			  	//console.log('Origen');
			  	//console.log(array_origen);
			  }else{
			  	array_destino = success['inventario'];
			  	//console.log('Destino');
			  	//console.log(array_destino);
			  }//*/
			});//*/		
		}

		var existencias_origen = 0;
		function SeleccionOrigen(elemento){
			$("#select_tienda_destino").val('SELECCIONAR');
			$("#div_cantidad").css('display','none');
			var id_tienda = $(elemento).val();
			var id_producto = $("#traspaso_codigo").val();
			if(id_tienda == 'SELECCIONAR'){
				$("#div_destino").css('display','none');
			}else{
				existencias_origen = array_origen[id_tienda]['CANTIDAD_EXISTENCIAS'];
				LlenarTiendas('select_tienda_destino',id_producto,'destino');
				$("#div_destino").css('display','block');
			}
		}

		var existencias_destino = 0;
		function SeleccionDestino(elemento){
			var id_tienda_destino = $(elemento).val();
			//console.log(id_tienda_destino);
			if(id_tienda_destino != 'SELECCIONAR'){
				existencias_destino = array_destino[id_tienda_destino]['CANTIDAD_EXISTENCIAS'];
				$("#h_cantidad_traspaso").text(existencias_destino);
				$("#div_cantidad").css('display','block');
			}else{
				existencias_destino = 0;
				$("#div_cantidad").css('display','none');
			}
		}

		//var cant_traspaso = 0;
		function AumentarCantidad(){
			var cantidad = $("#cantidad_traspaso").val();
			if(cantidad > 0 && cantidad <= existencias_origen){
				var tmp = parseInt(existencias_destino) + parseInt(cantidad);
				//console.log(tmp);
				$("#h_cantidad_traspaso").text(tmp);
			}else if(cantidad==0 || cantidad == '' || cantidad<0){
				MensajeModal('¡ATENCIÓN!','Favor de asignar una cantidad mayor a 0');
				$("#cantidad_traspaso").val(1);
			}else{
				MensajeModal('¡ATENCIÓN!','Se ha excedido el máximo de inventario de la tienda origen.');
				$("#cantidad_traspaso").val(existencias_origen);
			}
		}

		function ModalListadoMovilizacion(id_producto){
			$("#id_producto").val(id_producto);
			var success;
			var url = "/productos/traer_movilizaciones";
			var dataForm = new FormData();
			dataForm.append('id_producto',id_producto);
			//lamando al metodo ajax
			$("#body_movilizaciones").html("");
			metodoAjax(url,dataForm,function(success){
			  //aquí se escribe todas las operaciones que se harían en el succes
			  //la variable success es el json que recibe del servidor el método AJAX
			  for(var i = 0; i < success['movilizaciones'].length; i++){
			  	var acciones = "";
			  	if(success['movilizaciones'][i]['ESTATUS'] == 'PENDIENTE'){
			  		acciones = '<a href="javascript:void(0);" onclick="CancelarMovilizacion('+success['movilizaciones'][i]['ID_MOVILIZACION']+')" style="color:red;">Cancelar</a>';
			  	}else{
			  		acciones = "";
			  	}
			  	$("#body_movilizaciones").append(
			  		'<tr>'+
				      '<th scope="row">'+success['movilizaciones'][i]['FECHA_MOVIMIENTO']+'</th>'+
				      '<td>'+success['movilizaciones'][i]['NOMBRE_ORIGEN']+'</td>'+
				      '<td>'+success['movilizaciones'][i]['NOMBRE_DESTINO']+'</td>'+
				      '<td>'+success['movilizaciones'][i]['CANTIDAD_UNIDADES']+'</td>'+
				      '<td>'+success['movilizaciones'][i]['ESTATUS']+'</td>'+
				      '<td>'+acciones+'</td>'+
				    '</tr>'
			  	);
			  }
			  
			});//*/
			$("#ModalListadoMovilizacion").modal();//
		}

		function ModalListadoRecibirMovilizacion(id_producto){
			$("#id_producto").val(id_producto);
			var success;
			var url = "/productos/traer_movilizaciones_usuarios";
			var dataForm = new FormData();
			dataForm.append('id_producto',id_producto);
			//lamando al metodo ajax
			$("#body_movilizaciones_pendientes").html("");
			metodoAjax(url,dataForm,function(success){
			  //aquí se escribe todas las operaciones que se harían en el succes
			  //la variable success es el json que recibe del servidor el método AJAX
			  for(var i = 0; i < success['movilizaciones'].length; i++){
			  	var acciones = "";
			  	/*var tmp = {
			  				id_movilizacion : success['movilizaciones'][i]['ID_MOVILIZACION'],
			  				cantidad_traspaso : success['movilizaciones'][i]['CANTIDAD_UNIDADES'],
			  				tienda_destino : success['movilizaciones'][i]['NOMBRE_DESTINO']
		  				};
			  	console.log("------------------");
			  	console.log(tmp);//*/
			  	if(success['movilizaciones'][i]['ESTATUS'] == 'PENDIENTE'){
			  		//acciones = '<a href="javascript:void(0);" onclick="AprobarMovilizacion('+tmp+')" style="color:green;">Aceptar</a>';
			  		acciones = '<a href="javascript:void(0);" onclick="AprobarMovilizacion('+success['movilizaciones'][i]['ID_MOVILIZACION']+')" style="color:green;">Aceptar</a>';
			  		//console.log(acciones);
			  		$("#body_movilizaciones_pendientes").append(
				  		'<tr>'+
					      '<th scope="row">'+success['movilizaciones'][i]['FECHA_MOVIMIENTO']+'</th>'+
					      '<td>'+success['movilizaciones'][i]['NOMBRE_ORIGEN']+'</td>'+
					      '<td>'+success['movilizaciones'][i]['NOMBRE_DESTINO']+'</td>'+
					      '<td>'+success['movilizaciones'][i]['CANTIDAD_UNIDADES']+'</td>'+
					      '<td>'+acciones+'</td>'+
					    '</tr>'
				  	);
			  	}
			  	
			  }
			  
			});//*/
			$("#ModalAceptarMovilizacion").modal();//
		}

		function ModalTraspaso(){
			$("#btn_MovilizacionInventario").attr("disabled", false);
			$("#btn_MovilizacionInventario").text('Guardar');
			var id_producto = $("#id_producto").val();
			$("#div_destino").css('display','none');
			$("#div_cantidad").css('display','none');
			LlenarTiendas('select_tienda_origen',id_producto,'origen');
			$("#traspaso_codigo").val(id_producto);
			$("#ModalListadoMovilizacion").modal('hide');
			$("#ModalTraspasarProductos").modal();
		}

		function ActualizarDatosVenta(){
			var id_producto = $("#id_producto").val();
			var precio = $("#edicion_precio").val();
			var descuento = $("#edicion_descuento").val();
			var producto = $("#edicion_nombre_producto").val();
			if(precio == '' || precio < 0){
				MensajeModal('¡ATENCIÓN!','El precio del producto debe ser mayor a 0');
			}else if(descuento == '' || descuento < 0){
				MensajeModal('¡ATENCIÓN!','Debe descuento del producto debe ser mayor a 0');
			}else{
				var success;
				var url = "/productos/actualizar_datos_venta";
				var dataForm = new FormData();
				dataForm.append('id_producto',id_producto);
				dataForm.append('precio',precio);
				dataForm.append('descuento',descuento);
				//console.log(precio);
				//console.log(descuento);
				//lamando al metodo ajax
				metodoAjax(url,dataForm,function(success){
				  //aquí se escribe todas las operaciones que se harían en el succes
				  //la variable success es el json que recibe del servidor el método AJAX
				  MensajeModal("¡ÉXITO!",'Los datos de venta de "'+producto+'" se han actualizado correctamente.');
				});//*/
			}
		}

		function ActualizarProducto(){
			var id_producto = $("#id_producto").val();
			//console.log(id_producto);

			var producto = $("#edicion_nombre_producto").val();
			var color = $("#edicion_color_producto").val();
			var genero = $("#edicion_select_genero").val();
			var talla = $("#edicion_select_talla").val();
			var talla2 = $("#edicion_otra_talla").val();
			var observaciones = $("#edicion_observaciones").val();
			//var inventario_minimo = $("#inventario_minimo").val();

			//var existencias = $("#existencias_iniciales").val();
			if(producto == ''){
				MensajeModal('¡ATENCIÓN!','Debe escribir el nombre del producto');
			}else if(genero == 'SELECCIONAR'){
				MensajeModal('¡ATENCIÓN!','Debe escribir el genero del producto, si el producto no es para un género en específico, seleccione UNISEX');
			}else if(talla == 'SELECCIONAR'){
				MensajeModal('¡ATENCIÓN!','Debe seleccionar la talla del producto');
			}else if(talla == 'OTRA' && (talla2 == '' || talla2 < 0)){
				MensajeModal('¡ATENCIÓN!','Debe escribir numero de talla del producto');
			}else{
				var success;
				var url = "/productos/actualizar_datos";
				var dataForm = new FormData();
				dataForm.append('id_producto',id_producto);
				dataForm.append('producto',producto);
				dataForm.append('color',color);
				dataForm.append('genero',genero);
				dataForm.append('talla',(talla=='OTRA')?talla2:talla);
				dataForm.append('observaciones',observaciones);
				//lamando al metodo ajax
				metodoAjax(url,dataForm,function(success){
				  //aquí se escribe todas las operaciones que se harían en el succes
				  //la variable success es el json que recibe del servidor el método AJAX
				  MensajeModal("¡ÉXITO!",'Los datos de "'+producto+'" se han actualizado correctamente.');
				});//*/
			}
		}

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
			dataForm.append('id_producto',id_producto);
			//dataForm.append('existencias',existencias);
			//lamando al metodo ajax
			metodoAjax(url,dataForm,function(success){
			  //aquí se escribe todas las operaciones que se harían en el succes
			  //la variable success es el json que recibe del servidor el método AJAX
			  //MensajeModal("TITULO DEL MODAL",'Los datos del producto "'+producto+'" fueron actualizados correctamente.');

			  	$("#id_producto").val(id_producto);
				$("#edicion_nombre_producto").val(success['producto']['NOMBRE_PRODUCTO']);
				$("#edicion_color_producto").val(success['producto']['COLOR_PRODUCTO']);
				$("#edicion_select_genero").val(success['producto']['GENERO_PRODUCTO']);
				$("#edicion_select_talla").val(success['producto']['TALLA_PRODUCTO']);
				$("#edicion_otra_talla").val(success['producto']['TALLA_PRODUCTO']);
				$("#edicion_observaciones").val(success['producto']['OBSERVACIONES_PRODUCTO']);
				$("#edicion_precio").val(success['producto']['PRECIO_SIN_DESCUENTO']);
				$("#edicion_descuento").val(success['producto']['DESCUENTO_PRODUCTO']);
				//$("#div_edicion_input_talla").css('display','none');
				var tallas = ['XS','S','M','L','XL','XXL','SIN TALLA'];
				
				if(tallas.includes(success['producto']['TALLA_PRODUCTO'])){
					$("#div_edicion_input_talla").css('display','none');
				}else{
					$("#edicion_select_talla").val('OTRA');
					$("#div_edicion_input_talla").css('display','block');
				}
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
				  MensajeModal("¡ÉXITO!",'Producto "'+producto+'" agregado correctamente al inventario.');
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