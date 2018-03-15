<div  id="toprint">
<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
				<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
				<!--this css should be inside the toprint div , for printing the table borders-->
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						<th>Date</th>
						<th>Account Number</th>
						<th>Customer Name</th>
						<th>Pigmi Type</th>
						
						
						<th>Accumulated Amount</th>
						<th>Deducted Commision</th>
						<th>Deducted Amount</th>
						
						<th>Amount Payable</th>
						<th>CashPaid State</th>
						<th>Particulars</th>
						
						
					</tr>
					</thead>
					
					<tbody>
					
						
							@foreach($PrewithPigmiReport as $PWR)
								<tr>
									<td class="hidden">{{ $PWR->PgmPrewithdraw_ID }}</td>
									
									<td><?php $trandate=date("d-m-Y",strtotime($PWR->Withdraw_Date)); echo $trandate; ?> </td>
									<td>{{ $PWR->PigmiAcc_No }}</td>
									<td>{{ $PWR->FirstName }}.{{ $PWR->MiddleName }}.{{ $PWR->LastName }}</td>
									<td>{{ $PWR->Pigmi_Type }}</td>
									
									
									<td>{{ $PWR->PgmTotal_Amt }}</td>
									<td>{{ $PWR->Deduct_Commission }}</td>	
									<td>{{ $PWR->Deduct_Amount }}</td>	
									
									<td>{{ $PWR->TotalAmt_Payable }}</td>
									<td>{{ $PWR->CashPaid_State }}</td>
									<td>{{ $PWR->Particulars }}</td>
									
								
								</tr>
							@endforeach
						
						
					</tbody>
	</table>
				
				
				<div id='pagei'>
				
				
		
		{!! $PrewithPigmiReport->appends(Input::except('page'))->render() !!}
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
