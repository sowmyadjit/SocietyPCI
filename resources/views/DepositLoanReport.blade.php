<div  id="toprint<?php echo $loandeposit['module']->Mid; ?>">
<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
				<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
				<!--this css should be inside the toprint div , for printing the table borders-->   
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						<th>Loan Number</th>
						<th>Loan Type</th>
						<th>Account Number</th>
						<th>Loan Amount</th>
						<th>Loan Charge</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Duration</th>
						<th>Remaining Amount</th>
						<th>EMI Amount</th>
						
						
					</tr>
					</thead>
					
					<tbody>
						@foreach($loandeposit['datadeposit'] as $deposit)
						<tr>
							<td class="hidden">{{ $deposit->DepLoanAllocId }}</td>
							
							
							<td>{{ $deposit->DepLoan_LoanNum }}</td>
							<td>{{ $deposit->DepLoan_DepositeType }}</td>
							
						
						
							<td>{{ $deposit->DepLoan_AccNum }}</td>
							<td>{{ $deposit->DepLoan_LoanAmount }}</td>
							<td>{{ $deposit->DepLoan_LoanCharge }}</td>
							<td>{{ $deposit->DepLoan_LoanStartDate }}</td>
							<td>{{ $deposit->DepLoan_LoanEndDate }}</td>
							<td>{{ $deposit->DepLoan_LoanDurationDays }}</td>
							<td>{{ $deposit->DepLoan_RemailningAmt }}</td>
							<td><?php $amt=$deposit->EMI_Amount; echo round($amt,2);?></td>
							
						
							
						</tr>
						@endforeach
					</tbody>
					</table>
				
				<div id='pagei<?php echo $loandeposit['module']->Mid; ?>'>
			
				{!!$loandeposit['datadeposit']->appends(Input::except('page'))->render() !!}

				</div>
</div>
				
				
	<script>

	
	$("#pagei<?php echo $loandeposit['module']->Mid; ?>.pagination li a").each(function() {
 
    $(this).addClass("loadmc<?php echo $loandeposit['module']->Mid; ?>");
  
});
$('.loadmc<?php echo $loandeposit['module']->Mid; ?>').click(function(e)
{
	e.preventDefault();
	//alert($(this).attr('href'));
	$('.SearchRes<?php echo $loandeposit['module']->Mid; ?>').load($(this).attr('href'));
});
	</script>