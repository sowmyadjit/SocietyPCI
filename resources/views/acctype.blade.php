<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
		
	</div>
</noscript>

<div id="content<?php echo $a['module']->Mid; ?>" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	
	
	<div class="row">
		<div class="box col-md-12">
			<div class="bdy_<?php echo $a['module']->Mid; ?> box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i> ACCOUNT Detail</h2>
				</div>
				
				<div class="box-content">
					
					<div class="alert alert-info">
						<a href="accounttypedetail" class="btn btn-default CreateAccTypeBtn<?php echo $a['module']->Mid; ?>">Create ACCOUNT TYPE</a>
					</div>
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
						
						<thead>
							<tr>
								<th>ACCOUNT TYPE</th>
								<th>ACCOUNT Intrest</th>
							</tr>
						</thead>
						
						<tbody>
							
							@foreach ($a['AccType'] as $accounttype)
							<tr>
								<td class="hidden">{{ $accounttype->AccTid }}</td>
								<td>{{ $accounttype->Acc_Type }}</td>
								<td>{{ $accounttype->Intrest }}</td>
							</tr>
							
							@endforeach
						</tbody>
						
					</table>
					
				</div> 
				<div id='pagei<?php echo $a['module']->Mid; ?>'>
					{!! $a['AccType']->render() !!}
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	
	$('.clickme').click(function(e){
		$('.acctypclassid').click();
	});
	
	$('.CreateAccTypeBtn<?php echo $a['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.bdy_<?php echo $a['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$("#pagei<?php echo $a['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $a['module']->Mid; ?>");
		
	});
	$('.loadmc<?php echo $a['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		
		$('#<?php echo $a['module']->Mid; ?>_content').load($(this).attr('href'));
	});
	
</script>