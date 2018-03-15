<div  id="toprint">
<link href="css/bootstrap.min.css" rel='stylesheet' type="text/css" media="all">
				<link href="css/bootstrap-cerulean.min.css" rel='stylesheet' type="text/css" media="all">
				<!--this css should be inside the toprint div , for printing the table borders-->   
					
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
					
					<thead>
					<tr>
						<th>Member Name</th>
						<th>Personal Loan Number</th>
						<th>Loan Amount</th>
						<th>Other Charges</th>
						<th>Book Form Charges</th>
						
						<th>Share Charges</th>
						<th>Payable Amount</th>
						<th>Loan Duration</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>EMI Amount</th>
						<th>Remaining Amount</th>
						
					</tr>
					</thead>
					
					<tbody>
						@foreach ($loanpersonal['datapersonal'] as $personal)
						<tr>
							<td class="hidden">{{ $personal->PersLoanAllocID }}</td>
							<td>{{ $personal->FirstName }}.{{ $personal->MiddleName }}.{{ $personal->LastName }}</td>
							<td class="hidden">{{ $personal->MemId }}</td>
							<td>{{ $personal->PersLoan_Number }}/{{ $personal->Old_PersLoan_Number }}</td>
							<td>{{ $personal->LoanAmt }}</td>
							
							<td><?php $amt=$personal->otherCharges; echo round($amt,2);?></td>
							<td><?php $amt=$personal->Book_FormCharges; echo round($amt,2);?></td>
							
						
							<td>{{ $personal->ShareCharges }}</td>
							<td>{{ $personal->PayableAmt }}</td>
							<td>{{ $personal->LoandurationYears }}</td>
							<td>{{ $personal->StartDate }}</td>
							<td>{{ $personal->EndDate }}</td>
							
							<td><?php $amt=$personal->EMI_Amount; echo round($amt,2);?></td>
							<td><?php $amt=$personal->RemainingLoan_Amt; echo round($amt,2);?></td>
							
						</tr>
						@endforeach
					</tbody>
					</table>
				
				<div id='pagei'>
			
				{!! $loanpersonal['datapersonal']->appends(Input::except('page'))->render() !!}

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