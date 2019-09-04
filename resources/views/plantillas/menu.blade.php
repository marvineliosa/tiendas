<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('images/favico.ico')}}" type="image/ico" />

    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{asset('vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
  
    <!-- bootstrap-progressbar -->
    <link href="{{asset('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{asset('vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('build/css/custom.min.css')}}" rel="stylesheet">
    <!-- Archivos adicionales -->
    <!-- Datatables -->
    <link href="{{asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
    
    <!-- bootstrap-datetimepicker -->
    <link href="{{asset('vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')}}" rel="stylesheet">

    <style type="text/css">
      .test[style] {
         padding-right:0 !important;
     }
     .test.modal-open {
        overflow: auto;
        
     }
    </style>
  </head>

  <body class="nav-md">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container body">
      <div class="main_container">
        
        @include('plantillas.navbar')

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>@yield('tittle_page')</h3>
              </div>
             
              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">

                    <h3 class="pull-right"> {{\Session::get('nombre_tienda')[0]}}</h3>

                  </div>
                </div>
              </div>
       
            </div>
            <div class="clearfix"></div>

            @yield('content')

          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{asset('vendors/nprogress/nprogress.js')}}"></script>
    <!-- Chart.js')}} -->
    <script src="{{asset('vendors/Chart.js/dist/Chart.min.js')}}"></script>
    <!-- gauge.js')}} -->
    <script src="{{asset('vendors/gauge.js/dist/gauge.min.js')}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{asset('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{asset('vendors/iCheck/icheck.min.js')}}"></script>
    <!-- Skycons -->
    <script src="{{asset('vendors/skycons/skycons.js')}}"></script>
    <!-- Flot -->
    <script src="{{asset('vendors/Flot/jquery.flot.js')}}"></script>
    <script src="{{asset('vendors/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('vendors/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{asset('vendors/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{asset('vendors/Flot/jquery.flot.resize.js')}}"></script>
    <!-- Flot plugins -->
    <script src="{{asset('vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{asset('vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{asset('vendors/flot.curvedlines/curvedLines.js')}}"></script>
    <!-- DateJS -->
    <script src="{{asset('vendors/DateJS/build/date.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset('vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
    <script src="{{asset('vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <script src="{{asset('vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{asset('build/js/custom.min.js')}}"></script>

    <!-- Archivos adicionales -->
    <!-- Datatables -->
    <script src="{{asset('vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{asset('vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
    <script src="{{asset('vendors/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{asset('vendors/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('vendors/pdfmake/build/vfs_fonts.js')}}"></script>
    <!-- bootstrap-datetimepicker -->    
    <script src="{{asset('vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    <!-- codigo de barras -->
    <script src="{{asset('jsbarcode/JsBarcode.all.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/locale/es.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.js"></script>

    <!-- Modal mensaje -->
    <div class="modal fade" id="ModalMensaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title" id="TituloModalMensaje" align="center"></h2>
            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>-->
          </div>
          <div class="modal-body">
            <h3  id="CuerpoModalMensaje" align="center"> </h3>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modales -->
    <div class="modal fade" id="ModalDetalleProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: scroll; max-height:100%;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" id="thOficio"></th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody id="bodyDetalleProducto">
              </tbody>
          </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal historial -->
    <div class="modal fade" id="ModalHistorial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: scroll; max-height:100%;">
      <div class="modal-dialog" role="document" >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Historial</h5>
          </div>
          <div class="modal-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" width="75%">Historial</th>
                  <th scope="col" width="25%">Fecha</th>
                </tr>
              </thead>
              <tbody id="BodyHistorial">
              </tbody>
          </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

   <!-- Modal Carga-->
    <div class="modal fade" id="modalCarga" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div align="center">
          <img src="{{ asset('images/carga3.gif') }}" class="img-rounded" alt="Cinque Terre">
        </div>
      </div>
    </div>

  </body>
</html>
<script type="text/javascript">
    $(".modal").on('hidden.bs.modal', function () {
    // do something…
      $('body').addClass('test');//solución para que no se recorra el body hacia la izquierda
      //$("#cuerpoVinculacionDescripciones").html("");
    });

    function CancelarSubmit(){
        //console.log("Epale");
        return false;
      }

    function formatoMoneda(numero) {
      //numero = '3258.56';
      //console.log(numero);
      numero = numero.toFixed(2);
      numero = numero.toString();
      //console.log(numero);

      if(numero>999999){
        conPunto = numero.substring(0, numero.length-9);
        conPunto2 = numero.substring(numero.length-9, numero.length-6);
        conPunto3 = numero.substring(numero.length-6, numero.length);
        numero = conPunto + ',' + conPunto2 + ',' + conPunto3;
      }else{
        if(numero>999){
          conPunto = numero.substring(0, numero.length-6);
          conPunto2 = numero.substring(numero.length-6, numero.length);
          numero = conPunto + ',' + conPunto2;
        }       
      }
      return numero;
    }

    function ModalVerHistorial(id_producto){
      var success;
      var url = "/productos/ver_historial";
      var dataForm = new FormData();
      dataForm.append('id_producto',id_producto);
      //lamando al metodo ajax
      metodoAjax(url,dataForm,function(success){
        //aquí se escribe todas las operaciones que se harían en el succes
        //la variable success es el json que recibe del servidor el método AJAX
        //console.log(success);
        $("#BodyHistorial").html('');
        for(var i = 0; i < success['historial'].length; i++){
          if(success['historial'][i]){
            $("#BodyHistorial").append(
                '<tr>'+
                  '<td>'+
                    success['historial'][i]['TEXTO_HISTORIAL']+
                  '</td>'+
                  '<td>'+
                    success['historial'][i]['FECHA_HISTORIAL']+
                  '</td>'+
                '</tr>'
              );
          }
        }

        $("#ModalHistorial").modal();
      });
    }

    function MensajeModal(titulo,mensaje){
        $("#TituloModalMensaje").text(titulo);
        $("#CuerpoModalMensaje").text(mensaje);
        $("#ModalMensaje").modal();
    }
    
  //señor metodo maestro ajax
  function metodoAjax(url,dataForm,callback){
    var resultado = null;
    
    $.ajax({
      url :url,
      data : dataForm,
      contentType:false,
      processData:false,
      headers:{
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
      type: 'POST',
      dataType : 'json',
      beforeSend: function (){
        $("#modalCarga").modal();
      },
      success : function(json){
        //resultado = json;
        callback(json);
        //$("#nombre_producto").focus();
      },
      error : function(xhr, status) {
        $("#textoModalMensaje").text('Existió un problema con la operación');
        $("#modalMensaje").modal();
        MensajeModal('¡ERROR!','Existió un problema, intentelo de nuevo, si el problema persiste favor de reportarlo a la extensión --.')
      },
      complete : function(xhr, status){
         $("#modalCarga").modal('hide');
         $("#nombre_producto").focus();
      }
    });//*/
    //$("#nombre_producto").focus();
  }

  //señor ajax de las recargas de tablas
  function recargarTablaAjax(url) {
      var dato_busqueda = (($('.dataTables_filter input').val())?$('.dataTables_filter input').val():' ');
      var table = $('#tabla_datos').DataTable()
      var pagina = (table.page.info());
      pagina = parseInt(pagina.page) + 1;
      //console.log("PAGINA: "+(pagina));
      //console.log(dato_busqueda);
      var dataForm = new FormData();
      dataForm.append('id_sol','id_sol');
      $.ajax({
          method: "POST",
          url: url,
        headers:{
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
          success: function (response) {
              $('.collapse').collapse('show');
              $('#div_tabla_datos').html(response);
              //console.log(response);
              crearDatatable(dato_busqueda,pagina);
          },                               
      });//*/
      //tabla.search( dato_busqueda ).draw();
    }

    //presentando detalle del producto
    function VerDatosProducto(id_producto){
      var success;
      var url = "/productos/obtener_datos";
      var dataForm = new FormData();
      dataForm.append('id_producto', id_producto);
      //lamando al metodo ajax
      $("#bodyDetalleProducto").html('');
      metodoAjax(url,dataForm,function(success){
          //aquí se escribe todas las operaciones que se harían en el succes
          //la variable success es el json que recibe del servidor el método AJAX
        $("#bodyDetalleProducto").append(
          '<tr>'+
            '<th>Producto</th>'+
            '<td id="td-Producto">'+success['producto']['NOMBRE_PRODUCTO']+'</td>'+
          '</tr>'+
          '<tr>'+
            '<th>Color</th>'+
            '<td id="td-Color">'+success['producto']['COLOR_PRODUCTO']+'</td>'+
          '</tr>'+
          '<tr>'+
            '<th>Talla</th>'+
            '<td id="td-Talla">'+success['producto']['TALLA_PRODUCTO']+'</td>'+
          '</tr>'+
          '<tr>'+
            '<th>Genero</th>'+
            '<td id="td-Genero">'+success['producto']['GENERO_PRODUCTO']+'</td>'+
          '</tr>'+
          '<tr>'+
            '<th>Fecha de registro a DAPI</th>'+
            '<td id="td-FechaRegistro">'+success['producto']['FECHA_REGISTRO']+'</td>'+
          '</tr>'+
          '<tr>'+
            '<th>Precio sin descuento</th>'+
            '<td id="td-PrecioSinDescuento">$'+success['producto']['PRECIO_SIN_DESCUENTO']+'</td>'+
          '</tr>'+
          '<tr>'+
            '<th>Precio de venta (con descuento)</th>'+
            '<td id="td-PrecioVenta">$'+success['producto']['PRECIO_VENTA']+'</td>'+
          '</tr>'+
          '<tr>'+
            '<th>Descuento</th>'+
            '<td id="td-Decuento">'+((success['producto']['DESCUENTO_PRODUCTO'])?success['producto']['DESCUENTO_PRODUCTO']:0)+'%</td>'+
          '</tr>'+
          '<tr>'+
            '<th>Número de Notas de entrada</th>'+
            '<td id="td-NotasEntrada">'+success['producto']['TOTAL_NOTAS_ENTRADA']+'</td>'+
          '</tr>'+
          '<tr>'+
            '<th>Unidades vendidas</th>'+
            '<td id="td-UnidadesVendidas">'+'---FALTA AGREGAR---'+'</td>'+
          '</tr>'+
          '<tr>'+
            '<th>Observaciones</th>'+
            '<td id="td-Observaciones">'+((success['producto']['OBSERVACIONES_PRODUCTO'])?success['producto']['OBSERVACIONES_PRODUCTO']:'')+'</td>'+
          '</tr>'
        );
        for(var i = 0; i < success['producto']['INVENTARIO'].length; i++){
          $("#bodyDetalleProducto").append(
            '<tr>'+
              '<th>Inventario en '+success['producto']['INVENTARIO'][i]['ESPACIO_EXISTENCIAS']+'</th>'+
              '<td>'+success['producto']['INVENTARIO'][i]['CANTIDAD_EXISTENCIAS']+'</td>'+
            '</tr>'
          )
        }
        $("#ModalDetalleProducto").modal();
      });
    }

    crearDatatable();
    function crearDatatable(dato_busqueda,numero_pagina){
      //$('#TablaDatos').DataTable().destroy();
      var tabla = $('#TablaDatos').DataTable({
          //responsive: true,
          "searching": true,
          "paging":   true,
          "info":     true,
          "ordering": true,
          "pageLength": 10,
          //'displayStart': numero_pagina,
          language: {
            emptyTable: "No hay datos para mostrar en la tabla",
            zeroRecords: "No hay datos para mostrar en la tabla",
            "search": "Buscar:",
            "info":"Se muestra los registros _START_ a _END_ de _TOTAL_ totales.",
            "infoEmpty":"No se ha encontrado registros.",
            "lengthMenu":"Mostrando _MENU_ registros",
            "infoFiltered":"(Filtrado de un total de _MAX_ registros)",
            "search": "Buscar: ",
            paginate: {
              "first":      "Primero",
              "last":       "Ultimo",
              "next":       "Siguiente",
              "previous":   "Anterior"
            },
          }
        });//*/
        if(dato_busqueda){
          tabla.search( dato_busqueda ).draw();
          $( ".paginate_button  [data-dt-idx='"+numero_pagina+"']" ).trigger("click");
        }
    }
</script>


@yield('script')