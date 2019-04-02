<!DOCTYPE html>
<html>
	<head>
		<title>Impresión de Códigos</title>
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
		    body { font-family: 'Lucida Console', Monaco, monospace; font-size: 12px;}

		  </style>
	</head>
	<body id="cuerpoPagina">
		<div id="codigos">
		</div>
		<table width="100%" align="center">
			<tbody id="tabla_codigos">
				
			</tbody>
		</table>
	</body>
	<script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
	<script src="{{asset('jsbarcode/JsBarcode.all.js')}}"></script>
</html>


<script type="text/javascript">
	llenaCodigos();
	function llenaCodigos(){
		var numero = 123456789;
		var nombre_producto = 'NOMBRE COMPLETO DEL PRODUCTO A IMPRIMIR';
		var nombre_producto = '&nbsp'+'CHAMARRA ELITE MARINO FEMENIL TALLA XL'+'&nbsp';
		//var nombre_producto = '&nbsp'+'CHAMARRA ELITE MARINO VARONIL XS'+'&nbsp';
		for(var i = 0; i < 10; i++){
			//var img = '<img id="codigo-'+i+'"/>';
			/*var img = 	'<div style="display: inline-block;text-align: center;">'+
							'<img id="codigo-'+i+'"/><br>'+
							'<span align="center">'+'Producto'+'</span>'+
						'</div>';//*/
			var img = 	'<img id="codigo-'+i+'" /><br>'+
						'<sup align="center">'+nombre_producto+'</sup>';//*/

			//console.log(img);
			//var div = $("#codigos");
			//console.log(div);
			$("#tabla_codigos").append(
				'<tr style="text-align: center;">' +
					'<td>' + img + '</td>' +
					'<td>' + img + '</td>' +
					'<td>' + img + '</td>' +
				'</tr>'
			);
			JsBarcode("#codigo-"+i, numero, {
			  height: 41
			});
		}
		//window.print();
	}
</script>