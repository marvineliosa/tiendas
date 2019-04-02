@extends('plantillas.menu')
@section('title','Listado')
@section('tittle_page','Listado de Productos')

@section('content')
	<div class="row">
	  <div class="col-md-12 col-sm-12 col-xs-12">
	    <div class="x_panel">
	      <div class="x_title">
	        <h2>Listado de productos</h2>
	        <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#ModalAgregarProducto">Registrar Producto</button>
	        <div class="clearfix"></div>
	      </div>
	      <div class="x_content">
	        <table class="table table-hover" id="TablaDatosProductos">

	          <thead>
	            <tr>
	              <th scope="row">#</th>
	              <th>Producto</th>
	              <th>Talla</th>
	              <th>Color</th>
	              <th>Genero</th>
	              <th>Acciones</th>
	            </tr>
	          </thead>
	          <tbody id="cuerpoTablaProductos">
	          	<tr>
	          		<td>1</td>
	          		<td>PLAYERA LOBOS</td>
	          		<td>M</td>
	          		<td>ROJO</td>
	          		<td>UNISEX</td>
	          		<td>
	          			<button type="button" class="btn btn-default btn-xs" onclick="acciones(1)">
						  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
						</button>
	          			<button type="button" class="btn btn-default btn-xs" onclick="agregarExistencias()">
						  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						</button>
	          			<button type="button" class="btn btn-default btn-xs" onclick="verCodigoBarras()">
						  <span class="glyphicon glyphicon-barcode" aria-hidden="true"></span>
						</button>
	          		</td>
	          	</tr>
	          	<tr>
	          		<td>2</td>
	          		<td>PLAYERA LOBOS</td>
	          		<td>L</td>
	          		<td>ROJO</td>
	          		<td>UNISEX</td>
	          		<td>
	          			<button type="button" class="btn btn-default btn-xs" onclick="acciones(2)">
						  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
						</button>
	          			<button type="button" class="btn btn-default btn-xs" onclick="agregarExistencias()">
						  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						</button>
	          			<button type="button" class="btn btn-default btn-xs" onclick="verCodigoBarras()">
						  <span class="glyphicon glyphicon-barcode" aria-hidden="true"></span>
						</button>
	          		</td>
	          	</tr>
	          	<tr>
	          		<td>3</td>
	          		<td>USB LOBOS</td>
	          		<td>SIN TALLA</td>
	          		<td>GRIS</td>
	          		<td>UNISEX</td>
	          		<td>
	          			<button type="button" class="btn btn-default btn-xs" onclick="acciones(3)">
						  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
						</button>
	          			<button type="button" class="btn btn-default btn-xs" onclick="agregarExistencias()">
						  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						</button>
	          			<button type="button" class="btn btn-default btn-xs" onclick="verCodigoBarras()">
						  <span class="glyphicon glyphicon-barcode" aria-hidden="true"></span>
						</button>
	          		</td>
	          	</tr>
	          	<tr>
	          		<td>4</td>
	          		<td>SUDADERA LOBOS</td>
	          		<td>L</td>
	          		<td>NEGRO</td>
	          		<td>M</td>
	          		<td>
	          			<button type="button" class="btn btn-default btn-xs" onclick="acciones(4)">
						  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
						</button>
	          			<button type="button" class="btn btn-default btn-xs" onclick="agregarExistencias()">
						  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						</button>
	          			<button type="button" class="btn btn-default btn-xs" onclick="verCodigoBarras()">
						  <span class="glyphicon glyphicon-barcode" aria-hidden="true"></span>
						</button>
	          		</td>
	          	</tr>
	          </tbody>
	        </table>
	      </div>
	    </div>
	  </div>
	</div>

  	<!-- Modales -->
    <div class="modal fade" id="ModalDetalleProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table">
	            <thead>
	              <tr>
	                <th scope="col" id="thOficio"></th>
	                <th scope="col"></th>
	              </tr>
	            </thead>
	            <tbody id="bodyDetalle">
	              <tr>
	                <th>Producto</th>
	                <td id="td-Producto"></td>
	              </tr>
	              <tr>
	                <th>Color</th>
	                <td id="td-Color"></td>
	              </tr>
	              <tr>
	                <th>Talla</th>
	                <td id="td-Talla"></td>
	              </tr>
	              <tr>
	                <th>Genero</th>
	                <td id="td-Genero"></td>
	              </tr>
	              <tr>
	                <th>Fecha de registro a DAPI</th>
	                <td id="td-FechaRegistro"></td>
	              </tr>
	              <tr>
	                <th>Número de Notas de entrada</th>
	                <td id="td-NotasEntrada"></td>
	              </tr>
	              <tr>
	                <th>Inventario en bodega</th>
	                <td id="td-InventarioBodega"></td>
	              </tr>
	              <tr>
	                <th>Inventario en tienda</th>
	                <td id="td-InventarioTienda"></td>
	              </tr>
	              <tr>
	                <th>Precio de venta</th>
	                <td id="td-PrecioVenta"></td>
	              </tr>
	              <tr>
	                <th>Unidades vendidas</th>
	                <td id="td-UnidadesVendidas"></td>
	              </tr>
	              <tr>
	                <th>Observaciones</th>
	                <td id="td-Observaciones"></td>
	              </tr>

	            </tbody>
        	</table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- modal agregar producto -->
    <div class="modal fade" id="ModalAgregarProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
	          	<!-- nombre del producto -->
	            <div class="form-group">
	              <label class="control-label col-md-2 col-sm-2 col-xs-12">Producto</label>
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

	              <label class="control-label col-md-2 col-sm-2 col-xs-12">Género</label>
	              <div class="col-md-4 col-sm-4 col-xs-12">
	                <select class="form-control" id="select_genero" onchange="cambioTalla()">
	                  <option value="-1">--Seleccionar--</option>
	                  <option value="DAMA">DAMA</option>
	                  <option value="CABALLERO">CABALLERO</option>
	                  <option value="UNISEX">UNISEX</option>
	                </select>
	              </div>
	            </div>

	            <!-- Género -->
	            <div class="form-group">
	              <label class="control-label col-md-2 col-sm-2 col-xs-12">Talla</label>
	              <div class="col-md-4 col-sm-4 col-xs-12" id="">
	                <select class="form-control" id="select_talla" onchange="cambioTalla(this)">
	                  <option value="-1">--Seleccionar--</option>
	                  <option value="XS">XS</option>
	                  <option value="S">S</option>
	                  <option value="M">M</option>
	                  <option value="L">L</option>
	                  <option value="XL">XL</option>
	                  <option value="XXL">XXL</option>
	                  <option value="OTRA">OTRA</option>
	                  <option value="SIN_TALLA">NO APLICA</option>
	                </select>
	              </div>
	              <div style="display: none;" id="div_input_talla">
	              	<label class="control-label col-md-2 col-sm-2 col-xs-12">Nueva Talla</label>
	              	<div class="col-md-4 col-sm-4 col-xs-12">
	                	<input type="number" class="form-control" placeholder="Especifique" id="otra_talla" min="0"  max='50' value='0'>
	                </div>
	              </div>
	            </div>
	            <!-- Existencias -->
	            <div class="form-group">
	              <label class="control-label col-md-2 col-sm-2 col-xs-12">Tienda</label>
	              <div class="col-md-4 col-sm-4 col-xs-12" id="">
	                <select class="form-control" id="select_talla" onchange="">
	                  <option value="-1">--Seleccionar--</option>
	                  <option value="XS">CCU</option>
	                  <option value="S">CU - LOBOS</option>
	                  <option value="M">BODEGA</option>
	                </select>
	              </div>
	              <div style="display: block;" id="div_input_talla">
	              	<label class="control-label col-md-2 col-sm-2 col-xs-12">Existencias</label>
	              	<div class="col-md-4 col-sm-4 col-xs-12">
	                	<input type="number" class="form-control" placeholder="Especifique" id="otra_talla" min="0"  max='50' value='0'>
	                </div>
	              </div>
	            </div>
	            <!-- Existencias -->
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
        	<button type="button" class="btn btn-primary" onclick="agregaProducto()">Guardar</button>
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
          		<!-- fecha -->
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Fecha de llegada</label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <div class='input-group date' id='PickerLlegada'>
                  <input type='text' class="form-control" placeholder="Fecha de llegada" id="fecha_recibido" />
                  <span class="input-group-addon" id="FechaLlegada">
                     <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
              </div>
            </div>
            <!-- Cantidad -->
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Nota de entrada</label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="number" class="form-control" placeholder="" id="nota_entrada" min="0" value=''>
              </div>
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Cantidad</label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="number" class="form-control" placeholder="" id="cantidad" min="0" value=''>
              </div>
            </div>
            <!-- Precio de compra y venta -->
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Precio de compra</label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="number" class="form-control" placeholder="" id="precio_compra" min="0" value='' step=".10">
              </div>
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Precio de venta</label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="number" class="form-control" placeholder="" id="precio_venta" min="0" value='' step=".10">
              </div>
            </div>
            <!-- Observaciones -->
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Observaciones</label>
              <div class="col-md-10 col-sm-10 col-xs-12">
                <textarea class="form-control" id="textarea_observaciones" rows="3" placeholder="" style="resize:none;"></textarea>
              </div>
            </div>


        	</div><!-- fin div form -->
          </div>
          <div class="modal-footer">
        	<button type="button" class="btn btn-primary" onclick="agregaProducto()">Guardar</button>
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



@endsection

@section('script')
	<script type="text/javascript">
		//$("#ModalAgregarProducto").modal();

		function acciones(){
			$('#td-Producto').html('PLAYERA');
			$('#td-Color').html('ROJO');
			$('#td-Talla').html('M');
			$('#td-Genero').html('UNISEX');
			$('#td-FechaRegistro').html('12/01/2019');
			$('#td-NotasEntrada').html('1');
			$('#td-InventarioBodega').html('38');
			$('#td-InventarioTienda').html('12');
			$('#td-PrecioVenta').html('$327.00');
			$('#td-UnidadesVendidas').html('26');
			$('#td-Observaciones').html('La playera es de tela Climacool');

			$("#ModalDetalleProducto").modal();
		}
		var cont_producto = 5;
		function agregaProducto(){
			var producto = $("#nombre_producto").val();
			var color = $("#color_producto").val();
			var genero = $("#select_genero").val();
			var talla = $("#select_talla").val();
			var talla2 = $("#otra_talla").val();
			var acciones = 	'<button type="button" class="btn btn-default btn-xs" onclick="acciones(4)">'+
						  		'<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>'+
							'</button>';
			var acciones = acciones + 
				' <button type="button" class="btn btn-default btn-xs" onclick="agregarExistencias()">'+
				  '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>'+
				'</button>';
			var acciones = acciones + 
				' <button type="button" class="btn btn-default btn-xs" onclick="verCodigoBarras()">'+
				  '<span class="glyphicon glyphicon-barcode" aria-hidden="true"></span>'+
				'</button>';

			$("#cuerpoTablaProductos").append(
				'<tr>'+
	          		'<td>'+cont_producto+'</td>'+
	          		'<td>'+producto+'</td>'+
	          		'<td>'+((talla=='OTRA')?talla2:talla)+'</td>'+
	          		'<td>'+color+'</td>'+
	          		'<td>'+genero+'</td>'+
	          		'<td>'+
	          			acciones+
	          		'</td>'+
	          	'</tr>'
			);
			cont_producto++;
		}


	    function cambioTalla(elemento){
	      var select = $("#select_talla").val();
	      //var select = $(elemento).val();
	      console.log(select);
	      if(select == "OTRA"){
	        $("#div_input_talla").css('display','block');
	      }else{
	        $("#div_input_talla").css('display','none');
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

	    function agregarExistencias(){
	    	$("#ModalAgregarExistencias").modal();
	    }
	    function verCodigoBarras(){
	    	var min = 10000000;
	    	var max = 99999999;
			var numero = "PLAYERA LOBOS";
	    	var numero = parseInt(Math.random() * (max - min) + min);
	    	console.log(numero);

			JsBarcode("#codigo", numero);

	    	$("#ModalCodigoBarras").modal();
	    }

	    function abrirCodigo(){
	    	window.open('/codigo/imprimir','_blank');
	    }
	</script>

@endsection