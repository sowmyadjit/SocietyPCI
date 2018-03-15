<script src="js/bootstrap-typeahead.js"></script> 
<div  id="toprint<?php echo $RDTranBranchWiseData['module']->Mid; ?>">
	
	<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
	<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
	<!--this css should be inside the toprint div , for printing the table borders-->
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
		
		<thead>
			<tr>
				<th>BRANCH</th>
				<th>Date</th>
				<th>Account Number</th>
				<th>Transaction Type</th>
				<th>Perticulars</th>
				<th>Previous Balance</th>
				<th>Amount</th>
				<th>Total Balance</th>
				
			</tr>
		</thead>
		
		<tbody>
			
			
			@foreach($RDTranBranchWiseData['RdBWData'] as $SBBD)
			<tr>
				<td class="hidden">{{ $SBBD->RD_TransID }}</td>
				<td>{{ $SBBD->BName }}</td>
				<td class="hidden">{{ $SBBD->RD_TransID }}</td>
				<td><?php $trandate=date("d-m-Y",strtotime($SBBD->RDReport_TranDate)); echo $trandate; ?> </td>
				<td>{{ $SBBD->AccNum }}</td>
				<td>{{ $SBBD->RD_Trans_Type }}</td>
				<td>{{ $SBBD->RD_Particulars }}</td>
				<td>{{ $SBBD->RD_CurrentBalance }}</td>
				<td>{{ $SBBD->RD_Amount }}</td>
				<td>{{ $SBBD->RD_Total_Bal }}</td>
				
			</tr>
			@endforeach
			
			
		</tbody>
	</table>
	
	
	<div id='pagei<?php echo $RDTranBranchWiseData['module']->Mid; ?>'>
		
		
		
		{!! $RDTranBranchWiseData['RdBWData']->appends(Input::except('page'))->render() !!}
		
	</div>
</div>

<script>
	
	
	
	
	
	$("#pagei<?php echo $RDTranBranchWiseData['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $RDTranBranchWiseData['module']->Mid; ?>");
		
	});
	
	$('.loadmc<?php echo $RDTranBranchWiseData['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('.SearchRes<?php echo $RDTranBranchWiseData['module']->Mid; ?>').load($(this).attr('href'));
	});
</script>
