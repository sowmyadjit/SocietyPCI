
							<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
							<thead>
								<tr>
									<th>SL NO.</th>
									<th>Customer ID</th>
									<th>Name</th>
									<th>Loan Number</th>
									<th>Loan Amount</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Pending Amount</th>
									<th>Closed?</th>
									<th>Interest Paid Till</th>
									@if($ret_data['loan_category'] == "JL")
										<th>Jewel Description</th>
										<th>Net Weight</th>
									@endif
								</tr>
							</thead>
							<tbody>
								<?php $i=0;?>
								<tr>
									@foreach ($ret_data['loan_details'] as $row)
										<tr>
											<td>{{++$i}}</td>
											<td>{{ $row['user_id'] }}</td>
											<td>{{ $row['name'] }}</td>	
											<td>{{ $row['loan_no'] }}/{{ $row['loan_old_no'] }}</td>
											<td>{{ $row['loan_amount']}}</td>
											<td>{{ $row['start_date']}}</td>
											<td>{{$row['end_date']}}</td>
											<td>{{$row['ramaining_amount']}}</td>
											<td>{{$row['closed']}}</td>
											<td>{{$row['interest_paid_upto']}}</td>
											@if($ret_data['loan_category'] == "JL")
												<td>{{$row['jewel_description']}}</td>
												<td>{{$row['net_weight']}} </td>
											@endif
										</tr>
									@endforeach
								</tbody>
							</table>
							</div>
							
							
							
							
							
							