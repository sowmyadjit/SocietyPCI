<div class="box-content">
	<div  id="toprint<?php echo $plReceiptData['module']->Mid; ?>">
		<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
		<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
		<!--this css should be inside the toprint div , for printing the table borders-->	
		
		<center>
			<h4>Kumbarara Gudi Kaigarika Sahakara Sangha, Niyamita, Chakrasowdha, Kulai</h4>
			<h7>Number D.R.I 24/58</h7></br>
			<h7>Vidyanagara, Village and Post: Kulai-575019 Mangalore D.K</h7></br></br>
			<h5><b>PL RECEIPT</b></h5></br></br>
		</center>
		@foreach ($plReceiptData['data'] as $PLRec)
		<span style="font-weight:bold;">Receipt No:</span> <span class="receipt_number" style="font-weight:bold;color:red;font-size:18px">{{ $PLRec->PL_ReceiptNum }}</span>
		<span style="font-weight:bold;float:right;" class="receipt_date"></span>
		<table class="table table-striped bootstrap-datatable datatable responsive">
			
			
			
			
			
			
			
			
			<tr>
				<th>PL LOAN Number:</th>
				<td>
					{{ $PLRec->PersLoan_Number}}
				</td>
			</tr>
			
			<tr>
				<th>Customer Name: Mr/Mrs</th>
				<td>
					{{ $PLRec->FirstName}}.{{ $PLRec->MiddleName }}.{{ $PLRec->LastName }}
				</td>
			</tr>
			
			
			
			
			<hr>
			
			
			<tr>
				<th>Amount Paid:</th>
				<td><span class="receipt_amt" style="font-weight:bold;font-size:18px">Rs. {{ $PLRec->PLRepay_PaidAmt }}&nbsp/-</span></td>
			</tr>
			
			@endforeach
			
			
			
			
		</table>
		
		
	</div>
	
	<center>
		
		<div class="col-sm-12">
			<input type="button" value="PRINT" class="btn btn-info btn-sm print<?php echo $plReceiptData['module']->Mid; ?>" id="print<?php echo $plReceiptData['module']->Mid; ?>">
		</div>
		
	</center></br></br>		
</div>





<style type="text/css">
	@media print<?php echo $plReceiptData['module']->Mid; ?> {
	input#print<?php echo $plReceiptData['module']->Mid; ?> {
	display: none;
	}
	}
</style> 

<script src="js/jQuery.print.js"></script>

<script>
	ReceiptDate="<?php $recdate=date('d-m-Y'); echo "Receipt Date:  ".$recdate; ?>";
	$('.receipt_date').html(ReceiptDate);
	
	$('.clickme<?php echo $plReceiptData['module']->Mid; ?>').click(function(e)
	{
		$('.purshareclassid').click();
	});
	
	$(function() {
		$(".print<?php echo $plReceiptData['module']->Mid; ?>").click(function() {
			//alert('test');
			//$("#toprint").print();
			
		
			
			var divContents = $("#toprint<?php echo $plReceiptData['module']->Mid; ?>").html();
            var printWindow = window.open('', '', 'height=600,width=800');
            printWindow.document.write('<html><head><title>FD RECEIPT</title>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
		});
	});
	
	
</script>