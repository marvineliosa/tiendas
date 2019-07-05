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
	              	<!-- <div class="col-md-3 col-sm-3 col-xs-12">
	                	<input type="number" class="form-control" placeholder="Ingrese el código" id="nombre_producto" onblur="onBlur('nombre_producto')" autofocus>
	              	</div> -->
                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <select class="form-control" id="SelectEspacios" onfocus="onFocus('SelectEspacios')">
                      <option value="SELECCIONAR">-- SELECCIONAR --</option>
                      @foreach($espacios as $espacio)
                        <option value="{{$espacio->ID_ESPACIO}}">{{$espacio->NOMBRE_ESPACIO}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12" onfocus="onFocus('SelectModoBusqueda')">
                    <select class="form-control" id="SelectModoBusqueda">
                      <option value="SELECCIONAR">-- SELECCIONAR --</option>
                        <option value="BUSQUEDA">MODO BÚSQUEDA</option>
                        <option value="CONTEO">MODO CONTEO</option>
                    </select>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <input type="number" class="form-control" placeholder="Ingrese el código" id="nombre_producto" onblur="onBlur('nombre_producto')" autofocus>
                  </div>
	              	<!-- <div class="col-md-3 col-sm-3 col-xs-12">
	        			    <button class="btn btn-primary btn-md btn-block" onclick="agregarArticulo()" onfocus="onFocus('BtnAgregarArticulo')">Buscar Producto</button> 
	              	</div> -->
	            </form>
        	</div>
	      </div>
	      <div class="x_content">

            <!-- ID del trabajador -->
            <div class="form-group" align="center">
              <!-- <label class="control-label col-md-2 col-sm-2 col-xs-12">Dependencia*</label> -->
              <div class="col-md-12 col-sm-12 col-xs-12">
                <font SIZE=7 id="LabelNombreProducto" onfocus="onFocus('LabelNombreProducto')">Busque un artículo</font>
                <br>
                <font SIZE=7 style="font-size: 1000%" id="LabelCantidadConteo" onfocus="onFocus('LabelCantidadConteo')">0</font>
              </div>
            </div>

            <div class="well" style="overflow: auto">


              <div class="col-md-3 col-sm-3 col-xs-12">
                <button id="BtnReiniciarConteo" type="button" class="btn btn-danger btn-md btn-block" onclick="ReiniciarConteo()" onfocus="onFocus('BtnReiniciarConteo')">Reiniciar conteo</button>
              </div>

              <div class="col-md-3 col-sm-3 col-xs-12">
                <button id="BtnAgregarInventario" type="button" class="btn btn-success btn-md btn-block" onclick="GuardarardarConteo()">Guardar conteo</button>
              </div>

              <div class="col-md-3 col-sm-3 col-xs-12">
                <button id="BtnAgregarInventario" type="button" class="btn btn-primary btn-md btn-block" onclick="AgregarCantidadInventario()">Agregar al inventario</button>
              </div>

              <div class="col-md-3 col-sm-3 col-xs-12">
                <button id="BtnAgregarInventario" type="button" class="btn btn-primary btn-md btn-block" onclick="CompararConInventario()">Comparar</button>
              </div>

            </div>

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
    //----------------FUNCION PARA DETEC-----------------
    $.fn.delayPasteKeyUp = function(fn, ms){
       var timer = 0;
       $(this).on("propertychange input", function()
       {
         clearTimeout(timer);
         timer = setTimeout(fn, ms);
       });
     };

    $(document).ready(function(){
      $("#nombre_producto").delayPasteKeyUp(function(){
        // $("#respuesta").append("Producto registrado: "+ $("#ingreso").val() +"<br>");
        // $("#ingreso").val("");
        var espacio = $("#SelectEspacios").val();
        var modo = $("#SelectModoBusqueda").val();
        if(espacio=='SELECCIONAR'){
          MensajeModal('¡ATENCIÓN!' ,'Favor de seleccionar el espacio');
          $("#SelectEspacios").focus();
        }else if(modo=='SELECCIONAR'){
          MensajeModal('¡ATENCIÓN!' ,'Favor de seleccionar el modo con el que quiere trabajar');
          $("#SelectModoBusqueda").focus();
        }else if(espacio!='SELECCIONAR' && modo!='SELECCIONAR'){
          var producto = $("#nombre_producto").val();
          console.log(producto);
          //console.log($("#nombre_producto").val());
          //$("#nombre_producto").val("");
          if(modo == 'BUSQUEDA'){
            ModoBusqueda();
          }else{
            ModoConteo(producto);
          }
        }else {

        }
        $("#nombre_producto").val("");
        //$("#nombre_producto").focus();
      }, 200);
    });
    //---------------------------------
		var i = 1;
		var array_articulos = new Array();
		var contador_articulos = 0;
		function CancelarSubmit(){
      //console.log("Epale");
      return false;
    }

    function onFocus(elemento){
      console.log(elemento);
    }


    function onBlur(elemento){
      console.log(elemento);
      //$("#nombre_producto").focus();
    }

    function ReiniciarConteo(){
      console.log('ReiniciarConteo');
      GLContador = 0;
      $("#LabelCantidadConteo").text(GLContador);
      $("#nombre_producto").focus();
      console.log(GLContador);
    }

    function AgregarCantidadInventario(){
      console.log('AGREGAR CANTIDAD A INVENTARIO');
    }

    function ModoConteo(producto){
      if(producto == GLCodigo){
        console.log("Conteo!!");
        GLContador = GLContador + 1;
        $("#LabelCantidadConteo").text(GLContador);
      }else{
        MensajeModal('¡ATENCIÓN!','El código escaneado ('+producto+') no coincide con el del conteo actual ('+GLCodigo+')');
      }
    }

    var GLContador = 0;
    var GLCodigo = 0;

	    //$("#ModalCompraFinalizada").modal();
    function ModoBusqueda(){
      console.log('Epale');
      var id_producto = $("#nombre_producto").val();
      var id_espacio = $("#SelectEspacios").val();
      console.log(id_producto);
      var success;
      var url = "/inventario/conteo_actual";
      var dataForm = new FormData();
      dataForm.append('id_producto',id_producto);
      dataForm.append('id_espacio',id_espacio);
      //lamando al metodo ajax
      metodoAjax(url,dataForm,function(success){
        ///console.log(success);
        GLCodigo = id_producto;
        $("#LabelNombreProducto").text(success['producto']['NOMBRE_PRODUCTO']);
        //$("#LabelCantidadConteo").text(success['producto']['NOMBRE_PRODUCTO']);
        if(success['conteo'].length > 0){
          //GLContador =
        }else{
          $("#LabelCantidadConteo").text(0);
        }
        $("#nombre_producto").focus();
      });
      $("#nombre_producto").val("");
      $("#nombre_producto").focus();
    }

		function agregarArticulo2(){
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

	</script>
@endsection