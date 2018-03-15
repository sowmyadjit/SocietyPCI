<div class="box-content">
	<div  id="toprint">
		<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
		<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
		<!--this css should be inside the toprint div , for printing the table borders-->	
		
			&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp
						Kumbarara Gudi Kaigarika Sahakara Sangha
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
						
					
						 
						
						Kumbarara Gudi Kaigarika Sahakara Sangha</br>
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
						&nbsp &nbsp &nbsp &nbsp  
						Niyamita, Chakrasowdha, Kulai
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
						&nbsp 
						
						Niyamita, Chakrasowdha, Kulai</br>
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  
						<b>JL RECEIPT<b>
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp
			<b>JL RECEIPT<b></br>
		
		<table class="table table-striped bootstrap-datatable datatable responsive">
			
			<tr>
				<th>Receipt No:</th>
				<td>
					{{ $jlReceiptData['data']->jL_ReceiptNum}}
				</td>
				<th>Receipt No:</th>
				<td>
					{{ $jlReceiptData['data']->jL_ReceiptNum}}
				</td>
			</tr>
			
			<tr>
				<th>JL LOAN Number:</th>
				<td>
					{{ $jlReceiptData['data']->JewelLoan_LoanNumber}}
				</td>
				<th>JL LOAN Number:</th>
				<td>
					{{ $jlReceiptData['data']->JewelLoan_LoanNumber}}
				</td>
			</tr>
			
			<tr>
				<th>Customer Name: Mr/Mrs</th>
				<td>
					{{ $jlReceiptData['data']->FirstName}}.{{ $jlReceiptData['data']->MiddleName }}.{{ $jlReceiptData['data']->LastName }}
				</td>
				<th>Customer Name: Mr/Mrs</th>
				<td>
					{{ $jlReceiptData['data']->FirstName}}.{{ $jlReceiptData['data']->MiddleName }}.{{ $jlReceiptData['data']->LastName }}
				</td>
			</tr>
			
			<tr>
				<th>Interest Paid </th>
				<td>
					{{ $jlReceiptData['data']->JLRepay_interestpaid}}
				</td>
				<th>Interest Paid </th>
				<td>
					{{ $jlReceiptData['data']->JLRepay_interestpaid}}
				</td>
			</tr>
			<tr>
				<th>principal Amount Paid</th>
				<td>
					{{ $jlReceiptData['data']->JLRepay_paidtoprincipalamt}}
				</td>
				<th>principal Amount Paid</th>
				<td>
					{{ $jlReceiptData['data']->JLRepay_paidtoprincipalamt}}
				</td>
			</tr>
			
			@foreach($jlReceiptData['charges'] AS $jlrecepit)
			<tr>
				<th>{{ $jlrecepit->charges_name}}</th>
				<td>
					{{ $jlrecepit->amount}}
				</td>
				<th>{{ $jlrecepit->charges_name}}</th>
				<td>
					{{ $jlrecepit->amount}}
				</td>
			</tr>
			@endforeach
			<hr>
			
			
			<tr>
				<th>Amount Paid:</th>
				<td><span class="receipt_amt" style="font-weight:bold;font-size:18px">Rs. {{ $jlReceiptData['data']->JLRepay_PaidAmt }}&nbsp/-</span></td>
				<th>Amount Paid:</th>
				<td><span class="receipt_amt" style="font-weight:bold;font-size:18px">Rs. {{ $jlReceiptData['data']->JLRepay_PaidAmt }}&nbsp/-</span></td>
			</tr>
			
		
			
			
			
			
		</table>
		
		
	</div>
	
	<center>
		
		<div class="col-sm-12">
			<input type="button" value="PRINT" class="btn btn-info btn-sm print" id="print">
		</div>
		
	</center></br></br>		
</div>





<style type="text/css">
	@media print {
	input#print {
	display: none;
	}
	}
</style> 

<script src="js/jQuery.print.js"></script>

<script>
	ReceiptDate="<?php $recdate=date('d-m-Y'); echo "Receipt Date:  ".$recdate; ?>";
	$('.receipt_date').html(ReceiptDate);
	
	$('.clickme').click(function(e)
	{
		$('.purshareclassid').click();
		});
	
	$(function() {
		$(".print").click(function() {
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