<link href="css/datepicker.css" rel='stylesheet'>
<script src="js/bootstrap-datepicker.js"/>


<div>
		<script src="js/FileSaver.js"/>			
		<script src="js/tableExport.js"/>
        <link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
        <link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all"> 
		<input type="button" value="Back" class="btn btn-info btn-sm back" style="float:right;margin:15px;" href="pigmiDLPigmy">
		<input type="button" value="Print" class="btn btn-info btn-sm print" style="float:right;margin:15px;" id="print">
		<div id="toprint">
			<h2 style="text-align:center;">POTTERS COTTAGE INDUSTRIAL CO-OP SOCIETY LTD.</h2>
			<h3 style="text-align:center;">CHAKRASOUDHA, KULAI.</h3>
			<div style="padding:15px;">
				<h2>Customer Details</h2>    
				<table class="table table-striped bootstrap-datatable datatable responsive" style="width:100%;">
				<tr>
					<th style="width:20%;text-align: left;">
						Customer Name:
					</th>
					<td style="width:30%;text-align: left;">
						Djitsoft
					</td>
					<th style="width:20%;text-align: left;">
						Customer ID:
					</th>
					<td style="width:30%;text-align: left;">
						12345
					</td>
				</tr>
				<tr>
					<th style="width:20%;text-align: left;">
						Customer Address:
					</th>
					<td style="width:30%;text-align: left;">
						asdd
					</td>
					<th style="width:20%;text-align: left;">
						Customer Ph No:
					</th>
					<td style="width:30%;text-align: left;">
						decc
					</td>
				</tr>
				<tr>
					<th style="width:20%;text-align: left;">
						Guarantor :
					</th>
					<td style="width:30%;text-align: left;">
						qwerty
					</td>
					<th style="width:20%;text-align: left;">
						Guarantor Ph No:
					</th>
					<td style="width:30%;text-align: left;">
						1452365
					</td>
				</tr>
        </table>
        </div>
					<div style="padding:15px;text-align: left;">
				<h2>Repayment Details</h2>    
				<table class="table table-striped bootstrap-datatable datatable responsive" style="width:100%;">
				<tr>
					<th style="width:20%;text-align: left;">
						Sl No:
					</th>
					<td style="width:30%;text-align: left;">
						1
					</td>
					<th style="width:20%;text-align: left;">
						Date:
					</th>
					<td style="width:30%;text-align: left;">
						17-03-2018
					</td>
				</tr>
				<tr>
					<th style="width:20%;text-align: left;">
						Principal Amount:
					</th>
					<td style="width:30%;text-align: left;">
						100000s
					</td>
					<th style="width:20%;text-align: left;">
						Interest Paid Till:
					</th>
					<td style="width:30%;text-align: left;">
						12000
					</td>
				</tr>
				<tr>
					<th style="width:20%;text-align: left;">
						Interest :
					</th>
					<td style="width:30%;text-align: left;">
						100
					</td>
					<th style="width:20%;text-align: left;">
						Charges:
					</th>
					<td style="width:30%;text-align: left;">
						1452365
					</td>
				</tr>
        </table>
        </div>
		</div>
</div>
<script src="js/jQuery.print.js"></script>
<script>
	
	$(function() {
		$(".print").click(function() {
			var divContents = $("#toprint").html();
            var printWindow = window.open('', '', 'height=600,width=800');
            printWindow.document.write('<html><head><title>Customer RECEIPT</title>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
			//$("#toprint").print();
            printWindow.print(); 
		});
	});
		$('.back').click(function(e)
		{
				e.preventDefault();
				//alert($(this).attr('href'));       
				$('.box-inner').show();
				$('.receipt_print').hide();
		});
	
</script>			
