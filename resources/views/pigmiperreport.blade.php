<div  id="toprint<?php echo $psr['module']->Mid; ?>">
	<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
	<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
	<!--this css should be inside the toprint div , for printing the table borders-->
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
		
		<thead>
			<tr>
				<th>Date</th>
				<th>Name</th>
				<th>Account Number</th>
				
				<th>Agent Id </th>
				<th>Pigmi Type</th>
				<th>Current Balance</th>
				<th>Credited Amount</th>
				<th>Total Blance</th>
				
				
			</tr>
		</thead>
		
		<tbody>
			
			
			@foreach($psr['PigmyPerData'] as $pigmi_transaction)
			<tr>
				<td class="hidden">{{ $pigmi_transaction->PigmiTrans_ID }}</td>
				
				<td><?php $trandate=date("d-m-Y",strtotime($pigmi_transaction->PigReport_TranDate)); echo $trandate; ?> </td>
				<td>{{ $pigmi_transaction->PigmiAcc_No }}</td>
				<td>{{ $pigmi_transaction->PigmiAcc_No }}/{{ $pigmi_transaction->old_pigmiaccno }}</td>
				<td>{{ $pigmi_transaction->Agentid }}</td>
				<td>{{ $pigmi_transaction->Pigmi_Type }}</td>
				<td>{{ $pigmi_transaction->Current_Balance }}</td>
				<td>{{ $pigmi_transaction->Amount }}</td>	
				<td>{{ $pigmi_transaction->Total_Amount }}</td>
				
				
			</tr>
			@endforeach
			<td>TOTAL:{{ $psr['PigmyPerDatatotal']}}</td>
			
		</tbody>
	</table>
	
	
	<div id='pagei<?php echo $psr['module']->Mid; ?>'>
		{!! $psr['PigmyPerData']->appends(Input::except('page'))->render() !!}
	</div>
</div>

<script>
	$("#pagei<?php echo $psr['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $psr['module']->Mid; ?>");
		
	});
	
	$('.loadmc<?php echo $psr['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('.SearchRes<?php echo $psr['module']->Mid; ?>').load($(this).attr('href'));
	});
</script>
