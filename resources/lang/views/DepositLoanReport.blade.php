<div  id="toprint">
<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
				<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
				<!--this css should be inside the toprint div , for printing the table borders-->   
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						<th>Loan Number</th>
						<th>Name</th>
						<th>Loan Type</th>
						<th>Account Number</th>
						<th>Loan Amount</th>
						<th>Loan Charge</th>
						<th>Start Date</th>
						<th>End Date</th>
						
						<th>Remaining Amount</th>
						<th>EMI Amount</th>
						
						
					</tr>
					</thead>
					
					<tbody>
						@foreach($loandeposit['datadeposit'] as $deposit)
						<tr>
							<td class="hidden">{{ $deposit->DepLoanAllocId }}</td>
							
							
							<td>{{ $deposit->DepLoan_LoanNum }} / {{ $deposit->Old_loan_number }}</td>
							<td>{{ $deposit->FirstName }}.{{ $deposit->MiddleName }}.{{ $deposit->LastName }}</td>
							<td>{{ $deposit->DepLoan_DepositeType }}</td>
							
						
						
							<td>{{ $deposit->DepLoan_AccNum }} / {{ $deposit->Old_Accnum }}</td>
							<td>{{ $deposit->DepLoan_LoanAmount }}</td>
							<td>{{ $deposit->DepLoan_LoanCharge }}</td>
							<td>{{ $deposit->DepLoan_LoanStartDate }}</td>
							<td>{{ $deposit->DepLoan_LoanEndDate }}</td>
							
							<td>{{ $deposit->DepLoan_RemailningAmt }}</td>
							<td><?php $amt=$deposit->EMI_Amount; echo round($amt,2);?></td>
							
						
							
						</tr>
						@endforeach
					</tbody>
					</table>
				
				<div id='pagei'>
			
				{!!$loandeposit['datadeposit']->appends(Input::except('page'))->render() !!}

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