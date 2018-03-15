<div id="content" class="col-lg-12 col-sm-12">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> FD Pay Receipt</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					<div  id="toprint">
						<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
						<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
						<!--this css should be inside the toprint div , for printing the table borders-->	
						
						<center>
							<h4>Kumbarara Gudi Kaigarika Sahakara Sangha, Niyamita, Chakrasowdha, Kulai</h4>
							<h7>Number D.R.I 24/58</h7></br>
							<h7>Vidyanagara, Village and Post: Kulai-575019 Mangalore D.K</h7></br></br>
							<h5><b>FD PAY RECEIPT</b></h5></br></br>
						</center>
						
						<span style="font-weight:bold;">Receipt No:</span> <span class="receipt_number" style="font-weight:bold;color:red;font-size:18px"></span>
						
						<span style="font-weight:bold;float:right;" class="receipt_date"></span>
						
						<table class="table table-striped bootstrap-datatable datatable responsive">
							
							
							@foreach ($FdPayRece['FdPayAmt'] as $FPR)
							
							
							<tr>
								<th>Account No:</th>
								<td>{{ $FPR->FDPayAmt_AccNum }}</td>
							</tr>
							
							<tr>
								<th>FD Type:</th>
								<td>{{ $FPR->FdType }}</td>
							</tr>
							
							
							
							<tr>
								<th>Customer Name: Mr/Mrs</th>
								<td>
									{{ $FPR->FirstName}} &nbsp {{ $FPR->MiddleName }} &nbsp {{ $FPR->LastName }}
								</td>
							</tr>
							
							
							<tr>
								<th>Payment Date:</th>
								<td>
									<?php $paydate=date("d-m-Y",strtotime($FPR->FDPayAmtReport_PayDate)); echo $paydate;?>
								</td>
							</tr>
							
							<tr>
								<th>Place:</th>
								<td>{{ $FPR->BName }}</td>
							</tr>
							
							<tr>
								<th>Deposite Amount:</th>
								<td>{{ $FPR->FdTotal_Amt }}</td>
							</tr>
							
							<tr>
								<th>Interest Amount:</th>
								<td>{{ $FPR->Interest_Amount }}</td>
							</tr>
							
							
							<tr>
								<th>Paid Amount:</th>
								<td>{{ $FPR->FDPayAmt_PayableAmount }}</td>
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
				
				
			</div>
			
		</div>
	</div>
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
	ReceiptNumber="<?php echo $FPR->FD_PayAmount_ReceiptNum; ?>";
	ReceiptDate="<?php $recdate=date('d-m-Y'); echo "Receipt Date:  ".$recdate; ?>";
	
	$('.receipt_number').html(ReceiptNumber);
	$('.receipt_date').html(ReceiptDate);
	
	
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
            printWindow.document.write('<html><head><title>FD PAY RECEIPT</title>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
			//$.print("#toprint");
		});
	});
	
	
</script>