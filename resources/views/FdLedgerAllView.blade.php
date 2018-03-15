<div class="English<?php echo $FdLedgerPerData['module']->Mid; ?>">
	<div  id="toprint<?php echo $FdLedgerPerData['module']->Mid; ?>">
		
		<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
		<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
		<!--this css should be inside the toprint div , for printing the table borders-->	
		<style type="text/css">
			.table
			{
			font-size: 12px;
			}
			
			div.vertical
			{
			position: relative;
			height: auto;
			width: auto;
			margin-left: 0;
			padding-right: 0;
			writing-mode: tb-rl;
			filter: flipv fliph;
			}
			
			th.vertical
			{
			padding-bottom: 5px;
			vertical-align: bottom;
			}
		</style>
		<center>
			<h4>Kumbarara Gudi Kaigarika Sahakari Sangha Niyamita</h4>
			<h7>Number D.R.I 24/58 Chakrasaudha Kulai, Mangaluru D.K. 575019 </h7></br>
			<h3>Fixed Deposite Ledger </h3></br></br>
		</center>
		
		
		
		<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
			
			
			<thead>
				
				
				<tr>
					<th>FD Acc Num</br>/ Old Acc Num</th>
					
					<th>Name and Address</th>
					<th>Father or</br>Spouse Name</th>
					<th>Nominee</br> Name</th>
					
					<th>Fd Start Date</th>
					<th>Fd End Date</th>
					<th>Fd Type</th>
					<th>Duration</th>
					<th class="vertical"><div class="vertical">Rate Of</br>Interest</div></th>
					<th>Principal</th>
					<th>Interest</th>
					<th>Total Amount</th>
					
				</tr>
			</thead>
			
			<tbody>
				
				@foreach($FdLedgerPerData['CustomerDetails'] as $FDPD)
				<div class="hidden">{{ $FDPD->Fdid }}</div>
				
				<tr>
					
					<td>
						{{ $FDPD->Fd_CertificateNum }}
						@if($FDPD->Fd_OldCertificateNum!="")
						</br>
						<?php echo "/"; ?>
						@endif
						
						{{ $FDPD->Fd_OldCertificateNum }}	
						
					</td>
					
					<td>
						{{ $FDPD->FirstName }} . {{ $FDPD->MiddleName }} . {{ $FDPD->LastName }} </br>
						{{ $FDPD->Address }}&nbsp,</br>
						{{ $FDPD->City }}&nbsp,</br>
						{{ $FDPD->District }}&nbsp,</br>
						{{ $FDPD->State }}&nbsp,</br>
						{{ $FDPD->Pincode }}
						
					</td>
					
					<td>
						<center>
							@if($FDPD->FatherName!="")
							
							<?php $temp=$FDPD->FatherName; echo $temp."</br>(FATHER)"; ?>
							
							
							@else
							
							<?php $temp=$FDPD->SpouseName; echo $temp."</br>(SPOUSE)";?>
							
							
							@endif
						</center>	
					</td>
					
					<td>
						<center>
							{{ $FDPD->Nom_FirstName }} . {{ $FDPD->Nom_MiddleName }} . {{ $FDPD->Nom_LastName }}</br>
							({{ $FDPD->Relationship }})
						</center>
					</td>
					
					<td><?php $trandate=date("d-m-Y",strtotime($FDPD->FdReport_StartDate)); echo $trandate; ?></td>
					<td><?php $trandate=date("d-m-Y",strtotime($FDPD->FdReport_MatureDate)); echo $trandate; ?></td>
					
					
					<td>{{ $FDPD->FdType }}</td>
					<td>
						<center>
							{{ $FDPD->NumberOfYears }}-Year</br>(<u>{{ $FDPD->NumberOfDays }}</u>Days)
						</center>
					</td>
				<td>{{ $FDPD->FdInterest }}</u><b>%</b></td>
				<td>{{ $FDPD->Fd_DepositAmt }}</td>
				<td>{{ $FDPD->interest_amount }}</td>
				<td>{{$FDPD->Fd_TotalAmt}}</td>
				
			</tr>
			@endforeach
		</tbody>
	</table>
	
</div>
<div id='pagei<?php echo $FdLedgerPerData['module']->Mid; ?>'>
	
	{!! $FdLedgerPerData['CustomerDetails']->appends(Input::except('page'))->render() !!}
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
		<style type="text/css">
			.table
			{
			font-size: 12px;
			}
		</style>
		
		<center>
			<h4>ಕುಂಬಾರರ ಗುಡಿ ಕೈಗಾರಿಕಾ ಸಹಕಾರ ಸಂಘ ನಿಯಮಿತ</h4>
			<h7>ನಂಬ್ರ ಡಿ.ಆರ್.ಐ 24/58 ಚಕ್ರಸೌಧ ಕುಳಾಯಿ, ಮಂಗಳೂರು ದ.ಕ. 575019 </h7></br>
			<h3>ಆರ್.ಡಿ ಖಾತೆ ಲೆಡ್ಜರ್ </h3></br></br>
		</center>
		
		<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
			
			
			<thead>
				<tr>
					<th>ಎಫ್.ಡಿ ಖಾತೆ ಸಂಖ್ಯೆ </br>/ ಹಳೇ ಸಂಖ್ಯೆ</th>
					
					<th>ಹೆಸರು ಮತ್ತು ವಿಳಾಸ</th>
					<th>ತಂದೆ / ಪತ್ನಿ ಯ ಹೆಸರು</th>
					<th>ನಾಮಿನಿ ಹೆಸರು</th>
					
					<th>ಖಾತೆ ತೆರೆದ ದಿನಾಂಕ:</th>
					<th>ಖಾತೆ ಮುಕ್ತಾಯ ದಿನಾಂಕ</th>
					<th>ಎಫ್.ಡಿ ಯ ವಿಧ</th>
					<th>ಅವಧಿ</th>
					<th>ಬಡ್ಡಿದರ</th>
					<th>ಠೇವಣಿ ಮೊತ್ತ</th>
					<th>ಬಡ್ಡಿ ಮೊತ್ತ</th>
					<th>ಒಟ್ಟು ಮೊತ್ತ</th>
					
				</tr>
			</thead>
			
			<tbody>
				@foreach($FdLedgerPerData['CustomerDetails'] as $FDPD)
				<div class="hidden">{{ $FDPD->Fdid }}</div>
				<tr>
					<td>
						{{ $FDPD->Fd_CertificateNum }}</br>
						@if($FDPD->Fd_OldCertificateNum!="")
						<?php echo "/"; ?>
						@endif
						
						{{ $FDPD->Fd_OldCertificateNum }}	
						
					</td>
					
					<td>
						{{ $FDPD->Kan_FirstName }} . {{ $FDPD->Kan_MiddleName }} . {{ $FDPD->Kan_LastName }} </br>
						{{ $FDPD->Kan_Address }}&nbsp,</br>
						{{ $FDPD->Kan_City }}&nbsp,</br>
						{{ $FDPD->Kan_District }}&nbsp,</br>
						{{ $FDPD->Kan_State }}&nbsp,</br>
						{{ $FDPD->Pincode }} 
					</td>
					
					<td><center>
						@if($FDPD->Kan_FatherName!="")
						
						<?php $temp=$FDPD->Kan_FatherName; echo $temp."</br>(ತಂದೆ)"; ?>
						
						
						@else
						
						<?php $temp=$FDPD->Kan_SpouseName; echo $temp."</br> (ಪತಿ ಯಾ ಪತ್ನಿ)"; ?>
						
						
						@endif
					</center>
					</td>
					
					<td><center>
						{{ $FDPD->Kan_Nom_FirstName }} . {{ $FDPD->Kan_Nom_MiddleName }} . {{ $FDPD->Kan_Nom_LastName }}</br>
						({{ $FDPD->Kan_Relationship }})
					</center>
					</td>
					
					<td><?php $trandate=date("d-m-Y",strtotime($FDPD->FdReport_StartDate)); echo $trandate; ?></td>
					<td><?php $trandate=date("d-m-Y",strtotime($FDPD->FdReport_MatureDate)); echo $trandate; ?></td>
					
					
					<td>{{ $FDPD->FdType }}</td>
					<td><center>
						{{ $FDPD->NumberOfYears }}-ವರ್ಷ</br>({{ $FDPD->NumberOfDays }}ದಿನಗಳು)
						</center>
							</td>
				<td>{{ $FDPD->FdInterest }}</u><b>%</b></td>
			<td>{{ $FDPD->Fd_DepositAmt }}</td>
			<td>{{ $FDPD->interest_amount }}</td>
			<td>{{$FDPD->Fd_TotalAmt}}</td>
			
		</tr>
		@endforeach
	</tbody>
</table>



</div>
<div id='pagei<?php echo $FdLedgerPerData['module']->Mid; ?>'>
	
	{!! $FdLedgerPerData['CustomerDetails']->appends(Input::except('page'))->render() !!}
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
			printWindow.document.write('<html><head><title>RD LEDGER</title>');
			printWindow.document.write('</head><body>');
			printWindow.document.write(divContents);
			printWindow.document.write('</body></html>');
			printWindow.document.close();
			printWindow.print();
		});
		
		$(".Knprint<?php echo $FdLedgerPerData['module']->Mid; ?>").click(function() {
			
			var divContents = $("#toprint1<?php echo $FdLedgerPerData['module']->Mid; ?>").html();
			var printWindow = window.open('', '', 'height=600,width=800');
			printWindow.document.write('<html><head><title>ಆರ್.ಡಿ ಲೆಡ್ಜರ್</title>');
			printWindow.document.write('</head><body>');
			printWindow.document.write(divContents);
			printWindow.document.write('</body></html>');
			printWindow.document.close();
			printWindow.print();
		});
	});
	
	
</script>

<script>
	
	$("#pagei<?php echo $FdLedgerPerData['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $FdLedgerPerData['module']->Mid; ?>");
		
	});
	
	$('.loadmc<?php echo $FdLedgerPerData['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('.SearchRes<?php echo $FdLedgerPerData['module']->Mid; ?>').load($(this).attr('href'));
	});
	</script>												