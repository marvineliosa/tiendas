<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
<script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('jsbarcode/JsBarcode.all.js')}}"></script>

<a href="javascript:demoFromHTML()" class="button">

<div id="testcase">

<h1>
	We support special element handlers. Register them with jQuery-style.
</h1>

</div>
</a>
<script>
demoFromHTML();
function demoFromHTML() {
	//console.log('algo');
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