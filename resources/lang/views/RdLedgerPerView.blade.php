<div class="English">
	<div  id="toprint">
		<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
		<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
		<!--this css should be inside the toprint div , for printing the table borders-->	
		
		<center>
			<h4>Kumbarara Gudi Kaigarika Sahakari Sangha Niyamita</h4>
			<h7>Number D.R.I 24/58 Chakrasaudha Kulai, Mangaluru D.K. 575019 </h7></br>
			<h3>Recurring Deposite Account Ledger </h3></br></br>
		</center>
		
		
		<center>
			<table class="table bootstrap-datatable responsive">
				
				<tr >
					<td style="border-top: none;" ><b>Acc No:</b>
						<u>{{ $RdLedgerPerData['CustomerDetails']->Old_AccNo }}/{{ $RdLedgerPerData['CustomerDetails']->AccNum }}</u>
					&nbsp<b>Name:</b>
					<u>{{ $RdLedgerPerData['CustomerDetails']->FirstName }} . {{ $RdLedgerPerData['CustomerDetails']->MiddleName }} . {{ $RdLedgerPerData['CustomerDetails']->LastName }}</u>
				</td>
			</tr>
			
			<tr>
				<td style="border-top: none;"><b>Address:</b>
					<u>{{ $RdLedgerPerData['CustomerDetails']->Address }}&nbsp,
						{{ $RdLedgerPerData['CustomerDetails']->City }}&nbsp,
						{{ $RdLedgerPerData['CustomerDetails']->District }}&nbsp,
						{{ $RdLedgerPerData['CustomerDetails']->State }}&nbsp,
						{{ $RdLedgerPerData['CustomerDetails']->Pincode }}&nbsp&nbsp
						
					</u>
				</td>
				
			</tr>
			
			<tr>
				
				
				<td style="border-top: none;"><b>Acc Open Date:</b>
					<u>{{ $RdLedgerPerData['CustomerDetails']->Created_on }}</u>
					&nbsp
					<b>Maturity Date:</b>
					<u><?php $trandate=date("d-m-Y",strtotime($RdLedgerPerData['CustomerDetails']->Maturity_Date)); echo $trandate; ?></u>
				</td>
			</tr>
			<tr>
				
				<td style="border-top: none;"><b>Nominee:</b>
					<u>{{ $RdLedgerPerData['CustomerDetails']->Nom_FirstName }} . {{ $RdLedgerPerData['CustomerDetails']->Nom_MiddleName }} . {{ $RdLedgerPerData['CustomerDetails']->Nom_LastName }}</u>
				&nbsp<b>Relation:</b>
				<u>{{ $RdLedgerPerData['CustomerDetails']->Relationship }}</u>
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
		@foreach($RdLedgerPerData['TransactionDetails'] as $RLPD)
		<div class="hidden">{{ $RLPD->Accid }}</div>
		<tr>
			<td class="hidden">{{ $RLPD->RD_TransID }}</td>
			<td><?php $trandate=date("d-m-Y",strtotime($RLPD->RDReport_TranDate)); echo $trandate; ?></td>
			<td>{{ $RLPD->RD_Particulars }}</td>
			
			@if($RLPD->RD_Trans_Type=="Credit"||$RLPD->RD_Trans_Type=="CREDIT"||$RLPD->RD_Trans_Type=="credit")
			
			<td><p class="text-right"><?php $temp=$RLPD->RD_Amount; echo $temp; ?></p></td> 
			<td><p class="text-center">-</p></td>
			
			@else
			
			<td><p class="text-center">-</p></td>
			<td><p class="text-right"><?php $temp=$RLPD->RD_Amount; echo $temp; ?></p></td> 
			
			@endif
			<td><p class="text-right">{{ $RLPD->RD_Total_Bal }}</p></td>
		</tr>
		@endforeach
	</tbody>
</table>

</div>
<div id='pagei'>
	
	{!! $RdLedgerPerData['TransactionDetails']->appends(Input::except('page'))->render() !!}
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
			<h3>ಆರ್.ಡಿ ಖಾತೆ ಲೆಡ್ಜರ್ </h3></br></br>
		</center>
		
		
		<center>
			<table class="table bootstrap-datatable responsive">
				
				<tr >
					<td style="border-top: none;" ><b>ಖಾತೆ ಸಂಖ್ಯೆ:</b>
						<u>{{ $RdLedgerPerData['CustomerDetails']->Old_AccNo }}/{{ $RdLedgerPerData['CustomerDetails']->AccNum }}</u>
						&nbsp <b>ಹೆಸರು:</b>
						<u>{{ $RdLedgerPerData['CustomerDetails']->Kan_FirstName }} . {{ $RdLedgerPerData['CustomerDetails']->Kan_MiddleName }} . {{ $RdLedgerPerData['CustomerDetails']->Kan_LastName }}</u>
					</td>
				</tr>
				
				<tr>
					<td style="border-top: none;"><b>ವಿಳಾಸ:</b>
						<u>{{ $RdLedgerPerData['CustomerDetails']->Kan_Address }}&nbsp,
							{{ $RdLedgerPerData['CustomerDetails']->Kan_City }}&nbsp,
							{{ $RdLedgerPerData['CustomerDetails']->Kan_District }}&nbsp,
							{{ $RdLedgerPerData['CustomerDetails']->Kan_State }}&nbsp,
							{{ $RdLedgerPerData['CustomerDetails']->Pincode }}&nbsp&nbsp
							
						</u>
					</td>
					
				</tr>
				
				<tr>
					
					
					<td style="border-top: none;"><b>ಖಾತೆ ತೆರೆದ ದಿನಾಂಕ :</b>
						<u>{{ $RdLedgerPerData['CustomerDetails']->Created_on }}</u>&nbsp
						<b>ಮುಗಿಯುವ ದಿನಾಂಕ :</b>
						<u><?php $trandate=date("d-m-Y",strtotime($RdLedgerPerData['CustomerDetails']->Maturity_Date)); echo $trandate; ?></u>
					</td>
				</tr>
				<tr>
					
					<td style="border-top: none;"><b>ನಾಮಿನಿ::</b>
						<u>{{ $RdLedgerPerData['CustomerDetails']->Kan_Nom_FirstName }} . {{ $RdLedgerPerData['CustomerDetails']->Kan_Nom_MiddleName }} . {{ $RdLedgerPerData['CustomerDetails']->Kan_Nom_LastName }}</u>
						&nbsp
						<b>ಸಂಬಂಧ:</b>
						<u>{{ $RdLedgerPerData['CustomerDetails']->Kan_Relationship }}</u>
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
				@foreach($RdLedgerPerData['TransactionDetails'] as $RLPD)
				<tr>
					<td class="hidden">{{ $RLPD->RD_TransID }}</td>
					<td><?php $trandate=date("d-m-Y",strtotime($RLPD->RDReport_TranDate)); echo $trandate; ?></td>
					<td>{{ $RLPD->RD_Particulars }}</td>
					
					@if($RLPD->RD_Trans_Type=="Credit"||$RLPD->RD_Trans_Type=="CREDIT"||$RLPD->RD_Trans_Type=="credit")
					
					<td><p class="text-right"><?php $temp=$RLPD->RD_Amount; echo $temp; ?></p></td> 
					<td><p class="text-center">-</p></td>
					
					@else
					
					<td><p class="text-center">-</p></td>
					<td><p class="text-right"><?php $temp=$RLPD->RD_Amount; echo $temp; ?></p></td> 
					
					@endif
					<td><p class="text-right">{{ $RLPD->RD_Total_Bal }}</p></td>
				</tr>
				@endforeach
			</tbody>
		</table>
		
	</div>
	<div id='pagei'>
		
		{!! $RdLedgerPerData['TransactionDetails']->appends(Input::except('page'))->render() !!}
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
	
	CheckVal="<?php echo $RdLedgerPerData['Kannada']; ?>";
	
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
			printWindow.document.write('<html><head><title>RD LEDGER</title>');
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
			printWindow.document.write('<html><head><title>ಆರ್.ಡಿ ಲೆಡ್ಜರ್</title>');
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