
		<div class="row">
			<div class="box col-md-12">
				<div class="box-inner">
				
							<a href="#" class="btn btn-default btnrv">Back</a>
							<a class="btn btn-default Printvv">Print</a>
								<div id="fullvocherprint">
							<table class="table table-hover table-bordered display tablesorter" >
								
								<div class="text-center"> 
									<h3><center>Ledger Vouchers</center></h3>
								</div>

								<thead>
									<th>Date</th>
									<th>Particulars</th>
									<th>Voucher type</th>
									<th>Transaction type</th>
									<th>Cheque No</th>
									<th>Voucher id</th>
									<th>Debit</th>
									<th>Credit</th>
									<th>Running Balance</th>
									
									<tr><td>Openning Balance</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><?/*php echo $open_bal;*/ ?></td></tr>
								</thead>
								
								<tr>
									
									<td colspan="6" align="right">Opening Balance :</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								
								<tr>
									<td colspan="6" align="right">Current Total :</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								
								<tr>
									<td colspan="6" align="right">Closing Balance :</td>
									<td></td>
									<td></td>
									<td></td>				
								</tr>	
							</table>
							</div>
				
			</div>
		</div>
	</div>
	
	<script>
	$('.clickme').click(function(e){
		$('.financialclassid').click();
	});
	
	$('.btnrv').click(function(e){
		e.preventDefault();
		
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	</script>
		<script>

	$(".Printvv").click(function(){
	var divContents=$("#fullvocherprint").html();
	var printWindow=window.open(' ',' ','height=400,width=800');
	printWindow.document.write('<html><head><title>Ledger Vocher</title>');
	printWindow.document.write('</head><body>');
	printWindow.document.write(divContents);
	printWindow.document.write('</body></html>');
	printWindow.document.close();
	printWindow.print();
	
	
	});	
	</script>
