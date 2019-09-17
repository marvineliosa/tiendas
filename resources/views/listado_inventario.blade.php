@extends('plantillas.menu')
@section('title','Inventario')
@section('tittle_page','Inventario')

@section('content')

	<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <!-- <h2>Seccion 1 de la página</h2> -->
          <button type="button" class="btn btn-success pull-right" onclick="DescargarInventario()">Descargar</button>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table class="table table-hover" id="TablaDatos">
              <thead>
                <tr>
                  <th scope="row">Código</th>
                  <th>Producto</th>
                  <!-- <th>Precio</th> -->
                  <th>Cantidad</th>
                  <!-- <th>Acciones</th> -->
                </tr>
              </thead>
              <tbody>
                @foreach($productos as $producto)
                  <tr>
                    <td> {{$producto->CODIGO}} </td>
                    <td> {{$producto->PRODUCTO}} </td>
                    <!-- <td> PRECIO </td> -->
                    <td> {{$producto->CANTIDAD}} </td>
                    <!-- <td>
                      Acciones
                    </td> -->
                  </tr>
                @endforeach
              </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script type="text/javascript">
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

    function DescargarInventario(){
      var inventario = <?php echo json_encode($productos) ?>;
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
      var ws_data = inventario;  //a row with 2 columns


      var SolicitudesWs = XLSX.utils.json_to_sheet(ws_data) 

      // A workbook is the name given to an Excel file
      var wb = XLSX.utils.book_new() // make Workbook of Excel

      // add Worksheet to Workbook
      // Workbook contains one or more worksheets
      //XLSX.utils.book_append_sheet(wb, animalWS, 'animals') // sheetAName is name of Worksheet
      XLSX.utils.book_append_sheet(wb, SolicitudesWs, 'Inventario')   

      // export Excel file
      var nombre_archivo = 'Reporte_de_inventario'+'.xlsx';
      XLSX.writeFile(wb, nombre_archivo)
    }
  </script>
@endsection