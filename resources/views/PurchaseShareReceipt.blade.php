<div id="content" class="col-lg-12 col-sm-12">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
				<h2><i class="glyphicon glyphicon-user"></i> Purchase Share Receipt</h2>
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
					<h5><b>SHARE RECEIPT</b></h5></br></br>
					</center>
					
					<span style="font-weight:bold;">Receipt No:</span> <span class="receipt_number" style="font-weight:bold;color:red;font-size:18px"></span>
					
					<table class="table table-striped bootstrap-datatable datatable responsive">
					
					
							@foreach ($psreceipt['purshare'] as $purchaseshare)
							
					
					
							<tr>
								<th>Certificate No:</th>
								<td>{{ $purchaseshare->PURSH_Certfid }}</td>
							</tr>
					
							<tr>
								<th>Member name: Mr/Mrs</th>
								<td>
								{{ $purchaseshare->FirstName}} &nbsp {{ $purchaseshare->MiddleName }} &nbsp {{ $purchaseshare->LastName }}
								</td>
							</tr>
							
							<tr>
								<th>Father/Spouse name:</th>
								<td>{{ $purchaseshare->FatherName }}</td>
							</tr>
							
							<tr>
								<th>Purchase Date:</th>
								<td>
							<?php $purdate=date("d-m-Y",strtotime($purchaseshare->PURSH_Date)); echo $purdate;?>
								</td>
							</tr>
							
							<tr>
								<th>Place:</th>
								<td>{{ $purchaseshare->BName }}</td>
							</tr>
							
							<tr>
								<th>Share Class:</th>
								<td>{{ $purchaseshare->PURSH_Shrclass }}</td>
							</tr>
							
							<tr>
								<th>Total Shares:</th>
								<td>{{ $purchaseshare-> PURSH_Noofshares}}</td>
							</tr>
							
							<tr>
								<th>Share I.D:</th>
								<td>{{ $purchaseshare->PURSH_Memshareid }}</td>
							</tr>
							
							 
							<tr>
								<th>Share Amount:</th>
								<td>{{ $purchaseshare->PURSH_Shareamt }}</td>
							</tr>
							
							<tr>
								<th>Total Amount:</th>
								<td>{{ $purchaseshare->PURSH_Totalamt }}</td>
							</tr>
							
							
							<tr class="mem_fee_body">
								<th><div class="mem_fee_head"></div></th>
								<td><div class="mem_fee"></div></td>
							</tr>
							
							
							<tr>
								<th>Amount Payable:</th>
								<td><span class="receipt_amt" style="font-weight:bold;font-size:18px"></span></td>
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

memfee={{ $purchaseshare->Member_Fee }};
purtotamt={{ $purchaseshare->PURSH_Totalamt }};
purid={{ $purchaseshare->PURSH_Pid }};

minpurid="<?php echo $psreceipt['minPid'];?>";
maxreceid="<?php echo $psreceipt['maxReceiptId'];?>";


if(purid==minpurid)
{
	receiptamt=memfee+purtotamt;
	$('.mem_fee_head').html('Member Fee:');
	//$('.mem_fee').html('Member Fee:'+memfee);
	$('.mem_fee').html(memfee);
	
}
else
{
	$('.mem_fee_body').hide();
	receiptamt=purtotamt;
	
}

dbreceid={{ $purchaseshare->PURSH_ReceiptNo }};
//alert(dbreceid);
if(dbreceid=='0')
{
	receiptnum=(parseInt(maxreceid)+parseInt(1));
}
else
{
	receiptnum="Duplicate_"+dbreceid;
	
}




</script>


<script>
$('.receipt_amt').html('Rs. '+receiptamt);
//$('.receipt_number').html('Receipt No:'+receiptnum);
$('.receipt_number').html(receiptnum);



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
		//alert('test');
		//$("#toprint").print();
		
		//alert($receiptamt);
		//$cert={{ $purchaseshare->PURSH_Certfid }};
		var divContents = $("#toprint").html();
            var printWindow = window.open('', '', 'height=600,width=800');
            printWindow.document.write('<html><head><title>SHARE RECEIPT</title>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
			
			
			maxrid="<?php echo $psreceipt['maxReceiptId'];?>";
			purchaid={{ $purchaseshare->PURSH_Pid }};
			rectnum=(parseInt(maxrid)+parseInt(1));
			dbreceid={{ $purchaseshare->PURSH_ReceiptNo }};
//alert(dbreceid);
			if(dbreceid=='0')
			{
				//receiptnum=(parseInt(maxreceid)+parseInt(1));
				rectnum=(parseInt(maxrid)+parseInt(1));
				$.ajax({
							url: 'UpdateReceiptNo',
							type: 'post',
							data: '&recenum='+rectnum+'&purchid='+purchaid,
							success: function(data) {
								//alert($receiptnum);
							  
							}
					});
			}

			
		
		
	//$.print("#toprint");
	});
});


</script>