<div class="English">
	<div  id="toprint">
		<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
		<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
		<!--this css should be inside the toprint div , for printing the table borders-->	
		
		<center>
			<h4>Kumbarara Gudi Kaigarika Sahakari Sangha Niyamita</h4>
			<h7>Number D.R.I 24/58 Chakrasaudha Kulai, Mangaluru D.K. 575019 </h7></br>
			<h3>Pigmy Account Ledger </h3></br></br>
		</center>
		
		<center>
			<table class="table bootstrap-datatable responsive">
				
				<tr >
					<td style="border-top: none;" ><b>Acc No:</b>
						<u>{{ $PigmiLedgerPerData['CustomerDetails']->old_pigmiaccno }}/{{ $PigmiLedgerPerData['CustomerDetails']->PigmiAcc_No }}</u>
					</td>
					
					
					<td style="border-top: none;" colspan=2><b>Name:</b>
						<u>{{ $PigmiLedgerPerData['CustomerDetails']->FirstName }} . {{ $PigmiLedgerPerData['CustomerDetails']->MiddleName }} . {{ $PigmiLedgerPerData['CustomerDetails']->LastName }}</u>
					</td>
				</tr>
				
				<tr>
					<td style="border-top: none;" colspan=3><b>Address:</b>
						<u>{{ $PigmiLedgerPerData['CustomerDetails']->Address }}&nbsp,
							{{ $PigmiLedgerPerData['CustomerDetails']->City }}&nbsp,
							{{ $PigmiLedgerPerData['CustomerDetails']->District }}&nbsp,
							{{ $PigmiLedgerPerData['CustomerDetails']->State }}&nbsp,
						{{ $PigmiLedgerPerData['CustomerDetails']->Pincode }}&nbsp&nbsp
						
					</u>
				</td>
				
			</tr>
			
			<tr>
				
				
				<td style="border-top: none;"><b>Acc Open Date:</b>
					<u><?php $trandate=date("d-m-Y",strtotime($PigmiLedgerPerData['CustomerDetails']->StartDate)); echo $trandate; ?></u>
				</td>
				
				<td style="border-top: none;"><b>Acc End Date:</b>
					<u><?php $trandate=date("d-m-Y",strtotime($PigmiLedgerPerData['CustomerDetails']->EndDate)); echo $trandate; ?></u>
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
			@foreach($PigmiLedgerPerData['TransactionDetails'] as $SLPD)
			<div class="hidden">{{ $SLPD->PigmiAllocID }}</div>
			<tr>
				<td class="hidden">{{ $SLPD->PigmiTrans_ID }}</td>
				<td><?php $trandate=date("d-m-Y",strtotime($SLPD->PigReport_TranDate)); echo $trandate; ?></td>
				<td>{{ $SLPD->Particulars }}</td>
				
				@if($SLPD->Transaction_Type=="Credit"||$SLPD->Transaction_Type=="CREDIT"||$SLPD->Transaction_Type=="credit")
				
				<td><p class="text-right"><?php $temp=$SLPD->Amount; echo $temp; ?></p></td> 
				<td><p class="text-center">-</p></td>
				
				@else
				
				<td><p class="text-center">-</p></td>
				<td><p class="text-right"><?php $temp=$SLPD->Amount; echo $temp; ?></p></td> 
				
				@endif
				<td><p class="text-right">{{ $SLPD->Total_Amount }}</p></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	
</div>
<div id='pagei'>
	
	{!! $PigmiLedgerPerData['TransactionDetails']->appends(Input::except('page'))->render() !!}
</div>
<center>
	
	<div class="col-sm-12">
		<input type="button" value="PRINT" class="btn btn-info btn-md print" id="print">
	</div>
	
</center></br></br>	


</div>


<div class="Kannada">
	<div  id="toprint1">
		<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
		<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
		<!--this css should be inside the toprint div , for printing the table borders-->	
		
		<center>
			<h4>ಕುಂಬಾರರ ಗುಡಿ ಕೈಗಾರಿಕಾ ಸಹಕಾರ ಸಂಘ ನಿಯಮಿತ</h4>
			<h7>ನಂಬ್ರ ಡಿ.ಆರ್.ಐ 24/58 ಚಕ್ರಸೌಧ ಕುಳಾಯಿ, ಮಂಗಳೂರು ದ.ಕ. 575019 </h7></br>
			<h3>ನಿತ್ಯನಿಧಿ ಖಾತೆ ಲೆಡ್ಜರ್ </h3></br></br>
		</center>
		
		
	
	<center>
		<table class="table bootstrap-datatable responsive">
				
				<tr >
					<td style="border-top: none;" ><b> ನಿತ್ಯನಿಧಿ ಸಂಖ್ಯೆ:</b>
						<u>{{ $PigmiLedgerPerData['CustomerDetails']->old_pigmiaccno }}/{{ $PigmiLedgerPerData['CustomerDetails']->PigmiAcc_No }}</u>
					</td>
					
					
					<td style="border-top: none;" colspan=2><b>ಹೆಸರು:</b>
						<u>{{ $PigmiLedgerPerData['CustomerDetails']->Kan_FirstName }} . {{ $PigmiLedgerPerData['CustomerDetails']->Kan_MiddleName }} . {{ $PigmiLedgerPerData['CustomerDetails']->Kan_LastName }}</u>
					</td>
				</tr>
				
				<tr>
					<td style="border-top: none;" colspan=3><b>ವಿಳಾಸ:</b>
						<u>{{ $PigmiLedgerPerData['CustomerDetails']->Kan_Address }}&nbsp,
			{{ $PigmiLedgerPerData['CustomerDetails']->Kan_City }}&nbsp,
			{{ $PigmiLedgerPerData['CustomerDetails']->Kan_District }}&nbsp,
			{{ $PigmiLedgerPerData['CustomerDetails']->Kan_State }}&nbsp,
			{{ $PigmiLedgerPerData['CustomerDetails']->Pincode }}&nbsp&nbsp
			
		</u>
				</td>
				
			</tr>
			
			<tr>
				
				
				<td style="border-top: none;"><b>ಖಾತೆ ತೆರೆದ ದಿನಾಂಕ :</b>
					<u><?php $trandate=date("d-m-Y",strtotime($PigmiLedgerPerData['CustomerDetails']->StartDate)); echo $trandate; ?></u>
				</td>
				
				<td style="border-top: none;"><b>ಖಾತೆ ಮುಗಿಯುವ ದಿನಾಂಕ:</b>
					<u><?php $trandate=date("d-m-Y",strtotime($PigmiLedgerPerData['CustomerDetails']->EndDate)); echo $trandate; ?></u>
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
			@foreach($PigmiLedgerPerData['TransactionDetails'] as $SLPD)
			<tr>
				<td class="hidden">{{ $SLPD->PigmiTrans_ID }}</td>
				<td><?php $trandate=date("d-m-Y",strtotime($SLPD->PigReport_TranDate)); echo $trandate; ?></td>
				<td>{{ $SLPD->Particulars }}</td>
				
				@if($SLPD->Transaction_Type=="Credit"||$SLPD->Transaction_Type=="CREDIT"||$SLPD->Transaction_Type=="credit")
				
				<td><p class="text-right"><?php $temp=$SLPD->Amount; echo $temp; ?></p></td> 
				<td><p class="text-center">-</p></td>
				
				@else
				
				<td><p class="text-center">-</p></td>
				<td><p class="text-right"><?php $temp=$SLPD->Amount; echo $temp; ?></p></td> 
				
				@endif
				<td><p class="text-right">{{ $SLPD->Total_Amount }}</p></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	
</div>
<div id='pagei'>
	
	{!! $PigmiLedgerPerData['TransactionDetails']->appends(Input::except('page'))->render() !!}
</div>
<center>
	
	<div class="col-sm-12">
		<input type="button" value="ಮುದ್ರಿಸಿ" class="btn btn-info btn-md Knprint" id="Knprint">
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

<style type="text/css">
	@media Knprint {
	input#Knprint {
	display: none;
	}
	}
</style> 

<script src="js/jQuery.print.js"></script>
<script>
	
	CheckVal="<?php echo $PigmiLedgerPerData['Kannada']; ?>";
	
	$('document').ready(function(){
		
		if(CheckVal==0)
		{
			$('.English').show();
			$('.Kannada').hide();
		}
		
		else
		{
			$('.English').hide();
			$('.Kannada').show();
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
		$(".print").click(function() {
			
			var divContents = $("#toprint").html();
			var printWindow = window.open('', '', 'height=600,width=800');
			printWindow.document.write('<html><head><title>SB LEDGER</title>');
			printWindow.document.write('</head><body>');
			printWindow.document.write(divContents);
			printWindow.document.write('</body></html>');
			printWindow.document.close();
			printWindow.print();
			
			
			
			
			
			
			
			//$.print("#toprint");
		});
		
		$(".Knprint").click(function() {
			
			var divContents = $("#toprint1").html();
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
	
	$("ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc");
		
	});
	$('.loadmc').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.SearchRes').load($(this).attr('href'));
	});
	</script>		