



						<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
							<thead>
								<tr>
									<th>Serial No.</th>
									<th class="hide">Member_id</th>
									<th>Date</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Branch</th>
									<th>Share_Class</th>
									<th>Member_no</th>
									<th>Name</th>
									<th>Amount Paid</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i = 1;
								?>
								@foreach ($data["transactions"] as $row)
									<tr>
										<td>{{ $i++ }}</td>
										<td class="hide">{{ $row->member_id }}</td>
										<td>{{ $row->transaction_date }}</td>
										<td>{{ $row->start_date }}</td>
										<td>{{ $row->end_date }}</td>
										<td>{{ $row->BName }}</td>
										<td>{{ $row->Share_Class }}</td>
										<td>{{ $row->Member_no }}</td>
										<td>{{ $row->FirstName }} {{ $row->MiddleName }} {{ $row->LastName }}</td>
										<td>{{ $row->divident_amount }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						
						


<script>
</script>
