<div class="box-content">
	<div  id="toprint_receipt">
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
		<b>Expence RECEIPT<b>
			&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
			&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
			&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
			&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp
			<b>Expence RECEIPT<b></br>
				
				
				@foreach ($ib as $expense)
				<!--<span style="font-weight:bold;">Receipt No:</span> <span class="receipt_number" style="font-weight:bold;color:red;font-size:18px">
					{{ $expense->Expence_PamentVoucher }}</span>
				<span style="font-weight:bold;float:right;" class="receipt_date"></span>-->
				<table class="table table-striped bootstrap-datatable datatable responsive">
					
					<tr>
						<th>Expense Paid For:</th>
						<td>{{ $expense->lname }}</td>
						<th>Expense Paid For:</th>
						<td>{{ $expense->lname }}</td>
					</tr>
					<tr>
						<th>Expenced Amount:</th>
						<td>{{ $expense->amount }}&nbsp/- </td>
						<th>Expenced Amount:</th>
						<td>{{ $expense->amount }}&nbsp/- </td>
					</tr>
					<tr>
						<th>Date:</th>
						<td>{{ $expense->e_date }}&nbsp </td>
						<th>Date:</th>
						<td>{{ $expense->e_date }}&nbsp </td>
					</tr>
					<tr>
						<th>Perticulars:</th>
						<td>{{ $expense->Particulars }}&nbsp </td>
						<th>Perticulars:</th>
						<td>{{ $expense->Particulars }}&nbsp </td>
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
						
						
						
						var divContents = $("#toprint_receipt").html();
						var printWindow = window.open('', '', 'height=600,width=800');
						printWindow.document.write('<html><head><title>FD RECEIPT</title>');
						printWindow.document.write('</head><body>');
						printWindow.document.write(divContents);
						printWindow.document.write('</body></html>');
						printWindow.document.close();
						setTimeout(function(){
							printWindow.print();
						}, 3500);
					});
				});
				
				
			</script>			