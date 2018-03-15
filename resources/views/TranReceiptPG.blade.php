<div class="box-content">
	<div  id="toprint">
		<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
		<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
		<!--this css should be inside the toprint div , for printing the table borders-->	
		
		<center>
			<h4>Kumbarara Gudi Kaigarika Sahakara Sangha, Niyamita, Chakrasowdha, Kulai</h4>
			<h7>Number D.R.I 24/58</h7></br>
			<h7>Vidyanagara, Village and Post: Kulai-575019 Mangalore D.K</h7></br></br>
			<h5><b>FD RECEIPT</b></h5></br></br>
		</center>
		@foreach ($FdReceiptData['FdReceipt'] as $FdRec)
		<span style="font-weight:bold;">Receipt No:</span> <span class="receipt_number" style="font-weight:bold;color:red;font-size:18px">{{ $FdRec->FD_ReceiptNum }}</span>
		<span style="font-weight:bold;float:right;" class="receipt_date"></span>
		<table class="table table-striped bootstrap-datatable datatable responsive">
			
			
			
			
			
			
			
			
			<tr>
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
			</tr>
			
			<tr>
				<th>Father/Spouse name:</th>
				<td>{{ $FdRec->FatherName }}/{{ $FdRec->SpouseName }}</td>
			</tr>
			
			<tr>
				<th>Address:</th>
				<td>{{ $FdRec->Address }},</br>{{ $FdRec->City }},{{ $FdRec->District }},</br>{{ $FdRec->State }},{{ $FdRec->Pincode }}.</td>
			</tr>
			
			
			
			
			
			
			
			
			<tr>
				<th>Place:</th>
				<td>{{ $FdRec->BName }}</td>
			</tr>
			
			
			
			<tr>
				<th>FD Deposite Amount:</th>
				<td>{{ $FdRec->Fd_DepositAmt }}&nbsp/-</td>
			</tr>
			
			
			<hr>
			
			
			<tr>
				<th>Amount Paid:</th>
				<td><span class="receipt_amt" style="font-weight:bold;font-size:18px">Rs. {{ $FdRec->Fd_DepositAmt }}&nbsp/-</span></td>
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