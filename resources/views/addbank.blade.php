<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
		
	</div>
</noscript>


<div id="content<?php echo $bank['module']->Mid; ?>" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	
	
	<div class="row">
		<div class="box col-md-12">
			<div class="bdy_<?php echo $bank['module']->Mid; ?> box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i> Bank DETAIL</h2>
					
					
				</div>
				
				<div class="box-content">
					
					<div class="alert alert-info">
						<a href="bankdetail" class="btn btn-default CrtBankBtn<?php echo $bank['module']->Mid; ?>">CREATE Bank</a>
					</div>
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
						
						<thead>
							<tr>
								<th>Bank Name</th>
								<th>Bank Branch</th>
								<th>IFSC</th>
								<th>Account Number</th>
								<th>PCIC Society Branch</th>
								<th>Total Amount</th>
							</tr>
						</thead>
						
						<tbody>
							
							@foreach ($bank['Banks'] as $AddBank)
							<tr>
								<td class="hidden">{{ $AddBank->Bankid }}</td>
								<td>{{ $AddBank->BankName }}</td>
								<td>{{ $AddBank->Branch }}</td>
								<td>{{ $AddBank->AddBank_IFSC }}</td>
								<td>{{ $AddBank->AccountNo }}</td>
								<td>{{ $AddBank->SocietyBranch }}</td>
								<td>{{ $AddBank->TotalAmt }}</td>
								
							</tr>
							@endforeach
						</tbody>
					</table>
				</div> 
				<div id='pagei<?php echo $bank['module']->Mid; ?>'>
					{!! $bank['Banks']->render() !!}
				</div>
			</div>
		</div>
	</div>
</div>
<script src="js/jquery.min.js"></script>
<script>
	$('.clickme').click(function(e){
		$('.bankclassid').click();
	});
	
	$('.CrtBankBtn<?php echo $bank['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		$('.bdy_<?php echo $bank['module']->Mid; ?>').load($(this).attr('href'));
		
	});
	
	$("#pagei<?php echo $bank['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $bank['module']->Mid; ?>");
		
	});
	$('.loadmc<?php echo $bank['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('#<?php echo $bank['module']->Mid; ?>_content').load($(this).attr('href'));
	});
	
</script>