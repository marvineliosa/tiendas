<table class="table table-hover" id="TablaDatos">
  <thead>
    <tr>
      <th scope="row">#</th>
      <th>Nombre</th>
      <th>Ubicación</th>
      <th>Tipo</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($espacios as $espacio)
  		<tr>
  			<td> {{$espacio->ID_ESPACIO}} </td>
  			<td> <a>{{$espacio->NOMBRE_ESPACIO}}</a> </td>
  			<td> {{$espacio->UBICACION_ESPACIO}} </td>
  			<td> {{$espacio->TIPO_ESPACIO}} </td>
  			<td>
          <button type="button" class="btn btn-default btn-xs" onclick="abrirEspacio({!!$espacio->ID_ESPACIO!!})" data-toggle="tooltip" data-placement="top" title="VER INVENTARIO">
            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
          </button>
        </td>
  		</tr>
  	@endforeach
  </tbody>
</table>