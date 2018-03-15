<div  id="toprint<?php echo $AgentPigmiRepData['module']->Mid; ?>">
	<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
	<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
	<!--this css should be inside the toprint div , for printing the table borders-->
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
		
		<thead>
			<tr>
				<th>Transaction Date</th>
				<th>Account Number</th>
				<th>Full Name</th>
				
				<th>Current Balance</th>
				<th>Credited Amount</th>
				<th>Total Balance</th>
				
			</tr>
		</thead>
		
		<tbody>
			
			
			@foreach($AgentPigmiRepData['AgentSingleDayReport'] as $PABD)
			<tr>
				<td class="hidden">{{ $PABD->PigmiTrans_ID }}</td>
				<td><?php $trandate=date("d-m-Y",strtotime($PABD->PigReport_TranDate)); echo $trandate; ?></td>
				<td>{{ $PABD->PigmiAcc_No }} - {{ $PABD->old_pigmiaccno }}</td>
				<td>{{ $PABD->FirstName }}.{{ $PABD->MiddleName }}.{{ $PABD->LastName }}</td>
				<td><p class="text-right"><?php $amt=$PABD->Current_Balance; echo round($amt,2); ?></p></td>
				
				<td><p class="text-right"><?php $amt=$PABD->Amount; echo round($amt,2); ?></p></td>
				<td><p class="text-right"><?php $amt=$PABD->Total_Amount; echo round($amt,2); ?></p></td>
				
				
			</tr>
			@endforeach
			
			
		</tbody>
	</table>
	
	
	<div id='pagei<?php echo $AgentPigmiRepData['module']->Mid; ?>'>
		
		
		
		{!! $AgentPigmiRepData['AgentSingleDayReport']->appends(Input::except('page'))->render() !!}
		
	</div>
</div>

<script>
	
	
	
	
	
	$("#pagei<?php echo $AgentPigmiRepData['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $AgentPigmiRepData['module']->Mid; ?>");
		
	});
	
	$('.loadmc<?php echo $AgentPigmiRepData['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('.SearchRes<?php echo $AgentPigmiRepData['module']->Mid; ?>').load($(this).attr('href'));
	});
</script>
