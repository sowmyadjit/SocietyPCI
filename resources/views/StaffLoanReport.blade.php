<div  id="toprint<?php echo $loanstaff['module']->Mid; ?>">
<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
				<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
				<!--this css should be inside the toprint div , for printing the table borders-->   
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						<th>Loan Number</th>
						<th>Loan Amount</th>
						<th>Other Charges</th>
						<th>BookForm Charges</th>
						<th>Adjustment Charges</th>
						<th>Share Charges</th>
						<th>Payable Amount</th>
						<th>Loan Duration</th>
						<th>Staff Surety</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Remaining Amount</th>
						<th>EMI Amount</th>
						
						
					</tr>
					</thead>
					
					<tbody>
						@foreach($loanstaff['datastaff'] as $staff)
						<tr>
							<td class="hidden">{{ $staff->StfLoanAllocID }}</td>
							
							
							<td>{{ $staff->StfLoan_Number }}</td>
							<td>{{ $staff->LoanAmt }}</td>
							<td><?php $amt=$staff->otherCharges; echo round($amt,2);?></td>
							<td><?php $amt=$staff->Book_FormCharges; echo round($amt,2);?></td>
						
						
						
							<td>{{ $staff->AjustmentCharges }}</td>
							<td>{{ $staff->ShareCharges }}</td>
							<td>{{ $staff->PayableAmt }}</td>
							<td>{{ $staff->LoandurationYears }}</td>
							<td>{{ $staff->Staff_Surety }}</td>
							<td>{{ $staff->StartDate }}</td>
							<td>{{ $staff->EndDate }}</td>
							
							<td><?php $amt=$staff->StaffLoan_LoanRemainingAmount; echo round($amt,2);?></td>
						
							<td>{{ $staff->EMI_Amount }}</td>
							
						
							
						</tr>
						@endforeach
					</tbody>
					</table>
				
<?php /*
				<div id='pagei<?php echo $loanstaff['module']->Mid; ?>'>
			
				{!!$loanstaff['datastaff']->appends(Input::except('page'))->render() !!}

				</div>
*/?>
</div>
				
				
	<script>
	
	$("#pagei<?php echo $loanstaff['module']->Mid; ?>.pagination li a").each(function() {
 
    $(this).addClass("loadmc<?php echo $loanstaff['module']->Mid; ?>
  
});
$('.loadmc<?php echo $loanstaff['module']->Mid; ?>').click(function(e)
{
	e.preventDefault();
	//alert($(this).attr('href'));
	$('.SearchRes<?php echo $loanstaff['module']->Mid; ?>').load($(this).attr('href'));
});
	</script>