<style>
	tr.spaceUnder > td
	{
	padding-bottom: 1em;
	}
	}
</style>
<div class="English">
	<div  id="toprint">
		<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
		<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
		<!--this css should be inside the toprint div , for printing the table borders-->	
		
		<!--<center>
			<h4>Kumbarara Gudi Kaigarika Sahakari Sangha Niyamita</h4>
			<h7>Number D.R.I 24/58 Chakrasaudha Kulai, Mangaluru D.K. 575019 </h7></br>
			<h3>Savings Bank Account  </h3></br></br>
		</center>-->
		
		
		
		<table class="table bootstrap-datatable responsive" style='font-family:arial;font-size:16;margin-top: 10%;
		margin-left: 25%;'>
			<tr>
				<td style="border-top: none;" >
					
					<b>Name And Address Of The Branch:</b></br>
					{{ $SbprintPerData['CustomerDetails']->BName }} Branch</br>
					{{ $SbprintPerData['CustomerDetails']->BAddress }} ,
					{{ $SbprintPerData['CustomerDetails']->BCity }}</br>
					{{ $SbprintPerData['CustomerDetails']->BState }} ,
					{{ $SbprintPerData['CustomerDetails']->BPincode }}</br>
					{{ $SbprintPerData['CustomerDetails']->BPhoneNo }} , 
					{{ $SbprintPerData['CustomerDetails']->BMobileNo }}</br>
					
				</td>
				
			</table>
			
			<table class="table bootstrap-datatable responsive" style='font-family:arial;font-size:16;margin-top: 25%;
			margin-left: 1%;'>
				<tr>
					<td style="border-top: none;" ><b>Acc No:</b>
						<!--{{ $SbprintPerData['CustomerDetails']->Old_AccNo }}/-->{{ $SbprintPerData['CustomerDetails']->AccNum }}
					</td>
					
				</tr>
				<tr>
					
					</br><td style="border-top: none;"><b>Name:</b>
						{{ $SbprintPerData['CustomerDetails']->FirstName }} . {{ $SbprintPerData['CustomerDetails']->MiddleName }} . {{ $SbprintPerData['CustomerDetails']->LastName }}
					</td>
				</tr>
				
				<tr>
					<td style="border-top: none;" colspan=3><b>Address:</b>
						{{ $SbprintPerData['CustomerDetails']->Address }}&nbsp </br>
						{{ $SbprintPerData['CustomerDetails']->City }}&nbsp,
						{{ $SbprintPerData['CustomerDetails']->District }}&nbsp </br>
						{{ $SbprintPerData['CustomerDetails']->State }}&nbsp,
						{{ $SbprintPerData['CustomerDetails']->Pincode }}&nbsp&nbsp
						
						
					</td>
					
				</tr>
				
				<tr>
					
					
					<td style="border-top: none;"><b>Acc Open Date:</b>
						{{ $SbprintPerData['CustomerDetails']->Created_on }}
					</td>
					
					<td style="border-top: none;"><b>Nominee:</b>
						{{ $SbprintPerData['CustomerDetails']->Nom_FirstName }} . {{ $SbprintPerData['CustomerDetails']->Nom_MiddleName }} . {{ $SbprintPerData['CustomerDetails']->Nom_LastName }}
					</td>
					
					
					
				</tr>
				
				<tr>
					<td>&nbsp </br> &nbsp </br> &nbsp <b>Date  of Issue Of passBook:</b> <?php echo date('d-m-Y') ;?></td>
					
					
					<td>&nbsp </br> &nbsp </br> &nbsp <b>Authorised Signatory:</b> </td>
				</tr>
				
			</table>
			
			
			
		</div>
		
		<center>
			
			<div class="col-sm-12">
				<input type="button" value="PRINT" class="btn btn-info btn-md print" id="print">
			</div>
			
		</center></br></br>	
		
		
	</div>
	
	
	<div class="Kannada">
		<div  id="toprint1">
			<!--<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
			<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">-->
			<!--this css should be inside the toprint div , for printing the table borders-->	
			
			
			@for($i=$SbprintPerData['lineval'];$i>0;$i--)
			
			</br>
			@endfor
			
			<?php $x=0;$v=0;$tata=0;$temp=14;?>
			<table class="table bootstrap-datatable" style='font-size:12;width:100%;'>
				<tbody>
					@foreach($SbprintPerData['TransactionDetails'] as $SLPD)
					
					
					
					
					<?php  $x=$x+1; $b=$x+$SbprintPerData['lineval'] ?>
					@if($b==$temp&&$v==0)
					<?php $v=1;$temp=$temp+14;?>
			<tr>
			<td></br></br></br></br>
			</td>
			
			</tr>
				@endif
					
					<tr>
					
						<td  width="5%"><?php   $tata=$tata+1; echo $tata; ?></td>
						
						<td  width="10%"><?php $trandate=date("d-m-Y",strtotime($SLPD->SBReport_TranDate));  echo $trandate; ?></td>
						<td  width="40%"><?php  echo $s=$SLPD->particulars; $f=strlen($s);if($f>=43){$d=($f/43);$b=$b+intval($d);}?></td>
						<td width="10%">1234</td>
						@if($SLPD->TransactionType=="Credit"||$SLPD->TransactionType=="CREDIT"||$SLPD->TransactionType=="credit")
						
						<td  width="10%"><p class="text"><?php $temp=$SLPD->Amount; echo $temp; ?></p></td> 
						<td  width="10%"><p class="text">-</p></td>
						
						@else
						
						<td  width="10%"><p class="text">-</p></td>
						<td  width="10%"><p class="text"><?php $temp=$SLPD->Amount; echo $temp; ?></p></td> 
						
						@endif
						<td width="10%"><p class="text">{{ $SLPD->Total_Bal }}</p></td>
						<td width="10%"></td>
					</tr>
					
					@endforeach
				</tbody>
			</table>
		</div>
		<div id='pagei'>
			
			{!! $SbprintPerData['TransactionDetails']->appends(Input::except('page'))->render() !!}
		</div>
		<center>
			
			<div class="col-sm-12">
				<input type="button" value="print" class="btn btn-info btn-md Knprint" id="Knprint">
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
		
		CheckVal="<?php echo $SbprintPerData['Kannada']; ?>";
		
		$('document').ready(function(){
			
			if(CheckVal==0)
			{
				$('.English').hide();
				$('.Kannada').show();
			}
			
			else
			{
				$('.English').show();
				$('.Kannada').hide();
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