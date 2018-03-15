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
				@foreach ($psreceipt['purshare'] as $purchaseshare)
					
					
					<center>
					<h4>Kumbarara Gudi Kaigarika Sahakara Sangha, Niyamita, Chakrasowdha, Kulai</h4>
					<h7>Number D.R.I 24/58</h7></br>
					<h7>Vidyanagara, Village and Post: Kulai-575019 Mangalore D.K</h7></br></br>
					<h5><b>SHARE RECEIPT</b></h5></br></br>
					</center>
					<div class="receipt_number"></div>
					</br>
					Certificate No:{{ $purchaseshare->PURSH_Certfid }}
					
					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					
					Total Shares:{{ $purchaseshare-> PURSH_Noofshares}}
					
					
					</br></br>
					
					Member name: Mr/Mrs &nbsp {{ $purchaseshare->FirstName}} &nbsp {{ $purchaseshare->MiddleName }} &nbsp {{ $purchaseshare->LastName }} </br>
					Father/Husband name:  &nbsp {{ $purchaseshare->FatherName }}</br>
					Share I.D: &nbsp {{ $purchaseshare->PURSH_Memshareid }}</br>
					Share Class: &nbsp {{ $purchaseshare->PURSH_Shrclass }}</br>
					Share Amount: &nbsp  {{ $purchaseshare->PURSH_Shareamt }}</br>
					Total Amount: &nbsp {{ $purchaseshare->PURSH_Totalamt }}</br>
					<!--Member Fee: &nbsp {{ $purchaseshare->Member_Fee }}</br>-->
					<div class="mem_fee"></div>
					
					Amount Payable: &nbsp <span class="receipt_amt"></span></br>
					Purchase Date: &nbsp<?php $purdate=date("d-m-Y",strtotime($purchaseshare->PURSH_Date)); echo $purdate;?> </br>
					PLACE: {{ $purchaseshare->BName }}
					
				
					
				
					
					
					
					
					
					
					
	
						
						
						
						
						
			 
						@endforeach
						
					
					
					</div>
					
						<center>
							
							<div class="col-sm-12">
							<input type="button" value="PRINT" class="btn btn-info btn-sm print" id="print">
							</div>
							
							</center>		
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
	$('.mem_fee').html('Member Fee:'+memfee);
	
}
else
{
	
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
$('.receipt_amt').html(receiptamt);
$('.receipt_number').html('Receipt No:'+receiptnum);



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
            var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title>SHARE CERTIFICATE</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
			
			
			maxrid="<?php echo $psreceipt['maxReceiptId'];?>";
			purchaid={{ $purchaseshare->PURSH_Pid }};
			
			rectnum=(parseInt(maxrid)+parseInt(1));
			
			//alert(maxrid);
			//alert(purchaid);
			//alert(rectnum);
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