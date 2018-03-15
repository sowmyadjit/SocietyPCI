<div  id="toprint">
<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
				<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
				<!--this css should be inside the toprint div , for printing the table borders-->
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						<th>Deposit Date</th>
						<th>Branch</th>
						<th>Deposit Bank</th>
						<th>Payment Mode</th>
						<th>Cheque No</th>
						<th>Cheque Date</th>
						<th>Amount</th>
						
						
					</tr>
					</thead>
					
					<tbody>
					
						
							@foreach($DepositInhandChq as $depositcheque)
								<tr>
									<td class="hidden">{{ $depositcheque->d_id }}</td>
									
									<td>{{ $depositcheque->d_date }}</td>
									<td>{{ $depositcheque->Branch }}</td>
									<td>{{ $depositcheque->depo_bank }}</td>
									<td>{{ $depositcheque->pay_mode }}</td>	
									<td>{{ $depositcheque->cheque_no }}</td>	
									<td>{{ $depositcheque->cheque_date }}</td>	
									<td>{{ $depositcheque->amount }}</td>	
									
								
								</tr>
							@endforeach
						
						
					</tbody>
	</table>
				
				
				<div id='pagei'>
		{!! $DepositInhandChq->appends(Input::except('page'))->render() !!}
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
	$('.SearchRes').load($(this).attr('href'));
});
	</script>
