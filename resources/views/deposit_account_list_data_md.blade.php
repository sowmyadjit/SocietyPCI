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
										<th>Maturity Deposit Amount</th>
										@if($ret_data["deposit_closed"] == 0)
											<th>Action</th>
										@endif
									</tr>
								</thead>
							<tbody>
								<?php $i=0;?>
								<tr>
									<?php
										$total_dep_amt = 0;
									?>
									@foreach ($ret_data['deposit_details'] as $row)
										<?php
											$total_dep_amt += $row['maturity_amount'];
										?>
										<tr>
											<td>{{++$i}}</td>
											<td>{{ $row['user_id'] }}</td>
											<td>{{ $row['name'] }}</td>	
											<td>{{$row['account_no'] }}</td>
											<td>{{ $row['maturity_amount']}}</td>
											@if($ret_data["deposit_closed"] == 0)
												<td><button class="btn_pay btn-info btn-xs" data="{{$row['allocation_id']}}">Pay</button></td>
											@endif
										</tr>
									@endforeach
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td><b>{{$total_dep_amt}}</b></td>
										<td></td>
									</tr>
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
											<td>{{$row['account_no'] }}</td>
											<td>{{ $row['maturity_amount']}}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
							
		
<script>
	$(".btn_pay").click(function() {
		//console.log("all_id:"+$(this).attr("data"));
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
					//console.log("maturity_amount_pay_form: done");
					//console.log(data);
					$("#deposit_details_box").hide();
					$("#temp_box").html(data);
				}
			});
		}
	});
</script>


<script>
/*	$(document).ready(function() {
		disable_closed_state_edit();
	});
	
	$("#closed_editable").change(function() {
		if($(this).prop("checked")) {
			enable_closed_state_edit();
		} else {
			disable_closed_state_edit();
		}
	});
	
	function enable_closed_state_edit() {
		$('.closed_edit').prop("disabled",false);
	}
	
	function disable_closed_state_edit() {
		$('.closed_edit').prop("disabled",true);
	}
	
	$(".closed_edit").change(function() {
		var allocation_id = $(this).attr("data");
		var closed = $(this).val();
		console.log("allocation_id="+allocation_id+"\n colsed="+closed);
		deposit_account_edit(allocation_id,closed);
	});
	
	function deposit_account_edit(allocation_id,closed) {
		$.ajax({
			url:"deposit_account_edit",
			type:"post",
			data:"&category=KCC&closed="+closed+"&allocation_id="+allocation_id,
			success: function(data) {
				console.log("deposit_account_edit:done");
			}
		});
	}*/
	
	
</script>

<script>
	/*$('.CertiBtn, .ReceiptPrint, .custdet').click(function(e)
	{
		console.log("sfsd");
		e.preventDefault();
		$("#deposit_details_box").hide();
		$('#temp_box').html("Loading...");
		$('#temp_box').load($(this).attr('href'));
	});*/
</script>