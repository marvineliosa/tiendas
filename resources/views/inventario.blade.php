@extends('plantillas.menu')
@section('title','Inventario')
@section('tittle_page','Conteo de inventario')

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
                    <select class="form-control" id="SelectEspacios" >
                      <option value="SELECCIONAR">-- SELECCIONAR --</option>
                      @foreach($espacios as $espacio)
                        <option value="{{$espacio->ID_ESPACIO}}">{{$espacio->NOMBRE_ESPACIO}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12" >
                    <select class="form-control" id="SelectModoBusqueda">
                      <option value="SELECCIONAR">-- SELECCIONAR --</option>
                        <option value="BUSQUEDA">MODO BÚSQUEDA</option>
                        <option value="CONTEO">MODO CONTEO</option>
                    </select>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <input type="number" class="form-control" placeholder="Ingrese el código" id="nombre_producto" autofocus>
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
                <button id="BtnReiniciarConteo" type="button" class="btn btn-danger btn-md btn-block" onclick="ReiniciarConteo()" disabled="true">Reiniciar conteo</button>
              </div>

              <div class="col-md-3 col-sm-3 col-xs-12">
                <button id="BtnGuardarConteo" type="button" class="btn btn-success btn-md btn-block" onclick="GuardarConteo()" disabled="true">Guardar conteo</button>
              </div>

              <div class="col-md-3 col-sm-3 col-xs-12">
                <button id="BtnAgregarInventario" type="button" class="btn btn-primary btn-md btn-block" onclick="ModalAgregarInventario()" disabled="true">Agregar al inventario</button>
              </div>

              <div class="col-md-3 col-sm-3 col-xs-12">
                <button id="BtnCompararInventario" type="button" class="btn btn-primary btn-md btn-block" onclick="CompararConInventario()" disabled="true">Comparar</button>
              </div>

            </div>

	      </div>

	  </div>
	</div>
</div>
<!-- MODALES -->

    <!-- modal agregar existencias -->
    <div class="modal fade" id="ModalAgregarExistencias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-horizontal form-label-left">
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Artículo</label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="number" class="form-control" id="nota_venta_id_producto" min="0" value='' disabled>
                </div>
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Cantidad*</label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="number" class="form-control" placeholder="" id="nota_venta_cantidad" min="0" value='' disabled="true">
                </div>
              </div>
              <!-- Precio de compra y venta -->
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Precio de compra*</label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="number" class="form-control" placeholder="" id="nota_venta_precio_compra" min="0" value='' step=".10">
                </div>

                <label class="control-label col-md-2 col-sm-2 col-xs-12">Bodega destino*</label>
                <!-- <div class="col-md-4 col-sm-4 col-xs-12" id="">
                  <input type="text" class="form-control" placeholder="" id="nota_venta_espacio" value=''>
                </div> -->
                <div class="col-md-4 col-sm-4 col-xs-12">

                  <select class="form-control" id="nota_venta_select_bodega" disabled="true">
                    <option value="SELECCIONAR">-- SELECCIONAR --</option>
                    @foreach($espacios as $espacio)
                      <option value="{{$espacio->ID_ESPACIO}}">{{$espacio->NOMBRE_ESPACIO}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <!-- Observaciones -->
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Observaciones</label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                  <textarea class="form-control" id="nota_venta_observaciones" rows="3" placeholder="" style="resize:none;"></textarea>
                </div>
              </div>


          </div><!-- fin div form -->
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="AgregarCantidadInventario()">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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

    function GuardarConteo(){
      if(GLContador > 0){
        console.log('GUARDAR CONTEO');
        var espacio = $("#SelectEspacios").val();

        var success;
        var url = "/inventario/guardar_conteo";
        var dataForm = new FormData();
        dataForm.append('id_producto',GLCodigo);
        dataForm.append('cantidad',GLContador);
        dataForm.append('espacio',espacio);
        //lamando al metodo ajax
        metodoAjax(url,dataForm,function(success){
          //aquí se escribe todas las operaciones que se harían en el succes
          //la variable success es el json que recibe del servidor el método AJAX
          $("#ModalAgregarExistencias").modal('hide');
          MensajeModal("¡ÉXITO!","Conteo almacenado satisfactoriamente");
        });


      }else{
        MensajeModal('¡ATENCIÓN!','Aún no existe un conteo actual');
      }
    }

    function ReiniciarConteo(){
      if(GLContador > 0){
        console.log('Reiniciar conteo');
        var espacio = $("#SelectEspacios").val();
        var success;
        var url = "/inventario/reiniciar_conteo";
        var dataForm = new FormData();
        dataForm.append('id_producto',GLCodigo);
        dataForm.append('espacio',espacio);
        //lamando al metodo ajax
        metodoAjax(url,dataForm,function(success){
          //aquí se escribe todas las operaciones que se harían en el succes
          //la variable success es el json que recibe del servidor el método AJAX
          MensajeModal("¡ÉXITO!","Conteo reiniciado satisfactoriamente");
          GLContador = 0;
          $("#LabelCantidadConteo").text(GLContador);
        });
      }else{

      }
      $("#nombre_producto").focus();
    }

    function ModalAgregarInventario(){
      var espacio =  $("#SelectEspacios").val();
      $("#nota_venta_select_bodega").val(espacio);
      $("#nota_venta_id_producto").val(GLCodigo);
      $("#nota_venta_cantidad").val(GLContador);
      $("#ModalAgregarExistencias").modal();
    }

    function AgregarCantidadInventario(){

      if(GLContador>0){
        console.log('AGREGAR CANTIDAD A INVENTARIO');
        var dataForm = new FormData();
        var success;
        var url = "/productos/agregar_nota";
        var dataForm = new FormData();
        var precio_compra = $("#nota_venta_precio_compra").val();
        var espacio = $("#SelectEspacios").val();
        var observaciones = $("#nota_venta_observaciones").val();

        dataForm.append('id_producto',GLCodigo);
        dataForm.append('cantidad',GLContador);
        dataForm.append('precio_compra',precio_compra);
        //dataForm.append('consecutivo_inicial',consecutivo_inicial);
        //dataForm.append('consecutivo_final',consecutivo_final);
        dataForm.append('select_bodega',espacio);
        dataForm.append('observaciones',observaciones);
        //lamando al metodo ajax
        metodoAjax(url,dataForm,function(success){
          //aquí se escribe todas las operaciones que se harían en el succes
          //la variable success es el json que recibe del servidor el método AJAX
          $("#ModalAgregarExistencias").modal('hide');
          MensajeModal("¡ÉXITO!","Nota de venta registrada satisfactoriamente");
        });

        // console.log('AGREGAR CANTIDAD A INVENTARIO');
        // var success;
        // var url = "/inventario/agregar_inventario";
        // var dataForm = new FormData();
        // var espacio = $("#SelectEspacios").val();
        // dataForm.append('espacio',espacio);
        // dataForm.append('contador',GLContador);
        // //lamando al metodo ajax

        // metodoAjax(url,dataForm,function(success){
        //   //aquí se escribe todas las operaciones que se harían en el succes
        //   //la variable success es el json que recibe del servidor el método AJAX
        //   MensajeModal("¡EXITO!","El contador se ha almacenado correctamente");
        // });//*/
      }else{
        MensajeModal('¡ATENCIÓN!','Aún no existe un conteo actual');
      }

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
      $("#BtnReiniciarConteo").attr('disabled',true);
      $("#BtnCompararInventario").attr('disabled',true);
      $("#BtnGuardarConteo").attr('disabled',true);
      $("#BtnAgregarInventario").attr('disabled',true);
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
        //console.log(success);
        if(success['producto']){
          GLCodigo = id_producto;
          $("#LabelNombreProducto").text(success['producto']['NOMBRE_PRODUCTO']);
          //$("#LabelCantidadConteo").text(success['producto']['NOMBRE_PRODUCTO']);
          //console.log('EPALELELELELE' +success['conteo']['CONTEO_CANTIDAD']);
          if(success['conteo']['CONTEO_CANTIDAD']){
            GLContador = success['conteo']['CONTEO_CANTIDAD'];
            console.log(GLContador);
            $("#LabelCantidadConteo").text(success['conteo']['CONTEO_CANTIDAD']);
          }else{
            console.log('No hay datos');
            $("#LabelCantidadConteo").text(0);
          }
          //console.log($("#BtnReiniciarConteo"));
          //console.log('Hola');
          $("#BtnReiniciarConteo").attr('disabled',false);
          $("#BtnCompararInventario").attr('disabled',false);
          $("#BtnGuardarConteo").attr('disabled',false);
          $("#BtnAgregarInventario").attr('disabled',false);
          $("#nombre_producto").focus();

        }else{
          MensajeModal('¡ATENCIÓN!','No existe el artículo buscado')
        }
        
      });
      $("#nombre_producto").val("");
      $("#nombre_producto").focus();
    }

	</script>
@endsection