
							<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
							<thead>
								<tr>
									<th>SL NO.</th>
									<th>Customer ID</th>
									<th>Name</th>
									<th style="width:50px;">Loan Number</th>
									<th>Dep. Type</th>
									<th>Loan Amount</th>
									<th>Start Date</th>
									<th>End Date</th>
								<?php /*	<th>Pending Amount</th> */?>
									<th>Close</th>
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
									<?php
										$total_ln_amt = 0;
										$total_rm_amt = 0;
									?>
									@foreach ($ret_data['loan_details'] as $row)
										<?php
											$total_ln_amt += $row['loan_amount'];
											$total_rm_amt += $row['ramaining_amount'];
										?>
										<tr>
											<td>{{++$i}}</td>
											<td>{{ $row['user_id'] }}</td>
											<td>{{ $row['name'] }}</td>	
											<td style="width:50px;">{{ $row['loan_no'] }}/{{ $row['loan_old_no'] }}</td>
											<td>{{ $row['dep_type']}}</td>
											<td>{{ $row['loan_amount']}}</td>
											<td>{{ $row['start_date']}}</td>
											<td>{{ $row['end_date']}}</td>
										<?php /*	<td>{{ $row['ramaining_amount']}}</td> */?>
											<td>{{ $row['closed']}}</td>
											
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
												<select class="closed_edit" data="{{$row['loan_id']}}">
													<option {{$selected_no}}>NO</option>
													<option {{$selected_yes}}>YES</option>
												</select>
											</td>
											<td>
												<div class="form-group">
													<div class="col-sm-12">
														<input type="button" value="Receipt" class="btn btn-info btn-sm edtbtn" href="dlloanrecepit/{{ $row['loan_id'] }}"/>
													</div>
												</div>
											</td>	
										</tr>
									@endforeach
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td><b>{{$total_ln_amt}}</b></td>
										<td></td>
										<td></td>
									<?php /*	<td><b>{{$total_rm_amt}}</b></td> */ ?>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								</tbody>
							</table>
							
							
							
	

<script>
	$('.edtbtn').click(function(e)
	{
		e.preventDefault();
		$("#loan_details_box").hide();
		$('#receipt_box').load($(this).attr('href'));
	});
</script>



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
		var loan_id = $(this).attr("data");
		var closed = $(this).val();
		console.log("loan_id="+loan_id+"\n colsed="+closed);
		deposit_account_edit(loan_id,closed);
	});	
	
	function deposit_account_edit(loan_id,closed) {
		$.ajax({
			url:"account_list_edit",
			type:"post",
			data:"&category=DL&closed="+closed+"&loan_id="+loan_id,
			success: function(data) {
				console.log("deposit_account_edit:done");
			}
		});
	}
	
	
</script>
