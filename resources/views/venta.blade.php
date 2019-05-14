@extends('plantillas.menu')
@section('title','Venta')
@section('tittle_page','Punto de venta')

@section('content')
<div class="row">
	  <div class="col-md-12 col-sm-12 col-xs-12">
	    <div class="x_panel">
	      <div class="x_title">
	        <div class="form-horizontal form-label-left">
	          	<!-- nombre del producto -->
	            <form class="form-group" onsubmit="return CancelarSubmit();">
	              	<div class="col-md-3 col-sm-3 col-xs-12">
	                	<input type="number" class="form-control" placeholder="" id="nombre_producto">
	              	</div>
	              	<div class="col-md-2 col-sm-2 col-xs-12">
	        			<button type="submit" class="btn btn-primary" onclick="agregarArticulo()">Agregar Producto</button> 
	              	</div>
	            </form>
        	</div>
	      </div>
	      <div class="x_content">
	      	<table class="table table-hover" id="TablaVenta">
	          <thead>
	            <tr>
	              <th scope="row" style="vertical-align: middle; width: 10%;">#</th>
	              <th style="vertical-align: middle; width: 30%;">Producto</th>
	              <th style="vertical-align: middle; width: 20%;">Cantidad</th>
	              <th style="vertical-align: middle; width: 15%;">Precio</th>
	              <th style="vertical-align: middle; width: 15%;">Subtotal</th>
	              <th style="vertical-align: middle; width: 10%;"></th>
	            </tr>
	          </thead>
	          <tbody id="cuerpoVenta">

	          </tbody>
	      	</table>

			<table class="" id="TablaVenta" WIDTH="100%">
	          <thead>
	            <tr>
	              <th style="vertical-align: middle; width: 10%;"></th>
	              <th style="vertical-align: middle; width: 30%;"></th>
	              <th style="vertical-align: middle; width: 20%;"></th>
	              <th style="text-align: ; width: 15%;">&nbsp&nbspTotal:</th>
	              <th style="vertical-align: middle; width: 15%;" id="total_cuenta">&nbsp&nbsp$ 0.00</th>
	              <th style="vertical-align: middle; width: 10%;"></th>
	            </tr>
	          </thead>
	          <tbody>
	          	<td></td>
	          	<td></td>
	          	<td></td>
	          	<td><br><br><br><button type="button" class="btn btn-danger pull-right" onclick="CancelarCompra()">Cancelar Compra</button></td>
	          	<td><br><br><br><button type="button" class="btn btn-primary" onclick="finalizarCompra()">Filanizar Compra</button></td>

	          </tbody>
	      	</table>

	      </div>
	  </div>
	</div>
</div>



<!-- Modal Descuento Vía Nómina -->
<div class="modal fade" id="ModalDescuentoViaNomina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
	        <!-- Encabezado datos venta -->
	        <div class="form-group">
	          	<div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
	          		<h2>Descuento vía nómina</h2>
	          	</div>
	        </div>
	      	<!-- ID del trabajador -->
	        <div class="form-group">
	          <label class="control-label col-md-2 col-sm-2 col-xs-12">ID del trabajador*</label>
	          <div class="col-md-10 col-sm-10 col-xs-12">
	            <input type="number" class="form-control" placeholder="" id="pago_nomina_id_tr">
	          </div>
	        </div>
	      	<!-- nombre del producto -->
	        <div class="form-group">
	          <label class="control-label col-md-2 col-sm-2 col-xs-12">Nombre del trabajador*</label>
	          <div class="col-md-10 col-sm-10 col-xs-12">
	            <input type="text" class="form-control" placeholder="" id="pago_nomina_nombre_tr">
	          </div>
	        </div>
	      	<!-- nombre del producto -->
	        <div class="form-group">
	          <label class="control-label col-md-2 col-sm-2 col-xs-12">Importe</label>
	          <div class="col-md-4 col-sm-4 col-xs-12">
	            <input type="number" class="form-control" placeholder="" id="pago_nomina_importe" disabled>
	          </div>
	          <label class="control-label col-md-2 col-sm-2 col-xs-12">Quincenas*</label>
	          <div class="col-md-4 col-sm-4 col-xs-12">
	            <input type="number" class="form-control" placeholder="" id="pago_nomina_importe">
	          </div>
	        </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="finalizarCompra()">Finalizar Compra</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Créditos a Unidades Académicas -->
<div class="modal fade" id="ModalCreditoUnidadAcademica" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
	        <!-- Encabezado datos venta -->
	        <div class="form-group">
	          	<div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
	          		<h2>Crédito a Unidad Académica</h2>
	          	</div>
	        </div>
	      	<!-- ID del trabajador -->
	        <div class="form-group">
	          <label class="control-label col-md-2 col-sm-2 col-xs-12">Dependencia*</label>
	          <div class="col-md-10 col-sm-10 col-xs-12">
	            <input type="text" class="form-control" placeholder="" id="pago_nomina_id_tr">
	          </div>
	        </div>
	      	
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="finalizarCompra()">Finalizar Compra</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Créditos a Unidades Académicas -->
<div class="modal fade" id="ModalEleccionTipoPago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
	        <!-- Encabezado datos venta -->
	        <div class="form-group">
	          	<div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
	          		<h2>Crédito a Unidad Académica</h2>
	          	</div>
	        </div>
	      	<!-- ID del trabajador -->
	        <div class="form-group">
	          <label class="control-label col-md-2 col-sm-2 col-xs-12">Dependencia*</label>
	          <div class="col-md-10 col-sm-10 col-xs-12">
	            <input type="text" class="form-control" placeholder="" id="pago_nomina_id_tr">
	          </div>
	        </div>
	      	
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="finalizarCompra()">Finalizar Compra</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Créditos a Unidades Académicas -->
<div class="modal fade" id="ModalProductoInexistente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
	        	<h1>Producto Inexistente</h1>
	        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
	<script type="text/javascript">
		//$("#ModalDescuentoViaNomina").modal();
		//$("#ModalCreditoUnidadAcademica").modal();
		$("#ModalProductoInexistente").modal();
		var i = 1;
		var array_articulos = new Array();
		var contador_articulos = 0;
		function CancelarSubmit(){
	      console.log("Epale");
	      return false;
	    }

		function agregarArticulo(){
			var id_producto = $("#nombre_producto").val();
			console.log(id_producto);
			var success;
			var url = "/productos/obtener_datos";
			var dataForm = new FormData();
			dataForm.append('id_producto',id_producto);
			//lamando al metodo ajax
			metodoAjax(url,dataForm,function(success){
				//aquí se escribe todas las operaciones que se harían en el succes
				//la variable success es el json que recibe del servidor el método AJAX
				//console.log(success);
				if(success['producto']){
					var tmp_obj = {
						id_producto : id_producto,
						cantidad : 1,
						precio_venta : success['producto']['PRECIO_VENTA']
					}
					pos = array_articulos.map(function(e) { return e.id_producto; }).indexOf(id_producto);
					console.log('Posicion: '+pos);
					if(pos>-1){
						//console.log("-------------------------");
						//console.log("#contador_"+id_producto);
						var num = $("#contador_"+id_producto).val();
						//console.log(num);
						var tot_art = parseInt(num) + parseInt(1);
						//console.log(tmp);
						$("#contador_"+id_producto).val(tot_art);
						var total = parseInt(success['producto']['PRECIO_VENTA']) * parseInt(tot_art);
						array_articulos[pos].cantidad = tot_art;
						
						$("#subtotal_"+id_producto).html('$ '+total);
					}else{
						$("#cuerpoVenta").append(
							'<tr id="tr_'+ id_producto +'">'+
								'<td>'+ id_producto +'</td>'+
								'<td>'+success['producto']['NOMBRE_PRODUCTO'] +'</td>'+
								'<td>'+'<input type="number" class="form-control" id="contador_'+ id_producto +'" value="1" onchange="cambio(this,'+id_producto+','+success['producto']['PRECIO_VENTA']+' )">'+'</td>'+
								'<td>$ '+success['producto']['PRECIO_VENTA']+'</td>'+
								'<td id="subtotal_'+ id_producto +'" >$ '+ success['producto']['PRECIO_VENTA']+'</td>'+
								'<td id="btn_'+ id_producto +'" >'+
									'<button type="button" class="btn btn-danger btn-xs" onclick="EliminarProductoLista('+id_producto+')" data-toggle="tooltip" data-placement="top" title="VER INFORMACIÓN">'+
									    '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>'+
					  				'</button>'+
								'</td>'+
							'</tr>'
						);//
						i++; 
						array_articulos[contador_articulos] = tmp_obj;
						contador_articulos++;
					}
					console.log(array_articulos);
					calcularTotal();
				}else{
					$("#ModalProductoInexistente").modal();
				}
			});//*

			//$("#nombre_producto").val("EPALE");
		}

		function EliminarProductoLista(id_producto){
			console.log(id_producto);
			var pos = array_articulos.map(function(e) { return e.id_producto; }).indexOf(id_producto.toString());
			//var removed = array_articulos.splice(pos);
			delete array_articulos[pos];
			//console.log(removed);
			console.log(array_articulos);
			$("#tr_"+id_producto).remove();
		}

		function calcularTotal(){
			console.log("-----------");
			var total = 0;
			for(var j = 0; j < array_articulos.length; j++){
				if(array_articulos[j]){
					cantidad = array_articulos[j].cantidad;
					precio = array_articulos[j].precio_venta;
					total = parseInt(total) + parseInt( parseInt(cantidad) * parseInt(precio));
					//console.log(total);
				}
			}
			console.log(total);
			$("#total_cuenta").html("&nbsp&nbsp$ " + total)
			/*$.each(array_articulos, function(objeto){
				array_articulos[]
			});//*/
			console.log("-----------");
		}

		function cambio(elemento,id_producto,precio){
			console.log(id_producto);
			var num = $(elemento).val();
			var total = parseInt(precio) * parseInt(num);
			//console.log(id_producto.toString());
			pos = array_articulos.map(function(e) { return e.id_producto; }).indexOf(id_producto.toString());
			//console.log(pos);
			array_articulos[pos].cantidad = num;
			$("#subtotal_"+id_producto).html('$ '+total);
			console.log(array_articulos);
			calcularTotal();
		}

		function finalizarCompra(){
	    	var id_producto = $("#nombre_producto").val();
			console.log(id_producto);
			var success;
			var url = "/venta/almacenar_venta";
			var dataForm = new FormData();
			dataForm.append('venta',JSON.stringify({venta:array_articulos}));
			//lamando al metodo ajax
			metodoAjax(url,dataForm,function(success){

			});
	    }//*/

		/*function tecla(){
			alert('EL TECLADO BLOQUEADO')
			$("#nombre_producto").val("");
		}; 
		document.onkeydown=tecla;
		$("#nombre_producto").val("");
		$("#nombre_producto").val("");//*/
	</script>
@endsection