


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
										<td class="hidden">{{ $loan_allocation->StfLoanAllocID }}</td>
										
										<td>{{ $loan_allocation->FirstName }}.{{ $loan_allocation->MiddleName }}.{{ $loan_allocation->LastName }}</td>	
										<td>{{ $loan_allocation->StfLoan_Number }}/{{ $loan_allocation->old_saffloan_no }}</td>	
										
										<td>{{ $loan_allocation->LoanAmt}}</td>
										<td>{{ $loan_allocation->StartDate}}</td>
										<td>{{$loan_allocation->EndDate}}</td>
										<td>{{$loan_allocation->StaffLoan_LoanRemainingAmount}}</td>
									</tr>
									@endforeach
							</tbody>
						</table>
						
						

<script>


</script>			