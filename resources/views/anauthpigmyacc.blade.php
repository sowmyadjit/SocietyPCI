<div class="box_bdy_<?php echo $p['module']->Mid; ?> box col-md-12">
    <div class="bdy_<?php echo $p['module']->Mid; ?> box-inner">
		<div class="box-header well" data-original-title="">
			<h2><i class="glyphicon glyphicon-user"></i> PIGMI DETAIL</h2>
			
			
		</div>
		<div class="box-content">
			<div class="alert alert-info">
				<button class="btn-sm glyphicon glyphicon-refresh" id="refresh_data"></button>
			</div>

			<div id="table_data"></div>


			<!-- <div class="alert alert-info">For help with such table please check <a href="http://datatables.net/" target="_blank">http://datatables.net/</a></div>-->
			<!--<div class="alert alert-info">
				
				<a href="pigmedetail" class="btn btn-default crtds">Create PIGME TYPES</a>
			</div>-->

	<?php /*
			<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
				<thead>
					<tr>
						<th>Name</th>
						
						<th>PIGMI Type</th>
						<th>Max Interest</th>
						<th>Interest</th>
						<th>Max Commission</th>
						<th colspan=2><center>Action</center></th>
							
						</tr>
						</thead>
						<tbody>
							
							
							@foreach ($p['data'] as $pigmitype)
							<tr>
								<td class="hidden">{{ $pigmitype->PigmiTypeid }}</td>
								<td class="hidden">{{ $pigmitype->PigmiAllocID }}</td>
								
								<td>{{ $pigmitype->FirstName }} {{ $pigmitype->MiddleName }} {{ $pigmitype->LastName }}</td>
								<td>{{ $pigmitype->Pigmi_Type }}</td>
								<td>{{ $pigmitype->max_Interest}}</td>	
								<td>{{ $pigmitype->Interest}}</td>
								<td>{{$pigmitype->Max_Commission}}</td>
								<td>
									<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="ACCEPT" class="btn btn-success btn-sm accpigmy<?php echo $p['module']->Mid; ?>" href="acceptaccountpigmy/{{ $pigmitype->PigmiAllocID }}"/>
										</div>
									</div>
								</td>
								<td>
									<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="REJECT" class="btn btn-danger btn-sm rejbtn<?php echo $p['module']->Mid; ?>" href="rejectedaccountpigmy/{{ $pigmitype->PigmiAllocID }}"/>
										</div>
									</div>
								</td>
								
							</tr>
							
						</thead>
					</tbody>
					@endforeach
				</table>
		*/?>
			</div>
		</div>
	</div>
	
	
	
	
	
	
	<script>
		
		/* 
		
		$('.crtds').click(function(e)
		{
			e.preventDefault();
			//alert($(this).attr('href'));
			$('.box-inner').load($(this).attr('href'));
		});
		$('.accpigmy<?php echo $p['module']->Mid; ?>').click(function(e){
			e.preventDefault();
			//alert($(this).attr('href'));
			//$('.box-inner').load($(this).attr('href'));
			$('.bdy_<?php echo $p['module']->Mid; ?>').load($(this).attr('href'));
		});
		$('.rejbtn<?php echo $p['module']->Mid; ?>').click(function(e){
			e.preventDefault();
			//alert($(this).attr('href'));
			
			//$('.box-inner').load($(this).attr('href'));
			$('.bdy_<?php echo $p['module']->Mid; ?>').load($(this).attr('href'));
			
		});
		 */
	</script>



<script>
	function load_data() {
		var loading_img = `
			<div>
				<center>
					<img src="img\\loading2.gif" width="50px" height="50px"/>
				</center>
			</div>`;
		$("#table_data").html(loading_img);
		$.ajax({
			url: 'authpigmy_data',
			type: 'post',
			data: "",
			success: function(data) {
				$("#table_data").html(data);
			}
		});

	}
</script>

<script>
	$( document ).ready(function() {

		load_data();

	});
</script>

<script>
	$("#back").click(function() {
		$("#b2").html("");
		$(".b1").show();
	})
</script>

<script>
	$("#refresh_data").click(function() {
		load_data();
	})
</script>