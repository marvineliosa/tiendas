<!DOCTYPE html>
<html>
	<head>
		<title>Prueba jsPDF</title>
		<style>
		    table {
		      border: #b2b2b2 1px solid;
		      border-spacing: 10px;
		    }
		    td {
		      border: black 1px solid;
		    }
		    table {
		      border-collapse: collapse;
		    }
		    body { font-family: 'Lucida Console', Monaco, monospace; font-size: 11px;}

		  </style>
	</head>
	<body id="cuerpoPagina">
		<div id="codigos">
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
	<script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
	<script src="{{asset('jsbarcode/JsBarcode.all.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
</html>