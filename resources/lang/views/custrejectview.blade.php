       

		
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-user"></i> Rejected customer Detail</h2>
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
						<th>FIRST NAME</th>
						<th>MIDDLE NAME</th>
						<th>LAST NAME</th>
						<th>BRANCH NAME</th>
						<th>MOBILE NUMBER</th>
						<th>PHONE NUMBER</th>
						<th>ACTION</th>
						
					</tr>
					</thead>
					
					<tbody>
						@foreach ($c1 as $customer)
						<tr>
							<td class="hidden">{{ $customer->Custid }}</td>
							<td><a  href="customerdetails/{{ $customer->Custid }}" class="custdet">{{ $customer->FirstName }}</a></td>
							<td>{{ $customer->MiddleName }}</td>
							<td>{{ $customer->LastName }}</td>
							<td>{{ $customer->BName }}</td>
							<td>{{ $customer->MobileNo }}</td>
							<td>{{ $customer->PhoneNo }}</td>
							
							<td>
									<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="EDIT" class="btn btn-info btn-sm edtbtn" href="customerdetails/{{ $customer->Custid }}/edit"/>
										</div>
									</div>
								</td>
								<td>
								<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="Accept" class="btn btn-info btn-sm accustpbtn" href="authoriserejcust/{{ $customer->Custid }}"/>
										</div>
									</div>
									</td>
									
									
						</tr>
						@endforeach
						</tbody>
						</table>
				</div>
				<center>
			<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="Back" class="btn btn-info btn-sm backbtn" />
										</div>
									</div>
									</center>					
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
	$('.clickme').click(function(e){
		$('.custclassid').click();
	});
	
	$('.crtcust').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	$('.accustpbtn').click(function(e){
		alert("hai");
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	$('.custdet').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		
		$('.box-inner').load($(this).attr('href'));
		
	});
	$('.rejbtn').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		
		$('.box-inner').load($(this).attr('href'));
		
	});
	
	$('.edtbtn').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	$('.backbtn').click(function(e){
		$('.custauhclassid').click();
		
	});
	
</script>