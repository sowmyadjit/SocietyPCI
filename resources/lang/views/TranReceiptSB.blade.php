<div class="box-content">
	<div  id="toprint">
		<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
		<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
		<!--this css should be inside the toprint div , for printing the table borders-->	
		@foreach ($ReceiptData as $FdRec)
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
						<b>SB RECEIPT<b>
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp  
						
						
						<b>SB RECEIPT<b>
		
		
		<span style="font-weight:bold;float:right;" class="receipt_date">Transaction Date:
		<?php $strdate=date("d-m-Y",strtotime($FdRec->SBReport_TranDate)); echo $strdate;?></span>
		<table class="table table-striped bootstrap-datatable datatable responsive">
			
			
			
			
			
			
			
			
			<tr>
				<th>Receipt No:</th>
				@if($FdRec->TransactionType=="CREDIT")
			
				<td>
					{{ $FdRec->SB_resp_No}}
				</td>
				@elseif($FdRec->TransactionType=="DEBIT")
				<td>
					{{ $FdRec->SB_paymentvoucher_No}}
				</td>
				@endif
				<th>Receipt No:</th>
				@if($FdRec->TransactionType=="CREDIT")
			
				<td>
					{{ $FdRec->SB_resp_No}}
				</td>
				@elseif($FdRec->TransactionType=="DEBIT")
				<td>
					{{ $FdRec->SB_paymentvoucher_No}}
				</td>
				@endif
			</tr>
			
			<tr>
				<th>SB Account Number:</th>
				<td>
					{{ $FdRec->AccNum}}  /  {{ $FdRec->Old_AccNo}}
				</td>
				<th>SB Account Number:</th>
				<td>
					{{ $FdRec->AccNum}}  /  {{ $FdRec->Old_AccNo}}
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
			
			
			
			
			
			
			<hr>
			
			
			<tr>
				<th>Amount Paid:</th>
				<td><span class="receipt_amt" style="font-weight:bold;font-size:18px">Rs. {{ $FdRec->Amount }}&nbsp/-</span></td>
				<th>Amount Paid:</th>
				<td><span class="receipt_amt" style="font-weight:bold;font-size:18px">Rs. {{ $FdRec->Amount }}&nbsp/-</span></td>
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
	//ReceiptDate="<?php $recdate=date('d-m-Y'); echo "Receipt Date:  ".$recdate; ?>";
	
	//$('.receipt_date').html(ReceiptDate);
	
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
            printWindow.document.write('<html><head><title>SB RECEIPT</title>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
		});
	});
	
	
</script>