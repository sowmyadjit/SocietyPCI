<div  id="toprint<?php echo $incomedepo['module']->Mid; ?>">
<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
				<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
				<!--this css should be inside the toprint div , for printing the table borders-->   
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						<th>Deposit Loan Number</th>
						<th>Name</th>
						<th>Deposit Loan Charges</th>
						
						
						
					</tr>
					</thead>
					
					<tbody>
						@foreach($incomedepo['datadep'] as $depos)
						<tr>
							<td class="hidden">{{ $depos->DepLoanAllocId }}</td>
							
							
							<td>{{ $depos->DepLoan_LoanNum }}/{{ $depos->Old_loan_number }}</td>
							<td>{{ $depos->FirstName }}.{{ $depos->MiddleName }}.{{ $depos->LastName }}</td>
							<td>{{ $depos->DepLoan_LoanCharge }}</td>
							
							
						
						
							
							
						
							
						</tr>
						@endforeach
					</tbody>
					</table>
				
				<div id='pagei<?php echo $incomedepo['module']->Mid; ?>'>
			
				{!!$incomedepo['datadep']->appends(Input::except('page'))->render() !!}

				</div>
</div>
				
				
	<script>
	
	$("#pagei<?php echo $incomedepo['module']->Mid; ?>ul.pagination li a").each(function() {
 
    $(this).addClass("loadmc<?php echo $incomedepo['module']->Mid; ?>");
  
});
$('.loadmc<?php echo $incomedepo['module']->Mid; ?>').click(function(e)
{
	e.preventDefault();
	//alert($(this).attr('href'));
	$('.SearchRes<?php echo $incomedepo['module']->Mid; ?>').load($(this).attr('href'));
});
	</script>