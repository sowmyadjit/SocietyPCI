<div class="box-content">
	<div  id="toprint">
		<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
		<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
		<!--this css should be inside the toprint div , for printing the table borders-->	
		@foreach ($ReceiptData as $FdRec)
		&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp
						Kumbarara Gudi Kaigarika Sahakara Sangha
						&nbsp &nbsp &nbsp &nbsp &nbsp 
						Kumbarara Gudi Kaigarika Sahakara Sangha</br>
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
						&nbsp &nbsp &nbsp &nbsp  
						Niyamita, Chakrasowdha, Kulai
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
						Niyamita, Chakrasowdha, Kulai</br>
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  
						<b>RD RECEIPT - (office copy)<b>
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
						<b>RD RECEIPT - (customer copy)<b>
		
		<table class="table table-striped bootstrap-datatable datatable responsive">
			
			
			
			
			
			
			
			<tr>
				<th>Receipt No:</th>
				<td>
				{{ $FdRec->RD_resp_No }}
				</td>
				<th>Receipt No:</th>
				<td>
				{{ $FdRec->RD_resp_No }}
				</td>
			</tr><tr>
				<th>Transaction Date:</th>
				<td>
				<?php $strdate=date("d-m-Y",strtotime($FdRec->RDReport_TranDate)); echo $strdate;?>
				</td>
				<th>Transaction Date:</th>
				<td>
				<?php $strdate=date("d-m-Y",strtotime($FdRec->RDReport_TranDate)); echo $strdate;?>
				</td>
			</tr>
			<tr>
				<th>RD Account Number:</th>
				<td>
					{{ $FdRec->AccNum}}  /  {{ $FdRec->Old_AccNo}}
				</td>
				<th>RD Account Number:</th>
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
			
						
			
			
			<tr>
					<th>Particulars:</th>
					<td><span class="receipt_amt" style="font-weight:bold;font-size:18px"> {{ $FdRec->RD_Particulars }}</span></td>
					<th>Particulars:</th>
					<td><span class="receipt_amt" style="font-weight:bold;font-size:18px"> {{ $FdRec->RD_Particulars }}</span></td>
			</tr>
			
			
			
			<hr>
			
			
			<tr>
				<th>Amount Paid:</th>
				<td><span class="receipt_amt" style="font-weight:bold;font-size:18px">Rs. {{ $FdRec->RD_Amount }}&nbsp/-</span></td>
				<th>Amount Paid:</th>
				<td><span class="receipt_amt" style="font-weight:bold;font-size:18px">Rs. {{ $FdRec->RD_Amount }}&nbsp/-</span></td>
			</tr>

			<tr>
				<th>Amount in words:</th>
				<input type="hidden" name="rupees" value="{{$FdRec->RD_Amount}}" id="rupees" />
				<td><span class="receipt_amt" style="font-weight:bold;font-size:18px"> <span id="container"> </span></span></td>
				<th>Amount in words:</th>
				<td><span class="receipt_amt" style="font-weight:bold;font-size:18px"> <span id="container2"> </span></span></td>
			</tr>

			<tr>
			<th>
			<br>
			Customer
			</th>
			<th>
			<br>
			Clerk-Manager-Secretary
			</th>
			<th>
			<br>
			Customer
			</th>
			<th>
			<br>
			Clerk-Manager-Secretary
			</th>
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
            printWindow.document.write('<html><head><title>RD RECEIPT</title>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
		});
	});
	
	
</script>
<script type="text/javascript">
function test_value(){
			var junkVal=document.getElementById('rupees').value;
			junkVal = Math.floor(junkVal);
			var obStr = new String(junkVal);
			numReversed= obStr.split("");
			actnumber=numReversed.reverse();
			if(Number(junkVal) >=0){
			//do nothing
			}
			else{
				alert('wrong Number cannot be converted');
				return false;
			}
			if(Number(junkVal)==0){
				document.getElementById('container').innerHTML=obStr+''+'Rupees Zero Only';
				return false;
			}
			if(actnumber.length>9){
				alert('Oops!!!! the Number is too big to covertes');
				return false;
			}
			var iWords=["Zero", " One", " Two", " Three", " Four", " Five", " Six", " Seven", " Eight", " Nine"];
			var ePlace=['Ten', ' Eleven', ' Twelve', ' Thirteen', ' Fourteen', ' Fifteen', ' Sixteen', ' Seventeen', ' Eighteen', 'Nineteen'];
			var tensPlace=['dummy',' Ten',' Twenty',' Thirty', ' Forty', ' Fifty', ' Sixty', ' Seventy', ' Eighty', ' Ninety' ];
			var iWordsLength=numReversed.length;
			var totalWords="";
			var inWords=new Array();
			var finalWord="";
			j=0;
			
			for(i=0; i<iWordsLength; i++) {
				switch(i) {
					case 0:
							if(actnumber[i]==0 || actnumber[i+1]==1 ) {
							inWords[j]='';
							} else {
							inWords[j]=iWords[actnumber[i]];
							}
							inWords[j]=inWords[j];
							break;
					case 1:
							tens_complication();
							break;
							case 2:
							if(actnumber[i]==0) {
							inWords[j]='';
							}
							else if(actnumber[i-1]!=0 && actnumber[i-2]!=0) {
							inWords[j]=iWords[actnumber[i]]+' Hundred and';
							}
							else {
							inWords[j]=iWords[actnumber[i]]+' Hundred';
							}
							break;
					case 3:
							if(actnumber[i]==0 || actnumber[i+1]==1) {
							inWords[j]='';
							}
							else {
							inWords[j]=iWords[actnumber[i]];
							}
							if(actnumber[i+1] != 0 || actnumber[i] > 0){ //here
							inWords[j]=inWords[j]+" Thousand";
							}
							break;
					case 4:
							tens_complication();
							break;
					case 5:
							if(actnumber[i]=="0" || actnumber[i+1]==1 ) {
							inWords[j]='';
							}
							else {
							inWords[j]=iWords[actnumber[i]];
							}
							if(actnumber[i+1] != 0 || actnumber[i] > 0){ //here
							inWords[j]=inWords[j]+" Lakh";
							}
							break;
					case 6:
							tens_complication();
							break;
					case 7:
							if(actnumber[i]=="0" || actnumber[i+1]==1 ){
							inWords[j]='';
							}
							else {
							inWords[j]=iWords[actnumber[i]];
							}
							if(actnumber[i+1] != 0 || actnumber[i] > 0){ // changed here
							inWords[j]=inWords[j]+" Crore";
							}
							break;
					case 8:
							tens_complication();
							break;
					default:
							break;
				}
				j++;
			}
			function tens_complication() {
				if(actnumber[i]==0) {
					inWords[j]='';
				} else if(actnumber[i]==1) {
					inWords[j]=ePlace[actnumber[i-1]];
				} else {
					inWords[j]=tensPlace[actnumber[i]];
				}
			}
			inWords.reverse();
			for(i=0; i<inWords.length; i++) {
			finalWord+=inWords[i];
			}
			return finalWord;
		}

		function convert_amount_into_rupees_paisa(){
			var val = document.getElementById('rupees').value;
			if(val.length==0 || val=='00'|| val=='0'|| val=='0.00'|| val=='0.0'|| val=='00.00'|| val=='00.0') {
				document.getElementById('container').innerHTML="Zero Rupees Only";
				return false;
			}
			var finalWord1 = test_value();
			var finalWord2 = "";
			var val = document.getElementById('rupees').value;
			var actual_val = document.getElementById('rupees').value;
			document.getElementById('rupees').value = val;
			if(val.indexOf('.')!=-1) {
				val = val.substring(val.indexOf('.')+1,val.length);
				if(val.length==0 || val=='00'|| val=='0') {
					finalWord2 = "zero paisa only";
				} else {
					document.getElementById('rupees').value = val;
					finalWord2 = test_value() + " paisa only";
				}
				var n=finalWord1.match(false);
				if(n=='false')
					document.getElementById('container').innerHTML=finalWord2+ " paisa only";
				else
					document.getElementById('container').innerHTML=finalWord1 +" Rupees and "+finalWord2;
			} else{
				//finalWord2 = " Zero paisa only";
				document.getElementById('container').innerHTML=finalWord1 +" Rupees Only";
			}
			document.getElementById('rupees').value = actual_val;
		}
</script>
	<script>
		$("document").ready(function() {
			var rupees_w_paisa = parseFloat($("#rupees").val());
			var rupees_wo_paisa = parseInt($("#rupees").val());
			console.log(rupees_w_paisa-rupees_wo_paisa != 0);
			if(rupees_w_paisa-rupees_wo_paisa != 0) {
				$("#rupees").val(rupees_w_paisa.toFixed(2));
			} else {
				$("#rupees").val(rupees_w_paisa.toFixed(0));
			}
			convert_amount_into_rupees_paisa();
			var container = $("#container").html();
			$("#container2").html(container);
		});
	</script>