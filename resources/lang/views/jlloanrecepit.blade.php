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
				@foreach ($jlloanrecepit as $jLRec)
				<!--<span style="font-weight:bold;">Receipt No:</span> <span class="receipt_number" style="font-weight:bold;color:red;font-size:18px"></span>
				<span style="font-weight:bold;float:right;" class="receipt_date"></span>-->
				<table class="table table-striped bootstrap-datatable datatable responsive">
					
					<tr>
						<th>JL LOAN Number:</th>
						<td>
							{{ $jLRec->JewelLoan_LoanNumber}}/{{ $jLRec->jewelloan_Oldloan_No}}
						</td>
						<th>JL LOAN Number:</th>
						<td>
							{{ $jLRec->JewelLoan_LoanNumber}}/{{ $jLRec->jewelloan_Oldloan_No}}
						</td>
					</tr>
					
					<tr>
						<th>Customer Name: Mr/Mrs</th>
						<td>
							{{ $jLRec->FirstName}}.{{ $jLRec->MiddleName }}.{{ $jLRec->LastName }}
						</td>
						<th>Customer Name: Mr/Mrs</th>
						<td>
							{{ $jLRec->FirstName}}.{{ $jLRec->MiddleName }}.{{ $jLRec->LastName }}
						</td>
					</tr>
					<tr>
						<th>SaraparaCharge</th>
						<td>
							{{ $jLRec->JewelLoan_SaraparaCharge}}
						</td>
						<th>SaraparaCharge</th>
						<td>
							{{ $jLRec->JewelLoan_SaraparaCharge}}
						</td>
					</tr>
					<tr>
						<th>InsuranceCharge</th>
						<td>
							{{ $jLRec->JewelLoan_InsuranceCharge}}
						</td>
						<th>InsuranceCharge</th>
						<td>
							{{ $jLRec->JewelLoan_InsuranceCharge}}
						</td>
					</tr>
					<tr>
						<th>BookAndFormCharge</th>
						<td>
							{{ $jLRec->JewelLoan_BookAndFormCharge}}
						</td>
						<th>BookAndFormCharge</th>
						<td>
							{{ $jLRec->JewelLoan_BookAndFormCharge}}
						</td>
					</tr>
					
					<tr>
						<th>OtherCharge</th>
						<td>
							{{ $jLRec->JewelLoan_OtherCharge}}
						</td>
						<th>OtherCharge</th>
						<td>
							{{ $jLRec->JewelLoan_OtherCharge}}
						</td>
					</tr>
					
					<hr>
					
					
					<tr>
						<th>Amount Paid:</th>
						<td><span class="receipt_amt" style="font-weight:bold;font-size:18px">Rs. {{ $jLRec->JewelLoan_LoanAmountAfterDeduct }}&nbsp/-</span></td>
						<th>Amount Paid:</th>
						<td><span class="receipt_amt" style="font-weight:bold;font-size:18px">Rs. {{ $jLRec->JewelLoan_LoanAmountAfterDeduct }}&nbsp/-</span></td>
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
		