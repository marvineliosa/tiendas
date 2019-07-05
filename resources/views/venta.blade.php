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
	                	<input type="number" class="form-control" placeholder="Ingrese el código" id="nombre_producto">
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
	          	<td><br><br><br><button id="GlCancelarCompra" type="button" class="btn btn-danger pull-right" onclick="CancelarCompra()">Cancelar Compra</button></td>
	          	<td><br><br><br><button id="GlFinalizarCompra" type="button" class="btn btn-primary" onclick="ModalTipoPago()">Filanizar Compra</button></td>

	          </tbody>
	      	</table>

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
      <div class="modal-header" align="center">
        <h1>Formas de pago</h1>
      </div>
      <div class="modal-body">

      	<div class="form-horizontal form-label-left">
	      	<!-- ID del trabajador -->
	        <div class="form-group">
	          <div class="col-md-2 col-sm-2 col-xs-12"></div>
	          <div class="col-md-4 col-sm-4 col-xs-12">
	            <button type="button" class="btn btn-success btn-lg btn-block" onclick="PagoDebito()">Tarjeta de Débito</button>
	          </div>
	          <div class="col-md-4 col-sm-4 col-xs-12">
	            <button type="button" class="btn btn-success btn-lg btn-block" onclick="PagoCredito()">Tarjeta de Crédito</button>
	          </div>
	          <div class="col-md-2 col-sm-2 col-xs-12"></div>
	        </div>
	      	<!-- ID del trabajador -->
	        <div class="form-group">
	          <div class="col-md-2 col-sm-2 col-xs-12"></div>
	          <div class="col-md-4 col-sm-4 col-xs-12"> 
	            <button type="button" class="btn btn-success btn-lg btn-block" onclick="PagoEfectivo()">Efectivo</button>
	          </div>
	          <div class="col-md-4 col-sm-4 col-xs-12">
	            <button type="button" class="btn btn-success btn-lg btn-block" onclick="PagoMixto()">Mixto</button>
	          </div>
	          <div class="col-md-2 col-sm-2 col-xs-12"></div>
	        </div>
	      	<!-- ID del trabajador -->
	        <div class="form-group">
	          <div class="col-md-2 col-sm-2 col-xs-12"></div>
	          <div class="col-md-4 col-sm-4 col-xs-12"> 
	            <button type="button" class="btn btn-success btn-lg btn-block" onclick="PagoTransferencia()">Transferencia</button>
	          </div>
	          <div class="col-md-4 col-sm-4 col-xs-12">
	            <button type="button" class="btn btn-success btn-lg btn-block" onclick="PagoDeposito()">Depósito</button>
	          </div>
	          <div class="col-md-2 col-sm-2 col-xs-12"></div>
	        </div>
	      	<!-- ID del trabajador -->
	        <div class="form-group">
	          <div class="col-md-4 col-sm-4 col-xs-12"></div>
	          <div class="col-md-4 col-sm-4 col-xs-12">
	            <button type="button" class="btn btn-success btn-lg btn-block" onclick="PagoNomina()">Vía nómina</button>
	          </div>
	          <div class="col-md-4 col-sm-4 col-xs-12"></div>
	        </div>
        </div>

      </div>
      <div class="modal-footer">
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

<!-- Modal ConfirmacionPago -->
<div class="modal fade" id="ModalPagoDebito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        	<h2 id="TextoPagoDebito"></h2>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="BtnPagoDebito" onclick="AjaxPagoDebito(this)">Confirmar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal ModalPagoCredito -->
<div class="modal fade" id="ModalPagoCredito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        	<h2 id="TextoPagoCredito"></h2>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="BtnPagoCredito" onclick="AjaxPagoCredito(this)">Confirmar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal ModalPagoEfectivo -->
<div class="modal fade" id="ModalPagoEfectivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        	<h2 id="TextoPagoEfectivo"></h2>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="BtnPagoEfectivo" onclick="AjaxPagoEfectivo(this)">Confirmar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal ModalConfirmacionPago -->
<div class="modal fade" id="ModalConfirmacionPago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        	<h2 id="TextoConfirmacionPago"></h2>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Confirmar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal ModalPagoMixto -->
<div class="modal fade" id="ModalPagoMixto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" align="center">
        <h2 class="modal-title" id="exampleModalLabel">Pago Mixto</h2>
      </div>
      <div class="modal-body">

      	<div class="form-horizontal form-label-left">
	      	<!-- Pago débito -->
	        <div class="form-group">
	          <div class="col-md-2 col-sm-2 col-xs-12"></div>
	          <label class="control-label col-md-2 col-sm-2 col-xs-12">Tarjeta de Débito</label>
	          <div class="col-md-4 col-sm-4 col-xs-12">
	            <input type="number" class="form-control" id="PagoMixtoDebito" aria-describedby="emailHelp" placeholder="">
	          </div>
	          <div class="col-md-2 col-sm-2 col-xs-12"></div>
	        </div>
	      	<!-- Pago crédito -->
	        <div class="form-group">
	          <div class="col-md-2 col-sm-2 col-xs-12"></div>
	          <label class="control-label col-md-2 col-sm-2 col-xs-12">Tarjeta de Crédito</label>
	          <div class="col-md-4 col-sm-4 col-xs-12">
	            <input type="number" class="form-control" id="PagoMixtoCredito" aria-describedby="emailHelp" placeholder="">
	          </div>
	          <div class="col-md-2 col-sm-2 col-xs-12"></div>
	        </div>
	      	<!-- Pago Efectivo -->
	        <div class="form-group">
	          <div class="col-md-2 col-sm-2 col-xs-12"></div>
	          <label class="control-label col-md-2 col-sm-2 col-xs-12">Efectivo</label>
	          <div class="col-md-4 col-sm-4 col-xs-12">
	            <input type="number" class="form-control" id="PagoMixtoEfectivo" aria-describedby="emailHelp" placeholder="">
	          </div>
	          <div class="col-md-2 col-sm-2 col-xs-12"></div>
	        </div>

	      	<!-- Total a pagar -->
	        <div class="form-group">
	          <div class="col-md-2 col-sm-2 col-xs-12"></div>
	          <label class="control-label col-md-2 col-sm-2 col-xs-12">Total:</label>
	          <label class="control-label col-md-2 col-sm-2 col-xs-12 pull-left" id="PagoMixtoTotal"></label>
	          <div class="col-md-2 col-sm-2 col-xs-12"></div>
	        </div>
        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="BtnPagoMixto" onclick="AjaxPagoMixto(this)">Confirmar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal ModalPagoTransferencia -->
<div class="modal fade" id="ModalPagoTransferencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" align="center">
        <h2 class="modal-title" id="exampleModalLabel">Transferencia</h2>
      </div>
      <div class="modal-body">

      	<div class="form-horizontal form-label-left">
	      	<!-- Pago débito -->
	        <div class="form-group">
	          <div class="col-md-2 col-sm-2 col-xs-12"></div>
	          <label class="control-label col-md-2 col-sm-2 col-xs-12">Número de operación</label>
	          <div class="col-md-4 col-sm-4 col-xs-12">
	            <input type="text" class="form-control" id="TransferenciaNumeroOperacion" placeholder="">
	          </div>
	          <div class="col-md-2 col-sm-2 col-xs-12"></div>
	        </div>
	      	<!-- Total a pagar -->
	        <div class="form-group">
	          <div class="col-md-2 col-sm-2 col-xs-12"></div>
	          <label class="control-label col-md-2 col-sm-2 col-xs-12">Total:</label>
	          <label class="control-label col-md-2 col-sm-2 col-xs-12 pull-left" id="TransferenciaTotal"></label>
	          <div class="col-md-2 col-sm-2 col-xs-12"></div>
	        </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="BtnPagoTransferencia" onclick="AjaxPagoTransferencia()">Confirmar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal ModalPagoDeposito -->
<div class="modal fade" id="ModalPagoDeposito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" align="center">
        <h2 class="modal-title" id="exampleModalLabel">Depósito</h2>
      </div>
      <div class="modal-body">

      	<div class="form-horizontal form-label-left">
	      	<!-- Pago débito -->
	        <div class="form-group">
	          <div class="col-md-2 col-sm-2 col-xs-12"></div>
	          <label class="control-label col-md-2 col-sm-2 col-xs-12">Ficha de depósito</label>
	          <div class="col-md-4 col-sm-4 col-xs-12">
	            <input type="number" class="form-control" id="DepositoFichaDeposito" aria-describedby="emailHelp" placeholder="">
	          </div>
	          <div class="col-md-2 col-sm-2 col-xs-12"></div>
	        </div>

	      	<!-- Total a pagar -->
	        <div class="form-group">
	          <div class="col-md-2 col-sm-2 col-xs-12"></div>
	          <label class="control-label col-md-2 col-sm-2 col-xs-12">Total:</label>
	          <label class="control-label col-md-2 col-sm-2 col-xs-12 pull-left" id="DepositoTotal"></label>
	          <div class="col-md-2 col-sm-2 col-xs-12"></div>
	        </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="BtnPagoDeposito" onclick="AjaxPagoDeposito(this)">Confirmar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Créditos a Unidades Académicas -->
<div class="modal fade" id="ModalInventarioOtrasTiendas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        	<h3>No cuenta con inventario suficiente, puede encontrar el producto en los siguientes espacios.</h3>
        </div>
        <table class="table">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Espacio</th>
		      <th scope="col">Existencias</th>
		    </tr>
		  </thead>
		  <tbody id="BodyInventarioOtrasTiendas">
		    
		  </tbody>
		</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Descuento Vía Nómina -->
<div class="modal fade" id="ModalDescuentoViaNomina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" align="center">
        <h2 class="modal-title" id="exampleModalLabel">Descuento vía nómina</h2>
      </div>
      <div class="modal-body">

      	<div class="form-horizontal form-label-left">
	      	<!-- ID del trabajador -->
	        <div class="form-group">
	          <label class="control-label col-md-2 col-sm-2 col-xs-12">ID del trabajador*</label>
	          <div class="col-md-10 col-sm-10 col-xs-12">
	            <input type="text" class="form-control" placeholder="" id="id_trabajador_pago_nomina">
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
	            <select class="form-control" id="pago_nomina_quincenas">
			      <option value="NA">SELECCIONAR</option>
			      <option value="1">1</option>
			      <option value="2">2</option>
			      <option value="3">3</option>
			      <option value="4">4</option>
			      <option value="5">5</option>
			      <option value="6">6</option>
			    </select>
	          </div>
	        </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="BtnPagoNomina" onclick="AjaxPagoNomina()">Finalizar Compra</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal CompraFinalizada -->
<div class="modal fade" id="ModalCompraFinalizada" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" align="center">
        <h2 class="modal-title" id="exampleModalLabel">¡Éxito!</h2>
      </div>
      <div class="modal-body">

      	<h2 class="modal-title" id="TxtFinalizacionCompra" align="center">La compra ha sido almacenada satisfactoriamente, por favor ingrese el correo electrónico al que se enviará la remisión.</h2>
      	<h2 class="modal-title" align="center"><strong  id="TxtNumeroNota"></strong></h2>
      	<div class="form-horizontal form-label-left">
	      	<!-- correo electronico -->
	        <div class="form-group">
	          <label class="control-label col-md-2 col-sm-2 col-xs-12">Correo Electrónico</label>
	          <div class="col-md-10 col-sm-10 col-xs-12">
	            <input type="email" class="form-control" placeholder="" id="email_remision">
	          </div>
	        </div>
	      	
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="finalizarCompra()">Enviar remisión</button>
        <button type="button" class="btn btn-primary" onclick="finalizarCompra()">Imprimir remisión</button>
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
		//$("#ModalPagoTransferencia").modal();
		var i = 1;
		var array_articulos = new Array();
		var contador_articulos = 0;
		function CancelarSubmit(){
	      console.log("Epale");
	      return false;
	    }

	    //$("#ModalCompraFinalizada").modal();

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
					if(success['producto']['INVENTARIO_SESION']>0){
						var tmp_obj = {
							id_producto : id_producto,
							cantidad : 1,
							precio_venta : success['producto']['PRECIO_VENTA']
						}
						//se verifica si el proucto ya está listado para posteriormente agregarlo o solo aumentar el contador
						pos = array_articulos.map(function(e) { return e.id_producto; }).indexOf(id_producto);
						//console.log('Posicion: '+pos);
						
						if(pos>-1){
							//console.log("-------------------------");
							//console.log("#contador_"+id_producto);
							var num = $("#contador_"+id_producto).val();
							if(parseInt(num)==success['producto']['INVENTARIO_SESION']){
								alert('limite alcanzado');
								//calcularTotal();
							}else{
								//console.log(num);
								var tot_art = parseInt(num) + parseInt(1);
								//console.log(tmp);
								$("#contador_"+id_producto).val(tot_art);
								var total = parseInt(success['producto']['PRECIO_VENTA']) * parseInt(tot_art);
								array_articulos[pos].cantidad = tot_art;
								
								$("#subtotal_"+id_producto).html('$ '+total);

							}
						}else{
							$("#cuerpoVenta").append(
								'<tr id="tr_'+ id_producto +'">'+
									'<td>'+ id_producto +'</td>'+
									'<td>'+success['producto']['NOMBRE_PRODUCTO'] +'</td>'+
									'<td>'+'<input type="number" class="form-control" id="contador_'+ id_producto +'" value="1" onchange="cambio(this,'+id_producto+','+success['producto']['PRECIO_VENTA']+','+success['producto']['INVENTARIO_SESION']+' )">'+'</td>'+
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
						//console.log(array_articulos);
						calcularTotal();
						//$("#nombre_producto").focus();
					}else{
						//alert('Sin existencias en la tienda');
						MostrarInventarioOtrasTiendas(success['producto']['INVENTARIO']);
					}
				}else{
					$("#ModalProductoInexistente").modal();
				}
			});//*

			//$("#nombre_producto").focus();

			$("#nombre_producto").val("");
			//$("#nombre_producto").focus();
			//$("#nombre_producto").focus();
		}

		function MostrarInventarioOtrasTiendas(inventario){
			//console.log(inventario);
			$("#BodyInventarioOtrasTiendas").html("");
			for(var i = 0; i < inventario.length; i++){
				$("#BodyInventarioOtrasTiendas").append(

				    '<tr>'+
				      '<th scope="row">'+ (parseInt(i)+parseInt(1)) +'</th>'+
				      '<td>'+ inventario[i]['ESPACIO_EXISTENCIAS'] +'</td>'+
				      '<td>'+ inventario[i]['CANTIDAD_EXISTENCIAS'] +'</td>'+
				    '</tr>'
				);
			}
			$("#ModalInventarioOtrasTiendas").modal();

		}

		function EliminarProductoLista(id_producto){
			console.log(id_producto);
			var pos = array_articulos.map(function(e) { return e.id_producto; }).indexOf(id_producto.toString());
			//var removed = array_articulos.splice(pos);
			delete array_articulos[pos];
			//console.log(removed);
			console.log(array_articulos);
			$("#tr_"+id_producto).remove();
			calcularTotal();
		}

		function RegresaTotal(){
			var total = 0;
			for(var j = 0; j < array_articulos.length; j++){
				if(array_articulos[j]){
					cantidad = array_articulos[j].cantidad;
					precio = array_articulos[j].precio_venta;
					total = parseInt(total) + parseInt( parseInt(cantidad) * parseInt(precio));
					//console.log(total);
				}
			}
			return total;
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

		//
		function cambio(elemento,id_producto,precio,existencias_sesion){
			//console.log(existencias_sesion);
			var num = $(elemento).val();//conteo de numero de articulos actual
			if(parseInt(num)<=parseInt(existencias_sesion)){
				var total = parseInt(precio) * parseInt(num);
				//console.log(id_producto.toString());
				pos = array_articulos.map(function(e) { return e.id_producto; }).indexOf(id_producto.toString());
				//console.log(pos);
				array_articulos[pos].cantidad = num;
				$("#subtotal_"+id_producto).html('$ '+total);
				console.log(array_articulos);
				calcularTotal();
			}else{
				alert('Líminte de existencias alcanzado');
				pos = array_articulos.map(function(e) { return e.id_producto; }).indexOf(id_producto.toString());
				//console.log(pos);
				array_articulos[pos].cantidad = existencias_sesion;
				$(elemento).val(existencias_sesion);
				calcularTotal();
			}
			
		}

		function ModalTipoPago(){
			$("#ModalEleccionTipoPago").modal();
		}

		function AjaxFinalizarCompra(){
	    	var id_producto = $("#nombre_producto").val();
			console.log(id_producto);
			var success;
			var url = "/venta/almacenar_venta";
			var dataForm = new FormData();
			dataForm.append('venta',JSON.stringify({venta:array_articulos}));
			//lamando al metodo ajax
			metodoAjax(url,dataForm,function(success){

				//$('#ModalPagoDebito').modal('hide');

			});
	    }//*/

	    function PagoDebito(){
	    	var total = RegresaTotal();
	    	//console.log(total);
	    	if(total > 0){
		    	$("#TextoPagoDebito").text('Se registrará la compra con tarjeta de débito por la cantidad de $'+total);
		    	//$("#TextoPagoDebito").text('Se registrará la compra con tarjeta de débito por la cantidad de $158.60');
		    	$("#BtnPagoDebito").attr('disabled',false);
		    	$('#ModalPagoDebito').modal();
	    	}else{
	    		MensajeModal('¡ATENCIÓN!','No se han agregado artículos a la lista');
	    	}
	    }

	    function AjaxPagoDebito(boton){
	    	$("#BtnPagoDebito").attr('disabled',true);
	    	console.log('DEBITO');
	    	var total = RegresaTotal();
	    	var id_producto = $("#nombre_producto").val();
			console.log(id_producto);
			var success;
			var url = "/venta/almacenar_venta/debito";
			var dataForm = new FormData();
			dataForm.append('venta',JSON.stringify({venta:array_articulos,total:total}));
			//lamando al metodo ajax
			metodoAjax(url,dataForm,function(success){
				$('#ModalPagoDebito').modal('hide');
				$("#ModalEleccionTipoPago").modal('hide');
				//MensajeModal('¡Éxito!','La venta ha sido almacenada satisfactoriamente, el número de venta es: '+success['id_nota']);
				$("#TxtNumeroNota").text('Remisión: '+success['id_nota']);
				$("#ModalCompraFinalizada").modal();
				$("#GlCancelarCompra").attr('disabled',true);
				$("#GlFinalizarCompra").attr('disabled',true);

			});
	    }

	    function PagoCredito(){
	    	var total = RegresaTotal();
	    	//console.log(total);
	    	if(total > 0){
		    	$("#TextoPagoCredito").text('Se registrará la compra con tarjeta de crédito por la cantidad de $'+total);
		    	//$("#TextoPagoDebito").text('Se registrará la compra con tarjeta de débito por la cantidad de $158.60');
		    	$("#BtnPagoCredito").attr('disabled',false);
		    	$('#ModalPagoCredito').modal();
	    	}else{
	    		MensajeModal('¡ATENCIÓN!','No se han agregado artículos a la lista');
	    	}
	    }

	    function AjaxPagoCredito(boton){
	    	$("#BtnPagoCredito").attr('disabled',true);
	    	console.log('CREDITO');
	    	var total = RegresaTotal();
	    	var id_producto = $("#nombre_producto").val();
			console.log(id_producto);
			var success;
			var url = "/venta/almacenar_venta/credito";
			var dataForm = new FormData();
			dataForm.append('venta',JSON.stringify({venta:array_articulos,total:total}));
			//lamando al metodo ajax
			metodoAjax(url,dataForm,function(success){
				$('#ModalPagoCredito').modal('hide');
				$("#ModalEleccionTipoPago").modal('hide');
				//MensajeModal('¡Éxito!','La venta ha sido almacenada satisfactoriamente, el número de venta es: '+success['id_nota']);
				$("#TxtNumeroNota").text('Remisión: '+success['id_nota']);
				$("#ModalCompraFinalizada").modal();
				$("#GlCancelarCompra").attr('disabled',true);
				$("#GlFinalizarCompra").attr('disabled',true);

			});
	    }

	    function PagoEfectivo(){
	    	var total = RegresaTotal();
	    	console.log(total);
	    	if(total > 0){
		    	$("#TextoPagoEfectivo").text('Se registrará la compra con pago en efectivo por la cantidad de $ '+total);
		    	$("#BtnPagoEfectivo").attr('disabled',false);
		    	$('#ModalPagoEfectivo').modal();
	    	}else{
	    		MensajeModal('¡ATENCIÓN!','No se han agregado artículos a la lista');
	    	}
	    }

	    function AjaxPagoEfectivo(boton){
	    	$("#BtnPagoEfectivo").attr('disabled',true);
	    	console.log('EFECTIVO');
	    	var total = RegresaTotal();
	    	var id_producto = $("#nombre_producto").val();
			console.log(id_producto);
			var success;
			var url = "/venta/almacenar_venta/efectivo";
			var dataForm = new FormData();
			dataForm.append('venta',JSON.stringify({venta:array_articulos,total:total}));
			//lamando al metodo ajax
			metodoAjax(url,dataForm,function(success){
				$('#ModalPagoEfectivo').modal('hide');
				$("#ModalEleccionTipoPago").modal('hide');
				//MensajeModal('¡Éxito!','La venta ha sido almacenada satisfactoriamente, el número de venta es: '+success['id_nota']);
				$("#TxtNumeroNota").text('Remisión: '+success['id_nota']);
				$("#ModalCompraFinalizada").modal();
				$("#GlCancelarCompra").attr('disabled',true);
				$("#GlFinalizarCompra").attr('disabled',true);

			});
	    }

	    function PagoMixto(){
	    	var total = RegresaTotal();
	    	if(total > 0){
		    	$("#PagoMixtoTotal").text('$ '+total);
	    		$("#BtnPagoMixto").attr('disabled',false);
				$("#ModalPagoMixto").modal();
	    	}else{
	    		MensajeModal('¡ATENCIÓN!','No se han agregado artículos a la lista');
	    	}
	    }

	    function AjaxPagoMixto(elemento){
	    	$("#BtnPagoMixto").attr('disabled',true);
	    	var total = RegresaTotal();
	    	var cantidad_debito = $("#PagoMixtoDebito").val();
	    	cantidad_debito = ((cantidad_debito)?cantidad_debito:0);
	    	var cantidad_credito = $("#PagoMixtoCredito").val();
	    	cantidad_credito = ((cantidad_credito)?cantidad_credito:0);
	    	var cantidad_efectivo = $("#PagoMixtoEfectivo").val();
	    	cantidad_efectivo = ((cantidad_efectivo)?cantidad_efectivo:0);
	    	var acumulado = parseInt(cantidad_debito) + parseInt(cantidad_credito) + parseInt(cantidad_efectivo);
	    	//console.log(acumulado);

	    	if(acumulado >= total){
	    		console.log('Cantidad completada');
		    	$("#BtnPagoMixto").attr('disabled',true);
		    	console.log('PAGO MIXTO');
		    	var total = RegresaTotal();
		    	var id_producto = $("#nombre_producto").val();
				//console.log(id_producto);
				var success;
				var url = "/venta/almacenar_venta/mixto";
				var dataForm = new FormData();
				//console.log(array_articulos);
				var pagos={'efectivo':cantidad_efectivo,'credito':cantidad_credito,'debito':cantidad_debito};
				dataForm.append('venta',JSON.stringify({venta:array_articulos,total:total,pagos:pagos}));
				//lamando al metodo ajax - 1379.75 / 1563.58
				metodoAjax(url,dataForm,function(success){
					$('#ModalPagoMixto').modal('hide');
					$("#ModalEleccionTipoPago").modal('hide');
					//MensajeModal('¡Éxito!','La venta ha sido almacenada satisfactoriamente, el número de venta es: '+success['id_nota']);
					$("#TxtNumeroNota").text('Remisión: '+success['id_nota']);
					$("#ModalCompraFinalizada").modal();
					$("#GlCancelarCompra").attr('disabled',true);
					$("#GlFinalizarCompra").attr('disabled',true);

				});//*/
	    	}else{
	    		MensajeModal('¡ATENCIÓN!','Aún no se ha cubierto el total');
	    	}
	    }

	    function PagoTransferencia(){
	    	var total = RegresaTotal();
	    	if(total > 0){
		    	$("#TransferenciaTotal").text('$ '+total);
		    	$("#ModalPagoTransferencia").modal();
	    		$("#BtnPagoTransferencia").attr('disabled',false);
	    	}else{
	    		MensajeModal('¡ATENCIÓN!','No se han agregado artículos a la lista');
	    	}
	    }

	    function AjaxPagoTransferencia(){
	    	var numero_operacion = $("#TransferenciaNumeroOperacion").val();
	    	console.log(numero_operacion);
	    	if(numero_operacion != ''){
	    		$("#BtnPagoTransferencia").attr('disabled',true);
		    	console.log('PAGO TRANSFERENCIA: '+numero_operacion);
		    	var total = RegresaTotal();
		    	var id_producto = $("#nombre_producto").val();
				//console.log(id_producto);
				var success;
				var url = "/venta/almacenar_venta/transferencia";
				var dataForm = new FormData();
				//console.log(array_articulos);
				dataForm.append('venta',JSON.stringify({venta:array_articulos,total:total,operacion:numero_operacion}));
				//lamando al metodo ajax - 1379.75 / 1563.58
				metodoAjax(url,dataForm,function(success){
					$('#ModalPagoTransferencia').modal('hide');
					$("#ModalEleccionTipoPago").modal('hide');
					//MensajeModal('¡Éxito!','La venta ha sido almacenada satisfactoriamente, el número de venta es: '+success['id_nota']);
					$("#TxtNumeroNota").text('Remisión: '+success['id_nota']);
					$("#ModalCompraFinalizada").modal();
					$("#GlCancelarCompra").attr('disabled',true);
					$("#GlFinalizarCompra").attr('disabled',true);
				});//*/
	    	}else{
	    		MensajeModal('¡ATENCIÓN!','Ingrese el número de operación');
	    	}
	    }//*/

	    function PagoDeposito(){
	    	var total = RegresaTotal();
	    	if(total > 0){
		    	$("#DepositoTotal").text('$ '+total);
		    	$("#ModalPagoDeposito").modal();
	    		$("#BtnPagoDeposito").attr('disabled',false);
	    	}else{
	    		MensajeModal('¡ATENCIÓN!','No se han agregado artículos a la lista');
	    	}
	    }

	    function AjaxPagoDeposito(){
	    	var ficha = $("#DepositoFichaDeposito").val();
	    	if(ficha != ''){
	    		console.log('DEPOSITO:' + ficha);
	    		$("#BtnPagoDeposito").attr('disabled',true);
		    	var total = RegresaTotal();
		    	var id_producto = $("#nombre_producto").val();
				var success;
				var url = "/venta/almacenar_venta/deposito";
				var dataForm = new FormData();
				//console.log(array_articulos);
				dataForm.append('venta',JSON.stringify({venta:array_articulos,total:total,ficha:ficha}));
				//lamando al metodo ajax - 1379.75 / 1563.58
				metodoAjax(url,dataForm,function(success){
					$('#ModalPagoDeposito').modal('hide');
					$("#ModalEleccionTipoPago").modal('hide');
					//MensajeModal('¡Éxito!','La venta ha sido almacenada satisfactoriamente, el número de venta es: '+success['id_nota']);
					$("#TxtNumeroNota").text('Remisión: '+success['id_nota']);
					$("#ModalCompraFinalizada").modal();
					$("#GlCancelarCompra").attr('disabled',true);
					$("#GlFinalizarCompra").attr('disabled',true);
				});//*/

	    	}else{
	    		MensajeModal('¡ATENCIÓN!','Favor de registrar la ficha de depósito')
	    	}
	    }

	    function PagoNomina(){
	    	var total = RegresaTotal();
	    	if(total > 0){
		    	$("#pago_nomina_importe").val(total);
		    	$("#ModalDescuentoViaNomina").modal();
	    		$("#BtnPagoNomina").attr('disabled',false);
	    	}else{
	    		MensajeModal('¡ATENCIÓN!','No se han agregado artículos a la lista');
	    	}
	    }

	    function AjaxPagoNomina(elemento){
	    	var id_trabajador = $("#id_trabajador_pago_nomina").val();
	    	var nombre_trabajador = $("#pago_nomina_nombre_tr").val();
	    	var importe = $("#pago_nomina_importe").val();
	    	var quincenas = $("#pago_nomina_quincenas").val();
	    	/*console.log(id_trabajador);
	    	console.log(nombre_trabajador);
	    	console.log(quincenas);//*/
	    	if(id_trabajador == ''){
	    		MensajeModal('¡ATENCIÓN!','Favor de registrar el ID del trabajador');
	    	}else if(nombre_trabajador == ''){
	    		MensajeModal('¡ATENCIÓN!','Favor de registrar el nombre del trabajador');
	    	}else if(quincenas == 'NA'){
	    		MensajeModal('¡ATENCIÓN!','Favor de registrar el número de quincenas');
	    	}else{
	    		var total = RegresaTotal();
	    		console.log('NOMINA: '+total);
	    		$("#BtnPagoNomina").attr('disabled',true);
	    		var success;
				var url = "/venta/almacenar_venta/nomina";
				var dataForm = new FormData();
				dataForm.append('venta',JSON.stringify({venta:array_articulos,total:total}));
				dataForm.append('id_trabajador',id_trabajador);
				dataForm.append('nombre_trabajador',nombre_trabajador);
				dataForm.append('quincenas',parseInt(quincenas));
				//lamando al metodo ajax - 1379.75 / 1563.58
				metodoAjax(url,dataForm,function(success){
					$('#ModalPagoNomina').modal('hide');
					$("#ModalEleccionTipoPago").modal('hide');
					//MensajeModal('¡Éxito!','La venta ha sido almacenada satisfactoriamente, el número de venta es: '+success['id_nota']);
					$("#TxtNumeroNota").text('Remisión: '+success['id_nota']);
					$("#ModalCompraFinalizada").modal();
					$("#GlCancelarCompra").attr('disabled',true);
					$("#GlFinalizarCompra").attr('disabled',true);
				});//*/
	    	}
	    }

		/*function tecla(){
			alert('EL TECLADO BLOQUEADO')
			$("#nombre_producto").val("");
		}; 
		document.onkeydown=tecla;
		$("#nombre_producto").val("");
		$("#nombre_producto").val("");//*/
	</script>
@endsection