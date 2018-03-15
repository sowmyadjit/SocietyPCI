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
						<b>FD RECEIPT<b>
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp
			<b>FD RECEIPT<b></br>
		
		@foreach ($FdReceiptData['FdReceipt'] as $FdRec)
		
	
		
		<table class="table table-striped bootstrap-datatable datatable responsive">
			
			
			
			
			
			
			
			
			<tr>
				<th>FD RECEIPT Number:</th>
				<td>
					{{ $FdRec->FD_ReceiptNum}}
				</td>
				<th>FD RECEIPT Number:</th>
				<td>
					{{ $FdRec->FD_ReceiptNum}}
				</td>
			</tr>
			
			<tr>
				<th>FD Certificate Number:</th>
				<td>
					{{ $FdRec->Fd_CertificateNum}}
				</td>
				<th>FD Certificate Number:</th>
				<td>
					{{ $FdRec->Fd_CertificateNum}}
				</td>
			</tr>
			
			<tr>
				<th>Customer Name: Mr/Mrs</th>
				<td>
					{{ $FdRec->FirstName}}.{{ $FdRec->MiddleName }}.{{ $FdRec->LastName }}
				</td>
				<th>Customer Name: Mr/Mrs</th>
				<td>
					{{ $FdRec->FirstName}}.{{ $FdRec->MiddleName }}.{{ $FdRec->LastName }}
				</td>
			</tr>
			
			<tr>
				<th>Father/Spouse name:</th>
				<td>{{ $FdRec->FatherName }}/{{ $FdRec->SpouseName }}</td>
				<th>Father/Spouse name:</th>
				<td>{{ $FdRec->FatherName }}/{{ $FdRec->SpouseName }}</td>
			</tr>
			
			<tr>
				<th>Address:</th>
				<td>{{ $FdRec->Address }},</br>{{ $FdRec->City }},{{ $FdRec->District }},</br>{{ $FdRec->State }},{{ $FdRec->Pincode }}.</td>
				<th>Address:</th>
				<td>{{ $FdRec->Address }},</br>{{ $FdRec->City }},{{ $FdRec->District }},</br>{{ $FdRec->State }},{{ $FdRec->Pincode }}.</td>
			</tr>
			
			
			
			
			
			
			
			
			<tr>
				<th>Place:</th>
				<td>{{ $FdRec->BName }}</td>
				<th>Place:</th>
				<td>{{ $FdRec->BName }}</td>
			</tr>
			
			
			
			<tr>
				<th>FD Deposite Amount:</th>
				<td>{{ $FdRec->Fd_DepositAmt }}&nbsp/-</td>
				<th>FD Deposite Amount:</th>
				<td>{{ $FdRec->Fd_DepositAmt }}&nbsp/-</td>
			</tr>
			
			
			<hr>
			
			
			<tr>
				<th>Amount Paid:</th>
				<td><span class="receipt_amt" style="font-weight:bold;font-size:18px">Rs. {{ $FdRec->Fd_DepositAmt }}&nbsp/-</span></td>
				<th>Amount Paid:</th>
				<td><span class="receipt_amt" style="font-weight:bold;font-size:18px">Rs. {{ $FdRec->Fd_DepositAmt }}&nbsp/-</span></td>
			</tr>
			
			@endforeach
			
			
			
			
		</table>
		</br>
				</br>
				
				
				CUSTOMER SIGNATURE  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp CASHIER SIGNATURE
						
				 &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp CUSTOMER SIGNATURE  &nbsp &nbsp &nbsp 
						&nbsp &nbsp &nbsp &nbsp &nbsp     CASHIER SIGNATURE
		
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