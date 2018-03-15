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
			
			
			@foreach($SbTranBranchWiseData as $SBBD)
			<tr>
				<td class="hidden">{{ $SBBD->Tranid }}</td>
									<td>{{ $SBBD->BName }}</td>
									<td class="hidden">{{ $SBBD->Tranid }}</td>
									<td><?php $trandate=date("d-m-Y",strtotime($SBBD->SBReport_TranDate)); echo $trandate; ?> </td>
									<td>{{ $SBBD->AccNum }}</td>
									<td>{{ $SBBD->TransactionType }}</td>
									<td>{{ $SBBD->particulars }}</td>
									<td>{{ $SBBD->CurrentBalance }}</td>
									<td>{{ $SBBD->Amount }}</td>
									<td>{{ $SBBD->Total_Bal }}</td>
				
			</tr>
			@endforeach
			
			
		</tbody>
	</table>
	
	
	<div id='pagei'>
		
		
		
		{!! $SbTranBranchWiseData->appends(Input::except('page'))->render() !!}
		
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
