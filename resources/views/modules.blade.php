
<link href="css/toggles.css" rel="stylesheet">
<link href="css/toggles-soft.css" rel="stylesheet">
<style>
</style>

<div id="content<?php echo $m['module']->Mid; ?>" class="col-lg-10 col-sm-10">
	
	
	<div class="row">
		<div class="box col-md-12">
			<div class="bdy_<?php echo $m['module']->Mid; ?> box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-tasks"></i> MODULES Detail</h2>
					
				</div>
				
				<div class="box-content">
					
					<div class="alert alert-info">
						<a href="ShowCreateModule" class="btn btn-default crtds<?php echo $m['module']->Mid; ?>">Create Module</a>
					</div>
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive scroll">
						<thead>
							<tr>
								<th>ORDER ID</th>
								<th>NAME</th>
								<th>URL</th>
								<th>CLASS ID</th>
								<th>TOOL TIP</th>
								<th>ICON</th>
								<th colspan=2><center>ACTION</center></th>
							</tr>
						</thead>
						
						
						<tbody>
							
							@foreach ($m['moddata'] as $modules)
							<tr>
								<td class="hidden">{{ $modules->Mid }}</td>
								<td>{{ $modules->MOrderId }}</td>
								<td>{{ $modules->MName }}</td>
								<td>{{ $modules->MUrl }}</td>
								<td>{{ $modules->MClassId }}</td>
								<td>{{ $modules->MToolTip }}</td>
								<td>{{ $modules->MIcon }}</td>
								<td class="hidden">{{ $modules->MStatus }}</td>
								<td>
									<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="EDIT" class="btn btn-success btn-sm edtbtn<?php echo $m['module']->Mid; ?>" href="ModuleEditView/{{ $modules->Mid }}"/>
										</div>
									</div>	
								</td>
								<td>
									<div class="toggle toggle-soft" data-mid='{{ $modules->Mid }}' data-toggle-on="{{ $modules->MStatus }}" data-toggle-height="20" data-toggle-width="60"></div>
									
								</td>
							</tr>
							@endforeach
							
						</tbody>
						
						
					</table>
					
					<div id='pagei<?php echo $m['module']->Mid; ?>'>
						{!! $m['moddata']->render() !!}
					</div>
				</div>
				
			</div>
			
		</div>
	</div>
</div>

<script src="js/toggles.min.js"></script>



<script>
	
</script>

<script>
	
	$('.clickme').click(function(e){
		$('.modulesclassid').click();
	}); 
	
	$('.crtds<?php echo $m['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.bdy_<?php echo $m['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.edtbtn<?php echo $m['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box-inner').load($(this).attr('href'));
		$('.bdy_<?php echo $m['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$("#pagei<?php echo $m['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $m['module']->Mid; ?>");
		
	});
	$('.loadmc<?php echo $m['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('#<?php echo $m['module']->Mid; ?>_content').load($(this).attr('href'));
	});
	
	$('.toggle').toggles();
	
	$('.toggle').click(function(e){
		Stat=$(this).data('toggle-active');
		Mid=$(this).data('mid');
		//alert('status - '+$(this).data('toggle-active')+' mid -'+$(this).data('mid'));
		e.preventDefault();
		$.ajax({
			url: 'UpdateModuleStatus',
			type: 'post',
			data: '&ModuleStatus='+Stat+'&ModuleId='+Mid,
			success: function(data) {
				//alert('success');
				//$('.modulesclassid').click();
			}
		});
	});
	
</script>