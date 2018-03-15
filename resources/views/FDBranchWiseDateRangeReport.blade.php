<script src="js/bootstrap-typeahead.js"></script> 
<div  id="toprint<?php echo $FDTranBranchWiseData['module']->Mid; ?>">
	
	<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
	<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
	<!--this css should be inside the toprint div , for printing the table borders-->
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
		
		<thead>
			<tr>
				<th>Certificate Number</th>
				
				<th>First Name</th>
				<th>Middle Name</th>
				<th>Last Name</th>
				
				<th>Number Of Days</th>
				<th>Interest</th>
				<th>Deposit Amount</th>
				<th>Start Date</th>
				<th>Mature Date</th>
				<th>Maturity Amount</th>
				<th>Remarks</th>
				
			</tr>
		</thead>
		
		<tbody>
			
			
			@foreach($FDTranBranchWiseData['FdBWData'] as $fdallocation)
			<tr>
				<td>{{ $fdallocation->Fd_CertificateNum }}</td>
				
				<td>{{ $fdallocation->FirstName }}</td>
				<td>{{ $fdallocation->MiddleName}}</td>
				<td>{{ $fdallocation->LastName }}</td>
				
				<td>{{ $fdallocation->NumberOfDays }}</td>
				<td>{{ $fdallocation->FdInterest }}</td>
				<td>{{ $fdallocation->Fd_DepositAmt }}</td>	
				<td>{{$fdallocation->Fd_StartDate}}
					<td>{{ $fdallocation->Fd_MatureDate}}</td>
					<td>{{ $fdallocation->Fd_TotalAmt}}</td>
					<td>{{ $fdallocation->Fd_Remarks}}</td>
					
				</tr>
				@endforeach
				
				
			</tbody>
		</table>
		
		
		<div id='pagei<?php echo $FDTranBranchWiseData['module']->Mid; ?>'>
			
			
			
			{!! $FDTranBranchWiseData['FdBWData']->appends(Input::except('page'))->render() !!}
			
		</div>
	</div>
	
	<script>
		
		$("#pagei<?php echo $FDTranBranchWiseData['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $FDTranBranchWiseData['module']->Mid; ?>");
		
	});
	
	$('.loadmc<?php echo $FDTranBranchWiseData['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('.SearchRes<?php echo $FDTranBranchWiseData['module']->Mid; ?>').load($(this).attr('href'));
	});
	</script>
