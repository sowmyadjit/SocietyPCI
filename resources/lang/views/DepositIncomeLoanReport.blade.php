<div  id="toprint">
<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
				<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
				<!--this css should be inside the toprint div , for printing the table borders-->   
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						<th>Deposit Loan Number</th>
						<th>Deposit Loan Charges</th>
						
						
						
					</tr>
					</thead>
					
					<tbody>
						@foreach($incomedepo['datadep'] as $depos)
						<tr>
							<td class="hidden">{{ $depos->DepLoanAllocId }}</td>
							
							
							<td>{{ $depos->DepLoan_LoanNum }}</td>
							<td>{{ $depos->DepLoan_LoanCharge }}</td>
							
							
						
						
							
							
						
							
						</tr>
						@endforeach
					</tbody>
					</table>
				
				<div id='pagei'>
			
				{!!$incomedepo['datadep']->appends(Input::except('page'))->render() !!}

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