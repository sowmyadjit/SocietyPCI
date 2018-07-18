

<div class="bdy_<?php echo $rejectacc['module']->Mid; ?> box-inner">
	
	<div class="box-header well" data-original-title="">
		<h2><i class="glyphicon glyphicon-globe"></i> Account Detail</h2>
		
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
		
				<th colspan=2><center>ACTION</center></th>
				
			</tr>
		</thead>
		
		<tbody>
			
			@foreach ($rejectacc['data'] as $createaccount)
			<tr>
				<td class="hidden">{{ $createaccount->Accid }}</td>
				<td><a  href="accountdetails/{{ $createaccount->Accid }}" class="viwbtn<?php echo $rejectacc['module']->Mid; ?>">{{ $createaccount->AccNum }}</a></td>
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
							<input type="button" value="EDIT" class="btn btn-primary btn-sm edtbtn<?php echo $rejectacc['module']->Mid; ?>" href="accountdetails/{{ $createaccount->Accid }}/edit"/>
						</div>
					</div>
					
				</td>
				<td>
					<div class="form-group">
						<div class="col-sm-12">
							<input type="button" value="ACCEPT" class="btn btn-success btn-sm accbtn<?php echo $rejectacc['module']->Mid; ?>" href="acceptaccount/{{ $createaccount->Accid }}"/>
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
				<input type="button" value="Back" id="back_i" class="btn btn-info btn-sm backbtn<?php echo $rejectacc['module']->Mid; ?>" />
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
	$('.crtacc<?php echo $rejectacc['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box').load($(this).attr('href'));
		$('.bdy_<?php echo $rejectacc['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	
	$('.viwbtn<?php echo $rejectacc['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box-inner').load($(this).attr('href'));
		$('.bdy_<?php echo $rejectacc['module']->Mid; ?>').load($(this).attr('href'));
	});
	$('.accbtn<?php echo $rejectacc['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box-inner').load($(this).attr('href'));
		$('.bdy_<?php echo $rejectacc['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.edtbtn<?php echo $rejectacc['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box-inner').load($(this).attr('href'));
		$('.bdy_<?php echo $rejectacc['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.backbtn<?php echo $rejectacc['module']->Mid; ?>').click(function(e){
		$('.custauhclassid').click();
		
	});
	$('.rejbtn<?php echo $rejectacc['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		
		//$('.box-inner').load($(this).attr('href'));
		$('.bdy_<?php echo $rejectacc['module']->Mid; ?>').load($(this).attr('href'));
		
	});
	</script>	

	<script>
		$("#back_i").click(function() {
			$("#back").show();
			$("#back").trigger("click");
		});
	</script>