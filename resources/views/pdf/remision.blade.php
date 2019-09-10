<!DOCTYPE html>
<html>

	<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

		<title>Remision</title>
	</head>
	<body id="cuerpoPagina">
		<div><br></div>
		<div id="Parte1">
			<div class="form-inline">
			  <div class="form-group col-md-4">
			    NOTA de remisión
			  </div>
			  <div class="form-group col-md-4">
			    {{$datos_venta->FECHA_VENTA}}
			  </div>
			  <div class="form-group col-md-4">
			    {{$datos_venta->CONSECUTIVO_ANUAL}}
			  </div>
			</div>
			<br>
		</div>
		<div id="codigos" style="background-color: #013c5a;">
			epale
		</div>
		<table class="table table-bordered">
            <thead id="HeadTablaDevoluciones">
              <tr align="center">
                <th scope="col"></th>
                <th scope="col">Codigo</th>
                <th scope="col">Producto</th>
                <th scope="col">Cantidad Vendida</th>
                <th scope="col">Cantidad Devolución</th>
                <th scope="col">Precio de Venta</th>
                <th scope="col">Subtotal</th>
              </tr>
            </thead>
            <tbody id="CuerpoModalDevoluciones">
              @foreach($detalles as $venta)
              	
              @endforeach
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