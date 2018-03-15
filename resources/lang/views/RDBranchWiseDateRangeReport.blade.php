<script src="js/bootstrap-typeahead.js"></script> 
<div  id="toprint">
	
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
			
			
			@foreach($RDTranBranchWiseData as $SBBD)
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
	
	
	<div id='pagei'>
		
		
		
		{!! $RDTranBranchWiseData->appends(Input::except('page'))->render() !!}
		
	</div>
</div>

<script>
	
	
	
	
	
	$("ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc");
		
	});
	$('.loadmc').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.SearchRes').load($(this).attr('href'));// append the required param after href with + ,before that store those params in a global variable inside other div which is comman
	});
</script>
