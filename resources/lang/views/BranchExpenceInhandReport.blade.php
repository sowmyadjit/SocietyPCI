<div  id="toprint">
<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
				<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
				<!--this css should be inside the toprint div , for printing the table borders-->
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						<th>Expense Date</th>
						<th>Pay Mode</th>
						<th>Amount</th>
						<th>Particulars</th>
						
						
					</tr>
					</thead>
					
					<tbody>
					
						
							@foreach($ExpenceInhandRep['BExpInHand'] as $expenseInhand)
								<tr>
									<td class="hidden">{{ $expenseInhand->id }}</td>
									
									<td><?php $trandate=date("d-m-Y",strtotime($expenseInhand->e_date)); echo $trandate; ?> </td>
									<td>{{ $expenseInhand->pay_mode }}</td>
									<td>{{ $expenseInhand->amount }}</td>
									<td>{{ $expenseInhand->Particulars }}</td>	
									
								
								</tr>
							@endforeach
						
						
					</tbody>
	</table>
				
				
				<div id='pagei'>
		{!! $ExpenceInhandRep['BExpInHand']->appends(Input::except('page'))->render() !!}
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
