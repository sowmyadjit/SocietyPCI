<div class="box col-md-12">
    <div class="box-inner">
		<div class="box-header well" data-original-title="">
			<h2><i class="glyphicon glyphicon-user"></i> PIGMI DETAIL</h2>
			
			<div class="box-icon">
				<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
				<a href="#" class="btn btn-minimize btn-round btn-default"><i
				class="glyphicon glyphicon-chevron-up"></i></a>
				<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<!-- <div class="alert alert-info">For help with such table please check <a href="http://datatables.net/" target="_blank">http://datatables.net/</a></div>-->
			<!--<div class="alert alert-info">
				
				<a href="pigmedetail" class="btn btn-default crtds">Create PIGME TYPES</a>
			</div>-->
			<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
				<thead>
					<tr>
						<th> First Name</th>
						<th> mid Name</th>
						<th> last Name</th>
						
						<th>PIGMI Type</th>
						<th>Max Interest</th>
						<th>Interest</th>
						<th>Max Commission</th>
						<th>action<th>
							
						</tr>
						</thead>
						<tbody>
							
							<tr>
								@foreach ($p as $pigmitype)
								<tr>
									<td class="hidden">{{ $pigmitype->PigmiTypeid }}</td>
									<td class="hidden">{{ $pigmitype->PigmiAllocID }}</td>
									
									<td>{{ $pigmitype->FirstName }}</td>
									<td>{{ $pigmitype->MiddleName }}</td>
									<td>{{ $pigmitype->LastName }}</td>
									<td>{{ $pigmitype->Pigmi_Type }}</td>
									<td>{{ $pigmitype->max_Interest}}</td>	
									<td>{{ $pigmitype->Interest}}</td>
									<td>{{$pigmitype->Max_Commission}}</td>
									<td>
										<div class="form-group">
											<div class="col-sm-12">
												<input type="button" value="Accept" class="btn btn-info btn-sm accpigmy" href="acceptaccountpigmy/{{ $pigmitype->PigmiAllocID }}"/>
											</div>
										</div>
									</td>
									<td>
										<div class="form-group">
											<div class="col-sm-12">
												<input type="button" value="REject" class="btn btn-info btn-sm rejbtn" href="rejectedaccountpigmy/{{ $pigmitype->PigmiAllocID }}"/>
											</div>
										</div>
									</td>
									
								</tr>
							</tr>
						</thead>
					</tbody>
					@endforeach
				</table>
				
			</div>
		</div>
	</div>
	
	
	
	
	
	
	<script>
		
		
		
		$('.crtds').click(function(e)
		{
			e.preventDefault();
			//alert($(this).attr('href'));
			$('.box-inner').load($(this).attr('href'));
		});
		$('.accpigmy').click(function(e){
			e.preventDefault();
			//alert($(this).attr('href'));
			$('.box-inner').load($(this).attr('href'));
		});
		$('.rejbtn').click(function(e){
			e.preventDefault();
			//alert($(this).attr('href'));
			
			$('.box-inner').load($(this).attr('href'));
			
		});
		
	</script>																