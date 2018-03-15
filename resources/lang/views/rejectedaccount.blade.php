       
		
			<div class="box-inner">
		
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i> Account Detail</h2>

					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i
								class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
	
				
   
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						<th>Account Number</th>
						<th>Account Type</th>
						<th>Branch</th>
						<th>First Name</th>
						<th>Middle Name</th>
						<th>Last Name</th>
						<th>Mobile Number</th>
						<th>Phone Number</th>
						<!--<th>VIEW</th>-->
						<th>EDIT</th>
						<th>Action</th>
					</tr>
					</thead>
					
					<tbody>

					@foreach ($rejectacc as $createaccount)
					<tr>
						<td class="hidden">{{ $createaccount->Accid }}</td>
						<td><a  href="accountdetails/{{ $createaccount->Accid }}" class="viwbtn">{{ $createaccount->AccNum }}</a></td>
						<td>{{ $createaccount->Acc_Type }}</td>
						<td>{{ $createaccount->BName }}</td>
						<td>{{ $createaccount->FirstName }}</td>
						<td>{{ $createaccount->MiddleName }}</td>
						<td>{{ $createaccount->LastName }}</td>
						<td>{{ $createaccount->MobileNo }}</td>
						<td>{{ $createaccount->PhoneNo }}</td>
						<!--<td>
						
						<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="VIEW" class="btn btn-info btn-sm viwbtn" href="accountdetails/{{ $createaccount->Accid }}"/>
										</div>
									</div>
						
						</td>-->
						
						<td>
						
						<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="EDIT" class="btn btn-info btn-sm edtbtn" href="accountdetails/{{ $createaccount->Accid }}/edit"/>
										</div>
									</div>
						
						</td>
						<td>
									<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="Accept" class="btn btn-info btn-sm accbtn" href="acceptaccount/{{ $createaccount->Accid }}"/>
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
											<input type="button" value="Back" class="btn btn-info btn-sm backbtn" />
										</div>
									</div>
									</center>
					
					
				</div>	
				
			</div>	
			
		
	




<script>
	  
	  $('.clickme').click(function(e)
{
	$('.accclassid').click();
}); 
	  $('.crtacc').click(function(e)
{
	e.preventDefault();
	//alert($(this).attr('href'));
	$('.box').load($(this).attr('href'));
});

 
 $('.viwbtn').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	$('.accbtn').click(function(e){
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
	$('.rejbtn').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		
		$('.box-inner').load($(this).attr('href'));
		
	});
</script>