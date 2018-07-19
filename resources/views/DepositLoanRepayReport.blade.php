<div  id="toprint<?php echo $loandeposit['module']->Mid; ?>">
	<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
	<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
	<!--this css should be inside the toprint div , for printing the table borders-->   
	
	<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
		
		<thead>
			<tr>
				<th>Date</th>
				<th>Loan Number</th>
				<th>Loan Type</th>
				<th>Account Number</th>
				<th>Name</th>
				<th>Amount Paid</th>
				<th>Interest Calculated</th>
				<th>Interest Paid</th>
				<th>Interest Pending</th>
				<th>Principal Amount Paid</th>
				<th>Action</th>
				
				
				
			</tr>
		</thead>
		
		<tbody>
			@foreach($loandeposit['datadeposit'] as $deposit)
			<tr>
				<td class="hidden">{{ $deposit->DLRepay_ID }}</td>
				
				
				<td>{{ $deposit->DLRepay_Date }}</td>
				<td>{{ $deposit->DepLoan_LoanNum }}/{{ $deposit->Old_loan_number }}</td>
				<td>{{ $deposit->DepLoan_DepositeType }}</td>
				
				
				
				<td>{{ $deposit->DepLoan_AccNum }}/{{ $deposit->Old_Accnum }}</td>
				<td>{{ $deposit->FirstName }}.{{ $deposit->MiddleName }}.{{ $deposit->LastName }}</td>
				<td>{{ $deposit->DLRepay_PaidAmt }}</td>
				
				
				<td><?php $amt=$deposit->DLRepay_Interestcalculated; echo round($amt,2);?></td>
				<td><?php $amt=$deposit->DLRepay_InterestPaid; echo round($amt,2);?></td>
				<td><?php $amt=$deposit->DLRepay_InterestPending; echo round($amt,2);?></td>
				<td><?php $amt=$deposit->DLRepay_PrincipalPaid; echo round($amt,2);?></td>
				
				<td>
					
					<input type="button" value="RECEIPT" class="btn btn-info btn-sm ReceiptPrint<?php echo $loandeposit['module']->Mid; ?>" href="DLloanrepayReceipt/{{ $deposit->DLRepay_ID }}"/>
					
				</td>
				
			</tr>
			@endforeach
		</tbody>
	</table>
	
<?php /*
	<div id='pagei<?php echo $loandeposit['module']->Mid; ?>'>
		
		{!!$loandeposit['datadeposit']->appends(Input::except('page'))->render() !!}
		
	</div>
*/?>
</div>


<script>
	
	$("#pagei<?php echo $loandeposit['module']->Mid; ?>ul.pagination li a").each(function() {
		
		$(this).addClass("loadmc<?php echo $loandeposit['module']->Mid; ?>");
		
	});
	$('.ReceiptPrint<?php echo $loandeposit['module']->Mid; ?>').click(function(e){
				e.preventDefault();
				//alert($(this).attr('href'));
				$('.box-inner').load($(this).attr('href'));
			});
	$('.loadmc<?php echo $loandeposit['module']->Mid; ?>').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.SearchRes<?php echo $loandeposit['module']->Mid; ?>').load($(this).attr('href'));
	});
</script>