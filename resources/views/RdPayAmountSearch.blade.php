<div id="content<?php echo $PayAmount['module']->Mid; ?>" class="col-lg-12 col-sm-12">
    <!-- content starts -->
	
	
	<div class="row">
		<div class="box col-md-12">
			<div class="bdy_<?php echo $PayAmount['module']->Mid; ?> box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> Pigmy Pay Amount</h2>
					
				</div>
				
				<div class="box-content">
					
					
					<div class="alert alert-info">
						<div class="form-group">
							
						</div>
					</div>
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
						
						<thead>
							<tr>
								
								
								<th>Customer Name</th>
								<th>Account Number</th>
								<th>Payed Date</th>
								<th>RECEIPT</th>
								
							</tr>
						</thead>
						
						<tbody>
							
							@foreach ($PayAmount as $PAmt)
							<tr>
								<td class="hidden">{{ $PAmt->RDPayId }}</td>
								<td>{{ $PAmt->FirstName}}.{{ $PAmt->MiddleName}}.{{ $PAmt->LastName}}</td>
								
								<td>{{ $PAmt->RDPayAmt_AccNum }}</td>
								
								<td><?php $paydate=date("d-m-Y",strtotime($PAmt->RDPayAmtReport_PayDate)); echo $paydate;?></td>
								
								<td>
									<input type="button" value="RECEIPT" class="btn btn-info btn-sm ReceiptPrint" href="RdPayAmountReceipt/{{ $PAmt->RDPayId }}"/>
									
									
								</td>
							</tr>
							
							@endforeach
						</tbody>
						
						
						
					</table>
				</div>
			</div>
			
		</div>
	</div>
</div>
<script>
	
	$('.clickme').click(function(e)
	{
		$('.rdpayclassid').click();
	});
	
	$('.PayAmountLink').click(function(e)
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
	
	$('.ReceiptPrint').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
</script>	