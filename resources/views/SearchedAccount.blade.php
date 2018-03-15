<script src="js/bootstrap-typeahead.js"></script>
<div id="content<?php echo $sac['module']->Mid; ?>" class="col-lg-12 col-sm-12">
	<div class="row">
		<div class="box_bdy_<?php echo $sac['module']->Mid; ?> box col-md-12">
			<div class="bdy_<?php echo $sac['module']->Mid; ?> box-inner">
				
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-globe"></i>SB Account List</h2>
					
				</div>
				<div class="box-content">
					
					
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
								<th>Total Amount</th>
								<!--<th>VIEW</th>-->
								<th>EDIT</th>
							</tr>
						</thead>
						
						<tbody>
							@foreach ($sac['AccData'] as $searchacc)
							
							<tr>
								<td class="hidden">{{ $searchacc->Accid }}</td>
								<td><a  href="accountdetails/{{ $searchacc->Accid }}" class="viwbtn<?php echo $sac['module']->Mid; ?>">{{ $searchacc->AccNum }}/{{ $searchacc->Old_AccNo }}</a></td>
								<td>{{ $searchacc->Acc_Type }}</td>
								<td>{{ $searchacc->BName }}</td>
								<td>{{ $searchacc->FirstName }}</td>
								<td>{{ $searchacc->MiddleName }}</td>
								<td>{{ $searchacc->LastName }}</td>
								<td>{{ $searchacc->MobileNo }}</td>
								<td>{{ $searchacc->PhoneNo }}</td>
								<td>{{ $searchacc->Total_Amount }}</td>
								
								
								<td>
									
									<div class="form-group">
										<div class="col-sm-12">
											<input type="button" value="EDIT" class="btn btn-info btn-sm edtbtn<?php echo $sac['module']->Mid; ?>" href="accountdetails/{{ $searchacc->Accid }}/edit"/>
										</div>
									</div>
									
								</td>
							</tr>
							@endforeach
							
						</tbody>
						
					</table>
					
					
					
					
				</div>	
				<div id='pagei<?php echo $sac['module']->Mid; ?>'>
					
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
	
	$('.viwbtn<?php echo $sac['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box-inner').load($(this).attr('href'));
		$('.box_bdy_<?php echo $sac['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.edtbtn<?php echo $sac['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box-inner').load($(this).attr('href'));
		$('.box_bdy_<?php echo $sac['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$("#pagei<?php echo $sac['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $sac['module']->Mid; ?>");
		
	});
	
	$('.loadmc<?php echo $sac['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('#<?php echo $sac['module']->Mid; ?>_content').load($(this).attr('href'));
	});
	
	$('.backbtn').click(function(e){
		//$('.accclassid').click();
		//bdy_<?php echo $sac['module']->Mid; ?>
		$('.bdy_<?php echo $sac['module']->Mid; ?>').load($(this).attr('href'));
	});
	
/*	$('input.SearchTypeahead').typeahead({
		//ajax: '/GetSearchAcc'
		source:GetSearchAcc
	});*/
	</script>	