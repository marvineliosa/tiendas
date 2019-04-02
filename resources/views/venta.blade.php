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
	            <div class="form-group">
	              	<div class="col-md-3 col-sm-3 col-xs-12">
	                	<input type="text" class="form-control" placeholder="" id="nombre_producto">
	              	</div>
	              	<div class="col-md-2 col-sm-2 col-xs-12">
	        			<button type="button" class="btn btn-primary" onclick="agregarArticulo()">Agregar Producto</button> 
	              	</div>
	            </div>
        	</div>
	      </div>
	      <div class="x_content">
	      	<table class="table table-hover" id="TablaVenta">
	          <thead>
	            <tr>
	              <th scope="row" style="vertical-align: middle; width: 10%;">#</th>
	              <th style="vertical-align: middle; width: 30%;">Producto</th>
	              <th style="vertical-align: middle; width: 20%;">Cantidad</th>
	              <th style="vertical-align: middle; width: 20%;">Precio</th>
	              <th style="vertical-align: middle; width: 20%;">Subtotal</th>
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
	              <th style="text-align: ; width: 20%;">&nbsp&nbspTotal:</th>
	              <th style="vertical-align: middle; width: 20%;">&nbsp&nbsp$135.85</th>
	            </tr>
	          </thead>
	          <tbody>
	          	<td></td>
	          	<td></td>
	          	<td></td>
	          	<td><br><br><br><button type="button" class="btn btn-danger pull-right" onclick="finalizarCompra()">Cancelar Compra</button></td>
	          	<td><br><br><br><button type="button" class="btn btn-primary" onclick="finalizarCompra()">Filanizar Compra</button></td>

	          </tbody>
	      	</table>

	      </div>
	  </div>
	</div>
</div>
@endsection

@section('script')
	<script type="text/javascript">
		var i = 1;
		function agregarArticulo(){
			var producto = $("#nombre_producto").val();
			if(producto != ""){
				$("#cuerpoVenta").append(
					'<tr>'+
						'<td>'+i+'</td>'+
						'<td>'+producto+'</td>'+
						'<td>'+'<input type="number" class="form-control" id="nombre_producto" value="1">'+'</td>'+
						'<td>$'+'158.27'+'</td>'+
						'<td>$'+'158.27'+'</td>'+
					'</tr>'
				);
				i++;
			}
		}
	</script>
@endsection