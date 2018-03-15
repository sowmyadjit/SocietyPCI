<div  id="toprint<?php echo $PigmyTranBranchWiseData['module']->Mid; ?>">
<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
				<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
				<!--this css should be inside the toprint div , for printing the table borders-->
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						<th>BRANCH</th>
						<th>AGENT</th>
						<th>Old Account Number</th>
						<th>Account Number</th>
						<th>Transaction Date</th>
						<th>Pigmi Type</th>
						<th>Current Balance</th>
						<th>Credited Amount</th>
						<th>Total Balance</th>
						
					</tr>
					</thead>
					
					<tbody>
					
						
							@foreach($PigmyTranBranchWiseData['PgBWData'] as $PigmyBWD)
								<tr>
									<td class="hidden">{{ $PigmyBWD->PigmiTrans_ID }}</td>
								<td>{{ $PigmyBWD->BName }}</td>
								<td>{{ $PigmyBWD->FirstName }}.{{ $PigmyBWD->MiddleName }}.{{ $PigmyBWD->LastName }}</td>
								<td>{{ $PigmyBWD->old_pigmiaccno }}</td>
								<td>{{ $PigmyBWD->PigmiAcc_No }}</td>
				<td><?php $trandate=date("d-m-Y",strtotime($PigmyBWD->PigReport_TranDate)); echo $trandate; ?></td>
								<td>{{ $PigmyBWD->Pigmi_Type }}</td>
								<td>{{ $PigmyBWD->Current_Balance }}</td>
								<td>{{ $PigmyBWD->Amount }}</td>	
								<td>{{ $PigmyBWD->Total_Amount }}</td>
								
								</tr>
							@endforeach
						
						
					</tbody>
	</table>
				
				
				<div id='pagei<?php echo $PigmyTranBranchWiseData['module']->Mid; ?>'>
				
				
		
		{!! $PigmyTranBranchWiseData['PgBWData']->appends(Input::except('page'))->render() !!}
		
				</div>
</div>
				
	<script>
	
	
	
	
	
	$("#pagei<?php echo $PigmyTranBranchWiseData['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $PigmyTranBranchWiseData['module']->Mid; ?>");
		
	});
	
	$('.loadmc<?php echo $PigmyTranBranchWiseData['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('.SearchRes<?php echo $PigmyTranBranchWiseData['module']->Mid; ?>').load($(this).attr('href'));
	});
	</script>
