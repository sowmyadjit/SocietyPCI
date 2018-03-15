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
						<b>Customer RECEIPT<b>
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp
			<b>Customer RECEIPT<b></br>
			
		@foreach ($CustRecDetail['customer'] as $CustRec)
		<!--<span style="font-weight:bold;">Receipt No:</span> <span class="receipt_number" style="font-weight:bold;color:red;font-size:18px">{{ $CustRec->Customer_ReceiptNum }}</span>-->
		
		<table class="table table-striped bootstrap-datatable datatable responsive">
			<tr>
				<th>Customer Name: Mr/Mrs</th>
				<td>
					{{ $CustRec->FirstName}}.{{ $CustRec->MiddleName }}.{{ $CustRec->LastName }}
				</td>
				<th>Customer Name: Mr/Mrs</th>
				<td>
					{{ $CustRec->FirstName}}.{{ $CustRec->MiddleName }}.{{ $CustRec->LastName }}
				</td>
			</tr>
			
			<tr>
				<th>Father/Spouse name:</th>
				<td>{{ $CustRec->FatherName }}/{{ $CustRec->SpouseName }}</td>
				<th>Father/Spouse name:</th>
				<td>{{ $CustRec->FatherName }}/{{ $CustRec->SpouseName }}</td>
			</tr>
			
			<tr>
				<th>Address:</th>
				<td>{{ $CustRec->Address }},</br>{{ $CustRec->City }},{{ $CustRec->District }},</br>{{ $CustRec->State }},{{ $CustRec->Pincode }}.</td>
				<th>Address:</th>
				<td>{{ $CustRec->Address }},</br>{{ $CustRec->City }},{{ $CustRec->District }},</br>{{ $CustRec->State }},{{ $CustRec->Pincode }}.</td>
			</tr>
			
			
			<tr>
				<th>Customer Type:</th>
				<td>{{$CustRec->custtyp}}</td>
				
				<th>Customer Type:</th>
				<td>{{$CustRec->custtyp}}</td>
			</tr>
			
			<tr>
				<th>Customer Creation Date:</th>
				<td>
					<?php $custdate=date("d-m-Y",strtotime($CustRec->Created_on)); echo $custdate;?>
				</td>
				<th>Customer Creation Date:</th>
				<td>
					<?php $custdate=date("d-m-Y",strtotime($CustRec->Created_on)); echo $custdate;?>
				</td>
			</tr>
			
			
			
			<tr>
				<th>Place:</th>
				<td>{{ $CustRec->BName }}</td>
				
				<th>Place:</th>
				<td>{{ $CustRec->BName }}</td>
			</tr>
			
			
			
			<tr>
				<th>Fees:</th>
				<td>{{ $CustRec->Customer_Fee }}&nbsp/-</td>
				
				<th>Fees:</th>
				<td>{{ $CustRec->Customer_Fee }}&nbsp/-</td>
			</tr>
			
			
			<tr class="mem_fee_body">
				<th><div class="mem_fee_head"></div></th>
				<td><div class="mem_fee"></div></td>
				
				<th><div class="mem_fee_head"></div></th>
				<td><div class="mem_fee"></div></td>
			</tr>
			
			
			<tr>
				<th>Amount Paid:</th>
				<td><span class="receipt_amt" style="font-weight:bold;font-size:18px">Rs. {{ $CustRec->Customer_Fee }}&nbsp/-</span></td>
				
				<th>Amount Paid:</th>
				<td><span class="receipt_amt" style="font-weight:bold;font-size:18px">Rs. {{ $CustRec->Customer_Fee }}&nbsp/-</span></td>
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
            printWindow.document.write('<html><head><title>Customer RECEIPT</title>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
		});
	});
	
	
</script>