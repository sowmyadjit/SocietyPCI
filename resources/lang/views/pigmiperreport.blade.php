<div  id="toprint">
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
					
						
							@foreach($psr as $pigmi_transaction)
								<tr>
									<td class="hidden">{{ $pigmi_transaction->PigmiTrans_ID }}</td>
									
									<td><?php $trandate=date("d-m-Y",strtotime($pigmi_transaction->PigReport_TranDate)); echo $trandate; ?> </td>
									<td>{{ $pigmi_transaction->FirstName }}.{{ $pigmi_transaction->MiddleName }}.{{ $pigmi_transaction->LastName }}</td>
									<td>{{ $pigmi_transaction->PigmiAcc_No }}/{{ $pigmi_transaction->old_pigmiaccno }}</td>
									
									<td>{{ $pigmi_transaction->Agentid }}</td>
									<td>{{ $pigmi_transaction->Pigmi_Type }}</td>
									<td>{{ $pigmi_transaction->Current_Balance }}</td>
									<td>{{ $pigmi_transaction->Amount }}</td>	
									<td>{{ $pigmi_transaction->Total_Amount }}</td>
									
								
								</tr>
							@endforeach
						
						
					</tbody>
	</table>
				
				
				<div id='pagei'>
				
				<!--{!! $psr->render() !!}-->
		
		{!! $psr->appends(Input::except('page'))->render() !!}
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
