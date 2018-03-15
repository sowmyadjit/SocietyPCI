<div class="English<?php echo $FdLedgerPerData['module']->Mid; ?>">
	<div  id="toprint<?php echo $FdLedgerPerData['module']->Mid; ?>">
		<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
		<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
		<!--this css should be inside the toprint div , for printing the table borders-->	
		
		<center>
			<h4>Kumbarara Gudi Kaigarika Sahakari Sangha Niyamita</h4>
			<h7>Number D.R.I 24/58 Chakrasaudha Kulai, Mangaluru D.K. 575019 </h7></br>
			<h3>Fixed Deposite Ledger </h3></br></br>
			
		</center>
		
		
		<center>
			<table class="table bootstrap-datatable responsive">
				
				<tr >
					<td style="border-top: none;" ><b>Acc No:</b>
						<u>{{ $FdLedgerPerData['CustomerDetails']->Fd_OldCertificateNum }}
							@if($FdLedgerPerData['CustomerDetails']->Fd_OldCertificateNum!="")
							<?php echo "/"; ?>
							@endif
							
							
						{{ $FdLedgerPerData['CustomerDetails']->Fd_CertificateNum }}</u>
						&nbsp
						<b>Acc Open Date:</b>
						<u><?php $trandate=date("d-m-Y",strtotime($FdLedgerPerData['CustomerDetails']->FdReport_StartDate)); echo $trandate; ?></u>
						&nbsp
						<b>Maturity Date:</b>
						<u><?php $trandate=date("d-m-Y",strtotime($FdLedgerPerData['CustomerDetails']->FdReport_MatureDate)); echo $trandate; ?></u>
					</td>
				</tr>
				
				<tr>
					<td style="border-top: none;">
						<b>Name:</b>
						<u>{{ $FdLedgerPerData['CustomerDetails']->FirstName }} . {{ $FdLedgerPerData['CustomerDetails']->MiddleName }} . {{ $FdLedgerPerData['CustomerDetails']->LastName }}</u>
						&nbsp &nbsp
						
						
						@if($FdLedgerPerData['CustomerDetails']->FatherName!="")
						
						<?php $temp=$FdLedgerPerData['CustomerDetails']->FatherName; echo "<b>Father Name:</b> <u>".$temp."</u>"; ?>
						
						
						@else
						
						<?php $temp=$FdLedgerPerData['CustomerDetails']->SpouseName; echo "<b>Spouse Name:</b> <u>".$temp."</u>"; ?>
						
						
						@endif
						
					</tr>
					
					<tr>		
						<td style="border-top: none;" colspan=3><b>Address:</b>
							<u>{{ $FdLedgerPerData['CustomerDetails']->Address }}&nbsp,
								{{ $FdLedgerPerData['CustomerDetails']->City }}&nbsp,
								{{ $FdLedgerPerData['CustomerDetails']->District }}&nbsp,
								{{ $FdLedgerPerData['CustomerDetails']->State }}&nbsp,
								{{ $FdLedgerPerData['CustomerDetails']->Pincode }}&nbsp&nbsp
								
							</u>
						</td>
						
					</tr>
					
					
					<tr>
						
						<td style="border-top: none;"><b>Nominee:</b>
							<u>{{ $FdLedgerPerData['CustomerDetails']->Nom_FirstName }} . {{ $FdLedgerPerData['CustomerDetails']->Nom_MiddleName }} . {{ $FdLedgerPerData['CustomerDetails']->Nom_LastName }}</u>
						&nbsp<b>Relation:</b>
						<u>{{ $FdLedgerPerData['CustomerDetails']->Relationship }}</u>
					</td>
					
				</tr>
			</table>
			
			<table class="table bootstrap-datatable responsive">
				<tr>
					<th style="border-top: none;" colspan=1>
						FD Type
					</th>
					
					<th style="border-top: none;" colspan=1>
						Duration
					</th>
					
					<th style="border-top: none;" colspan=1>
						Rate Of Interest
					</th>
				</tr>
				
				<tr>
					<td style="border-top: none;" colspan=1>
						{{ $FdLedgerPerData['CustomerDetails']->FdType }}
					</td>
					
					<td style="border-top: none;" colspan=1>
						{{ $FdLedgerPerData['CustomerDetails']->NumberOfYears }}&nbsp <b>Year </b>&nbsp <b>( </b>
						<u>{{ $FdLedgerPerData['CustomerDetails']->NumberOfDays }}</u> <b> Days ) </b>
					</td>
					
					<td style="border-top: none;" colspan=1>
					{{ $FdLedgerPerData['CustomerDetails']->FdInterest }}</u><b>%</b>
				</td>
				
				
			</tr>
			
			<tr>
				
				<th style="border-top: none;" colspan=1>
					Principal
				</th>
				
				
				<th style="border-top: none;" colspan=1>
					Interest
				</th>
				
				
				
				<th style="border-top: none;" colspan=1>
					Total Amount
				</th>
			</tr>
			
			<tr>
				
				<td style="border-top: none;" colspan=1>
					{{ $FdLedgerPerData['CustomerDetails']->Fd_DepositAmt }}
				</td>
				
				<td style="border-top: none;" colspan=1>
					{{ $FdLedgerPerData['CustomerDetails']->interest_amount }}
				</td>
				
				<td style="border-top: none;" colspan=1>
					{{ $FdLedgerPerData['CustomerDetails']->Fd_TotalAmt }}
				</td>
				
			</tr>
			
			
		</table>
	</center>
	
	
</div>

<center>
	
	<div class="col-sm-12">
		<input type="button" value="PRINT" class="btn btn-info btn-md print<?php echo $FdLedgerPerData['module']->Mid; ?>" id="print<?php echo $FdLedgerPerData['module']->Mid; ?>">
	</div>
	
</center></br></br>	


</div>




<div class="Kannada<?php echo $FdLedgerPerData['module']->Mid; ?>">
	<div  id="toprint1<?php echo $FdLedgerPerData['module']->Mid; ?>">
		<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
		<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
		<!--this css should be inside the toprint div , for printing the table borders-->	
		
		<center>
			<h4>ಕುಂಬಾರರ ಗುಡಿ ಕೈಗಾರಿಕಾ ಸಹಕಾರ ಸಂಘ ನಿಯಮಿತ</h4>
			<h7>ನಂಬ್ರ ಡಿ.ಆರ್.ಐ 24/58 ಚಕ್ರಸೌಧ ಕುಳಾಯಿ, ಮಂಗಳೂರು ದ.ಕ. 575019 </h7></br>
			<h3>ನಿರಖು ಠೇವಣಿ ಖಾತೆ ಲೆಡ್ಜರ್ </h3></br></br>
		</center>
		
		
		<center>
			
			<table class="table bootstrap-datatable responsive">
				
				<tr >
					<td style="border-top: none;" ><b>ಖಾತೆ ಸಂಖ್ಯೆ:</b>
						<u>{{ $FdLedgerPerData['CustomerDetails']->Fd_OldCertificateNum }}
							@if($FdLedgerPerData['CustomerDetails']->Fd_OldCertificateNum!="")
							<?php echo "/"; ?>
							@endif
							
							
						{{ $FdLedgerPerData['CustomerDetails']->Fd_CertificateNum }}</u>
						&nbsp
						<b>ಖಾತೆ ತೆರೆದ ದಿನಾಂಕ:</b>
						<u><?php $trandate=date("d-m-Y",strtotime($FdLedgerPerData['CustomerDetails']->FdReport_StartDate)); echo $trandate; ?></u>
						&nbsp
						<b>ಖಾತೆ ಮುಕ್ತಾಯ ದಿನಾಂಕ:</b>
						<u><?php $trandate=date("d-m-Y",strtotime($FdLedgerPerData['CustomerDetails']->FdReport_MatureDate)); echo $trandate; ?></u>
					</td>
				</tr>
				
				<tr>
					<td style="border-top: none;">
						<b>ಹೆಸರು:</b>
						<u>{{ $FdLedgerPerData['CustomerDetails']->Kan_FirstName }} . {{ $FdLedgerPerData['CustomerDetails']->Kan_MiddleName }} . {{ $FdLedgerPerData['CustomerDetails']->Kan_LastName }}</u>
						&nbsp &nbsp
						
						
						@if($FdLedgerPerData['CustomerDetails']->FatherName!="")
						
						<?php $temp=$FdLedgerPerData['CustomerDetails']->Kan_FatherName; echo "<b>ತಂದೆಯ ಹೆಸರು:</b> <u>".$temp."</u>"; ?>
						
						
						@else
						
						<?php $temp=$FdLedgerPerData['CustomerDetails']->Kan_SpouseName; echo "<b>ಪತ್ನಿ ಯಾ ಗಂಡನ ಹೆಸರು:</b> <u>".$temp."</u>"; ?>
						
						
						@endif
						
					</tr>
					
					<tr>		
						<td style="border-top: none;" colspan=3><b>ವಿಳಾಸ:</b>
							<u>{{ $FdLedgerPerData['CustomerDetails']->Kan_Address }}&nbsp,
								{{ $FdLedgerPerData['CustomerDetails']->Kan_City }}&nbsp,
								{{ $FdLedgerPerData['CustomerDetails']->Kan_District }}&nbsp,
								{{ $FdLedgerPerData['CustomerDetails']->Kan_State }}&nbsp,
								{{ $FdLedgerPerData['CustomerDetails']->Pincode }}&nbsp&nbsp
								
							</u>
						</td>
						
					</tr>
					
					
					<tr>
						
						<td style="border-top: none;"><b>ನಾಮಿನಿ:</b>
							<u>{{ $FdLedgerPerData['CustomerDetails']->Kan_Nom_FirstName }} . {{ $FdLedgerPerData['CustomerDetails']->Kan_Nom_MiddleName }} . {{ $FdLedgerPerData['CustomerDetails']->Kan_Nom_LastName }}</u>
							&nbsp
							<b>ಸಂಬಂಧ:</b>
							<u>{{ $FdLedgerPerData['CustomerDetails']->Kan_Relationship }}</u>
						</td>
						
					</tr>
				</table>
				
				<table class="table bootstrap-datatable responsive">
					<tr>
						<th style="border-top: none;" colspan=1>
							ಎಫ್.ಡಿ ವಿಧ
						</th>
						
						<th style="border-top: none;" colspan=1>
							ಅವಧಿ
						</th>
						
						<th style="border-top: none;" colspan=1>
							ಬಡ್ಡಿದರ
						</th>
					</tr>
					
					<tr>
						<td style="border-top: none;" colspan=1>
							{{ $FdLedgerPerData['CustomerDetails']->FdType }}
						</td>
						
						<td style="border-top: none;" colspan=1>
							{{ $FdLedgerPerData['CustomerDetails']->NumberOfYears }}&nbsp <b>ವರ್ಷ </b>&nbsp <b>( </b>
							{{ $FdLedgerPerData['CustomerDetails']->NumberOfDays }} <b> ದಿನಗಳು ) </b>
						</td>
						
						<td style="border-top: none;" colspan=1>
						{{ $FdLedgerPerData['CustomerDetails']->FdInterest }}</u><b>%</b>
					</td>
					
					
				</tr>
				
				<tr>
					
					<th style="border-top: none;" colspan=1>
						ಠೇವಣಿ ಮೊತ್ತ
					</th>
					
					
					<th style="border-top: none;" colspan=1>
						ಬಡ್ಡಿ ಮೊತ್ತ
					</th>
					
					
					
					<th style="border-top: none;" colspan=1>
						ಒಟ್ಟು ಮೊತ್ತ
					</th>
				</tr>
				
				<tr>
					
					<td style="border-top: none;" colspan=1>
						{{ $FdLedgerPerData['CustomerDetails']->Fd_DepositAmt }}
					</td>
					
					<td style="border-top: none;" colspan=1>
						{{ $FdLedgerPerData['CustomerDetails']->interest_amount }}
					</td>
					
					<td style="border-top: none;" colspan=1>
						{{ $FdLedgerPerData['CustomerDetails']->Fd_TotalAmt }}
					</td>
					
				</tr>
				
				
			</table>
			
		</center>
		
		
		
	</div>
	
	<center>
		
		<div class="col-sm-12">
			<input type="button" value="ಮುದ್ರಿಸಿ" class="btn btn-info btn-md Knprint<?php echo $FdLedgerPerData['module']->Mid; ?>" id="Knprint<?php echo $FdLedgerPerData['module']->Mid; ?>">
		</div>
		
	</center></br></br>	
</div>








<style type="text/css">
	@media print {
	input#print<?php echo $FdLedgerPerData['module']->Mid; ?> {
	display: none;
	}
	}
</style> 

<style type="text/css">
	@media Knprint {
	input#Knprint<?php echo $FdLedgerPerData['module']->Mid; ?> {
	display: none;
	}
	}
</style> 

<script src="js/jQuery.print.js"></script>
<script>
	
	CheckVal="<?php echo $FdLedgerPerData['Kannada']; ?>";
	
	$('document').ready(function(){
		
		if(CheckVal==0)
		{
			$('.English<?php echo $FdLedgerPerData['module']->Mid; ?>').show();
			$('.Kannada<?php echo $FdLedgerPerData['module']->Mid; ?>').hide();
		}
		
		else
		{
			$('.English<?php echo $FdLedgerPerData['module']->Mid; ?>').hide();
			$('.Kannada<?php echo $FdLedgerPerData['module']->Mid; ?>').show();
		}
		
		
	});
</script>



<script>
	$('.clickme').click(function(e)
	{
		$('.purshareclassid').click();
	});
	
	$('.purshrcrt').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	$('.edtbtn').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	$(function() {
		$(".print<?php echo $FdLedgerPerData['module']->Mid; ?>").click(function() {
			
			var divContents = $("#toprint<?php echo $FdLedgerPerData['module']->Mid; ?>").html();
			var printWindow = window.open('', '', 'height=600,width=800');
			printWindow.document.write('<html><head><title>FD LEDGER</title>');
			printWindow.document.write('</head><body>');
			printWindow.document.write(divContents);
			printWindow.document.write('</body></html>');
			printWindow.document.close();
			printWindow.print();
		});
		
		$(".Knprint<?php echo $FdLedgerPerData['module']->Mid; ?>").click(function() {
			
			var divContents = $("#toprint1<?php echo $FdLedgerPerData['module']->Mid; ?>").html();
			var printWindow = window.open('', '', 'height=600,width=800');
			printWindow.document.write('<html><head><title>ಎಫ್.ಡಿ ಲೆಡ್ಜರ್</title>');
			printWindow.document.write('</head><body>');
			printWindow.document.write(divContents);
			printWindow.document.write('</body></html>');
			printWindow.document.close();
			printWindow.print();
		});
	});
	
	
	</script>																				