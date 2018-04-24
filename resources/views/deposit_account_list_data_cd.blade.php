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
										<th>Account Number</th>
										<th>Compulsory Deposit Amount</th>
										@if($ret_data["deposit_closed"] == 0)
											<th>Action</th>
										@endif
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
											<td>{{$row['account_no'] }}</td>
											<td>{{ $row['amount']}}</td>
											@if($ret_data["deposit_closed"] == 0)
												<td><button class="btn_pay btn-info btn-xs" data="{{$row['allocation_id']}}">Pay</button></td>
											@endif
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
							
		
<script>
	$(".btn_pay").click(function() {
		var allocation_id = $(this).attr("data");
		var day_open_status = {{$day_open_status}};
		if(day_open_status == {{DAY_IS_NOT_OPEN}}) {
			alert("DAY IS NOT OPEN!");
		} else if(day_open_status == {{DAY_IS_CLOSED}}) {
			alert("DAY IS CLOSED!");
		} else {
			$.ajax({
				url:"maturity_amount_pay_form",
				type:"post",
				data:"&allocation_id="+allocation_id,
				success:function(data) {
					$("#deposit_details_box").hide();
					$("#temp_box").html(data);
				}
			});
		}
	});
</script>