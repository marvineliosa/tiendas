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


  <!-- Modal Detalle Devolución -->
  <div class="modal fade" id="ModalDetalleDevolucion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="TituloModalDetalleDevolucion" align="center">Detalle de Venta</h2>
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
@endsection

@section('script')
  <script type="text/javascript">

    //$("#ModalDetalleVenta").modal();




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

    function Devolucion(id_venta){
      alert(id_venta);
    }

    function GenerarReporte(){
      var min = 70;
      var max = 2000;
      var fecha_inicio = $("#FechaInicioCalendario").val();
      var fecha_fin = $("#FechaFinCalendario").val();
      //console.log(fecha_inicio);
      var success;
      var url = "/reportes/reporte_intervalo";
      var dataForm = new FormData();
      dataForm.append('fecha_inicio',fecha_inicio);
      dataForm.append('fecha_fin',fecha_fin);
      $('#TablaDatos').DataTable().destroy();
      //lamando al metodo ajax
      metodoAjax(url,dataForm,function(success){
        //aquí se escribe todas las operaciones que se harían en el succes
        //la variable success es el json que recibe del servidor el método AJAX
        //MensajeModal("TITULO DEL MODAL","MENSAJE DEL MODAL");
        $("#fecha_tabla").text("Ventas del día "+fecha_inicio + ' al día '+fecha_fin);
        $("#body-reportes").html('');
        for (var i = 0; i < success['ventas'].length; i++) {
          var botones = '<button type="button" class="btn btn-default btn-xs" onclick="DetalleVenta('+ success['ventas'][i]['VENTAS_ID'] +')" data-toggle="tooltip" data-placement="top" title="VER DETALLE">'+
            '<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>'+
          '</button>'+
          '<button type="button" class="btn btn-default btn-xs" onclick="Devolucion('+ success['ventas'][i]['VENTAS_ID'] +')" data-toggle="tooltip" data-placement="top" title="DEVOLUCIÓN">'+
            '<span class="glyphicon glyphicon-retweet" aria-hidden="true"></span>'+
          '</button>';
          $("#body-reportes").append(

            '<tr>'+
              '<td>'+ (parseInt(success['ventas'].length)-parseInt(i)) +'</td>'+
              '<td>'+ "Remisión "+ success['ventas'][i]['VENTAS_CONSECUTIVO_ANUAL'] +'</td>'+
              '<td>$ '+ formatoMoneda(success['ventas'][i]['VENTAS_TOTAL']) +'</td>'+
              '<td>'+ success['ventas'][i]['VENTAS_TIPO_PAGO'] +'</td>'+
              '<td>'+ '' +'</td>'+
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