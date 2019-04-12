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
  			<td> <a href="/espacios/{{$espacio->ID_ESPACIO}}">{{$espacio->NOMBRE_ESPACIO}}</a> </td>
  			<td> {{$espacio->UBICACION_ESPACIO}} </td>
  			<td> {{$espacio->TIPO_ESPACIO}} </td>
  			<td></td>
  		</tr>
  	@endforeach
  </tbody>
</table>