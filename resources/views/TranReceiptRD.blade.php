<div class="box-content">
	<div  id="toprint">
		<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
		<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
		<!--this css should be inside the toprint div , for printing the table borders-->	
		@foreach ($ReceiptData as $FdRec)
		<center>
			<h4>Kumbarara Gudi Kaigarika Sahakara Sangha, Niyamita, Chakrasowdha, Kulai</h4>
			<h7>Number D.R.I 24/58</h7></br>
			<h7>Vidyanagara, Village and Post: Kulai-575019 Mangalore D.K</h7></br></br>
			
			<h6><b>BRANCH: &nbsp {{ $FdRec->BName }} </b></h6>
			<h5><b>RD RECEIPT</b></h5></br></br>
		</center>
		
		<span style="font-weight:bold;">Receipt No:</span> <span class="receipt_number" style="font-weight:bold;color:red;font-size:18px">{{ $FdRec->RD_resp_No }}</span>
		<span style="font-weight:bold;float:right;" class="receipt_date">Transaction Date:
			<?php $strdate=date("d-m-Y",strtotime($FdRec->RDReport_TranDate)); echo $strdate;?>
			</span>
		<table class="table table-striped bootstrap-datatable datatable responsive">
			
			
			
			
			
			
			
			
			<tr>
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
			</tr>
			
						
			
			
			<tr>
					<th>Particulars:</th>
					<td><span class="receipt_amt" style="font-weight:bold;font-size:18px"> {{ $FdRec->particulars }}</span></td>
			</tr>
			
			
			
			<hr>
			
			
			<tr>
				<th>Amount Paid:</th>
				<td><span class="receipt_amt" style="font-weight:bold;font-size:18px">Rs. {{ $FdRec->RD_Amount }}&nbsp/-</span></td>
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
            printWindow.document.write('<html><head><title>SB RECEIPT</title>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
		});
	});
	
	
</script>