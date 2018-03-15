<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>
	</div>
</noscript>

<div id="content<?php echo $s['module']->Mid; ?>" class="col-lg-10 col-sm-10 col-md-10">
	<!-- content starts -->
	
	
	<div class="row">
		<div class="box col-md-12">
			<div class="bdy_<?php echo $s['module']->Mid; ?> box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> Shares Detail</h2>
					
				</div>
				
				<div class="box-content">
					<div class="alert alert-info">
						<a href="sharesdetail" class="btn btn-default CrtShTypBtn<?php echo $s['module']->Mid; ?>">Create Shares</a>
					</div>
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
						
						<thead>
							<tr>
								<th>Shares Class</th>
								<th>Shares Facevalue</th>
								<th>Shares Price</th>
								
							</tr>
						</thead>
						
						<tbody>
							@foreach ($s['shares'] as $shares)
							<tr>
								<td class="hidden">{{ $shares->Share_ID }}</td>
								<td>{{ $shares->Share_Class }}</td>
								<td>{{ $shares->Facevalue }}</td>
								<td>{{ $shares->Share_Price }}</td>
								<td>
										<div class="form-group">
											<div class="col-sm-12">
												<input type="button" value="EDIT" class="btn btn-info btn-sm edtbtn<?php echo $s['module']->Mid; ?>" href="sharetypeedit/{{ $shares->Share_ID }}"/>
											</div>
										</div>
								</td>
							</tr>
							@endforeach
						</tbody>
						
					</table>
				</div>
				<div id='pagei<?php echo $s['module']->Mid; ?>'>
					{!! $s['shares']->render() !!}
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	
	$('.clickme').click(function(e){
		$('.shareclassid').click();
	});
	
	$('.CrtShTypBtn<?php echo $s['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		$('.bdy_<?php echo $s['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	
	$("#pagei<?php echo $s['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $s['module']->Mid; ?>");
		
	});
	$('.loadmc<?php echo $s['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('#<?php echo $s['module']->Mid; ?>_content').load($(this).attr('href'));
	});
	$('.edtbtn<?php echo $s['module']->Mid; ?>').click(function(e)
	{
	e.preventDefault();
	//alert($(this).attr('href'));
	$('.box').load($(this).attr('href'));
	});
</script>