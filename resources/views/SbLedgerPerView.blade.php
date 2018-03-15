<div class="English<?php echo $SbLedgerPerData['module']->Mid; ?>">
	<div  id="toprint<?php echo $SbLedgerPerData['module']->Mid; ?>">
		<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
		<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
		<!--this css should be inside the toprint div , for printing the table borders-->	
		
		<center>
			<h4>Kumbarara Gudi Kaigarika Sahakari Sangha Niyamita</h4>
			<h7>Number D.R.I 24/58 Chakrasaudha Kulai, Mangaluru D.K. 575019 </h7></br>
			<h3>Savings Bank Account Ledger </h3></br></br>
		</center>
		
		
		<center>
			<table class="table bootstrap-datatable responsive">
				
				<tr >
					<td style="border-top: none;" ><b>Acc No:</b>
						<u>{{ $SbLedgerPerData['CustomerDetails']->Old_AccNo }}/{{ $SbLedgerPerData['CustomerDetails']->AccNum }}</u>
					</td>
					
					
					<td style="border-top: none;" colspan=2><b>Name:</b>
						<u>{{ $SbLedgerPerData['CustomerDetails']->FirstName }} . {{ $SbLedgerPerData['CustomerDetails']->MiddleName }} . {{ $SbLedgerPerData['CustomerDetails']->LastName }}</u>
					</td>
				</tr>
				
				<tr>
					<td style="border-top: none;" colspan=3><b>Address:</b>
						<u>{{ $SbLedgerPerData['CustomerDetails']->Address }}&nbsp,
							{{ $SbLedgerPerData['CustomerDetails']->City }}&nbsp,
							{{ $SbLedgerPerData['CustomerDetails']->District }}&nbsp,
							{{ $SbLedgerPerData['CustomerDetails']->State }}&nbsp,
							{{ $SbLedgerPerData['CustomerDetails']->Pincode }}&nbsp&nbsp
							
						</u>
					</td>
					
				</tr>
				
				<tr>
					
					
					<td style="border-top: none;"><b>Acc Open Date:</b>
						<u>{{ $SbLedgerPerData['CustomerDetails']->Created_on }}</u>
					</td>
					
					<td style="border-top: none;"><b>Nominee:</b>
						<u>{{ $SbLedgerPerData['CustomerDetails']->Nom_FirstName }} . {{ $SbLedgerPerData['CustomerDetails']->Nom_MiddleName }} . {{ $SbLedgerPerData['CustomerDetails']->Nom_LastName }}</u>
					</td>
					
					<td style="border-top: none;"><b>Relation:</b>
						<u>{{ $SbLedgerPerData['CustomerDetails']->Relationship }}</u>
					</td>
					
				</tr>
				
				
			</table>
		</center>
		<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
			
			
			<thead>
				<tr>
					<th>Date</th>
					<th>PARTIULARS</th>
					
					<th>Amount Received</th>
					<th>Amount Withdrawn</th>
					<th>Balance at Credit</th>
					
				</tr>
			</thead>
			
			<tbody>
				@foreach($SbLedgerPerData['TransactionDetails'] as $SLPD)
				<div class="hidden">{{ $SLPD->Accid }}</div>
				<tr>
					<td class="hidden">{{ $SLPD->Tranid }}</td>
					<td><?php $trandate=date("d-m-Y",strtotime($SLPD->SBReport_TranDate)); echo $trandate; ?></td>
					<td>{{ $SLPD->particulars }}</td>
					
					@if($SLPD->TransactionType=="Credit"||$SLPD->TransactionType=="CREDIT"||$SLPD->TransactionType=="credit")
					
					<td><p class="text-right"><?php $temp=$SLPD->Amount; echo $temp; ?></p></td> 
					<td><p class="text-center">-</p></td>
					
					@else
					
					<td><p class="text-center">-</p></td>
					<td><p class="text-right"><?php $temp=$SLPD->Amount; echo $temp; ?></p></td> 
					
					@endif
					<td><p class="text-right">{{ $SLPD->Total_Bal }}</p></td>
				</tr>
				@endforeach
			</tbody>
		</table>
		
	</div>
	<div id='pagei<?php echo $SbLedgerPerData['module']->Mid; ?>'>
		
		{!! $SbLedgerPerData['TransactionDetails']->appends(Input::except('page'))->render() !!}
	</div>
	<center>
		
		<div class="col-sm-12">
			<input type="button" value="PRINT" class="btn btn-info btn-md print<?php echo $SbLedgerPerData['module']->Mid; ?>" id="print<?php echo $SbLedgerPerData['module']->Mid; ?>">
		</div>
		
	</center></br></br>	
	
	
</div>


<div class="Kannada<?php echo $SbLedgerPerData['module']->Mid; ?>">
	<div  id="toprint1<?php echo $SbLedgerPerData['module']->Mid; ?>">
		<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
		<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
		<!--this css should be inside the toprint div , for printing the table borders-->	
		
		<center>
			<h4>ಕುಂಬಾರರ ಗುಡಿ ಕೈಗಾರಿಕಾ ಸಹಕಾರ ಸಂಘ ನಿಯಮಿತ</h4>
			<h7>ನಂಬ್ರ ಡಿ.ಆರ್.ಐ 24/58 ಚಕ್ರಸೌಧ ಕುಳಾಯಿ, ಮಂಗಳೂರು ದ.ಕ. 575019 </h7></br>
			<h3>ಉಳಿತಾಯ ಖಾತೆ ಲೆಡ್ಜರ್ </h3></br></br>
		</center>
		
		
	<center>
		<table class="table bootstrap-datatable responsive">
			
			<tr >
				<td style="border-top: none;" ><b>ಖಾತೆ ಸಂಖ್ಯೆ:</b>
					<u>{{ $SbLedgerPerData['CustomerDetails']->Old_AccNo }}/{{ $SbLedgerPerData['CustomerDetails']->AccNum }}</u>
				</td>
				
				
				<td style="border-top: none;" colspan=2><b>ಹೆಸರು:</b>
					<u>{{ $SbLedgerPerData['CustomerDetails']->Kan_FirstName }} . {{ $SbLedgerPerData['CustomerDetails']->Kan_MiddleName }} . {{ $SbLedgerPerData['CustomerDetails']->Kan_LastName }}</u>
				</td>
			</tr>
			
			<tr>
				<td style="border-top: none;" colspan=3><b>ವಿಳಾಸ:</b>
					<u>{{ $SbLedgerPerData['CustomerDetails']->Kan_Address }}&nbsp,
						{{ $SbLedgerPerData['CustomerDetails']->Kan_City }}&nbsp,
						{{ $SbLedgerPerData['CustomerDetails']->Kan_District }}&nbsp,
						{{ $SbLedgerPerData['CustomerDetails']->Kan_State }}&nbsp,
						{{ $SbLedgerPerData['CustomerDetails']->Pincode }}&nbsp&nbsp
						
					</u>
				</td>
				
			</tr>
			
			<tr>
				
				
				<td style="border-top: none;"><b>ಖಾತೆ ತೆರೆದ ದಿನಾಂಕ :</b>
					<u>{{ $SbLedgerPerData['CustomerDetails']->Created_on }}</u>
				</td>
				
				<td style="border-top: none;"><b>ನಾಮಿನಿ::</b>
					<u>{{ $SbLedgerPerData['CustomerDetails']->Kan_Nom_FirstName }} . {{ $SbLedgerPerData['CustomerDetails']->Kan_Nom_MiddleName }} . {{ $SbLedgerPerData['CustomerDetails']->Kan_Nom_LastName }}</u>
				</td>
				
				<td style="border-top: none;"><b>ಸಂಬಂಧ:</b>
					<u>{{ $SbLedgerPerData['CustomerDetails']->Kan_Relationship }}</u>
				</td>
				
			</tr>
			
			
		</table>
	</center>
	
	<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
		
		<thead>
			<tr>
				<th>ದಿನಾಂಕ</th>
				<th>ವಿವರಗಳು</th>
				
				<th>ಜಮಾ ರೂಪಾಯಿ</th>
				<th>ಡೆಬಿಟ್  ರೂಪಾಯಿ</th>
				<th>ಶಿಲ್ಲು ರೂಪಾಯಿ</th>
				
			</tr>
		</thead>
		
		<tbody>
			@foreach($SbLedgerPerData['TransactionDetails'] as $SLPD)
			<tr>
				<td class="hidden">{{ $SLPD->Tranid }}</td>
				<td><?php $trandate=date("d-m-Y",strtotime($SLPD->SBReport_TranDate)); echo $trandate; ?></td>
				<td>{{ $SLPD->particulars }}</td>
				
				@if($SLPD->TransactionType=="Credit"||$SLPD->TransactionType=="CREDIT"||$SLPD->TransactionType=="credit")
				
				<td><p class="text-right"><?php $temp=$SLPD->Amount; echo $temp; ?></p></td> 
				<td><p class="text-right">-</p></td>
				
				@else
				
				<td><p class="text-right">-</p></td>
				<td><p class="text-right"><?php $temp=$SLPD->Amount; echo $temp; ?></p></td> 
				
				@endif
				<td><p class="text-right">{{ $SLPD->Total_Bal }}</p></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	
</div>
<div id='pagei<?php echo $SbLedgerPerData['module']->Mid; ?>'>
	
	{!! $SbLedgerPerData['TransactionDetails']->appends(Input::except('page'))->render() !!}
</div>
<center>
	
	<div class="col-sm-12">
		<input type="button" value="ಮುದ್ರಿಸಿ" class="btn btn-info btn-md Knprint<?php echo $SbLedgerPerData['module']->Mid; ?>" id="Knprint<?php echo $SbLedgerPerData['module']->Mid; ?>">
	</div>
	
</center></br></br>	
</div>








<style type="text/css">
	@media print<?php echo $SbLedgerPerData['module']->Mid; ?> {
	input#print<?php echo $SbLedgerPerData['module']->Mid; ?> {
	display: none;
	}
	}
</style> 

<style type="text/css">
	@media Knprint<?php echo $SbLedgerPerData['module']->Mid; ?> {
	input#Knprint<?php echo $SbLedgerPerData['module']->Mid; ?> {
	display: none;
	}
	}
</style> 

<script src="js/jQuery.print.js"></script>
<script>
	
	CheckVal="<?php echo $SbLedgerPerData['Kannada']; ?>";
	
	$('document').ready(function(){
		
		if(CheckVal==0)
		{
			$('.English<?php echo $SbLedgerPerData['module']->Mid; ?>').show();
			$('.Kannada<?php echo $SbLedgerPerData['module']->Mid; ?>').hide();
		}
		
		else
		{
			$('.English<?php echo $SbLedgerPerData['module']->Mid; ?>').hide();
			$('.Kannada<?php echo $SbLedgerPerData['module']->Mid; ?>').show();
		}
		
		
	});
</script>



<script>
	

	
	
	$(function() {
		$(".print<?php echo $SbLedgerPerData['module']->Mid; ?>").click(function() {
			
			var divContents = $("#toprint<?php echo $SbLedgerPerData['module']->Mid; ?>").html();
			var printWindow = window.open('', '', 'height=600,width=800');
			printWindow.document.write('<html><head><title>SB LEDGER</title>');
			printWindow.document.write('</head><body>');
			printWindow.document.write(divContents);
			printWindow.document.write('</body></html>');
			printWindow.document.close();
			printWindow.print();
			
			
			
			
			
			
			
			//$.print("#toprint");
		});
		
		$(".Knprint<?php echo $SbLedgerPerData['module']->Mid; ?>").click(function() {
			
			var divContents = $("#toprint1<?php echo $SbLedgerPerData['module']->Mid; ?>").html();
			var printWindow = window.open('', '', 'height=600,width=800');
			printWindow.document.write('<html><head><title>ಎಸ್.ಬಿ ಲೆಡ್ಜರ್</title>');
			printWindow.document.write('</head><body>');
			printWindow.document.write(divContents);
			printWindow.document.write('</body></html>');
			printWindow.document.close();
			printWindow.print();
			
			
			
			
			
			
			
			//$.print("#toprint");
		});
	});
	
	
</script>

<script>
	
	$("#pagei<?php echo $SbLedgerPerData['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $SbLedgerPerData['module']->Mid; ?>");
		
	});
	
	$('.loadmc<?php echo $SbLedgerPerData['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('.SearchRes<?php echo $SbLedgerPerData['module']->Mid; ?>').load($(this).attr('href'));
	});
	</script>								