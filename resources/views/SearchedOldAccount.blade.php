<div class="SearchedPage<?php echo $soac['module']->Mid; ?>">
	<script src="js/bootstrap-typeahead.js"></script>
	<div class="row">
		<div class="box_bdy_<?php echo $soac['module']->Mid; ?> box col-md-12">
			<div class="bdy_<?php echo $soac['module']->Mid; ?> box-inner">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>SB Account List</h2>
					
				</div>
				<div class="box-content">
					
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
						
						<thead>
							<tr>
								<th>Old Account Number</th>
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
							@foreach ($soac['AccData'] as $searchacc)
							
							<tr>
								<td class="hidden">{{ $searchacc->Accid }}</td>
								<td><a  href="accountdetails/{{ $searchacc->Accid }}" class="viwbtn<?php echo $soac['module']->Mid; ?>">{{ $searchacc->Old_AccNo }}</a></td>
								<td>{{ $searchacc->Acc_Type }}</td>
								<td>{{ $searchacc->BName }}</td>
								<td>{{ $searchacc->FirstName }}</td>
								<td>{{ $searchacc->MiddleName }}</td>
								<td>{{ $searchacc->LastName }}</td>
								<td>{{ $searchacc->MobileNo }}</td>
								<td>{{ $searchacc->PhoneNo }}</td>
								
								
								<td>
									
									<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="EDIT" class="btn btn-info btn-sm edtbtn<?php echo $soac['module']->Mid; ?>" href="accountdetails/{{ $searchacc->Accid }}/edit"/>
										</div>
									</div>
									
								</td>
							</tr>
							@endforeach
							
						</tbody>
						
					</table>
					
					
					
					
				</div>	
				<div id='pagei<?php echo $soac['module']->Mid; ?>'>
					
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
		$('.box-inner').load($(this).attr('href'));
	});
	
	$('.viwbtn<?php echo $soac['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box-inner').load($(this).attr('href'));
		//$('.box_bdy_<?php echo $soac['module']->Mid; ?>').load($(this).attr('href'));
		$('.SearchedPage<?php echo $soac['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.edtbtn<?php echo $soac['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box-inner').load($(this).attr('href'));
		$('.box_bdy_<?php echo $soac['module']->Mid; ?>').load($(this).attr('href'));
		//$('.SearchedPage<?php echo $soac['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$("#pagei<?php echo $soac['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $soac['module']->Mid; ?>");
		
	});
	
	$('.loadmc<?php echo $soac['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('#<?php echo $soac['module']->Mid; ?>_content').load($(this).attr('href'));
	});
	
	$('.backbtn').click(function(e){
		$('.accclassid').click();
		
	});
	
	$('input.SearchTypeahead').typeahead({
		//ajax: '/GetSearchAcc'
		source:GetSearchAcc
	});
</script>