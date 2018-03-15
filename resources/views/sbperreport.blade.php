<div  id="toprint<?php echo $sbsr['module']->Mid; ?>">
	<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
	<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
	<!--this css should be inside the toprint div , for printing the table borders-->   
	
	<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
		
		<thead>
			<tr>
				<th>Date</th>
				<th>Name</th>
				<th>Account Number</th>
				<th>Transaction Type</th>
				<th>Perticulars</th>
				<th>Previous Balance</th>
				<th>Amount</th>
				<th>Total Balance</th>
				
			</tr>
		</thead>
		
		<tbody>
			@foreach ($sbsr['SbPerData'] as $sb_transaction)
			<tr>
				<td class="hidden">{{ $sb_transaction->Tranid }}</td>
				<td><?php $trandate=date("d-m-Y",strtotime($sb_transaction->SBReport_TranDate)); echo $trandate; ?></td>
						<td>{{ $sb_transaction->FirstName }}.{{ $sb_transaction->MiddleName }}.{{ $sb_transaction->LastName }}</td>
				<td>{{ $sb_transaction->AccNum }}</td>
				<td>{{ $sb_transaction->TransactionType }}</td>
				<td>{{ $sb_transaction->particulars }}</td>
				<td>{{ $sb_transaction->CurrentBalance }}</td>
				<td>{{ $sb_transaction->Amount }}</td>
				<td>{{ $sb_transaction->Total_Bal }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	
	<div id='pagei<?php echo $sbsr['module']->Mid; ?>'>
		{!! $sbsr['SbPerData']->appends(Input::except('page'))->render() !!}
	</div>
</div>


<script>
	
	$("#pagei<?php echo $sbsr['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $sbsr['module']->Mid; ?>");
		
	});
	
	$('.loadmc<?php echo $sbsr['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('.SearchRes<?php echo $sbsr['module']->Mid; ?>').load($(this).attr('href'));
	});
</script>