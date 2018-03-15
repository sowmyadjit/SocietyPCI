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
						
						<th>Month Total Amount</th>
						<th>Interest Amount</th>
						
						<th>Interest Month</th>
						<th>Interest Year</th>
						
						<th>Amount Payable</th>
						<th>STATUS</th>
						
						
						
					</tr>
					</thead>
					
					<tbody>
					
						
							@foreach($MaturedPigmiReport as $PCR)
								<tr>
									<td class="hidden">{{ $PCR->PgmInterest_ID }}</td>
									
									<td><?php $trandate=date("d-m-Y",strtotime($PCR->PgmInt_Date)); echo $trandate; ?> </td>
									<td>{{ $PCR->PigmiAcc_No }}</td>
									<td>{{ $PCR->FirstName }}.{{ $PCR->MiddleName }}.{{ $PCR->LastName }}</td>
									<td>{{ $PCR->Pigmi_Type }}</td>
									
									<td>{{ $PCR->Monthtotal_Amount }}</td>	
									<td>{{ $PCR->Interest_Amt }}</td>	
									
									<td>{{ $PCR->Month }}</td>	
									<td>{{ $PCR->Year }}</td>	
									
									<td>{{ $PCR->Amount_Payable }}</td>
									<td>{{ $PCR->Paid_State }}</td>	
									
									
								
								</tr>
							@endforeach
						
						
					</tbody>
	</table>
				
				
				<div id='pagei'>
				
				
		
		{!! $MaturedPigmiReport->render() !!}
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
