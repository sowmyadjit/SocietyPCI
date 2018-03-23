<div  id="toprint<?php echo $rdsr['module']->Mid; ?>">
	<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
	<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
	<!--this css should be inside the toprint div , for printing the table borders-->   
	
	<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
		<tr>
			<th>Name</th>
			<td>{{ $rdsr['RdPerData'][0]->FirstName }}.{{ $rdsr['RdPerData'][0]->MiddleName }}.{{ $rdsr['RdPerData'][0]->LastName }}</td>
		</tr>
		<tr>
			<th>Account Number</th>
			<td>{{ $rdsr['RdPerData'][0]->AccNum }}</td>
		</tr>
		<tr>
			<th>Interest Rate</th>
			<td>{{$rdsr['RdDet']->Intrest}}%</td>
		</tr>
		<tr>
			<th>Duration</th>
			<td>{{$rdsr['RdDet']->Duration}}</td>
		</tr>
	</table>
	<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
		
		<thead>
			<tr>
				<th>Date</th>
				<th>Transaction Type</th>
				<th>Perticulars</th>
				<th>Amount</th>
				<th>Current Blance</th>
				<th>Total Blance</th>
				
			</tr>
		</thead>
		
		<tbody>
			@foreach ($rdsr['RdPerData'] as $rd_transaction)
			<tr>
				<td class="hidden">{{ $rd_transaction->RD_TransID }}</td>
				<td><?php $trandate=date("d-m-Y",strtotime($rd_transaction->RDReport_TranDate)); echo $trandate; ?></td>
				<td>{{ $rd_transaction->RD_Trans_Type }}</td>
				<td>{{ $rd_transaction->RD_Particulars }}</td>
				<td>{{ $rd_transaction->RD_Amount }}</td>
				<td>{{ $rd_transaction->RD_CurrentBalance }}</td>
				<td>{{ $rd_transaction->RD_Total_Bal }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	
	<div id='pageird<?php echo $rdsr['module']->Mid; ?>'>
		{!! $rdsr['RdPerData']->appends(Input::except('page'))->render() !!}
		
	</div>
</div>


<script>
	
	$("#pageird<?php echo $rdsr['module']->Mid; ?> > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $rdsr['module']->Mid; ?>");
		
	});
	
	$('.loadmc<?php echo $rdsr['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		$('.SearchResRd<?php echo $rdsr['module']->Mid; ?>').load($(this).attr('href'));
	});
</script>