
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
									<th>Pending Amount</th> <?php /**/?>
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
											<td><a id="user_name_{{$row['loan_id']}}" class="user_name" href="" data="{{$row['loan_id']}}">{{ $row['name'] }}</a></td>
											<td style="width:50px;">{{ $row['loan_no'] }}/{{ $row['loan_old_no'] }}</td>
											<td>{{ $row['dep_type']}} ({{$row["deposit_account_no"]}})</td>
											<td>{{ $row['loan_amount']}}</td>
											<td>{{ $row['start_date']}}</td>
											<td>{{ $row['end_date']}}</td>
											<td>{{ $row['ramaining_amount']}}</td> <?php /**/?>
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
		show_loading_img("#page_2");
		$('#page_2').load($(this).attr('href'));
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

<script>
	$(".user_name").click(function(e) {
		e.preventDefault();
		var loan_id = $(this).attr("data");

		$.ajax({
			url:"view_loan_data",
			type:"post",
			data:"&category=DL"+"&loan_id="+loan_id,
			success: function(data) {
				console.log("done");
				$("#loan_details_box").hide();
				show_loading_img("#page_2");
				$('#page_2').html(data);
			}
		});

	});
</script>
