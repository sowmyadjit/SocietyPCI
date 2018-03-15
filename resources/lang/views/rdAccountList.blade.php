        
			
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
		
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>RD Account List</h2>

					
				</div>
	
				
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						<th>Account Number</th>
						<th>Old Account Number</th>
						<th>Agent Id</th>
						<th>Account Type</th>
						<th>Branch</th>
						<th>First Name</th>
						<th>Middle Name</th>
						<th>Last Name</th>
						<th>Mobile Number</th>
						<th>Phone Number</th>
						<!--<th>VIEW</th>-->
						<th>EDIT</th>
					</tr>
					</thead>
					
					<tbody>

					@foreach ($a as $createaccount)
					<tr>
						<td class="hidden">{{ $createaccount->Accid }}</td>
						<td><a  href="accountdetails/{{ $createaccount->Accid }}" class="viwbtn">{{ $createaccount->AccNum }}</a></td>
						<td>{{ $createaccount->Old_AccNo }}</td>
						<td>{{ $createaccount->Agent_ID }}</td>
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
					</tr>
			 
					@endforeach
					</tbody>
					
					</table>
					
					 
					
					
				</div>	
				<div id='pagei'>
				{!! $a->render() !!}
				</div>
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
	$('.accclassid').click();
}); 
	  $('.crtacc').click(function(e)
{
	e.preventDefault();
	//alert($(this).attr('href'));
	$('.box-inner').load($(this).attr('href'));
});

$('.viwbtn').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
$('.edtbtn').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});
	
	$("ul.pagination li a").each(function() {
 
    $(this).addClass("loadmc");
  
});
$('.loadmc').click(function(e)
{
	e.preventDefault();
	//alert($(this).attr('href'));
	$('.loadper').load($(this).attr('href'));
});

$('.backbtn').click(function(e){
		$('.accclassid').click();
		
	});
</script>