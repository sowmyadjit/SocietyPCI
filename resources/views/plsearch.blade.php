


						<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
							<thead>
								<tr>
									<th>Name</th>
									<th>Loan Number</th>
									<th>Loan Amount</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Pending Amount</th>
								</tr>
							</thead>
							<tbody>
									@foreach ($data as $loan_allocation)
									<tr>
										<td class="hidden">{{ $loan_allocation->PersLoanAllocID }}</td>
										<td class="hidden">{{ $loan_allocation->MemId }}</td>
										
										<td>{{ $loan_allocation->FirstName }}.{{ $loan_allocation->MiddleName }}.{{ $loan_allocation->LastName }}</td>	
										<td><a  href="memberdetails/{{ $loan_allocation->MemId }}" class="memdet">{{ $loan_allocation->PersLoan_Number }}/{{ $loan_allocation->Old_PersLoan_Number }}</a></td>	
										
										<td>{{ $loan_allocation->LoanAmt}}</td>
										<td>{{ $loan_allocation->StartDate}}</td>
										<td>{{$loan_allocation->EndDate}}</td>
										<td>{{$loan_allocation->RemainingLoan_Amt}}</td>
									</tr>
									@endforeach
							</tbody>
						</table>
						
						

<script>

	$('.memdet').click(function(e)
	{
		e.preventDefault();
		//alert($(this).attr('href'));
		$('.box-inner').load($(this).attr('href'));
	});

</script>			