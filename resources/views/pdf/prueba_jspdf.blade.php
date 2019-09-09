<!DOCTYPE html>
<html id="pagina_html">
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
		<table width="100%" align="center">
			<tbody id="tabla_codigos">
				
			</tbody>
		</table>
	</body>
	<a href="javascript:demoFromHTML()" class="button">
		<div id="testcase">
			<h1>
				We support special element handlers. Register them with jQuery-style.
			</h1>
		</div>
	</a>
	<script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
	<script src="{{asset('jsbarcode/JsBarcode.all.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
</html>


<script type="text/javascript">
	llenaCodigos();
	function llenaCodigos(){
		var numero = 123456;
		var nombre_producto = 'NOMBRE COMPLETO DEL PRODUCTO A IMPRIMIR';
		var nombre_producto = '&nbsp'+'CHAMARRA ELITE MARINO FEMENIL TALLA XL'+'&nbsp';
		//var nombre_producto =  producto['NOMBRE_PRODUCTO'] + ' '+ producto['COLOR_PRODUCTO'] + ' '+ ((producto['TALLA_PRODUCTO']=='SIN TALLA')?'':producto['TALLA_PRODUCTO']) +' '+  producto['GENERO_PRODUCTO'];
		//var nombre_producto = '&nbsp'+'CHAMARRA ELITE MARINO VARONIL XS'+'&nbsp';
		for(var i = 0; i < 10; i++){
			//var img = '<img id="codigo-'+i+'"/>';
			/*var img = 	'<div style="display: inline-block;text-align: center;">'+
							'<img id="codigo-'+i+'"/><br>'+
							'<span align="center">'+'Producto'+'</span>'+
						'</div>';//*/
			var img = 	'<img id="codigo-'+i+'" /><br>'+
						'<sup align="center">'+nombre_producto.toUpperCase()+'</sup>';//*/

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
			  height: 40
			});
		}
		//window.print();
		//demoFromHTML();
	}
	function demoFromHTML() {
		var doc = new jsPDF();          
		var elementHandler = {
		  '#ignorePDF': function (element, renderer) {
		    return true;
		  }
		};
		var source = window.document.getElementsByTagName("body")[0];
		doc.fromHTML(
		    source,
		    15,
		    15,
		    {
		      'width': 180,'elementHandlers': elementHandler
		    });

		doc.output("dataurlnewwindow");
	}
</script>