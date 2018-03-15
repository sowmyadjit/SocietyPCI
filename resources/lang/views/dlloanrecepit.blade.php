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
						<b>DL RECEIPT<b>
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp
			<b>DL RECEIPT<b></br>
		@foreach ($dlloanrecepit as $dlRec)
		<!--<span style="font-weight:bold;">Receipt No:</span> <span class="receipt_number" style="font-weight:bold;color:red;font-size:18px"></span>
		<span style="font-weight:bold;float:right;" class="receipt_date"></span>-->
		<table class="table table-striped bootstrap-datatable datatable responsive">
			<tr>
				<th>DL LOAN Number:</th>
				<td>
					{{ $dlRec->DepLoan_LoanNum}}/{{ $dlRec->Old_loan_number}}
				</td>
				<th>DL LOAN Number:</th>
				<td>
					{{ $dlRec->DepLoan_LoanNum}}/{{ $dlRec->Old_loan_number}}
				</td>
			</tr>
			<tr>
				<th>DL LOAN TYPE:</th>
				<td>
					{{ $dlRec->DepLoan_DepositeType}}
				</td>
				<th>DL LOAN TYPE:</th>
				<td>
					{{ $dlRec->DepLoan_DepositeType}}
				</td>
			</tr>
			
			<tr>
				<th> ACCOUNT NUMBER:</th>
				<td>
					{{ $dlRec->DepLoan_AccNum}}/{{ $dlRec->Old_Accnum}}
				</td>
				<th> ACCOUNT NUMBER:</th>
				<td>
					{{ $dlRec->DepLoan_AccNum}}/{{ $dlRec->Old_Accnum}}
				</td>
			</tr>
			
			<tr>
				<th>Customer Name: Mr/Mrs</th>
				<td>
					{{ $dlRec->FirstName}}.{{ $dlRec->MiddleName }}.{{ $dlRec->LastName }}
					</td>
					
					<th>Customer Name: Mr/Mrs</th>
				<td>
					{{ $dlRec->FirstName}}.{{ $dlRec->MiddleName }}.{{ $dlRec->LastName }}
					</td>
			</tr>
			
			<tr>
				<th>LoanCharge</th>
				<td>
					{{ $dlRec->DepLoan_LoanCharge}}
					</td>
					
					<th>LoanCharge</th>
				<td>
					{{ $dlRec->DepLoan_LoanCharge}}
					</td>
			</tr>
			
			
			
			
			<hr>
			
			
			<tr>
				<th>Amount Paid:</th>
				<td><span class="receipt_amt" style="font-weight:bold;font-size:18px">Rs. {{ $dlRec->DepLoan_LoanAmount }}&nbsp/-</span></td>
				<th>Amount Paid:</th>
				<td><span class="receipt_amt" style="font-weight:bold;font-size:18px">Rs. {{ $dlRec->DepLoan_LoanAmount }}&nbsp/-</span></td>
			</tr>
			
			@endforeach
			
			
			
			
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