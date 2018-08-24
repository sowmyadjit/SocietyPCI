<?php
	$day_open_status = $ret_data["day_open_status"];
?>

<style>
	.hide_it {
		opacity: 0.5;
		height: 1px;
		overflow: scroll;
	}
</style>



							<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" >
								<thead>
									<tr>
										<th>Sl. No.</th>
										<th>Customer ID</th>
										<th>Customer Name</th>
										<th>User Type</th>
										<th>Account Number</th>
										<th>Security Deposit Amount</th>
									</tr>
								</thead>
							<tbody>
								<?php $i=0;?>
								<tr>
									@foreach ($ret_data['deposit_details'] as $row)
										<tr>
											<td>{{++$i}}</td>
											<td>{{ $row['user_id'] }}</td>
											<td>{{ $row['name'] }}</td>	
											<td>{{ $row['user_type'] }}</td>	
											<td>{{$row['account_no'] }}</td>
											<td>{{ $row['amount']}}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
							
							
							
							
						<div id="toprint_data" class="hide_it">
							<table class="table table-striped table-bordered bootstrap-datatable datatable responsive" >
								<thead>
									<tr>
										<th>Sl. No.</th>
										<th>Customer ID</th>
										<th>Customer Name</th>
										<th>Account Number</th>
										<th>Deposit Amount</th>
									</tr>
								</thead>
							<tbody>
								<?php $i=0;?>
								<tr>
									@foreach ($ret_data['deposit_details'] as $row)
										<tr>
											<td>{{++$i}}</td>
											<td>{{ $row['user_id'] }}</td>
											<td>{{ $row['name'] }}</td>	
											<td>{{ $row['account_no'] }}</td>
											<td>{{ $row['amount']}}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
							
		