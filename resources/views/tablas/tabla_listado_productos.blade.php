<table class="table table-hover" id="TablaDatos">
  <thead>
    <tr>
      <th scope="row">CODIGO</th>
      <th>Producto</th>
      <th>Talla</th>
      <th>Color</th>
      <th>Genero</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($productos as $producto)
  		<tr>
  			<td> {{$producto->PRODUCTOS_ID}} </td>
  			<td> {{$producto->PRODUCTOS_NOMBRE}} </td>
  			<td> {{$producto->PRODUCTOS_TALLA}} </td>
  			<td> {{$producto->PRODUCTOS_COLOR}} </td>
  			<td> {{$producto->PRODUCTOS_GENERO}} </td>
  			<td>
	  			<button type="button" class="btn btn-default btn-xs" onclick="VerDatosProducto({!! $producto->PRODUCTOS_ID !!})" data-toggle="tooltip" data-placement="top" title="VER INFORMACIÓN">
				    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
  				</button>
	  			<button type="button" class="btn btn-default btn-xs" onclick="ModalAgregarNotaVenta({!! $producto->PRODUCTOS_ID !!})" data-toggle="tooltip" data-placement="top" title="NOTAS DE VENTA">
  				  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
  				</button>
          <button type="button" class="btn btn-default btn-xs" onclick="verCodigoBarras({!! $producto->PRODUCTOS_ID !!})" data-toggle="tooltip" data-placement="top" title="CÓDIGO DE BARRAS">
            <span class="glyphicon glyphicon-barcode" aria-hidden="true"></span>
          </button>
          <button type="button" class="btn btn-default btn-xs" onclick="ModalVerHistorial({!! $producto->PRODUCTOS_ID !!})" data-toggle="tooltip" data-placement="top" title="HISTORIAL">
            <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
          </button>
          <button type="button" class="btn btn-default btn-xs" onclick="ModalEditarProducto({!! $producto->PRODUCTOS_ID !!})" data-toggle="tooltip" data-placement="top" title="EDITAR PRODUCTO">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
          </button>
          <button type="button" class="btn btn-default btn-xs" onclick="ModalListadoMovilizacion({!! $producto->PRODUCTOS_ID !!})" data-toggle="tooltip" data-placement="top" title="REALIZAR MOVILIZACIÓN DE INVENTARIO">
            <span class="fa fa-truck fa-flip-horizontal" aria-hidden="true"></span>
          </button>
          <button type="button" class="btn btn-default btn-xs" onclick="ModalListadoRecibirMovilizacion({!! $producto->PRODUCTOS_ID !!})" data-toggle="tooltip" data-placement="top" title="RECIBIR MOVILIZACIÓN DE INVENTARIO">
            <span class="fa fa-truck" aria-hidden="true"></span>
          </button>
	  		</td>
  		</tr>
  	@endforeach
  </tbody>
</table>