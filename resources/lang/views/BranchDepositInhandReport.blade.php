<div  id="toprint">
<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
				<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
				<!--this css should be inside the toprint div , for printing the table borders-->
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						<th>Deposite Date</th>
						<th>Pay Mode</th>
						<th>Amount</th>
						
						
						
					</tr>
					</thead>
					
					<tbody>
					
						
							@foreach($DepositInhandRep as $depositInhand)
								<tr>
									<td class="hidden">{{ $depositInhand->d_id }}</td>
									
									<td>{{ $depositInhand->d_date }}</td>
									<td>{{ $depositInhand->pay_mode }}</td>
									<td>{{ $depositInhand->amount }}</td>
									
									
								
								</tr>
							@endforeach
						
						
					</tbody>
	</table>
				
				
				<div id='pagei'>
		{!! $DepositInhandRep->appends(Input::except('page'))->render() !!}
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
