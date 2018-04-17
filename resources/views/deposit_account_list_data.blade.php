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
										@if($ret_data['deposit_category'] == "PG")
											<th>PIGMI Type</th>
										@endif
										<th>Customer Name</th>
										<th>Account Number</th>
										<th>Allocation Date</th>
										<th>Start Date</th>
										<th>End Date</th>
										<th>Total Balance</th>
										<th>
											<div>
												(editable<input id="closed_editable" type="checkbox" />)
											</div>
											Closed
										</th>
										<th>Action</th>
									</tr>
								</thead>
							<tbody>
								<?php $i=0;?>
								<tr>
									@foreach ($ret_data['deposit_details'] as $row)
										<tr>
											<td>{{++$i}}</td>
											<td>{{ $row['user_id'] }}</td>
											@if($ret_data['deposit_category'] == "PG")
												<td>{{ $row['pigmy_type'] }}</td>
											@endif
											<td>{{ $row['name'] }}</td>	
											<td style="width:50px;">{{ $row['account_no'] }}/{{ $row['old_account_no'] }}</td>
											<td>{{ $row['allocation_date']}}</td>
											<td>{{ $row['start_date']}}</td>
											<td>{{ $row['end_date']}}</td>
											<td>{{ $row['total_amount']}}</td>
											<td>
												<?php
													$selected_yes = "";
													$selected_no = "";
													
													if($row['closed'] == "YES") {
														$selected_yes = "selected";
													} else {
														$selected_no = "selected";
													}
													//{{ $row['closed']}}
												?>
												<select class="closed_edit" data="{{$row['allocation_id']}}">
													<option {{$selected_no}}>NO</option>
													<option {{$selected_yes}}>YES</option>
												</select>
											</td>
											<td>
												<div class="form-group">
													<div class="col-sm-12">
														<input type="button" value="EDIT" class="btn btn-info btn-sm edtbtn<?php //echo $pa['module']->Mid; ?>" href="ViewPigallocEdit/{{ $row['allocation_id'] }}"/>
													</div>
												</div>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
							
							<div id="toprint" class="hide_it">
							
							<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
								<thead>
									<tr>
										<th>Sl. No.</th>
										<th>Cus ID</th>
										@if($ret_data['deposit_category'] == "PG")
											<th>PIGMI Type</th>
										@endif
										<th>Customer Name</th>
										<th>Account Number</th>
										<th>Start Date</th>
										<th>End Date</th>
										<th>Total Balance</th>
										<th>Closed</th>
									</tr>
								</thead>
							<tbody>
								<?php $i=0;?>
								<tr>
									@foreach ($ret_data['deposit_details'] as $row)
										<tr>
											<td>{{++$i}}</td>
											<td>{{ $row['user_id'] }}</td>
											@if($ret_data['deposit_category'] == "PG")
												<td>{{ $row['pigmy_type'] }}</td>
											@endif
											<td>{{ $row['name'] }}</td>	
											<td style="width:50px;">{{ $row['account_no'] }}/{{ $row['old_account_no'] }}</td>
											<td style="width:50px;">{{ $row['start_date']}}</td>
											<td style="width:50px;">{{ $row['end_date']}}</td>
											<td>{{ $row['total_amount']}}</td>
											<td>{{ $row['closed'] }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
							
							
							</div>
							
		
<script>
	$(document).ready(function() {
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
			data:"&category=PG&closed="+closed+"&allocation_id="+allocation_id,
			success: function(data) {
				console.log("deposit_account_edit:done");
			}
		});
	}
	
	
</script>

<script>
	$('.edtbtn').click(function(e)
	{
		console.log("sfsd");
		e.preventDefault();
		$("#deposit_details_box").hide();
		$('#temp_box').load($(this).attr('href'));
	});
</script>