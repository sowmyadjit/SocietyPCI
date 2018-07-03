<style>
table th {
    font-weight: normal !important;
	padding: 5px !important;
}
table td {
    font-weight: normal !important;
	padding: 5px !important;
	/* max-width:300px !important; */
}

.table {
	/* margin-left: 50px; */
}

#toprint {
	/* margin-left: 60px; */
}

</style>
<div class="box-content">
	<div  id="toprint">
		<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
		<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
		<!--this css should be inside the toprint div , for printing the table borders-->	
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
						<b> <?php /*{{$data->tran_category_name}} */?>
						@if(strcasecmp($data->transaction_type,"CREDIT") == 0)
							RECEIPT
						@elseif(strcasecmp($data->transaction_type,"DEBIT") == 0)
							VOUCHER
						@endif
						 - (office copy)<b>
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp 
			      		<b> <?php /*{{$data->tran_category_name}} */?>
						@if(strcasecmp($data->transaction_type,"CREDIT") == 0)
							RECEIPT
						@elseif(strcasecmp($data->transaction_type,"DEBIT") == 0)
							VOUCHER
						@endif
						 - (customer copy)<b>
		
		<div>
		<span style="font-weight:bold;float:right;" class="receipt_date">
		<?php $strdate=date("d-m-Y",strtotime($data->date)); 
		// echo $strdate;
		?></span>
		<span style="font-weight:bold;float:left;" class="receipt_date">
		<?php $strdate=date("d-m-Y",strtotime($data->date)); 
		//echo $strdate;
		?></span>
		<table class="table table-striped bootstrap-datatable datatable responsive"></div>
			
			
			
			
			
			<tr>
				<th>Date:
				{{$strdate}}
				</th>

				<th>
				@if($data->transaction_type=="CREDIT")
					
				Receipt No:	{{ $data->receipt_voucher_no}}
					
				@elseif($data->transaction_type=="DEBIT")
					
				Voucher No:	{{ $data->receipt_voucher_no}}
					
				@endif
				</th>

				<th>Date:
				{{$strdate}}
				</th>

				<th>
				@if($data->transaction_type=="CREDIT")
					
				Receipt No:	{{ $data->receipt_voucher_no}}
					
				@elseif($data->transaction_type=="DEBIT")
					
				Voucher No:	{{ $data->receipt_voucher_no}}
					
				@endif
				</th>

			</tr>
			

			<tr>
				<th>Cus Name:</th>
				<td>
				Mr/Mrs. {{ $data->name }}({{$data->uid}})
				</td>
				<th>Cus Name:</th>
				<td>
				Mr/Mrs. {{ $data->name }}({{$data->uid}})
				</td>
			</tr>

			@if(strcasecmp($data->transaction_type, "DEBIT") == 0)
				<tr>
					<th>Account Head:</th>
					<td>
						{{$data->account_head}}
					</td>
					<th>Account Head:</th>
					<td>
						{{$data->account_head}}
					</td>
				</tr>
			@endif

			@if($data->tran_category == "PG_PEND")
			@else
				<tr>
					<th>A/C No.:</th>
					<td>
						{{$data->acc_no}}  /  {{$data->old_acc_no}}
					</td>
					<th>A/C No.:</th>
					<td>
						{{$data->acc_no}}  /  {{$data->old_acc_no}}
					</td>
				</tr>
			@endif
			
			<hr>

			@if(strcasecmp($data->transaction_type, "CREDIT") == 0)
				@if($data->tran_category_name != "RD")
					<tr>
						<th>Particulars:</th>
						<td><span class="receipt_amt" style="white-space:pre" <?php /*style="font-weight:bold;font-size:18px" */?> >{{ $data->particulars }}</span></td>
						<th>Particulars:</th>
						<td><span class="receipt_amt" style="white-space:pre" <?php /*style="font-weight:bold;font-size:18px" */?> >{{ $data->particulars }}</span></td>
					</tr>
				@endif
			@else
				@if($data->tran_category_name != "RD" && $data->tran_category != "JL" && $data->tran_category != "DL" && $data->tran_category != "SL" && $data->tran_category != "PL" && $data->tran_category != "RD_PAY_AMT" && $data->tran_category != "PG_PAY_AMT")
					<tr>
						<th>Remarks:</th>
						<td><span class="receipt_amt" style="white-space:pre" <?php /*style="font-weight:bold;font-size:18px" */?> >{{ $data->particulars }}</span></td>
						<th>Remarks:</th>
						<td><span class="receipt_amt" style="white-space:pre" <?php /*style="font-weight:bold;font-size:18px" */?> >{{ $data->particulars }}</span></td>
					</tr>
				@endif
			@endif

		<?php
			if(isset($data->sub_amt)) {
				foreach($data->sub_amt as $key=>$value) {
		?>
					<tr>
						<th>{{$key}}:</th>
						<td><span class="receipt_amt" style="white-space:pre" <?php /*style="font-weight:bold;font-size:18px" */?> >{{$value}}</span></td>
						<th>{{$key}}:</th>
						<td><span class="receipt_amt" style="white-space:pre" <?php /*style="font-weight:bold;font-size:18px" */?> >{{$value}}</span></td>
					</tr>
		<?php
				}
			}
		?>

			
			<tr>
				<th>Total:</th>
				<td><span class="receipt_amt" <?php /*style="font-weight:bold;font-size:18px" */?> >Rs. {{ $data->amount }}&nbsp/-</span></td>
				<th>Total:</th>
				<td><span class="receipt_amt" <?php /*style="font-weight:bold;font-size:18px" */?> >Rs. {{ $data->amount }}&nbsp/-</span></td>
			</tr>
			<tr>
				<th>In words:</th>
				<input type="hidden" name="rupees" value="{{$data->amount}}" id="rupees" />
				<td><span class="receipt_amt" <?php /*style="font-weight:bold;font-size:18px" */?> > <span id="container"> </span></span></td>
				<th>In words:</th>
				<td><span class="receipt_amt" <?php /*style="font-weight:bold;font-size:18px" */?> > <span id="container2"> </span></span></td>
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
            printWindow.document.write('<html><head><title>SB RECEIPT</title>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
			setTimeout(function () {
        		printWindow.print();
    		}, 500);
        	//printWindow.print();
        	

		});
	});
	
</script>


<script>
		$("#save_denominations").click(function(e) {
			e.preventDefault();
			var form_data = $("#form_denominations").serialize();
			console.log("form_data: "+form_data);
			$.ajax({
				url : "save_denominations",
				type : "post",
				data : form_data,
				success : function(data) {
					console.log(data);
				}
			});
		});
	</script>
	

	<script type="text/javascript">
		$("#aa").click(function()
		{
			console.log("sdfsdlfhd");
			convert_amount_into_rupees_paisa() ;
		});

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
		<?php	/*				<!-- <input type="" name="rupees" value="{{$data->Amount}}" id="rupees" /> --> 
							<input type="" name="rupees" value="100.01" id="rupees" />  */ ?>

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