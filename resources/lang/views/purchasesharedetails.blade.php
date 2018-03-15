<div id="content" class="col-lg-12 col-sm-12">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
				<h2><i class="glyphicon glyphicon-user"></i> Purchase Share Detail</h2>
				<div class="box-icon">
					<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
					<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
				</div>
				</div>
				
				<div class="box-content">
				<div  id="toprint">
				<style type="text/css" media="all">
							.lettersize {
							font-size:15px;
							font-style:italic;
							line-height: 150%;
							
							}
							
						</style>
				<center>
				SHARE CERTIFICATE</center></br>
				@foreach ($psd['purshare'] as $purchaseshare)
				
					Certificate No:{{ $purchaseshare->PURSH_Certfid }}
					&nbsp &nbsp &nbsp
					
					&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
					&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
					&nbsp &nbsp &nbsp
					
				CLASS:{{ $purchaseshare->PURSH_Shrclass }}
						&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
					M.NO:{{ $purchaseshare->Memid }}
					
					
					
					</br>
					</br>
					<div class="lettersize">
					This is to certify that Mr/Mrs &nbsp <u>{{ $purchaseshare->FirstName}}&nbsp {{$purchaseshare->MiddleName }} &nbsp {{ $purchaseshare->LastName }}</u></br>
					Father/Husband name: <u> &nbsp {{ $purchaseshare->FatherName }} &nbsp{{ $purchaseshare->SpouseName }} &nbsp {{ $purchaseshare->Address }} &nbsp {{ $purchaseshare->City }} &nbsp {{ $purchaseshare->District }} &nbsp {{ $purchaseshare->State }}</u></br>
					is the share holder of &nbsp <h7 class="noofsahre"></h7>&nbsp shares of Rupees &nbsp <h7 class="sahreamt"></h7>&nbsp each fully paid up in the Capital of Potters Cottage Industrial Co-Operative Society Ltd.,DRI No.24/58,Chakrasoudha,kulai,Mangaluru-575019 D.K.Subject to the Rules and bylaws of the said Society and that the sum of Rs.&nbsp {{ $purchaseshare->PURSH_Totalamt }}(<h7 class='rup'></h7>)has been paid in respect of said shares.Given under the seal of the said Society on &nbsp<?php $purdate=date("d-m-Y",strtotime($purchaseshare->PURSH_Date)); echo $purdate;?> </br>
					NOMIMEE:Mr/Mrs &nbsp {{ $purchaseshare->Nom_FirstName}} &nbsp {{ $purchaseshare->Nom_MiddleName}} &nbsp {{ $purchaseshare->Nom_LastName}} &nbsp (RELATIONSHIP:&nbsp {{ $purchaseshare->Relationship}})
					</br>
					{{ $purchaseshare->Nom_Address}}&nbsp {{ $purchaseshare->Nom_City}}&nbsp 
					
					
						@endforeach
					
					</div>
					
								
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


<style type="text/css">
@media print {
input#print {
display: none;
}
}
</style> 
<script src="js/AmountToRupee.js"></script>
<script src="js/NumberToWords.js"></script>
<script src="js/jQuery.print.js"></script>
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
		//alert('test');
		//$("#toprint").print();
		$cert={{ $purchaseshare->PURSH_Certfid }};
		var divContents = $("#toprint").html();
            var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title>SHARE CERTIFICATE</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
	//$.print("#toprint");
	});
});


</script>

<script type="text/javascript">
	rupee="{{ $purchaseshare->PURSH_Totalamt }}";
	noofshare="{{ $purchaseshare-> PURSH_Noofshares}}";
	shareamt="{{ $purchaseshare-> PURSH_Shareamt}}";
	
	
	InWords=AmountToRupee(rupee);
	noofshareInWords=NumberToWords(noofshare);
	shareamtInWords=AmountToRupee(shareamt);
	//alert(InWords);
	$('.fdln3').html(InWords);
	$('.rup').html(InWords);
	$('.noofsahre').html(noofshareInWords);
	$('.sahreamt').html(shareamtInWords);
	
	
</script>
