
<div class="row">
	<div class="box_bdy_<?php echo $a['module']->Mid; ?> box col-md-12">
		<div class="bdy_<?php echo $a['module']->Mid; ?> box-inner">
			
			<div class="box-header well" data-original-title="">
				<h2><i class="glyphicon glyphicon-globe"></i>SB Account List</h2>
				
			</div>
			
			
			
			<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
				<thead>
					<tr>
						<th>Account Number</th>
						<th>Old Account Number</th>
						<th>Account Type</th>
						<th>Branch</th>
						<th>Name</th>
						<th>Mobile Number</th>
						<th>Phone Number</th>
						<th>SB Balance(old)</th>
						<th>SB Balance(pass book)</th>
						<!--<th>VIEW</th>-->
						<th>EDIT</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($a['SbList'] as $createaccount)
					<tr>
						<td class="hidden">{{ $createaccount->Accid }}</td>
						<td><a  href="accountdetails/{{ $createaccount->Accid }}" class="ViewSbList<?php echo $a['module']->Mid; ?>">{{ $createaccount->AccNum }}</a></td>
						<td>{{ $createaccount->Old_AccNo }}</td>
						<td>{{ $createaccount->Acc_Type }}</td>
						<td>{{ $createaccount->BName }}</td>
						<td>{{ $createaccount->FirstName }} {{ $createaccount->MiddleName }} {{ $createaccount->LastName }}</td>
						<td>{{ $createaccount->MobileNo }}</td>
						<td>{{ $createaccount->PhoneNo }}</td>
						<td>{{ $createaccount->Total_Amount }}</td>
						<td>{{ $createaccount->sb_bal }}</td>
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
									<input type="button" value="EDIT" class="btn btn-info btn-sm EditSbList<?php echo $a['module']->Mid; ?>" href="accountdetails/{{ $createaccount->Accid }}/edit"/>
								</div>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			
			
			
			
		</div>	
		<div id='pagei<?php echo $a['module']->Mid; ?>'>
			{!! $a['SbList']->render() !!}
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
	
	
	$('.ViewSbList<?php echo $a['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box-inner').load($(this).attr('href'));
		$('.bdy_<?php echo $a['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$('.EditSbList<?php echo $a['module']->Mid; ?>').click(function(e){
		e.preventDefault();
		//alert($(this).attr('href'));
		//$('.box-inner').load($(this).attr('href'));
		$('.bdy_<?php echo $a['module']->Mid; ?>').load($(this).attr('href'));
	});
	
	$("#pagei<?php echo $a['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $a['module']->Mid; ?>");
		
	});
	
	$('.loadmc<?php echo $a['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('#<?php echo $a['module']->Mid; ?>_content').load($(this).attr('href'));
	});
	
	$('.backbtn').click(function(e){
		$('.accclassid').click();
		
	});
</script>
