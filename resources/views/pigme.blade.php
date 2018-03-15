

<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
		
	</div>
</noscript>

<div id="content<?php echo $p['module']->Mid; ?>" class="col-lg-10 col-sm-10">
	
	<div class="row">
		<div class="box col-md-12">
			<div class="bdy_<?php echo $p['module']->Mid; ?> box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> PIGMI DETAIL</h2>
					
					
				</div>
				<div class="box-content">
					<!-- <div class="alert alert-info">For help with such table please check <a href="http://datatables.net/" target="_blank">http://datatables.net/</a></div>-->
					<div class="alert alert-info">
						
						<a href="pigmedetail" class="btn btn-default CrtPigmTypBtn<?php echo $p['module']->Mid; ?>">Create PIGME TYPES</a>
					</div>
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
						<thead>
							<tr>
								<th>PIGMI Type</th>
								<th>Max Interest</th>
								<th>Interest</th>
								<th>Max Commission</th>
								<th>Commission</th>
							</tr>
						</thead>
						<tbody>
							
							
							@foreach ($p['pigmitype'] as $pigmitype)
							<tr>
								<td class="hidden">{{ $pigmitype->PigmiTypeid }}</td>
								<td>{{ $pigmitype->Pigmi_Type }}</td>
								<td>{{ $pigmitype->max_Interest}}</td>	
								<td>{{ $pigmitype->Interest}}</td>
								<td>{{$pigmitype->Max_Commission}}</td>
								<td>{{$pigmitype->Commission}}</td>
							</tr>
							
							
							
							@endforeach
						</tbody>
					</table>
				</div>
				<div id='pagei<?php echo $p['module']->Mid; ?>'>
					{!! $p['pigmitype']->render() !!}
				</div>
			</div>
		</div>
	</div>
</div>





<script>
	
	
	
	$('.CrtPigmTypBtn<?php echo $p['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.bdy_<?php echo $p['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$("#pagei<?php echo $p['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $p['module']->Mid; ?>");
		
	});
	$('.loadmc<?php echo $p['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('#<?php echo $p['module']->Mid; ?>_content').load($(this).attr('href'));
	});
	
</script>