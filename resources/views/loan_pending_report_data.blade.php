




						<table class="table table-striped table-bordered bootstrap-datatable datatable responsive export_table" id="loan_pending_report_table">
							<thead>
								<tr>
									<th>No.</th>
									<th>Name</th>
									<th>Loan No.</th>
									<th>Remaining Amount</th>
									<th>End Date</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($data['det'] as $key=>$row)
									<tr>
										<td>{{ $key + 1 }}</td>
										<td>{{ $row->FirstName }} {{ $row->MiddleName }} {{ $row->LastName }}</td>
										<td>{{ $row->ln_no }}</td>
										<td>{{ $row->rem_amt }}</td>
										<td>{{ $row->end_date }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>