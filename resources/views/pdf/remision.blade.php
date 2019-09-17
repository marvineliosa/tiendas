<!DOCTYPE html>
<html>

	<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

		<title>Remision</title>

	<style type="text/css">
		td.total{
			border-left:	1px solid white;
			border-bottom:	1px solid white;
			border-right:	1px solid white;
		}
		td.total2{
			border-left-color:		white;
			border-bottom-color:	white;
			border-right-color:	white;
		}
	</style>
	</head>
	<body id="cuerpoPagina">
			<table class="table table">
	      <thead id="HeadTablaDevoluciones">
	        <tr align="center">
	          <td style="font-size: 12px;border-top: 0px;border-right: 0px;border-bottom: 0px solid black;border-left: 0px;">NOTA de remisión</td>
	          <td style="font-size: 12px;border-top: 0px;border-right: 0px;border-bottom: 0px solid black;border-left: 0px;">Fecha de venta: {{$datos_venta->FECHA_VENTA}}</td>
	          <td style="font-size: 12px;border-top: 0px;border-right: 0px;border-bottom: 0px solid black;border-left: 0px;">{{$datos_venta->CONSECUTIVO_ANUAL}}</td>
	        </tr>
	      </thead>
	    </table>
		<div id="codigos">
			<table class="table table-sm" style="background-color: #013c5a;">
		      <thead id="HeadTablaDevoluciones">
		        <tr align="">
		          <td style="width: 33%;border-top: 0px;border-right: 0px;border-bottom: 0px solid black;border-left: 0px;" class="align-middle"><img src="images/logo-buap.png" width="150" height="67"></td>
		          <td style="width: 33%;border-top: 0px;border-right: 0px;border-bottom: 0px solid black;border-left: 0px;"></td>
		          <td style="width: 33%;border-top: 0px;border-right: 0px;border-bottom: 0px solid black;border-left: 0px;">
		          	<p style="color:white;">
		          		<strong>{{$datos_venta->TIENDA->NOMBRE_ESPACIO}}</strong> 
		          	</p>
		          	<p style="color:white;font-size: 10px;">
		          		{{$datos_venta->TIENDA->UBICACION_ESPACIO}}
		          	</p>
		          </td>
		        </tr>
		      </thead>
		    </table>
		</div>
		<table class="table table-bordered table-sm" style="width:100%;">
	      <tbody id="CuerpoModalDevoluciones">
        	<tr>
        		<td align="right" style="width: 25%;">Nombre:</td>
        		<td align="center" style="">{{$datos_venta->NOMBRE_CLIENTE}}</td>
        	</tr>
        	<tr>
        		<td align="right" style="width: 25%;">Correo electrónico:</td>
        		<td align="center">{{$datos_venta->MAIL}}</td>
        	</tr>
	      </tbody>
	    </table>
		<table class="table table-bordered table-sm" style="width:100%;">
	      <thead id="HeadTablaDevoluciones">
	        <tr align="center">
	          <th scope="col" style="width: 10%; text-align:center;">Codigo</th>
	          <th scope="col" style="width: 10%; text-align:center;">Cantidad</th>
	          <th scope="col" style="width: 30%; text-align:center;">Producto</th>
	          <th scope="col" style="width: 10%; text-align:center;">Precio Unitario</th>
	          <th scope="col" style="width: 10%; text-align:center;">Importe</th>
	        </tr>
	      </thead>
	      <tbody id="CuerpoModalDevoluciones">
	        @foreach($detalles as $venta)
	        	<tr>
	        		<td align="center"> {{$venta->FK_PROCUTO}} </td>
	        		<td align="center"> {{$venta->CANTIDAD_VENTA}} </td>
	        		<td style="font-size: 15px;"> {{$venta->NOMBRE_PRODUCTO}} </td>
	        		<td align="right"> {{'$'.number_format($venta->PRECIO_VENTA,2)}} </td>
	        		<td align="right"> {{'$'.number_format( ($venta->CANTIDAD_VENTA * $venta->PRECIO_VENTA),2)}} </td>
	        	</tr>
	        @endforeach
	        	<tr>
	        		<td align="center" class="total2"></td>
	        		<td align="center" class="total2"></td>
	        		<td align="center" class="" style="border-bottom-color:white;"></td>
	        		<td align="right">TOTAL: </td>
	        		<td align="right"> {{'$'.number_format( ($datos_venta->VENTAS_TOTAL),2)}} </td>
	        	</tr>
	      </tbody>
	    </table>
	</body>
</html>

<script type="text/javascript">
	var remision = <?php echo json_encode($detalles) ?>;
	console.log(remision);
	var datos_venta = <?php echo json_encode($datos_venta) ?>;
	console.log(datos_venta);
</script>