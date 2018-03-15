     <div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> Member Detail</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i
								class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
						<tr>
					
						<th>First Name</th>
						<th>Middle Name</th>
						<th>Last Name</th>
						<th>Date</th>
						<th>Share Class</th>
						<th>Number Of Shares</th>
						<th>Total Share Price</th>
						<th>Remarks</th>
						<th>ACTION</th>
						</tr>
					
					</thead>
					
					<tbody>
					
						@foreach ($m as $members)
						<tr>
							 <td class="hidden">{{ $members->Memid }}</td>
							 <td class="hidden">{{ $members->PURSH_Pid }}</td>
							 
							 <td><a  href="memberdetails/{{ $members->Memid }}" class="memdet">{{ $members->FirstName }}</a></td>
							 <td>{{ $members->MiddleName }}</td>
							 <td>{{ $members->LastName }}</td>
							 <td>{{$members->CreatedDate}}</td>
							 <td>{{$members->PURSH_Shrclass}}</td>
							 <td>{{$members->PURSH_Noofshares}}</td>
							 <td>{{$members->PURSH_TotalShareValue}}</td>
							 <td>{{$members->Remarks}}</td>
							
							 <td>
									<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="EDIT" class="btn btn-info btn-sm edtbtn" href="memberdetails/{{ $members->Memid }}/edit"/>
										</div>
									</div>
								</td>	
								
								<td>
									
								<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="ACCEPT" class="btn btn-info btn-sm rejbtn" href="AcceptRejectedShare/{{ $members->Memid }}/{{ $members->PURSH_Pid }}"/>
										</div>
									</div>
									
							 </td>
							 
						</tr>
						@endforeach
						
					</tbody>
					
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

   
<script>
	  
	$('.clickme').click(function(e)
	{
		$('.memclassid').click();
	});
	
	$('.crtmem').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	$('.memdet').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	$('.edtbtn').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	$('.accbtn').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box').load($(this).attr('href'));
	});
	$('.backbtn').click(function(e){
		$('.custauhclassid').click();
		
	});
	$('.rejbtn').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		
		$('.box-inner').load($(this).attr('href'));
		
	});
	
</script>









	<!--				<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> Member Detail</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i
								class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					
				<!--	<div class="alert alert-info">
						<a href="membesuspendview" class="btn btn-default crtmem">view suspend Member</a>
					</div>-->
					
			<!--		<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
						<tr>
					
						<th>First Name</th>
						<th>Middle Name</th>
						<th>Last Name</th>
						<th>Date</th>
						<th>Remarks</th>
						<th>Shares Class</th>
						<th>No OF Shares</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					
					</thead>
					
					<tbody>
					
						@foreach ($m as $members)
						<tr>
							 <td class="hidden">{{ $members->Memid }}</td>
							 <td>{{ $members->FirstName }}</td>
							 <td>{{ $members->MiddleName }}</td>
							 <td>{{ $members->LastName }}</td>
							 <td>{{$members->CreatedDate}}</td>
							 <td>{{$members->Remarks}}</td>
							 <td>{{$members->PURSH_Shrclass}}</td>
							 <td>{{$members->PURSH_Noofshares}}</td>
							 <td>{{$members->Status}}</td>
							 <td>
									<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="Accept" class="btn btn-info btn-sm accsuspbtn" href="acceptsuspendshares/{{ $members->Memid }}"/>
										</div>
									</div>
								</td>
								
						</tr>
						@endforeach
						
					</tbody>
					
					</table>
					<center>
			<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="Back" id='test1' class="btn btn-info btn-sm backauth"  />
										</div>
									</div>
									</center>
				</div>
				
			</div>
			
			
	
	


  
<script>
$('.backauth').click(function(e){
	e.preventDefault();
			alert("hai");
		$('.custauhclassid').click();
		
	});
$('.accsuspbtn').click(function(e){
		alert("hai");
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	
	
</script>-->