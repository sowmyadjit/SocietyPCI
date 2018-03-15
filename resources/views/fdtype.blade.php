<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
		
	</div>
</noscript>

<div id="content<?php echo $fd['module']->Mid; ?>" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	
	
	<div class="row">
		<div class="box_bdy_<?php echo $fd['module']->Mid; ?> box col-md-12">
			<div class="bdy_<?php echo $fd['module']->Mid; ?> box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i> FD Detail</h2>
					
					
				</div>
				
				<div class="box-content">
					
					<div class="alert alert-info">
						<a href="fdtypedetail" class="btn btn-default CrtFdTypeBtn<?php echo $fd['module']->Mid; ?>">Create FD TYPE</a>
					</div>
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
						
						<thead>
							<tr>
								<th>FD Type</th>
								<th>FD Years</th>
								<th>FD Days</th>
								<th>FD Interest</th>
							</tr>
						</thead>
						
						<tbody>
							
							@foreach ($fd['FdTypes'] as $fdtype)
							<tr>
								<td class="hidden">{{ $fdtype->FdTid }}</td>
								<td>{{ $fdtype->FdType }}</td>
								<td>{{ $fdtype->NumberOfYears }}</td>
								<td>{{ $fdtype->NumberOfDays }}</td>
								<td>{{ $fdtype->FdInterest }}</td>
							</tr>
							
							@endforeach
						</tbody>
						
					</table>
					
				</div> 
				<div id='pagei<?php echo $fd['module']->Mid; ?>'>
					{!! $fd['FdTypes']->render() !!}
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	
	$('.clickme').click(function(e){
		$('.acctypclassid').click();
	});
	
	$('.CrtFdTypeBtn<?php echo $fd['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.bdy_<?php echo $fd['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$("#pagei<?php echo $fd['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $fd['module']->Mid; ?>");
		
	});
	$('.loadmc<?php echo $fd['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('#<?php echo $fd['module']->Mid; ?>_content').load($(this).attr('href'));
	});
	
</script>