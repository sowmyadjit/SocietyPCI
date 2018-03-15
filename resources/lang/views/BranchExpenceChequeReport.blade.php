<div  id="toprint">
<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
				<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
				<!--this css should be inside the toprint div , for printing the table borders-->
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						<th>Expense Date</th>
						<th>Bank Name</th>
						<th>Payment Mode</th>
						<th>Cheque Date</th>
						<th>Cheque Number</th>
						<th>Amount</th>
						<th>Particulars</th>
						
						
					</tr>
					</thead>
					
					<tbody>
					
						
							@foreach($ExpenceInhandChq['BExpCheque'] as $ExpenseCheque)
								<tr>
									<td class="hidden">{{ $ExpenseCheque->id }}</td>
									
									<td><?php $trandate=date("d-m-Y",strtotime($ExpenseCheque->e_date)); echo $trandate; ?> </td>
									
									<td>{{ $ExpenseCheque->bank }}</td>
									<td>{{ $ExpenseCheque->pay_mode }}</td>
									
									<td><?php $trandate=date("d-m-Y",strtotime($ExpenseCheque->cheque_date)); echo $trandate; ?> </td>
									<td>{{ $ExpenseCheque->cheque_no }}</td>
									<td>{{ $ExpenseCheque->amount }}</td>
									<td>{{ $ExpenseCheque->Particulars }}</td>	
									
									
								
								</tr>
							@endforeach
						
						
					</tbody>
	</table>
				
				
				<div id='pagei'>
		
		{!! $ExpenceInhandChq['BExpCheque']->appends(Input::except('page'))->render() !!}
				</div>
</div>
				
	<script>
	$("#pagei > ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc");
		
	});
	
	$('.loadmc').click(function(e)
	{
		e.preventDefault();
		$('.SearchRes').load($(this).attr('href'));
	});
	</script>
