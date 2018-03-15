<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
		
	</div>
</noscript>

<div id="content<?php echo $lt['module']->Mid; ?>" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	
	
	<div class="row">
		<div class="box col-md-12">
			<div class="bdy_<?php echo $lt['module']->Mid; ?> box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i> LOAN DETAIL</h2>
				</div>
				
				<div class="box-content">
					
					<div class="alert alert-info">
						<a href="loantypedetail" class="btn btn-default CrtLoanTypeBtn<?php echo $lt['module']->Mid; ?>">CREATE LOAN TYPE</a>
					</div>
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
						
						<thead>
							<tr>
								<th>LOAN TYPE</th>
								<th>LOAN INTEREST</th>
							<!--	<th>ACTION</th>-->
							</tr>
						</thead>
						
						<tbody>
							
							@foreach ($lt['LoanType'] as $loan_type)
							<tr>
								<td class="hidden">{{ $loan_type->LoanType_ID }}</td>
								<td>{{ $loan_type->LoanType_Name }}</td>
								<td>{{ $loan_type->LoanType_Interest }}</td>

							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div id='pagei<?php echo $lt['module']->Mid; ?>'>
					{!! $lt['LoanType']->render() !!}
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$('.clickme').click(function(e){
		$('.loanclassid').click();
	});
	
	$('.CrtLoanTypeBtn<?php echo $lt['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		$('.bdy_<?php echo $lt['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$("#pagei<?php echo $lt['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $lt['module']->Mid; ?>");
		
	});
	$('.loadmc<?php echo $lt['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('#<?php echo $lt['module']->Mid; ?>_content').load($(this).attr('href'));
	});
</script>