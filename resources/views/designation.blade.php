<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
	</div>
</noscript>

<div id="content<?php echo $d['module']->Mid; ?>" class="col-lg-10 col-sm-10">
    <!-- content starts -->
	
	
	<div class="row">
		<div class="box col-md-12">
			<div class="bdy_<?php echo $d['module']->Mid; ?> box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-briefcase"></i> Designation Detail</h2>
					
					
				</div>
				
				<div class="box-content">
					
					<div class="alert alert-info">
						<a href="createdesgn" class="btn btn-default crtds<?php echo $d['module']->Mid; ?>">Create Designation</a>
					</div>
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
						<thead>
							<tr>
								<th>DESIGNATION</th>
								<th>INITIAL</th>
								<th>LEVEL</th>
							</tr>
						</thead>
						
						<tbody>
							@foreach ($d['desig'] as $designation)
							<tr>
								<td class="hidden">{{ $designation->Did }}</td>
								<td>{{ $designation->DName }}</td>
								<td>{{ $designation->DInitial }}</td>
								<td>{{ $designation->DLevel }}</td>
								
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>	
				<div id='pagei<?php echo $d['module']->Mid; ?>'>
					{!! $d['desig']->render() !!}
				</div>
			</div>					
		</div>					
	</div>					
</div>					

<script>
	
	$('.clickme').click(function(e){
		$('.designationclassside').click();
	}); 
	
	$('.crtds<?php echo $d['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.bdy_<?php echo $d['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$("#pagei<?php echo $d['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $d['module']->Mid; ?>");
		
	});
	$('.loadmc<?php echo $d['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('<?php echo $d['module']->Mid; ?>').addClass("col-md-12");
		$('#<?php echo $d['module']->Mid; ?>_content').load($(this).attr('href'));
	});
	
</script>