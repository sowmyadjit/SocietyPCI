<div class="box-content">
	<div  id="toprint<?php echo $jlReceiptData['module']->Mid; ?>">
		<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
		<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
		<!--this css should be inside the toprint div , for printing the table borders-->	
		
		<center>
			<h4>Kumbarara Gudi Kaigarika Sahakara Sangha, Niyamita, Chakrasowdha, Kulai</h4>
			<h7>Number D.R.I 24/58</h7></br>
			<h7>Vidyanagara, Village and Post: Kulai-575019 Mangalore D.K</h7></br></br>
			<h5><b>JL RECEIPT</b></h5></br></br>
		</center>
		@foreach ($jlReceiptData['data'] as $jLRec)
		<span style="font-weight:bold;">Receipt No:</span> <span class="receipt_number" style="font-weight:bold;color:red;font-size:18px">{{ $jLRec->jL_ReceiptNum }}</span>
		<span style="font-weight:bold;float:right;" class="receipt_date"></span>
		<table class="table table-striped bootstrap-datatable datatable responsive">
			
			
			
			
			
			
			
			
			<tr>
				<th>JL LOAN Number:</th>
				<td>
					{{ $jLRec->JewelLoan_LoanNumber}}
				</td>
			</tr>
			
			<tr>
				<th>Customer Name: Mr/Mrs</th>
				<td>
					{{ $jLRec->FirstName}}.{{ $jLRec->MiddleName }}.{{ $jLRec->LastName }}
				</td>
			</tr>
			
			
			
			
			<hr>
			
			
			<tr>
				<th>Amount Paid:</th>
				<td><span class="receipt_amt" style="font-weight:bold;font-size:18px">Rs. {{ $jLRec->JLRepay_PaidAmt }}&nbsp/-</span></td>
			</tr>
			
			@endforeach
			
			
			
			
		</table>
		
		
	</div>
	
	<center>
		
		<div class="col-sm-12">
			<input type="button" value="PRINT" class="btn btn-info btn-sm print<?php echo $jlReceiptData['module']->Mid; ?>" id="print<?php echo $jlReceiptData['module']->Mid; ?>">
		</div>
		
	</center></br></br>		
</div>





<style type="text/css">
	@media print<?php echo $jlReceiptData['module']->Mid; ?> {
	input#print<?php echo $jlReceiptData['module']->Mid; ?> {
	display: none;
	}
	}
</style> 

<script src="js/jQuery.print.js"></script>

<script>
	ReceiptDate="<?php $recdate=date('d-m-Y'); echo "Receipt Date:  ".$recdate; ?>";
	$('.receipt_date').html(ReceiptDate);
	
	$('.clickme<?php echo $jlReceiptData['module']->Mid; ?>').click(function(e)
	{
		$('.purshareclassid').click();
	});
	
	$(function() {
		$(".print<?php echo $jlReceiptData['module']->Mid; ?>").click(function() {
			//alert('test');
			//$("#toprint").print();
			
		
			
			var divContents = $("#toprint").html();
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
</script>
</script>
</script>
</script>
</script>
</script>
</script>
</script>