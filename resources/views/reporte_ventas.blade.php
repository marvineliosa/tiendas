@extends('plantillas.menu')
@section('title','Prueba')
@section('tittle_page','Reporte de ventas')

@section('content')

	<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Seleccione una fecha</h2>
          
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="well" style="overflow: auto">
              <div class="col-md-3 col-sm-3 col-xs-12">
                <fieldset>
                  <div class="control-group">
                    <div class="controls">
                      <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="FechaInicioCalendario" placeholder="Fecha inicio" aria-describedby="inputSuccess2Status4">
                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                      </div>
                    </div>
                  </div>
                </fieldset>
              </div>
              <div class="col-md-3 col-sm-3 col-xs-12">
                <fieldset>
                  <div class="control-group">
                    <div class="controls">
                      <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="FechaFinCalendario" placeholder="Fecha fin" aria-describedby="inputSuccess2Status4">
                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                      </div>
                    </div>
                  </div>
                </fieldset>
              </div>

              @if(in_array(\Session::get('categoria')[0],['ADMINISTRADOR','ENCARGADO']))
              <div class="col-md-3 col-sm-3 col-xs-12">
                <select class="form-control" id="SelectEspacio">
                  <option value="TODOS">TODOS</option>
                  @foreach($espacios as $espacio)
                    @if(strcmp($espacio->TIPO_ESPACIO,'TIENDA')==0)
                      <option value="{{$espacio->ID_ESPACIO}}">{{$espacio->NOMBRE_ESPACIO}}</option>
                    @endif
                  @endforeach
                </select>
              </div>
              @endif
              <div class="col-md-3 col-sm-3 col-xs-12">
                <button type="button" class="btn btn-primary btn-md btn-block" onclick="GenerarReporte()">Generar Reporte</button>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <button type="button" class="btn btn-success pull-right" onclick="DescargarReporte()">Descargar Reporte</button>
        <button type="button" class="btn btn-primary pull-right" onclick="ModalEnlazarFacturas()">Enlazar Facturas</button>
        <div class="x_title">
          <h2 id="fecha_tabla" ></h2>
          
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table class="table table-hover" id="TablaDatos">
              <thead>
                <tr>
                  <th scope="row">#</th>
                  <th>Remisión</th>
                  <th>Importe</th>
                  <th>Tipo de Pago</th>
                  <th>Factura</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody id="body-reportes">
              </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>



  <!-- Modal Detalle Venta -->
  <div class="modal fade" id="ModalDetalleVenta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="TituloModalDetalleVenta" align="center">Detalle de Venta</h2>
          <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>-->
        </div>
        <div class="modal-body">
          <h3  id="TituloModalDetalleVenta" align="center"> </h3>
          <table class="table table-bordered">
            <thead id="HeadTablaArchivos">
              <tr>
                <th scope="col">Codigo</th>
                <th scope="col">Producto</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio</th>
                <th scope="col">Subtotal</th>
              </tr>
            </thead>
            <tbody id="CuerpoModalDetalleVenta">
              
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal Devoluciones -->
  <div class="modal fade" id="ModalDevoluciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="TituloModalDevoluciones" align="center">Devoluciones</h2>
          <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>-->
        </div>
        <div class="modal-body">
          <h3  id="TituloModalDevoluciones" align="center"> Descripción de la venta</h3>
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
              
            </tbody>
          </table>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Motivo de la devolución</label>
            <textarea class="form-control" id="MotivoDevolucion" rows="2"></textarea>
          </div>
          <div align="right">
            <button type="button" class="btn btn-primary" onclick="LlenarTablaDevolucion()">Seleccionar</button>
          </div>
          
          <div id="DatosCambio" hidden="true">
            <hr>
            <div class="form-horizontal form-label-left">
              <!-- nombre del producto -->
              <form class="form-group" onsubmit="return CancelarSubmit();">
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="number" class="form-control" placeholder="Ingrese el código" id="nombre_producto" min="0">
                </div>
                <div class="col-md-2 col-sm-2 col-xs-12">
                  <button type="submit" class="btn btn-primary" onclick="TraerArticulo()">Buscar Producto</button>
                </div>
              </form>
            </div>

            <table class="table table-bordered">
              <thead id="HeadTablaDetalle">
                <tr align="center">
                  <th scope="col" colspan="2" style="width: 50%;">Producto a Devolver</th>
                  <th scope="col" colspan="2" style="width: 50%;">Producto a Cambio</th>
                </tr>
              </thead>
              <tbody id="CuerpoTablaDetalle">
                <tr>
                  <th scope="row" style="width: 20%;">Código</th>
                  <td id="td_devolucion-codigo"></td>
                  <th scope="row" style="width: 20%;">Código</th>
                  <td id="td_cambio-codigo"></td>
                </tr>
                <tr>
                  <th scope="row" style="width: 20%;">Nombre</th>
                  <td id="td_devolucion-nombre"></td>
                  <th scope="row" style="width: 20%;">Nombre</th>
                  <td id="td_cambio-nombre"></td>
                </tr>
                <tr>
                  <th scope="row" style="width: 20%;">Cantidad</th>
                  <td id="td_devolucion-cantidad"></td>
                  <th scope="row" style="width: 20%;">Cantidad</th>
                  <td id="td_cambio-cantidad">
                    <input type="number" class="form-control" id="cantidad_cambio" value="0" min="0" onchange="CalcularSubtotalCambio()" disabled="true">
                  </td>
                </tr>
                <tr>
                  <th scope="row" style="width: 20%;">Precio</th>
                  <td id="td_devolucion-precio"></td>
                  <th scope="row" style="width: 20%;">Precio</th>
                  <td id="td_cambio-precio"></td>
                </tr>
                <tr>
                  <th scope="row" style="width: 20%;">Subtotal</th>
                  <td id="td_devolucion-subtotal"></td>
                  <th scope="row" style="width: 20%;">Subtotal</th>
                  <td id="td_cambio-subtotal"></td>
                </tr>
              </tbody>
            </table>
            <div align="right">
              <button type="button" class="btn btn-warning" onclick="RealizarDevolucion()">Realizar Devolución</button>
            </div>
          </div>

          <hr>
          <h3  id="TituloModalDevoluciones" align="center"> Artículos a Cambio </h3>
          <table class="table table-bordered">
            <thead id="HeadTablaDevueltos">
              <tr align="center">
                <th scope="col">Codigo</th>
                <th scope="col">Producto</th>
                <th scope="col">Cantidad Devolución</th>
                <th scope="col">Fecha Devolución</th>
              </tr>
            </thead>
            <tbody id="CuerpoTablaDevueltos">
              
            </tbody>
          </table>

        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal CompraFinalizada -->
  <div class="modal fade" id="ModalEnviarRemision" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" align="center">
          <h2 class="modal-title" id="exampleModalLabel">Remisión</h2>
        </div>
        <div class="modal-body">

          <!-- <h2 class="modal-title" id="TxtFinalizacionCompra" align="center">La compra ha sido almacenada satisfactoriamente, por favor ingrese el correo electrónico al que se enviará la remisión.</h2> -->
          <h2 class="modal-title" align="center"><strong  id="TxtNumeroNota"></strong></h2>
          <div class="form-horizontal form-label-left">
            <!-- nombre -->
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Cliente</label>
              <div class="col-md-10 col-sm-10 col-xs-12">
                <input type="email" class="form-control" placeholder="" id="cliente_remision">
              </div>
            </div>
            <!-- correo electronico -->
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Correo Electrónico</label>
              <div class="col-md-10 col-sm-10 col-xs-12">
                <input type="email" class="form-control" placeholder="" id="email_remision">
              </div>
            </div>
            
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="EnviarRemision()">Enviar remisión</button>
          <button type="button" class="btn btn-primary" onclick="ImprimirRemision()">Imprimir remisión</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal CompraFinalizada -->
  <div class="modal fade" id="ModalFacturarVentas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" align="center">
          <h2 class="modal-title" id="exampleModalLabel">Enlazar remisiones con facturas</h2>
        </div>
        <div class="modal-header" align="right">
          <label class="form-check-label" for="check_seleccionar_todo">Seleccionar todo</label>
          <input type="checkbox" class="form-check-input" onclick="SeleccionarTodo()" id="check_seleccionar_todo">
        </div>
        <div class="modal-body">

          <!-- <h2 class="modal-title" id="TxtFinalizacionCompra" align="center">La compra ha sido almacenada satisfactoriamente, por favor ingrese el correo electrónico al que se enviará la remisión.</h2> -->
          <h2 class="modal-title" align="center"><strong  id="TxtNumeroNota"></strong></h2>
          <div class="form-horizontal form-label-left" align="center">
            <!-- nombre -->
            <table class="table table-striped" id="TablaDatos" style="width: 100%">
              <thead>
                <tr>
                  <th style="text-align: center;">Remisión</th>
                  <th style="text-align: center;">Fecha</th>
                  <th style="text-align: center;">Total</th>
                  <th style="text-align: center;">Seleccionar</th>
                </tr>
              </thead>
              <tbody id="BodyTablaFacturas">
                <!-- <tr>
                  <td> REMISION </td>
                  <td> 
                    <div class="form-check" align="center">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                     
                    </div>
                  </td>
                </tr> -->
              </tbody>
            </table>
            
          </div>

        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-secondary pull-right" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary pull-right" onclick="EnlazarRemisiones()">Enlazar remisiones</button>

          <div class="col-md-4 col-sm-4 col-xs-12 pull-right" align="right">
            <input type="text" class="form-control" id="InputFactura" placeholder="Ingresar factura">
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')
  <script type="text/javascript">

    function GenerarArrayVentas(){
      var ventas_reporte = new Array();
      var total = 0;
      for(var i = 0; i < Gl_ventas.length; i++){
        var objeto = {
          'REMISION':Gl_ventas[i]['VENTAS_CONSECUTIVO_ANUAL'],
          'FECHA DE VENTA':Gl_ventas[i]['FECHA_VENTA'],
          'FACTURA':Gl_ventas[i]['VENTAS_FACTURA'],
          'TIPO DE PAGO':Gl_ventas[i]['VENTAS_TIPO_PAGO'],
          'IMPORTE':Gl_ventas[i]['VENTAS_TOTAL']
        }
        ventas_reporte[i] = objeto;
        total = total + Gl_ventas[i]['VENTAS_TOTAL'];
      }
        var objeto = {
          'REMISION':'',
          'FECHA DE VENTA':'',
          'FACTURA':'',
          'TIPO DE PAGO':'TOTAL' ,
          'IMPORTE':total
        }
        ventas_reporte[parseInt(Gl_ventas.length) + parseInt(1)] = objeto;
      return ventas_reporte;
    }

    function DescargarReporte(){
      //Gl_ventas

      //console.log(inventario);
      //console.log(success['']);
      var wb = XLSX.utils.book_new();
      wb.Props = {
              Title: "Reporte de Inventaio",
              Subject: "Reporte",
              Author: "Marvin Eliosa",
              CreatedDate: new Date()
      };
      wb.SheetNames.push("Reporte");
      //var ws_data = [['hello' , 'world']];  //a row with 2 columns
      var ws_data = GenerarArrayVentas();  //a row with 2 columns
      //var ws_data = GenerarArrayVentas();  //a row with 2 columns

      //var ws = XLSX.utils.json_to_sheet();

      //ventasWs.A1.s = "NOMBRE DE PRUEBA";
      var ventasWs = XLSX.utils.json_to_sheet(ws_data);

      // A workbook is the name given to an Excel file
      var wb = XLSX.utils.book_new() // make Workbook of Excel

      // add Worksheet to Workbook
      // Workbook contains one or more worksheets
      //XLSX.utils.book_append_sheet(wb, animalWS, 'animals') // sheetAName is name of Worksheet
      XLSX.utils.book_append_sheet(wb, ventasWs, 'Reporte de ventas')   
      
      // export Excel file
      var nombre_archivo = 'Reporte_de_ventas'+'.xlsx';
      XLSX.writeFile(wb, nombre_archivo)
    }

    function ModalEnlazarFacturas(){
      console.log(Gl_ventas);
      $("#BodyTablaFacturas").html("");
      console.log(Gl_ventas.length);
      for(var i = 0; i < Gl_ventas.length; i++){
        //console.log(Gl_ventas[i]['VENTAS_FACTURA']);
        if(!Gl_ventas[i]['VENTAS_FACTURA']){
          //console.log('Entra');
          $("#BodyTablaFacturas").append(
            '<tr>'+
              '<td align="center">'+Gl_ventas[i]['VENTAS_CONSECUTIVO_ANUAL']+' </td>'+
              '<td align="center">'+Gl_ventas[i]['FECHA_VENTA']+' </td>'+
              '<td align="center">$ '+Gl_ventas[i]['VENTAS_TOTAL']+' </td>'+
              '<td align="center">'+
                '<div class="form-check">'+
                  '<input type="checkbox" class="form-check-input" id="'+Gl_ventas[i]['VENTAS_ID']+'" value="'+Gl_ventas[i]['VENTAS_ID']+'">'+
                '</div>'+
              '</td>'+
            '</tr>'
          );
        }
      }
      $("#ModalFacturarVentas").modal();
    } 

    function EnlazarRemisiones(){
      var factura = $("#InputFactura").val();
      console.log(factura);
      var array_remisiones = [];
      $('#TablaDatos input:checked').each(function() {
          array_remisiones.push($(this).attr('value'));
      });
      if(factura == ''){
        MensajeModal('¡Atención!','Por favor ingrese la factura con la que quiere enlazar las remisiones.');
      }else if(array_remisiones.length == 0){
        MensajeModal('¡Atención!','Aún no se ha seleccionado remisiones para enlazar.');
      }else{
        console.log(array_remisiones);
        var url = '/remisiones/enlazar_facturas';
        var success;
        var dataForm = new FormData();
        dataForm.append('factura',factura);
        dataForm.append('remisiones',JSON.stringify({remisiones:array_remisiones}));
        //lamando al metodo ajax
        metodoAjax(url,dataForm,function(success){
          $("#ModalFacturarVentas").modal('hide');
          GenerarReporte();
          MensajeModal('¡ÉXITO!','Se ha enlazado correctamente las solicitudes');
          //$('#ModalPagoDebito').modal('hide');

        });
      }
    }

    var GL_check = false;
    function SeleccionarTodo(){
      //console.log('Entra');
      $('#TablaDatos input').each(function() {
          //selected.push($(this).attr('value'));
          if(GL_check){
            $(this).prop('checked', false);
          }else{
            $(this).prop('checked', true);
          }
          //console.log(GL_check);
      });
      if(GL_check){
        GL_check = false;
      }else{
        GL_check = true;
      }
      //console.log(GL_check);
    }

    function ImprimirRemision(){
      window.open('/remision/'+Gl_enviar_remision,'_blank');
    }

    function EnviarRemision(){
      var url = '/mail/enviar_remision';
      var cliente = $("#cliente_remision").val();
      var mail = $("#email_remision").val();
      var success;
      var dataForm = new FormData();
      dataForm.append('id_venta',Gl_enviar_remision);
      dataForm.append('cliente',cliente);
      dataForm.append('mail',mail);
      //lamando al metodo ajax
      metodoAjax(url,dataForm,function(success){
        MensajeModal('¡ÉXITO!','La nota de venta se ha enviado satisfactoriamente al correo '+mail);
        //$('#ModalPagoDebito').modal('hide');

      });
    }

    //funcion para abrir el modal de enviar/imprimir remision
    var Gl_enviar_remision = null;
    function ModalEnviarRemision(id_venta){
      Gl_enviar_remision = id_venta;
      var success;
      var url = "/remision/obtener_datos";
      var dataForm = new FormData();
      dataForm.append('id_venta', id_venta);
      //lamando al metodo ajax
      metodoAjax(url,dataForm,function(success){
        $("#cliente_remision").val('');
        $("#email_remision").val('');
        if(success['venta']){
          console.log('');
          $("#cliente_remision").val(success['venta']['REL_DATOS_NOMBRE']);
          $("#email_remision").val(success['venta']['REL_DATOS_CORREO']);
        }
        $("#ModalEnviarRemision").modal();
      });

    }

    //funcion para generar la devolución de un artículo
    function RealizarDevolucion(){
      //datos del producto a devolver
      var id_producto_devolver = seleccionado;
      var cantidad_devolucion = $("#cant_dev_"+id_producto_devolver).val();
      var motivo_devolucion = $("#MotivoDevolucion").val();
      //datos articulo a cambio
      //console.log(producto_cambio);
      var id_producto_cambio = ((producto_cambio)?producto_cambio['ID_PRODUCTO']:null);
      var cantidad_cambio = $("#cantidad_cambio").val();

      if(producto_cambio == null){
        MensajeModal('¡Atención!','Debe ingresar los datos del artículo a cambio');
      }else if(cantidad_devolucion <= 0){
        MensajeModal('¡Atención!','Debe elegir la cantidad a devolver');
      }else if(motivo_devolucion == ''){
        MensajeModal('¡Atención!','Debe especificar el motivo de la devolución');
      }else if(cantidad_cambio <= 0){
        MensajeModal('¡Atención!','Debe elegir la cantidad a de articulos a cambio');
      } else{
        // console.log("ID Articulo devuelto: "+ id_producto_devolver);
        // console.log("Cantidad Articulo devuelto: "+ cantidad_devolucion);
        // console.log("Motivo Articulo devuelto: "+ motivo_devolucion);
        // console.log("ID Articulo cambio: "+ id_producto_cambio);
        // console.log("Cantidad Cambio: "+ cantidad_cambio);
        // console.log('Enviando...');

        var success;
        var url = "/devolucion/almacenar";
        var dataForm = new FormData();
        dataForm.append('id_producto_devolver', id_producto_devolver);
        dataForm.append('cantidad_devolucion', cantidad_devolucion);
        dataForm.append('motivo_devolucion', motivo_devolucion);
        dataForm.append('id_producto_cambio', id_producto_cambio);
        dataForm.append('cantidad_cambio', cantidad_cambio);
        dataForm.append('id_venta', GL_IdVentaDevolucion);
        //lamando al metodo ajax
        metodoAjax(url,dataForm,function(success){
          //aquí se escribe todas las operaciones que se harían en el succes
          //la variable success es el json que recibe del servidor el método AJAX
          //MensajeModal("TITULO DEL MODAL","MENSAJE DEL MODAL");
          // if(success['fl_dev']){
          //   MensajeModal("¡Atención!",success['mensaje']);
          // }
          MensajeModal("¡Atención!",success['mensaje']);
          if(!success['fl_dev']){
            $("#ModalDevoluciones").modal('hide');
          }
        });


      }
    }

    //esta funcion llena los datos de la tabla para su comparacion
    function LlenarTablaDevolucion(){
      var id_producto = seleccionado;
      var cantidad = $("#cant_dev_"+id_producto).val();
      var motivo = $("#MotivoDevolucion").val();
      if(id_producto == null){
        MensajeModal('¡Atención!','´Debe seleccionar un articulo para su devolución');
      }else if(cantidad <= 0){
        MensajeModal('¡Atención!','Debe elegir la cantidad a devolver');
      }else if(motivo == ''){
        MensajeModal('¡Atención!','Debe especificar el motivo de la devolución');
      }else{
        for(var i = 0; i < array_articulos.length; i++){
          if(array_articulos[i]['FK_PROCUTO'] == id_producto){
            $("#td_devolucion-codigo").text(array_articulos[i]['FK_PROCUTO']);
            $("#td_devolucion-nombre").text(array_articulos[i]['NOMBRE_PRODUCTO']);
            //$("#td_devolucion-cantidad").text(  ); //se llena en CalcularSubtotalDevolucion()
            $("#td_devolucion-precio").text("$ "+formatoMoneda(array_articulos[i]['PRECIO_VENTA']));
            //$("#td_devolucion-subtotal").text(array_articulos[i]['NOMBRE_PRODUCTO']); //se llena en CalcularSubtotalDevolucion()
          }
        }
        $("#DatosCambio").show();
      }
    }

    //esta funcion trae los datos del articulo seleccionado para hacer el cambio
    var producto_cambio;
    function TraerArticulo(){
      var id_producto = $("#nombre_producto").val();

      var success;
      var url = "/productos/obtener_datos";
      var dataForm = new FormData();
      dataForm.append('id_producto',id_producto);
      //$('#TablaDatos').DataTable().destroy();
      //lamando al metodo ajax
      metodoAjax(url,dataForm,function(success){
        if(success['producto']){
          if(parseFloat(success['producto']['PRECIO_VENTA']) <= subtotal_devolucion){
            $("#cantidad_cambio").attr('disabled',false);
            producto_cambio = success['producto'];
            producto_cambio['ID_PRODUCTO'] = id_producto;
            //console.log(producto_cambio);
            $("#td_cambio-codigo").text(id_producto);
            $("#td_cambio-nombre").text(producto_cambio['NOMBRE_PRODUCTO']);
            $("#cantidad_cambio").val(1);
            $("#td_cambio-precio").text("$ " + formatoMoneda(producto_cambio['PRECIO_VENTA']));
            $("#td_cambio-subtotal").text('$ '+formatoMoneda(producto_cambio['PRECIO_VENTA']));
          }else{
            //console.log(success);
            MensajeModal('¡Atención!','El precio del artículo '+success['producto']['NOMBRE_PRODUCTO']+' es mayor al monto de devolución.');
          }
        }
      });
    }

    //esta funcion obtiene y agrega el subtotal al articulo seleccionado para devolver
    var subtotal_devolucion = 0;
    function CalcularSubtotalDevolucion(id_producto,precio){
      var cantidad = $("#cant_dev_"+id_producto).val();
      //console.log("Cantidad: "+cantidad);
      subtotal = parseFloat(precio) * parseInt(cantidad);
      //console.log("subtotal:" + subtotal);
      $("#subtotal_dev_"+id_producto).text('$ '+ formatoMoneda(subtotal));

      if($("#radio_"+id_producto).prop('checked')){
        $("#td_devolucion-cantidad").text( cantidad );
        $("#td_devolucion-subtotal").text('$ ' + formatoMoneda(subtotal) );
      }
      subtotal_devolucion = subtotal;
      //total = total +
    }
    
    //esta funcion calcula el subtotal de los articulos seleccionados a cambio
    function CalcularSubtotalCambio(){
      //var id_producto = producto_cambio['ID_PRODUCTO'];
      var precio = producto_cambio['PRECIO_VENTA'];
      var cantidad = $("#cantidad_cambio").val();
      subtotal = parseFloat(precio) * parseFloat(cantidad);
      if(subtotal > subtotal_devolucion){
        //mandamos mensaje de alerta
        MensajeModal('¡Atención!','El subtotal del artículo es mayor al monto de devolución.');
        //Obtenemos el numero de unidades maxima que se puedan pagar con el subtotal a devolver
        var tmp_cantidad = parseInt(parseFloat(subtotal_devolucion)/parseFloat(precio))
        $("#cantidad_cambio").val( tmp_cantidad );
        //calculamos el precio de la cantidad resultante multiplicado por el precio original
        var tmp_subtotal = parseInt(tmp_cantidad)*parseFloat(precio);
        $("#td_cambio-subtotal").text('$ '+formatoMoneda(tmp_subtotal));
        //$("#cantidad_cambio").val(1);
      }else if(cantidad >producto_cambio['INVENTARIO_SESION']){
        //mandamos mensaje de alerta
        MensajeModal('¡Atención!','El límite de inventario del artículo '+producto_cambio['NOMBRE_PRODUCTO']+' es de ' + producto_cambio['INVENTARIO_SESION']);
        //obtenemos el subtotal que pondrá el límite de artículos disponible
        subtotal = parseFloat(precio) * parseFloat( producto_cambio['INVENTARIO_SESION'] );
        //agregamos el dato en el campo de cantidad y de subtotal
        $("#cantidad_cambio").val( producto_cambio['INVENTARIO_SESION'] );
        $("#td_cambio-subtotal").text('$ '+formatoMoneda(subtotal));
      }else{
        //console.log('SUBTOTAL CAMBIO: '+subtotal);
        $("#td_cambio-subtotal").text('$ '+formatoMoneda(subtotal));
      }
    }

    //esta funcion detecta cuando se selecciona un radio button
    var seleccionado;
    function seleccionArticulo(id_producto,elemento){
      $("#td_cambio-codigo").text('');
      $("#td_cambio-nombre").text('');
      $("#cantidad_cambio").val(0);
      $("#td_cambio-precio").text('');
      $("#td_cambio-subtotal").text('');
      $("#cantidad_cambio").attr('disabled',true);
      producto_cambio = null;
      if( $(elemento).prop('checked')){
        //console.log('radio_'+id_producto+' seleccionado');
        $("#tr_"+seleccionado).removeClass('warning');
        $("#tr_"+id_producto).addClass('warning');
        seleccionado = id_producto;
        $("#DatosCambio").hide();
      }

      $(".cantidades").val(0);
    }

    //esta funcion obtiene los datos de la compra realizada y llena la tabla con la informacion
    var array_articulos = new Array();
    var GL_IdVentaDevolucion;
    function Devolucion(id_venta){
      $("#CuerpoTablaDevueltos").html('');
      //console.log(fecha_inicio);
      var success;
      var url = "/reportes/obtner_detalle";
      var dataForm = new FormData();
      dataForm.append('id_venta',id_venta);
      //$('#TablaDatos').DataTable().destroy();
      //lamando al metodo ajax
      metodoAjax(url,dataForm,function(success){
        GL_IdVentaDevolucion = id_venta;
        //console.log(success);
        array_articulos = success['datos'];
        $("#CuerpoModalDevoluciones").html('');
        var total = 0;
        for(var i = 0; i < success['datos'].length; i++){
          var subtotal = parseInt(success['datos'][i]['CANTIDAD_VENTA']) * parseInt(success['datos'][i]['PRECIO_VENTA']);
          AppendTablaCambio(success['datos'][i]['DEVOLUCION']['cambio']);
          //console.log('subtotal: '+subtotal);
          total = parseInt(total) + parseInt(subtotal);
          var fl_devuelto = success['datos'][i]['DEVOLUCION']['fl_existe'];
          $("#CuerpoModalDevoluciones").append(
            '<tr id="tr_'+success['datos'][i]['FK_PROCUTO']+'">'+
              '<td style="width: 5%;">'+
                '<div class="form-check">'+
                  '<input type="radio" name="numero" value="1" id="radio_'+success['datos'][i]['FK_PROCUTO']+'" onclick="seleccionArticulo('+success['datos'][i]['FK_PROCUTO']+',this)" '+((fl_devuelto)?'disabled':'')+'>'+
                '</div>'+
              '</td>'+

              '<td style="width: 10%;">'+success['datos'][i]['FK_PROCUTO']+'</td>'+

              '<td>'+success['datos'][i]['NOMBRE_PRODUCTO']+'</td>'+
              '<td style="width: 10%;">'+success['datos'][i]['CANTIDAD_VENTA']+'</td>'+

              '<td style="width: 10%;">'+
                '<input type="number" class="form-control cantidades" id="cant_dev_'+success['datos'][i]['FK_PROCUTO']+'" value="0" max="'+success['datos'][i]['CANTIDAD_VENTA']+'" min="0" onchange="CalcularSubtotalDevolucion(' + success['datos'][i]['FK_PROCUTO']+','+ formatoMoneda(success['datos'][i]['PRECIO_VENTA']) + ')"'+((fl_devuelto)?'disabled':'')+'>'+
              '</td>'+
              '<td style="width: 12%;">$ '+ formatoMoneda(success['datos'][i]['PRECIO_VENTA']) +'</td>'+

              '<td style="width: 15%;" id="subtotal_dev_'+success['datos'][i]['FK_PROCUTO']+'">$ '+ formatoMoneda(0) +'</td>'+
            '</tr>'
          );
        }
        //console.log(total);
        $("#MotivoDevolucion").val('');
        $("#DatosCambio").hide();
        $("#ModalDevoluciones").modal();
      });
    }

    function AppendTablaCambio(cambio){
      //console.log();
      if(cambio['DEVOLUCIONES_PROCUTO_ID']){
        $("#CuerpoTablaDevueltos").append(
            '<tr>'+
              '<td>'+
                cambio['DEVOLUCIONES_PROCUTO_ID']+
              '</td>'+
              '<td>'+
                cambio['NOMBRE_PRODUCTO']+
              '</td>'+
              '<td>'+
                cambio['DEVOLUCIONES_CANTIDAD']+
              '</td>'+
              '<td>'+
                cambio['created_at']+
              '</td>'+
            '</tr>'
          );
      }

    }

    //esta funcion muestra el detalle de la venta realizada, similar a la de devolucion pero sin funcionalidad de devolucion
    function DetalleVenta(id_venta){
      //console.log(fecha_inicio);
      var success;
      var url = "/reportes/obtner_detalle";
      var dataForm = new FormData();
      dataForm.append('id_venta',id_venta);
      //$('#TablaDatos').DataTable().destroy();
      //lamando al metodo ajax
      metodoAjax(url,dataForm,function(success){
        console.log(success);
        $("#CuerpoModalDetalleVenta").html('');
        var total = 0;
        for(var i = 0; i < success['datos'].length; i++){
          var subtotal = parseInt(success['datos'][i]['CANTIDAD_VENTA']) * parseInt(success['datos'][i]['PRECIO_VENTA']);
            console.log('subtotal: '+subtotal);
            total = parseInt(total) + parseInt(subtotal);
          $("#CuerpoModalDetalleVenta").append(
            '<tr>'+
              '<td>'+success['datos'][i]['FK_PROCUTO']+'</td>'+
              '<td>'+success['datos'][i]['NOMBRE_PRODUCTO']+'</td>'+
              '<td>'+success['datos'][i]['CANTIDAD_VENTA']+'</td>'+
              '<td>$ '+ formatoMoneda(success['datos'][i]['PRECIO_VENTA']) +'</td>'+
              '<td>$ '+ formatoMoneda(parseInt(subtotal)) +'</td>'+
            '</tr>'
          );
        }
        console.log(total);
        $("#CuerpoModalDetalleVenta").append(
            '<tr>'+
              '<td></td>'+
              '<td></td>'+
              '<td></td>'+
              '<td>Total</td>'+
              '<td>$ '+ formatoMoneda(parseInt(total)) +'</td>'+
            '</tr>'
          );
        $("#ModalDetalleVenta").modal();
      });
    }

    //esta funcion obtiene el intervalo entre las fechas ingresadas por el usuario y obtiene todas las ventas en ese rango
    var Gl_ventas = null;
    function GenerarReporte(){
      var min = 70;
      var max = 2000;
      var fecha_inicio = $("#FechaInicioCalendario").val();
      var fecha_fin = $("#FechaFinCalendario").val();
      var tienda = $("#SelectEspacio").val();
      //console.log(fecha_inicio);
      var success;
      var url = "/reportes/reporte_intervalo";
      var dataForm = new FormData();
      dataForm.append('fecha_inicio',fecha_inicio);
      dataForm.append('fecha_fin',fecha_fin);
      dataForm.append('tienda',tienda);
      $('#TablaDatos').DataTable().destroy();
      //lamando al metodo ajax
      metodoAjax(url,dataForm,function(success){
        //aquí se escribe todas las operaciones que se harían en el succes
        //la variable success es el json que recibe del servidor el método AJAX
        //MensajeModal("TITULO DEL MODAL","MENSAJE DEL MODAL");
        Gl_ventas = success['ventas'];
        $("#fecha_tabla").text("Ventas del díass "+fecha_inicio + ' al día '+fecha_fin);
        $("#body-reportes").html('');
        for (var i = 0; i < success['ventas'].length; i++) {
          var botones = '<button type="button" class="btn btn-default btn-xs" onclick="DetalleVenta('+ success['ventas'][i]['VENTAS_ID'] +')" data-toggle="tooltip" data-placement="top" title="VER DETALLE">'+
            '<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>'+
          '</button>'+
          '<button type="button" class="btn btn-default btn-xs" onclick="Devolucion('+ success['ventas'][i]['VENTAS_ID'] +')" data-toggle="tooltip" data-placement="top" title="DEVOLUCIÓN">'+
            '<span class="glyphicon glyphicon-retweet" aria-hidden="true"></span>'+
          '</button>'+
          '<button type="button" class="btn btn-default btn-xs" onclick="ModalEnviarRemision('+ success['ventas'][i]['VENTAS_ID'] +')" data-toggle="tooltip" data-placement="top" title="DEVOLUCIÓN">'+
            '<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>'+
          '</button>';
          $("#body-reportes").append(

            '<tr>'+
              '<td>'+ (parseInt(success['ventas'].length)-parseInt(i)) +'</td>'+
              '<td>'+ "Remisión "+ success['ventas'][i]['VENTAS_CONSECUTIVO_ANUAL'] +'</td>'+
              '<td>$ '+ formatoMoneda(success['ventas'][i]['VENTAS_TOTAL']) +'</td>'+
              '<td>'+ success['ventas'][i]['VENTAS_TIPO_PAGO'] +'</td>'+
              '<td>'+ ((success['ventas'][i]['VENTAS_FACTURA'])?success['ventas'][i]['VENTAS_FACTURA']:'') +'</td>'+
              '<td>'+ botones  +'</td>'+
            '</tr>'

          );
        }
        crearDatatable();
      });
    }


    $('#FechaInicioCalendario').daterangepicker({
        singleDatePicker: true,
        singleClasses: "picker_4"
      }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
      });

    $('#FechaFinCalendario').daterangepicker({
        singleDatePicker: true,
        singleClasses: "picker_4"
      }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
      });

    function ejemploAjax(){
      var success;
      var url = "/ruta1/ruta2";
      var dataForm = new FormData();
      dataForm.append('p1',"p1");
      dataForm.append('p2','p2');
      //lamando al metodo ajax
      metodoAjax(url,dataForm,function(success){
        //aquí se escribe todas las operaciones que se harían en el succes
        //la variable success es el json que recibe del servidor el método AJAX
        MensajeModal("TITULO DEL MODAL","MENSAJE DEL MODAL");
      });
    }
  </script>
@endsection